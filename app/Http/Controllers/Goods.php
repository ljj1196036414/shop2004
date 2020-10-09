<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\Admin\Goods as GoodsModel;
class Goods extends Controller
{
    /**
     * Display a listing of the resource.
     *商品的详情
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res=GoodsModel:: orderBy('goods_id','desc')->limit(10)->get();
        //dd($res);
        return view('goods/index',['res'=>$res]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('goods/create');
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
        //文件上传
        if($request->hasFile('goods_img')){
            $data['goods_img']=$this->upload('goods_img');
        }
        //dd($data);
        $res=GoodsModel::insert($data);
        if($res){
            return redirect('goods/index');
        }
    }
    public function upload($filename){
        $file=request()->file($filename);
        if($file->isValid()){
            $pach=$file->store('uploads');
            return $pach;
        }
        exit('文件上传过程出错');
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
    public function edit($id)
    {

        $res=GoodsModel::where('goods_id',$id)->find();
        return view('goods/edit',['res'=>$res]);
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
        $data=$request->except('_topen');
        $res=GoodsModel::where('goods_id',$id)->update($data);
        if($res){
            return view('goods/index');
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
        $res=GoodsModel::destroy($id);
            return redirect('goods/index');
    }
}
