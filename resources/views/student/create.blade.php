<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<form action="{{url('student/save')}}" method="post">
    @csrf
    <table border="1">
        <tr>
            <td>名称</td>
            <td>
                <input type="text" name="s_name">

            </td>
        </tr>
        <tr>
            <td>性别</td>
            <td><input type="radio" value="1" name="s_esx" checked>男
                <input type="radio" value="2" name="s_esx">女</td>
        </tr>
        <tr>
            <td>年龄</td>
            <td><input type="text" name="s_age"></td>
        </tr>
        <tr>
            <td>身份证号</td>
            <td><input type="text" name="s_card"></td>
        </tr>
        <tr>
            <td><input type="submit" value="添加"></td>
        </tr>

    </table>
</form>

</body>
</html>
