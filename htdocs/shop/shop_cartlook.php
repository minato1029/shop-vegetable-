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
            
            if (isset($_SESSION['cart'])==true){
                $cart = $_SESSION['cart'];
                $amount = $_SESSION['amount'];
                $max = count($cart);
            }else {
                $max = 0;
            }
            if ($max==0){
                print 'カートに商品が入っていません<br><br>';
                print '<a href="shop_list.php">商品一覧へ戻る</a>';
                exit();
            }

            $dsn = 'mysql:dbname=shop;host=localhost;charset-utf8';
            $user = 'root';
            $password = '';
            $dbh = new PDO($dsn, $user, $password);
            $dbh ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            foreach ($cart as $key => $val){
                $sql = 'SELECT code, name, price, picture FROM mst_product WHERE code=?';
                $stmt = $dbh -> prepare($sql);
                $data[0] = (int)$val;
                $stmt -> execute($data);

                $rec = $stmt -> fetch(PDO::FETCH_ASSOC);

                $product_name[] = $rec['name'];
                $product_price[] = $rec['price'];
                if ($rec['picture'] == ''){
                    $product_picture[] = '';
                }else {
                    $product_picture[] = '<br><img src="../product/picture/'.$rec['picture'].'">';
                }
            }
            $dbh = null;

        }catch (Exception $e) {
            print '障害が発生しています';
            exit();
        }
    ?>

    <p>カートの中身</p>
    <form action="amount_change.php" method="post">
        <table border="solid">
            <tr>
                <td>商品</td>
                <td>商品画像</td>
                <td>価格</td>
                <td>数量</td>
                <td>小計</td>
                <td>削除</td>
            </tr>
            <?php   for ($i = 0; $i < $max; $i++ ){ ?>
            <tr>
                <td><?php        print $product_name[$i]; ?></td>
                <td><?php        print $product_picture[$i]; ?></td>
                <td><?php        print $product_price[$i].'円'; ?></td>
                <td><input type="text" name="amount<?php print $i ?>" value="<?php print $amount[$i] ?>" style="width: 50px; margin-left:20px "> 個</td>
                <td><?PHP print $product_price[$i]*$amount[$i];?>円</td>
                <td><input type="checkbox" name="delete<?php print $i ?>"><br></td>
            </tr>
            <?PHP } ?>
            <input type="hidden" name="max" value="<?php print $max ?>"><br>
            <input type="submit" value="数量変更"><br>
            <input type="button" onclick="history.back()" value="戻る">
        </table>
    </form>
    <br>
    <a href="shop_form.html">ご購入手続きへ進む</a><br>
<?php
    if (isset($_SESSION['member_login'])==true) {
        print '<a href="shop_easy_check.php">会員簡単注文へ進む</a><br>';
    }
?>
</body>
</html>
