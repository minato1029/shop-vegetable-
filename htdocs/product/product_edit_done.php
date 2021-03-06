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
            require_once('../common/common.php');
            $post = sanitize($_POST);

            $product_code = $post['code'];
            $product_name = $post['name'];
            $product_price = $post['price'];
            $product_picture_name_old = $post['picture_name_old'];
            $product_picture_name = $post['picture_name'];

            $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $user = 'root';
            $password = '';
            $dbh = new PDO($dsn, $user, $password);
            $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = 'UPDATE mst_product SET name=?, price=?, picture=? WHERE code=?';
            $stmt = $dbh -> prepare($sql);
            $data[] = $product_name;
            $data[] = $product_price;
            $data[] = $product_picture_name;
            $data[] = $product_code;

            $stmt -> execute($data);

            $dbh = null;

            if ($product_picture_name_old != "" && $product_picture_name_old != $product_picture_name){
                unlink('./picture/'.$product_picture_name_old);
            }

            print $product_name;
            print '<br>を修正しました。 <br />';

        }catch (Exception $e) {
            print '<br>ただいま障害が起きています';
            exit();
        }
    ?>

    <a href="product_list.php">戻る</a>

</body>
</html>
