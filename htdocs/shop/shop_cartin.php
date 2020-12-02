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

            if (isset($_SESSION['cart'])==true){
                $cart = $_SESSION['cart'];
                $amount = $_SESSION['amount'];
                if (in_array($product_code, $cart)==true){
                    print 'その商品は既にカートに入っています。<br>';
                    print '<a href="shop_list.php">商品一覧に戻る</a>';
                    exit();
                }
            }
            $cart[] = $product_code;
            $amount[] = 1;
            $_SESSION['cart'] = $cart;
            $_SESSION['amount'] = $amount;

        }catch (Exception $e) {
            print '障害が発生しています';
            exit();
        }
    ?>
    <p>カートに追加しました</p>
    <a href="shop_list.php">商品一覧に戻る</a>

</body>
</html>
