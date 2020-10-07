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
<table>
    <tr>
        <td>id</td>
        <td>名称</td>
        <td>性别</td>
        <td>年龄</td>
        <td>身份证号</td>
        <td>操作</td>
    </tr>
    @foreach($res as $v)
    <tr>
        <td>{{$v->s_id}}</td>
        <td>{{$v->s_name}}</td>
        <td>{{$v->s_esx}}</td>
        <td>{{$v->s_age}}</td>
        <td>{{$v->s_card}}</td>
        <td>
            <a href="{{url('student/edit/'.$v->s_id)}}">编辑</a>
            <a href="{{url('student/destroy/'.$v->s_id)}}">删除</a>
        </td>
    </tr>
        @endforeach
</table>
</body>
</html>
