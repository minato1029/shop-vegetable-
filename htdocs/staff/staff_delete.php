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
    <?php
        try {
            $staff_code = $_GET['staffcode'];

            $dsn = 'mysql:dbname=shop;host=localhost;charset-utf8';
            $user = 'root';
            $password = '';
            $dbh = new PDO($dsn, $user, $password);
            $dbh ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = 'select name from mst_staff where code = ?';
            $stmt = $dbh -> prepare($sql);
            $data[] = $staff_code;
            $stmt -> execute($data);

            $rec = $stmt -> fetch(PDO::FETCH_ASSOC);
            $staff_name = $rec['name'];

            $dbh = null;

        }catch (Exception $e) {
            print '障害が発生しています';
            exit();
        }
    ?>

    スタッフ削除<br><br>

    スタッフコード<br>
    <?php print $staff_code; ?>
    <br>
    スタッフ名<br>
    <?php print $staff_name; ?><br>
    <br>
    このスタッフを削除してよろしいですか？<br>
    <br>
    <form method="post" action="staff_delete_done.php">
        <input type="hidden" name="code" value="<?php print $staff_code ?>">
        <input type="button" onclick="history.back()" value="戻る">
        <input type="submit" value="OK">
    </form>

</body>
</html>
