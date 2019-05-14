"use strict";

/* ========================================
  script_menu.js
======================================== */

/* ----------------------------------------
  当jsは、レスポンシブでwidthが1024px未満に
  なった際に適応します。
---------------------------------------- */

$(function() {

  /**
  * PC操作でウィンドウ幅をリサイズしたらメニューを閉じる。
  */
  $(window).resize(function() {
    $(window).off('wheel');
    $(window).off('touchmove');
    if($('.l-topMenu').css("right") !== "-250px" && $('.l-menuBtn').hasClass('u-menuActive')) {
      $('.l-topMenu').stop().animate(
        { right : "-250px" }
        ,500);
    }
    $('.u-menuLine').removeClass('u-menuActive');
    $('.l-base').removeClass('u-menuOpen');
    $('.u-overlay').removeClass('u-menuOpen');
    $('.l-menuBtn').removeClass('u-menuActive');
    $('.l-header__ttl').removeClass('u-menuOpen');
  });

  /**
  * メニューの開閉処理。
  */
  function menuSwitch() {
    $('.u-menuLine').toggleClass('u-menuActive');
    $('.l-base').toggleClass('u-menuOpen');
    $('.u-overlay').toggleClass('u-menuOpen');
    $('.l-menuBtn').toggleClass('u-menuActive');
    $('.l-header__ttl').toggleClass('u-menuOpen');
    if($('.l-topMenu').css("right") == "-250px") {
      $('.l-topMenu').stop().animate(
        { right : 0 }
        ,500);
    } else {
      $('.l-topMenu').stop().animate(
        { right : "-250px" }
        ,500);
    }
  }

  /**
  * 右上のボタンを押してメニューを開く。開いている最中はスクロール無効。
  * @event
  */
  $('.l-menuBtn').on('click' , function() {
    if($(this).hasClass('u-menuActive')) {
      menuSwitch();
      $(window).off('wheel');
      $(window).off('touchmove');
    } else {
      menuSwitch();
      $(window).on('wheel',function(e) {
        e.preventDefault();
      });
      $(window).on('touchmove',function(e) {
        e.preventDefault();
      });
    }
  });
  $('.u-overlay').on('click',function() {
    menuSwitch();
    $(window).off('wheel');
    $(window).off('touchmove');
  });

});
