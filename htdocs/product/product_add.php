<?php
session_start();
session_regenerate_id(true);
if (isset($_SESSION['login'])==false) {
    print 'ログインされていません<br>';
    print '<a href="../login/staff_login.html">ログイン画面へ</a>';
    exit();
}else {
    print $_SESSION['staff_name'];
    print 'さん　ログイン中<br><br>';
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ろくまる農園</title>
</head>
<body>
    <p>商品追加</p>
    <form action="product_add_check.php" method="post" style="width: 400px" enctype="multipart/form-data">
        <p>商品名を追加してください</p>
        <input type="text" name="name" style="width: 200px">
        <p>価格を入力してください</p>
        <input type="text" name="price" style="width: 50px"><br>
        <p>画像を選んで下さい</p>
        <input type="file" name="picture" style="width: 400px"><br>
        <br>
        <input type="button" onclick="history.back()" value="戻る">
        <input type="submit" value="OK">
    </form>
</body>
</html>
