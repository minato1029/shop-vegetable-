<?php
    session_start();
    session_regenerate_id(true);
    if (isset($_SESSION['login'])==false) {
        print 'ログインされていません<br>';
        print '<a href="../login/staff_login.html">ログイン画面へ</a>';
        exit();
    }else {
        print $_SESSION['staff_name'];
        print 'さん　ログイン中';
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ろくまる農園</title>
</head>
<body>
    <p>ショップ管理トップメニュー</p>
    <a href="../staff/staff_list.php">スタッフ管理</a><br>
    <a href="../product/product_list.php">商品管理</a><br>
    <a href="../order/order_download.php">注文ダウンロード</a><br>
    <br>
    <a href="staff_logout.php">ログアウト</a><br>
</body>
</html>
