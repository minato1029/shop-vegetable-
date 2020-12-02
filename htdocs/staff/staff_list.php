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
            $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $user = 'root';
            $password = '';
            $dbh = new PDO($dsn, $user, $password);
            $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = 'select code, name from mst_staff where 1';
            $stmt = $dbh -> prepare($sql);
            $stmt -> execute();

            $dbh = null;

            print 'スタッフ一覧<br><br>';

            print '<form method="post" action="staff_branch.php">';

            while(true) {
                $rec = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($rec == false) {
                    break;
                }
                print '<input type="radio" name="staffcode" value="'.$rec['code'].'">';
                print $rec['name'];
                print '<br>';
            }
            print '<input type="submit" name="display" value="参照">';
            print '<input type="submit" name="edit" value="修正">';
            print '<input type="submit" name="delete" value="削除">';
            print '<input type="submit" name="add" value="追加">';
            print '</form>';

        }catch(Exception $e) {
            print 'ただいま障害が発生しています';
            exit();
        }
    ?>

    <a href="../login/staff_top.php">トップメニューへ</a><br>
</body>
</html>
