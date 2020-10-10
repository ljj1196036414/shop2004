<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\model\Admin\UserModel;
use Illuminate\Support\Facades\Redis;
use Validator;
use Illuminate\Support\Facades\Cookie;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $res=DB::table('user')->get();
       return view('user/index',['res'=>$res]);
    }
    //登录页面
    public function login(){
        return view('user/login');
    }
    public function logins(Request $request){
        $data=$request->except('_token');
        //使用Laravel封装的方法来获取用户的真实ip地址
        $ip=$request->getClientIp();
        $UserModel=new UserModel();
        //存一个redis  keys
        $res=UserModel::where('user_name',$data['user_name'])
            ->orwhere('email',$data['user_name'])
            ->orwhere('phone',$data['user_name'])
            ->first();
        //dd($res);
        if(empty($res)){
            return redirect('user/login')
                ->with(['msg'=>'用户不存在']);
        }
        $key='login:login_count:'.$data['user_name'];
        //ceil 取整
        //  TTL设置时间
        // login_time名 自定义
        $login_time=ceil(Redis::TTL("login_time:".$res['uid'])/60);
        //get 获取
        //如果用户的一小时锁定时间 去 / (除以) 60去取整
        //反馈给用户还剩余多少时间可重新操作登录
        if(!empty(Redis::get('login_time:'.$res['uid']))){
            return redirect('user/login')
                ->with(['msg'=>'该账户密码输入错误次数过多,已锁定一小时,剩余时间'.$login_time.'分钟']);
        }

        //dd($ddd);
        // 判断用户是否已经锁定
        if(Redis::get("login_count:".$res['uid'])>=4){
            Redis::setex("login_time:".$res['uid'],3600,Redis::get("login_count:".$res['uid']));
            return redirect('user/login')
                ->with(['msg'=>'该账户密码输入错误次数过多,已锁定一小时']);
        }
        if(password_verify($data['password'],$res['password'])){
            // 如果用户登录成功 并且 账号的status(状态)不在锁定状态，也就是说用户的错误次数没有超过一定的限制
            // 下边这个操作是讲该用户的登录的错误次数设置为null(空)
            /**
             * Redis::setex
             * 使用Redis来定义一个
             * 第一个参数为键
             * 第二个参数为过期时间(单位为:秒)
             * 第三个参数设置为键所对应的值(这里不是规范)
             */
            Redis::setex("login_count:".$res['uid'],1,Redis::get("login_count:".$res['uid']));
            $logininfo=['last_login'=>time(),'last_ip'=>$ip,'login_count'=>$res['login_count']+1];
            $UserModel->where('uid',$res['uid'])->update($logininfo);
            return redirect('goods/index');
        }else{
                // 判断用户是不是第一次错误 如果是第一次错误则释放出一个属于第一次的时间领域
                /**
                 * Redis::setex
                 * 使用Redis来定义一个
                 * 第一个参数为键
                 * 第二个参数为过期时间(单位为:秒)
                 * 第三个参数设置为键所对应的值
                 */
                if(empty(Redis::get("login_count:".$res['uid']))){//设置一个10分钟的时间领域
                    Redis::setex("login_count:".$res['uid'],600,Redis::get("login_count:".$res['uid']));
                }
                // 来设置用户的错误次数
                Redis::incr("login_count:".$res['uid']);
                return redirect('user/login')->with(['msg'=>'您输入的账号或密码有误,错误次数:'.Redis::get("login_count:".$res['uid'])]);

            }
        request()->session()->put('userlogin',$res);
        return redirect('goods/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user/create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_name'=>'required|unique:user',
            'password'=>'required',
            'email'=>'required|unique:user',
            'phone'=>'required|unique:user',
            'passwords'=>'required|unique:user',
            ],[
        'user_name.required'=>'名称必填',
        'user_name.regex'=>'名称为汉字',
        'user_name.unique'=>'名称已存在',
        'password.required'=>'密码必填',
        'email.unique'=>'邮箱已存在',
        'email.required'=>'邮箱必填',
        'phone.unique'=>'手机号已存在',
        'phone.required'=>'手机号必填',
    ]);
        if ($validator->fails()) {
            return redirect('user/create')
                ->withErrors($validator)
                ->withInput();
        }
        $data=$request->except('_token');
        if($data['password']!=$data['passwords']){
            return redirect('user/create')->with('msg','两次密码不一样');
        }
        $data['password']=password_hash($data['password'],PASSWORD_DEFAULT);
        $data['reg_time']=time();
        unset($data['passwords']);
        //dd($data);
        $res=UserModel::insert($data);
        if($res){
            return redirect('user/login');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $uid
     * @return \Illuminate\Http\Response
     */
    public function edit($uid)
    {
        $res=DB::table('user')->where('uid',$uid)->first();
        //dd($res);
        return view('user/edit',['res'=>$res]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data=$request->except('_token');
        $res=DB::table('user')->where('uid',$id)->update($data);
        $res=DB::table('user')->get();
        //dd($res);
        if($res){
            return view('user/index',['res'=>$res]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res=DB::table('user')->where('uid',$id)->delete();
        return view('user/index');
    }
}
