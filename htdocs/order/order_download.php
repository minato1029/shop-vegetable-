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
    <?php require_once ('../common/common.php'); ?>
    <p>ダウンロードしたい注文日を選んでください</p>
    <form action="order_download_done.php" method="post">
        <?php pulldown_year(); ?>
        年
        <?php pulldown_month(); ?>
        月
        <?php pulldown_day(); ?>
        日<br>
        <br>
        <input type="submit" value="To Download">
    </form>
</body>
</html>
