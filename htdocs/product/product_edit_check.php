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
    require_once('../common/common.php');
    $post = sanitize($_POST);

    $product_code = $post["code"];
    $product_name = $post["name"];
    $product_price = $post["price"];
    $product_picture_name_old = $post['picture_name_old'];
    $product_picture = $_FILES['picture'];

    if ($product_name == "") {
        print "商品名が入力されていません。<br />";
    }else {
        print "商品名 : ";
        print $product_name;
        print '<br />';
    }
    if ($product_price == "") {
        print "価格が入力されていません。<br />";
    }else {
        print "商品価格 : ";
        print $product_price;
        print '<br />';
    }
    if ($product_picture['size']>1000000){
        print 'サイズが大きすぎます';
    }else {
        move_uploaded_file($product_picture['tmp_name'], './picture/'.$product_picture['name']);
        print '<img src="./picture/'.$product_picture['name'].'">';
        print '<br>';
    }

    if ($product_name == ""||$product_price == "") {
        print '<form>';
        print '<input type="button" onclick="history.back()" value="戻る">';
        print '</form>';
    }else {
        print '<form method="post" action="product_edit_done.php">';
        print '<input type="hidden" name="code" value="'.$product_code.'">';
        print '<input type="hidden" name="name" value="'.$product_name.'">';
        print '<input type="hidden" name="price" value="'.$product_price.'">';
        print '<input type="hidden" name="picture_name_old" value="'.$product_picture_name_old.'">';
        print '<input type="hidden" name="picture_name" value="'.$product_picture['name'].'">';
        print '<br />';
        print '<input type="button" onclick="history.back()" value="戻る">';
        print '<input type="submit" value="OK">';
        print '</form>';
    }
?>
</body>
</html>
