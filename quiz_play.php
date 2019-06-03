<?php

include_once('./quiz/contents.php');
$fileName = './quiz/management.txt';
$retArray = file($fileName);
$startSwitch = (int)$retArray[2];

if(isset($_POST['challenge'])) {
  if($startSwitch !== 0) {
    $readError = 1;
    goto reset;
  }
}

$referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null;
if(preg_match("|^http?://[a-zA-Z0-9-]+\.github\.io|" , $referer)) {} else {
  header('location:error.php');
  exit();
}

// 1度だけランダム出題生成。
// 生成した配列を文字列にして外部ファイルへ保存。
// そうしないとエラーになって死ぬ。
if($startSwitch !== 1) {
  $buildList = array();
  for($x=0;$x<$count;$x++) {
    array_push($buildList,$x);
  }
  $getList = array_rand($buildList,10);
  shuffle($getList);
  $retArray[2] = '1'."\n";
  $retArray[3] = implode(',' , $getList);
  file_put_contents($fileName,$retArray);
}

$getNum = (int)$retArray[0];
$getPoint = (int)$retArray[1];
$pickList = explode(',' , $retArray[3]);

if(isset($_POST['reset'])) {
  reset:
  $getNum = 0;
  $getPoint = 0;
  $retArray[0] = strval($getNum)."\n";
  $retArray[1] = strval($getPoint)."\n";
  $retArray[2] = '0'."\n";
  $retArray[3] = '0';
  file_put_contents($fileName,$retArray);
  if($readError !== 1) {
    header('location:index.php');
  } else {
    header('location:index.php?readError='.$readError);
  }
  exit();
}

if(isset($_POST['count'])) {
  if(isset($_POST['question'])) {
    $select_q = $_POST['question'];
    $answer = $question_list[$pickList[$getNum]][$question_answer[$pickList[$getNum]]];
    if($select_q === $answer) {
      $getPoint += 1;
      $retArray[1] = strval($getPoint)."\n";
      file_put_contents($fileName,$retArray);
    }
    $getNum += 1;
    $retArray[0] = strval($getNum)."\n";
    file_put_contents($fileName,$retArray);
  }
}

if($getNum == 10) {
  header('location:result.php');
  exit();
}

if($pickList[$getNum] <= 8) {
  $imgNum = "0".strval($pickList[$getNum] + 1);
} else {
  $imgNum = $pickList[$getNum] + 1;
}

shuffle($question_list[$pickList[$getNum]]);

 ?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./reset.css" type="text/css" />
  <link rel="stylesheet" href="./css/style.css" type="text/css" />
  <link rel="stylesheet" href="./css/style_sub.css" type="text/css" />
  <title>グラブルクイズ</title>
</head>
<body>
<div class="l-base p-quiz__play__bg">
  <div class="p-quiz__play__ttlBg">
    <h2 class="p-quiz__play__ttl">グラブルクイズ</h2>
  </div>
  <div class="p-quiz__play__wrapper">
    <p class="p-quiz__play__question">Q<?php echo $getNum + 1 ?>&nbsp;:&nbsp;<?php echo $question_title[$pickList[$getNum]] ?></p>
    <div class="u-txtCentering">
      <img class="p-quiz__play__img" src="./img/quiz/q_img//q<?php echo $imgNum ?>.jpg" alt="イメージ画像" />
    </div>
    <form class="p-quiz__play__form" method="POST" action="">
      <ul class="p-quiz__play__answer">
      <?php foreach($question_list[$pickList[$getNum]] as $value){ ?>
        <li><input type="radio" name="question" value="<?php echo $value; ?>" /><?php echo $value ?></li>
      <?php } ?>
      </ul>
      <input type="hidden" name="answer" value="<?php echo $question_answer[$pickList[$getNum]]; ?>">
      <input class="p-quiz__play__btn c-content__txt--size" type="submit" name="count" value="回答する!!">
      <input class="p-quiz__play__btn p-quiz__play__reset c-content__txt--size u-clearfix" type="submit" name="reset" value="諦める…">
      <p class="c-content__txt--size"><?php if(isset($_POST['count'])) {
        if(isset($_POST['question'])) {
        } else {
          echo '(!)項目にチェックして下さい。';
        }
      } ?></p>
    </form>
  </div>
</div>
</body>
</html>
