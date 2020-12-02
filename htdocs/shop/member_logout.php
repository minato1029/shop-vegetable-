<?php
    session_start();
    $_SESSION = array();

    if (isset($_COOKIE[session_name()])==true) {
        setcookie(session_name(), '', time()-42000, '/');
    }
    session_destroy();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ろくまる農園</title>
</head>
<body>
    <p>ログアウトしました</p><br>
    <br>
    <a href="shop_list.php">商品一覧へ</a>
</body>
</html>

