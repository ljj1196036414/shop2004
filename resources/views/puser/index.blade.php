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

            <td>问题</td>
            <td>回答</td>
            <td>性别</td>
            <td>生日</td>
            <td>用户钱</td>
            <td>冻结资金</td>
            <td>支付点</td>
            <td>秩点</td>
            <td>地址id</td>
            <td>时间</td>
            <td>最后登录时间</td>
            <td>最后ip</td>
            <td>访问计数</td>
            <td>化名</td>
            <td>被验证</td>
            <td>操作</td>
        </tr>
        @foreach($res as $v)

            <tr>
                <td>{{$v->user_id}}</td>
                <td>{{$v->user_name}}</td>
                <td>{{$v->question}}</td>
                <td>{{$v->answer}}</td>
                <td>{{$v->sex}}</td>
                <td>{{$v->bithday}}</td>
                <td>{{$v->user_money}}</td>
                <td>{{$v->frozen_money}}</td>
                <td>{{$v->pay_points}}</td>
                <td>{{$v->rank_points}}</td>
                <td>{{$v->address_id}}</td>
                <td>{{date('Y-m-d H:i:s'),$v->reg_time}}</td>
                <td>{{$v->last_login}}</td>
                <td>{{$v->last_ip}}</td>
                <td>{{$v->visit_count}}</td>
                <td>{{$v->alias}}</td>
                <td>{{$v->is_validated}}</td>
                <td>
                    <a href="{{url('puser/edit/'.$v->user_id)}}">编辑</a>
                    <a href="{{url('puser/destroy/'.$v->user_id)}}">删除</a>
                </td>
            </tr>
        @endforeach
    </table>
</from>
</body>
</html>
