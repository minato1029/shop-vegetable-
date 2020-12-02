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
            $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $user = 'root';
            $password = '';
            $dbh = new PDO($dsn, $user, $password);
            $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = 'select code, name, price from mst_product where 1';
            $stmt = $dbh -> prepare($sql);
            $stmt -> execute();

            $dbh = null;

            print '商品一覧<br><br>';

            while(true) {
                $rec = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($rec == false) {
                    break;
                }

                print '<a href="shop_product.php?procode='.$rec['code'].'">';
                    print $rec['name'];
                    print '---';
                    print $rec['price'];
                    print '円<br>';
                print '</a>';
            }

        }catch(Exception $e) {
            print 'ただいま障害が発生しています';
            exit();
        }
        print '<br>';
        print '<a href="shop_cartlook.php">カートを見る</a><br>'
    ?>
</body>
</html>
