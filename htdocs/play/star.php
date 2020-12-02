<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ろくまる農園</title>
</head>
<body>
    <?php
        $m_number = $_POST['m_number'];

        $star['M1']='カニ星雲';
        $star['M31']='アンドロメダ大星雲';
        $star['M42']='オリオン大星雲';
        $star['M45']='すばる';
        $star['M57']='ドーナツ星雲';

        foreach($star as $key => $val) {
            print $key.'は'.$val;
            print '<br>';
        }

        print 'あなたが選んだ星は';
        print $star[$m_number];

    ?>

</body>
</html>


