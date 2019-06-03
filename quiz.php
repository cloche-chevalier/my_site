<?php

if(isset($_GET['readError'])) {
  $readError = (int)$_GET['readError'];
  if($readError === 1) {
    $errorComment = '前回正常に終了されなかったため、問題をリセットしました。';
  }
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="./img/favicon.ico">
  <link rel="stylesheet" href="./css/reset.css" type="text/css" />
  <link rel="stylesheet" href="./css/slick.css" type="text/css" media="screen">
  <link rel="stylesheet" href="./css/slick-theme.css" type="text/css" media="screen">
  <link rel="stylesheet" href="./css/style.css" type="text/css" media="screen" />
  <link rel="stylesheet" href="./css/style_sub.css" type="text/css" media="screen" />
  <title>Quiz - PHPを使った4択クイズ!! | Spiel des Ketzers</title>
</head>
<body>
<div class="c-loading__bg">
<div class="c-loading">
  <img src="./img/loading_img.gif" alt="ローディング中…" />
</div>
</div>
<div class="l-field u-clearBg">
  <div class="l-menuBtn u-hidden">
    <span class="u-menuLine"></span>
    <span class="u-menuLine"></span>
    <span class="u-menuLine"></span>
  </div>
  <nav>
    <ul class="l-topMenu u-hidden">
      <li><a class="l-topMenu__link" href="index.html">トップ</a></li>
      <li><a class="l-topMenu__link" href="#wrap">キッカケ</a></li>
      <li><a class="l-topMenu__link" href="profile.html">プロフィール</a></li>
      <li><a class="l-topMenu__link" href="liking.html">趣味・嗜好</a></li>
      <li><a class="l-topMenu__nowPage" href="#wrap">PHPクイズ</a></li>
    </ul>
  </nav>
<div class="l-base u-hidden">
<header>
<div class="l-header p-quiz__headerBg">
  <div class="l-header--overlay">
    <h1 class="l-header__ttl u-fadeOut u-fadeOutHgt" data-subTtl="-&nbsp;PHPの練習作品！&nbsp;-">Spiel des Ketzers</h1>
  </div>
</div>
</header><!-- headerここまで -->
<div class="l-wrapper u-txtCentering">
  <h2 class="c-column__ttl p-trigger__ttl u-fadeOut u-fadeOutHgt" data-subTtl="-&nbsp;知らなくてもやってみて！&nbsp;-">グラブル4択クイズ</h2>
  <div class="u-mb20">
    <img class="p-quiz__img" src="./img/img_quiz.jpg" alt="クイズしなさいッ！！" />
  </div>
  <ul class="p-quiz__description c-content__txt--size">
    <li>グラブルに関する4択クイズです！</li>
    <li>全30問の中から10問をランダムで出題！！</li>
    <li>パーフェクト目指して頑張って下さい！</li>
    <li>※出題データは2019年5月現在ものです。</li>
  </ul>
  <form method="POST" action="quiz_play.php">
    <input class="p-quiz__challengeBtn" type="submit" name="challenge" value="挑戦する">
  </form>
  <p class="c-content__txt--size"><?php echo $errorComment ?></p>
</div>
<footer><!-- footerここから -->
<div class="l-footer l-blkBack">
<div class="l-wrapper u-wrapPd u-fadeOut u-fadeOutRtt">
  <a class="l-footer__topBtn u-animation" href="#">&#9650;</a>
  <div class="u-clearfix">
    <div class="l-footer__menu">
      <p class="l-footer__menu__ttl">Main&nbsp;Contents</p>
      <ul class="l-footer__menu__list">
        <li><a href="trigger.html"><img class="l-footer__menu__img" src="./img/icn_trigger.png" alt="キッカケへ" /><p>Trigger</p></a></li>
        <li><a href="profile.html"><img class="l-footer__menu__img" src="./img/icn_profile.png" alt="プロフィールへ" /><p>Profile</p></a></li>
        <li><a href="liking.html"><img class="l-footer__menu__img" src="./img/icn_liking.png" alt="趣味・嗜好へ" /><p>Liking</p></a></li>
        <li><a class="u-nowPageTop" href="#"><img class="l-footer__menu__img" src="./img/icn_quiz.png" alt="PHPクイズへ" /><p>Quiz</p></a></li>
      </ul>
    </div>
    <div class="l-footer__about">
      <p class="l-footer__menu__ttl">About&nbsp;this&nbsp;site</p>
      <p class="u-txtLefting l-footer__about__txt">当サイトは見習いSEの鈴木が覚えたての知識を存分に振る舞おうと必死になって試行錯誤して完成させた駄サイトです。趣味全開の写真はまさにドン引きモノ。何を好きになってもいいじゃないか。人間だもの。</p>
    </div>
  </div>
  <p class="l-footer__copyLight">&copy;&nbsp;Spiel&nbsp;des&nbsp;Ketzers&nbsp;ALL&nbsp;rights&nbsp;Reserved</p>
</div>
</div>
</dooter>
</div><!--l-baseを閉じるdiv-->
<div class="u-overlay"></div>
<div class="l-pageTop u-animation"><a href="#"><img src="./img/go_to_top.png" alt="このページのトップへ" /></a></div>
</div>
<script type="text/javascript" src="./js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="./js/slick.min.js"></script>
<script type="text/javascript" src="./js/script_common.js"></script>
</body>
</html>
