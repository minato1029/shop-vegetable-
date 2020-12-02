<?php
    session_start();
    session_regenerate_id(true);
    if (isset($_SESSION['member_login'])==false) {
        print 'ログインされていません。<br />';
        print '<a href="shop_list.php">商品一覧へ</a>';
        exit();
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

            $member_name = $post['name'];
            $email = $post['email'];
            $postal1 = $post['postal1'];
            $postal2 = $post['postal2'];
            $address = $post['address'];
            $telephone = $post['telephone'];

            print $member_name . '様<br>';
            print 'ご注文ありがとうござました。<br>';
            print $email . 'にメールを送りましたのでご確認ください。<br>';
            print '商品は以下の住所に発送させていただきます。<br>';
            print $postal1 . '-' . $postal2 . '<br>';
            print $address . '<br>';
            print $telephone . '<br><br><br>';

            $text='';
            $text.=$member_name."様\n\nこのたびはご注文ありがとうございました。\n";
            $text.="\n";
            $text.="ご注文商品\n";
            $text.="--------------------\n";

            $cart = $_SESSION['cart'];
            $amount = $_SESSION['amount'];
            $max = count($cart);

            $dsn = 'mysql:dbname=shop;host=localhost;charset=utf8';
            $user = 'root';
            $password = '';
            $dbh = new PDO($dsn, $user, $password);
            $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            print '1<br><br>';

            for ($i=0; $i<$max; $i++){
                $sql = 'SELECT name, price FROM mst_product WHERE code=?';
                $stmt = $dbh -> prepare($sql);
                $data[0] = $cart[$i];
                $stmt -> execute($data);
                
                $rec = $stmt -> fetch(PDO::FETCH_ASSOC);


                $name = $rec['name'];
                $price = $rec['price'];
                $value[] = $price;
                $quantity = $amount[$i];
                $total = $price * $quantity;

                $text.=$name.' ';
                $text.=$price.'円 x ';
                $text.=$quantity.'個 = ';
                $text.=$total."円\n";
            }
            print '2<br><br>';

            $sql = 'LOCK TABLES dat_sales WRITE, dat_sales_product WRITE, dat_member WRITE';
            $stmt = $dbh -> prepare($sql);
            $stmt -> execute();

            $lastmembercode = $_SESSION['member_code'];

            print '3<br><br>';

            $sql = 'insert into dat_sales (code_member, name , email, postal1, postal2, address, telephone) values (?, ?, ?, ?, ?, ?, ?)';
            $stmt = $dbh -> prepare($sql);
            $data = array();
            $data[] = $lastmembercode;
            $data[] = $member_name;
            $data[] = $email;
            $data[] = $postal1;
            $data[] = $postal2;
            $data[] = $address;
            $data[] = $telephone;
            $stmt -> execute($data);

            print '7<br><br>';

            $sql = 'SELECT LAST_INSERT_ID()';
            $stmt = $dbh -> prepare($sql);
            $stmt -> execute();
            $rec = $stmt -> fetch(PDO::FETCH_ASSOC);
            $lastcode = $rec['LAST_INSERT_ID()'];

            print '8<br><br>';

            for ($i=0; $i<$max; $i++) {
                $sql = 'insert into dat_sales_product (code_sales, code_product, price, quantity) values (?, ?, ?, ?)';
                $stmt = $dbh -> prepare($sql);
                $data = array();
                $data[] = $lastcode;
                $data[] = $cart[$i];
                $data[] = $value[$i];
                $data[] = $amount[$i];

                $stmt -> execute($data);
            }
            $sql = 'UNLOCK TABLES';
            $stmt = $dbh ->prepare($sql);
            $stmt ->execute();

            $dbh = null;

            $text.="送料は無料です。\n";
            $text.="--------------------\n";
            $text.="\n";
            $text.="代金は以下の口座にお振込ください。\n";
            $text.="ろくまる銀行 やさい支店 普通口座 １２３４５６７\n";
            $text.="入金確認が取れ次第、梱包、発送させていただきます。\n";
            $text.="\n";
            $text.="□□□□□□□□□□□□□□\n";
            $text.="　～安心野菜のろくまる農園～\n";
            $text.="\n";
            $text.="○○県六丸郡六丸村123-4\n";
            $text.="電話 090-6060-xxxx\n";
            $text.="メール info@rokumarunouen.co.jp\n";
            $text.="□□□□□□□□□□□□□□\n";

//            print nl2br($text);

            $title = 'ご注文ありがとうございます';
            $header = 'From:info@rokumarunouen.co.jp';
            $text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');
            mb_language('Japanese');
            mb_internal_encoding('UTF-8');
            mb_send_mail($email, $title, $header);

            $title = 'ご注文ありがとうございます';
            $header = 'From:'.$email;
            $text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');
            mb_language('Japanese');
            mb_internal_encoding('UTF-8');
            mb_send_mail('info@rokumarunouen.co.jp', $title, $header);

        }catch (Exception $e) {
            print 'ただいま障害中';
            exit();
        }

//    if (isset($_COOKIE[session_name()])==true) {
//        setcookie(session_name(), '', time()-42000, '/');
//    }
//    session_destroy();
    ?>
    <a href="shop_list.php">商品画面へ</a>

</body>
</html>
