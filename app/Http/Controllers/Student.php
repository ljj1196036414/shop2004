<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\model\Admin\Student as StudentModel;
class Student extends Controller
{
    public function create(){
        return view('student/create');
    }
    public function save(Request $request){
        $post=$request->except('_token');
        //dd(11);
        $res=StudentModel::insert($post);
        if($res){
            return redirect('student/index');
        }
    }
    public function index(){
        //从一个数据表中获取所有行  查询构造器  DB
        //$res=DB::table('student')->get();
        //从一个数据表中获取所有行   model   StudentModel
        //$res=StudentModel::all();
        //从一个数据表中获取一行   询构造器  DB
        //$res=DB::table('student')->where('s_name','李俊鲸')->first();
        //从一个数据表中获取一列   询构造器  DB
        $res=DB::table('student')->pluck('s_name');
        dd($res);
        return view('student.index',['res'=>$res]);
    }
    public function destroy($s_id){
        $res=StudentModel::destroy($s_id);
        return redirect('student/index');
    }
    public function edit($s_id){
        $res=StudentModel::find($s_id);
        return view('student/edit',['res'=>$res]);
    }
    public function update(Request $request,$s_id){
        $post=$request->except('_token');
        $res=StudentModel::where('s_id',$s_id)->update($post);
        if($res){
            return redirect('student/index');
        }
    }
}
