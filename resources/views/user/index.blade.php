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
<from>
    @csrf
    <table border="1">
        <tr>
            <td>id</td>
            <td>用户名</td>
            <td>邮箱</td>

            <td>注册时间</td>
            <td>最后登录时间</td>
            <td>最后登录ip</td>
            <td>登录次数</td>
            <td>操作</td>
        </tr>
        @foreach($res as $v)

            <tr>
                <td>{{$v->uid}}</td>
                <td>{{$v->user_name}}</td>
                <td>{{$v->email}}</td>
                <td>{{$v->reg_time}}</td>
                <td>{{$v->last_login}}</td>
                <td>{{$v->last_ip}}</td>
                <td>{{$v->login_count}}</td>
                <td>
                    <a href="{{url('user/edit/'.$v->uid)}}">编辑</a>
                    <a href="{{url('user/destroy/'.$v->uid)}}">删除</a>
                </td>
            </tr>
    @endforeach
    </table>
</from>
</body>
</html>
