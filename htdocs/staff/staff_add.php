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
    <p>スタッフ追加</p>
    <form action="staff_add_check.php" method="post" style="width: 400px">
        <p>スタッフ名を追加してください</p>
        <input type="text" name="name" style="width: 200px">
        <p>パスワードを入力してください</p>
        <input type="password" name="pass" style="width: 200px">
        <p>パスワードをもう一度入力してください</p>
        <input type="password" name="pass2" style="width: 200px">
        <br><br>
        <input type="button" onclick="history.back()" value="戻る">
        <input type="submit" value="OK">
    </form>
</body>
</html>
