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
<form action="{{url('goods/store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <table>
        <tr>
            <td>商品名称</td>
            <td><input type="text" name="goods_name"></td>
        </tr>
        <tr>
            <td>商品价格</td>
            <td><input type="text" name="shop_price"></td>
        </tr>
        <tr>
            <td>关键词</td>
            <td><input type="text" name="keywords"></td>
        </tr>
        <tr>
            <td>商品运输</td>
            <td><input type="text" name="goods_desc"></td>
        </tr>
        <tr>
            <td>商品图片</td>
            <td><input type="file" name="goods_img"></td>
        </tr>
        <tr>
            <td>是否删除</td>
            <td>
                <input type="radio" name="is_delete" value="1">是
                <input type="radio" name="is_delete" value="2">否
            </td>
        </tr>
        <tr>
            <td>销售价格</td>
            <td><input type="text" name="is_delete"></td>
        </tr>
        <tr>
            <td><input type="submit" value="添加"></td>
            <td></td>
        </tr>
    </table>
</form>
</body>
</html>