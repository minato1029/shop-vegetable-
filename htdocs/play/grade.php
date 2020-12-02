<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ろくまる農園</title>
</head>
<body>
    <?php
        $grade = $_POST['grade'];

        switch ($grade) {
            case '1';       
                $building='あなたの校舎は南校舎です。';
                $club='部活動にはスポーツ系と文科系があります。';
                $aim='まずは学校に慣れましょう。';
                break;

            case'2':
                $building='あなたの校舎は西校舎です。';
                $club='学園祭目指して全力で取り組みましょう。';
                $aim='今しかできないことを見つけよう。';
                break;

            case'3':
                $building='あなたの校舎は東校舎です。';
                $club='受験に就職に忙しくなります。後輩へ譲っていきましょう。';
                $aim='将来への道を作ろう。';
                break;

            default:
                $building='あなたの校舎は３年生と同じです。';
                $club='部活動はありません。';
                $aim='早く卒業しましょう。';
        }
        print '校舎　'.$building.'</br>';
        print '部活　'.$club.'</br>';
        print '目標　'.$aim.'</br>';
    ?>
</body>
</html>



