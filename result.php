<?php

$fileName = './quiz/management.txt';
$retArray = file($fileName);
$getLength = (int)$retArray[0];
$getCorrect = (int)$retArray[1];

if(isset($_POST['allReset'])) {
  $getLength = 0;
  $getCorrect = 0;
  $retArray[0] = strval($getLength)."\n";
  $retArray[1] = strval($getCorrect)."\n";
  $retArray[2] = '0'."\n";
  file_put_contents($fileName,$retArray);
  header('location:quiz.php');
  exit();
}

if($getCorrect == 0) {
  $comment = '今すぐグラブルをプレイしましょう！';
  $imgAlt = '残念無念。';
  $imgType = '01';
} else if($getCorrect <= 3) {
  $comment = 'もっとグラブルを沢山プレイしましょう！';
  $imgAlt = 'いまいちな結果です。';
  $imgType = '02';
} else if($getCorrect <= 6) {
  $comment = '頑張ってグラブルをプレイしましょう！';
  $imgAlt = '可もなく不可もなく';
  $imgType = '03';
} else if($getCorrect <= 9) {
  $comment = '他の同ランクの方に負けないくらいプレイしましょう！';
  $imgAlt = '惜しい！もう少しです！';
  $imgType = '04';
} else if($getCorrect == 10) {
  $comment = 'パーフェクト！やりますねェ！';
  $imgAlt = '全問正解！やったね！';
  $imgType = '05';
}

$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null;
if(preg_match("|^http?://[a-zA-Z0-9-]+\.github\.io|" , $referer)) {} else {
  header('location:error.php');
  exit();
}
// $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null;
// if(preg_match("|^https?://[a-zA-Z0-9-]+\.github\.io|" , $referer)) {} else {
//   header('location:error.php');
//   exit();
// }

 ?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./reset.css" type="text/css" />
  <link rel="stylesheet" href="./css/style.css" type="text/css" />
  <link rel="stylesheet" href="./css/style_sub.css" type="text/css" />
  <title>グラブルクイズ結果発表！</title>
</head>
<body>
<div class="l-base p-quiz__play__bg">
  <div class="p-quiz__play__ttlBg">
    <h2 class="p-quiz__play__ttl">結果発表！</h2>
  </div>
  <div class="p-quiz__play__wrapper">
    <div class="u-txtCentering u-mb30">
      <img class="p-quiz__play__img" src="./img/quiz/result/result<?php echo $imgType ?>.jpg" alt="<?php echo $imgAlt ?>" />
      <p class="c-content__txt--size"><?php echo $getLength ?>問中<span class="p-quiz__play__resultTxt"><?php echo $getCorrect ?></span>問正解！</p>
      <p class="c-content__txt--size"><?php echo $comment ?></p>
    </div>
    <form method="POST" action="">
      <input type="submit" name="allReset" value="トップへ戻る">
    <form>
  </div>
</div>
</body>
</html>
