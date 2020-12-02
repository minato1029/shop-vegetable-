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
            $product_code = $_POST['code'];
            $product_picture_name = $_POST['picture_name'];

            $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $user = 'root';
            $password = '';
            $dbh = new PDO($dsn, $user, $password);
            $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = 'delete from mst_product where code=?';
            $stmt = $dbh -> prepare($sql);
            $data[] = $product_code;

            $stmt -> execute($data);

            $dbh = null;

            if ($product_picture_name != ""){
                unlink('./picture/'.$product_picture_name);
            }

        }catch (Exception $e) {
            print '<br>ただいま障害が起きています';
            exit();
        }
    ?>

    削除しました。<br>
    <a href="product_list.php">戻る</a>

</body>
</html>
