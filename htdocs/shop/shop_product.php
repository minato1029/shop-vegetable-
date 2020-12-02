<?php
session_start();
session_regenerate_id(true);
if (isset($_SESSION['member_login'])==false) {
    print 'ようこそゲスト様<br>';
    print '<a href="member_login.html">会員ログイン</a><br>';
    print '<br>';
}else {
    print 'Welcome ';
    print $_SESSION['member_name'];
    print '様　';
    print '<a href="member_logout.php">ログアウト</a><br><br>';
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
            $product_code = $_GET['procode'];

            $dsn = 'mysql:dbname=shop;host=localhost;charset-utf8';
            $user = 'root';
            $password = '';
            $dbh = new PDO($dsn, $user, $password);
            $dbh ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = 'select name, price, picture from mst_product where code = ?';
            $stmt = $dbh -> prepare($sql);
            $data[] = $product_code;
            $stmt -> execute($data);

            $rec = $stmt -> fetch(PDO::FETCH_ASSOC);
            $product_name = $rec['name'];
            $product_price = $rec['price'];
            $product_picture_name = $rec['picture'];

            $dbh = null;

            if ($product_picture_name==''){
                $picture_display = '';
            }else {
                $picture_display = '<img src="../product/picture/'.$product_picture_name.'">';
            }
            print '<a href="shop_cartin.php?procode='.$product_code.'">カートに入れる</a><br><br>';


        }catch (Exception $e) {
            print '障害が発生しています';
            exit();
        }
    ?>

    商品情報参照<br>
    <br>

    商品コード<br>
    <?php print $product_code; ?><br>
    <br>
    商品名<br>
    <?php print $product_name; ?><br>
    <br>
    価格<br>
    <?php print $product_price; ?><br>
    <br>
    <?php print $picture_display; ?>
    <form>
        <input type="button" onclick="history.back()" value="戻る">
    </form>

</body>
</html>
