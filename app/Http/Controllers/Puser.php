<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\Admin\Puser as PuserModel;
class Puser extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res=PuserModel::limit('10')->get();
        return view('puser/index',['res'=>$res]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('puser/puser');
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
       // dd($data);
        $res=PuserModel::insert($data);
        //dd($res);
        if($res){
            return redirect('puser/index');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id)
    {
        $res=PuserModel::find($user_id);
       // dd($res);
        return view('puser/edit',['res'=>$res]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id)
    {
        $data=$request->except('_token');
        $res=PuserModel::where('user_id',$user_id)->update($data);
        if($res){
            return redirect('puser/index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id)
    {
        $res=PuserModel::where('user_id',$user_id)->delete();
        if($res){
            return redirect('puser/index');
        }

    }
}
