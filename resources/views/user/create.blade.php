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
{{session('msg')}}
<form action="{{url('user/store')}}" method="post">
    @csrf
    <table>
        <tr>
            <td>用户名</td>
            <td><input type="text" name="user_name" placeholder="请输入名称">
                <b style="color:red">{{$errors->first('user_name')}}</b></td>
        </tr>
        <tr>
            <td>邮箱</td>
            <td><input type="email" name="email" placeholder="请输入邮箱">
                <b style="color:red">{{$errors->first('email')}}</b></td></td>
        </tr>
        <tr>
            <td>手机号</td>
            <td><input type="text" name="phone"  placeholder="请输入手机号">
                <b style="color:red">{{$errors->first('phone')}}</b></td></td>
        </tr>
        <tr>
            <td>密码</td>
            <td><input type="password" name="password" placeholder="请输入密码">
                <b style="color:red">{{$errors->first('password')}}</b></td></td>
        </tr>
        <tr>
            <td>确认密码</td>
            <td><input type="password" name="passwords" placeholder="请确认密码">
                <b style="color:red">{{$errors->first('passwords')}}</b></td></td>
        </tr>
        <tr>
            <td>添加</td>
            <td><input type="submit" value="注册"></td>
        </tr>

    </table>
    </form>
</body>
</html>