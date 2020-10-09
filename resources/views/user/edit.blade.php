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
{{--{{session('msg')}}--}}
{{--@if($error->any())--}}
{{--    <div class="alert alert-danger">--}}
{{--        <ul>--}}
{{--            @foreach($errors->all() as $error)--}}
{{--                <li>{{$error}}</li>--}}
{{--                @endforeach--}}
{{--        </ul>--}}
{{--    </div>--}}
<form action="{{url('user/update/'.$res->uid)}}" method="post">
    @csrf
    <table border="1">
        <tr>
            <td>用户名</td>
            <td><input type="text" name="user_name" value="{{$res->user_name}}"></td>
        </tr>
        <tr>
            <td>邮箱</td>
            <td><input type="email" name="email" value="{{$res->email}}"></td>
        </tr>
        <tr>
            <td>手机号</td>
            <td><input type="test" name="phone" value="{{$res->phone}}"></td>
        </tr>
        <tr>
            <td>密码</td>
            <td><input type="password" name="password" value="{{$res->password}}"></td>
        </tr>
        <tr>
            <td>邮箱</td>
            <td><input type="email" name="email" value="{{$res->email}}"></td>
        </tr>
        <tr>
            <td>添加</td>
            <td><input type="submit" value="编辑"></td>
        </tr>

    </table>
</form>
</body>
</html>