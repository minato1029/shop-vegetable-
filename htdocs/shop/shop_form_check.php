<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ろくまる農園</title>
</head>
<body>
    <?php
        require_once ('../common/common.php');
        $post = sanitize($_POST);
            
        $name = $post['name'];
        $email = $post['email'];
        $postal1 = $post['postal1'];
        $postal2 = $post['postal2'];
        $address = $post['address'];
        $telephone = $post['telephone'];

        $order = $_POST['order'];
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];
        $sex = $_POST['sex'];
        $birth = $_POST['birth'];

        $flag = true;

        if($name==''){
            print 'お名前が入力されていません。<br><br>';
            $flag = false;
        }else{
            print 'お名前<br>';
            print $name;
            print '<br><br>';
        }
        if(preg_match('/\A[\w\-\.]+\@[\w\-\.]+\.([a-z]+)\z/',$email)==0){
            print 'メールアドレスを正確に入力してください。<br><br>';
            $flag = false;
        }else{
            print 'メールアドレス<br>';
            print $email;
            print '<br><br>';
        }
        if(preg_match('/\A[0-9]+\z/',$postal1)==0){
            print '郵便番号は半角数字で入力してください。<br><br>';
            $flag = false;
        }else{
            print '郵便番号<br>';
            print $postal1;
            print '-';
            print $postal2;
            print '<br><br>';
        }
        if(preg_match('/\A[0-9]+\z/',$postal2)==0){
            print '郵便番号は半角数字で入力してください。<br><br>';
            $flag = false;
        }
        if($address==''){
            print '住所が入力されていません。<br><br>';
            $flag = false;
        }else{
            print '住所<br>';
            print $address;
            print '<br><br>';
        }
        if(preg_match('/\A\d{2,5}-?\d{2,5}-?\d{4,5}\z/',$telephone)==0){
            print '電話番号を正確に入力してください。<br><br>';
            $flag = false;
        }else{
            print '電話番号<br>';
            print $telephone;
            print '<br><br>';
        }
        if ($order == 'register') {
            if($password1 == '') {
                print 'パスワードが入力されていません。<br><br>';
                $flag = false;
            }

            if($password1 != $password2) {
                print 'パスワードが一致しません。<br><br>';
                $flag = false;
            }

            print '性別<br>';
            if($sex == 'male') {
                print '男性';
            }
            else {
                print '女性';
            }
            print '<br><br>';

            print '生まれ年<br>';
            print $birth;
            print '年代';
            print '<br><br>';
        }

        if ($flag == true){
            print '<form method="post" action="shop_form_done.php">';
            print '<input type="hidden" name="name" value="'.$name.'">';
            print '<input type="hidden" name="email" value="'.$email.'">';
            print '<input type="hidden" name="postal1" value="'.$postal1.'">';
            print '<input type="hidden" name="postal2" value="'.$postal2.'">';
            print '<input type="hidden" name="address" value="'.$address.'">';
            print '<input type="hidden" name="telephone" value="'.$telephone.'">';
            print '<input type="hidden" name="order" value="'.$order.'">';
            print '<input type="hidden" name="password" value="'.$password1.'">';
            print '<input type="hidden" name="sex" value="'.$sex.'">';
            print '<input type="hidden" name="birth" value="'.$birth.'">';
            print '<input type="button" onclick="history.back()" value="戻る">';
            print '<input type="submit" value="OK"><br>';
            print '</form>';
        }else {
            print '<input type="button" onclick="history.back()" value="戻る">';
        }
    ?>

</body>
</html>
