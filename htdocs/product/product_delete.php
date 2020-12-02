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
            $product_code = $_GET['productcode'];

            $dsn = 'mysql:dbname=shop;host=localhost;charset-utf8';
            $user = 'root';
            $password = '';
            $dbh = new PDO($dsn, $user, $password);
            $dbh ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = 'select name, picture from mst_product where code = ?';
            $stmt = $dbh -> prepare($sql);
            $data[] = $product_code;
            $stmt -> execute($data);

            $rec = $stmt -> fetch(PDO::FETCH_ASSOC);
            $product_name = $rec['name'];
            $product_picture_name = $rec['picture'];

            $dbh = null;

            if ($product_picture_name == ""){
                $picture_display = "";
            }else {
                $picture_display = '<img src="./picture/'.$product_picture_name.'"">';
            }

        }catch (Exception $e) {
            print '障害が発生しています';
            exit();
        }
    ?>

    商品削除<br><br>

    商品コード<br>
    <?php print $product_code; ?>
    <br>
    商品名<br>
    <?php print $product_name; ?><br>
    <br>
    <?php print $picture_display ?><br>
    この商品を削除してよろしいですか？<br>
    <br>
    <form method="post" action="product_delete_done.php">
        <input type="hidden" name="code" value="<?php print $product_code ?>">
        <input type="hidden" name="picture_name" value="<?php print $product_picture_name ?>">
        <input type="button" onclick="history.back()" value="戻る">
        <input type="submit" value="OK">
    </form>

</body>
</html>
