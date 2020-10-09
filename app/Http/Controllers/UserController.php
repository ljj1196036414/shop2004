<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\model\Admin\UserModel;
use Illuminate\Support\Facades\Redis;
use Validator;
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
        $data['last_login']=time();
        $reg='/^1[3|4|5|6|7|8|9]\d{9}$/';
        $reg_email='/^\w{3,}@([a-z]{2,7}|[0-9]{3}\.(com|cn))$/';
        $res=UserModel::where('user_name',$data['user_name'])
            ->orwhere('email',$data['user_name'])
            ->orwhere('phone',$data['user_name'])
            ->first();
       /*if(!$res){
           return redirect('user/login')->with('msg','用户名不存在');
       }
        if(password_verify($res->password ,$data['password'])){

            return redirect('user/login')->with('msg','密码错误');die;
        }*/
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
    public function showProfile()
    {
        Redis::set('name','lijunjing');
        $res=Redis::get('name');
        dd($res);
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
