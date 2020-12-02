<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ろくまる農園</title>
</head>
<body>
    <?php
        $month = $_POST['month'];
    
        $vegetable[]='';
        $vegetable[]='ブロッコリー';
        $vegetable[]='カリフラワー';
        $vegetable[]='レタス';
        $vegetable[]='みつば';
        $vegetable[]='アスパラガス';
        $vegetable[]='セロリ';
        $vegetable[]='ナス';
        $vegetable[]='ピーマン';
        $vegetable[]='オクラ';
        $vegetable[]='さつまいも';
        $vegetable[]='大根';
        $vegetable[]='ほうれんそう';

        print $month;
        print '月は';
        print $vegetable[$month];
        print 'が旬です';
    ?>
</body>
</html>
