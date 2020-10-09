<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<table border="1">
    <tr>
        <td>id</td>
        <td>分类</td>
        <td>商品sn</td>
        <td>商品名称</td>
        <td>点击计数</td>
        <td>商品编号</td>
        <td>商品价格</td>
        <td>关键词</td>

        <td>商品图片</td>
        <td>时间</td>
        <td>是否删除</td>
        <td>销售价格</td>
        <td>操作</td>
    </tr>
    @foreach($res as $v)
    <tr>
        <td>{{$v->goods_id}}</td>
        <td>{{$v->cat_id}}</td>
        <td>{{$v->goods_sn}}</td>
        <td>{{$v->goods_name}}</td>
        <td>{{$v->click_count}}</td>
        <td>{{$v->goods_number}}</td>
        <td>{{$v->shop_price}}</td>
        <td>{{$v->keywords}}</td>
        <td>@if($v->goods_img)<img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" width="50">@endif</td>
        <td>{{$v->add_time}}</td>
        <td>{{$v->is_delete}}</td>
        <td>{{$v->sale_num}}</td>
        <td>
            <a href="{{url('goods/destroy/'.$v->goods_id)}}">删除</a>
            <a href="{{url('goods/edit/'.$v->goods_id)}}">编辑</a>
        </td>
    </tr>
    @endforeach
</table>
</body>
</html>