<?php

    session_start();
    session_regenerate_id(true);
    if (isset($_SESSION['login']) == false) {
        print 'ログインされていません<br>';
        print '<a href="../login/staff_login.html">ログイン画面へ</a>';
        exit();
    }

    if (isset($_POST['display'])==true){

        if (isset($_POST['productcode'])==false){
            header('Location:product_ng.php');
            exit();
        }
        $product_code = $_POST['productcode'];
        header('Location:product_display.php?productcode='.$product_code);
    }


    if (isset($_POST['add'])==true){
        header('Location:product_add.php');
    }

    if (isset($_POST['edit'])==true){

        if (isset($_POST['productcode'])==false) {
            header('Location:product_ng.php');
            exit();
        }

        $product_code = $_POST['productcode'];
        header('Location:product_edit.php?productcode='.$product_code);
        exit();
    }

    if (isset($_POST['delete'])==true){

        if (isset($_POST['productcode'])==false) {
            header('Location:product_ng.php');
            exit();
        }

        $product_code = $_POST['productcode'];
        header('Location:product_delete.php?productcode='.$product_code);
        exit();
    }

?>