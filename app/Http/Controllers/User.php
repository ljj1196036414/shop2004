<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use app\model\Admin\User as UserModel;
class User extends Controller
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
        //dd($data);
        $res=DB::table('user')->where('user_name',$data['user_name'])->first();
       if(!$res){
           return redirect('user/login')->with('msg','用户名或者密码不正确');
       }
        if($res->password!=$data['password']){
            return redirect('user/login')->with('msg','用户名或者密码不正确');
        }
        request()->session()->put('userlogin',$res);
        $data['last_login']=time();
        DB::table('user')->where('uid',$res->uid)->update($data);
        return redirect('user/index');
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
        $data=$request->except('_token');
        $data['reg_time']=time();
        //dd($data);
        $res=DB::table('user')->insert($data);
        if($res){
            return redirect('user/index');
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
