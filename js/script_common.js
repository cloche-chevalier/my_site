"use strict";

/**
* @fileOverview ファイル名 : script_common.js
* @fileDescription サイトに使用する動的な部分を制御するjs
*/

$(function() {

  /**
  * ロード時に実行。即時関数
  */
  (function() {
    const wh = $(window).height();
    $('.c-loading , .c-loading__bg').height(wh).css('display' , 'block');
  }());

  /**
  * 外部プラグイン「slick」の処理。
  */
  $('.l-header__photoSlider').slick({
    adaptiveHeight: true,
    arrows: false,
    autoplay: true,
    centerMode: true,
    dots: false,
    fade: true,
    focusOnSelect: true,
    infinite: true,
  });

  /**
  * ホイール、フリック操作無効を解除。
  */
  function scrollUnlock() {
    const $win = $(window);
    $win.off('wheel');
    $win.off('touchmove');
  }

  /**
  * SP状態のメニュー開閉処理。
  */
  function menuSwitch() {
    const $win = $(window);
    const $menu = $('.l-topMenu');
    $('.u-menuLine').toggleClass('u-menuActive');
    $('.l-base').toggleClass('u-menuOpen');
    $('.u-overlay').toggleClass('u-menuOpen');
    $('.l-menuBtn').toggleClass('u-menuActive');
    $('.l-header__ttl').toggleClass('u-menuOpen');
    if($menu.css("right") == "-250px") {
      $win.on('wheel',function(e) {
        e.preventDefault();
      });
      $win.on('touchmove',function(e) {
        e.preventDefault();
      });
      $menu.addClass('u-menuOpen');
    } else {
      $menu.removeClass('u-menuOpen');
      scrollUnlock();
    }
  }

  /**
  * PC操作でウィンドウ幅をリサイズしたらメニューを閉じる。
  */
  function resizeClose() {
    const $win = $(window);
    const $menu = $('.l-topMenu');
    scrollUnlock();
    if($menu.css("right") !== "-250px" && $('.l-menuBtn').hasClass('u-menuActive')) {
      $menu.removeClass('u-menuOpen');
    }
    $('.u-menuLine').removeClass('u-menuActive');
    $('.l-base').removeClass('u-menuOpen');
    $('.u-overlay').removeClass('u-menuOpen');
    $('.l-menuBtn').removeClass('u-menuActive');
    $('.l-header__ttl').removeClass('u-menuOpen');
  }

  /**
  * サイト右下に表示するトップへ戻るボタンの処理。スクロール値が100以上で表示、以下で非表示。
  */
  function scrollTopBtn() {
    const $btn = $('.l-pageTop');
    if($(window).scrollTop() > 100) {
      $btn.stop().animate(
        { 'bottom' : '20px' },
        200);
    } else {
      $btn.stop().animate(
        { 'bottom' : '-100px' },
        200);
    }
  }

  /**
  * profileページのアコーディオン処理。
  *
  * @this {クリックした$list}
  */
  function toggleList($this) {
    const $list = $('.p-profile__QandA li');
    $this.next().slideToggle();
    $list.not($this).next('.p-profile__QandA li:nth-of-type(even)').slideUp();
  }

  /**
  * profileページの取扱説明書の処理。同じindexの内容を表示させる
  *
  * @this {クリックした$('.p-profile__about__serecter li')のindex}
  */
  function siblingsList($this) {
    const $img = $('.p-profile__about__img li');
    const $txt = $('.p-profile__about__txt li');
    $img.eq($this).removeClass('u-hideObject').siblings().addClass('u-hideObject');
    $txt.eq($this).removeClass('u-hideObject').siblings().addClass('u-hideObject');
    // $img.eq($this).slideToggle();
    // $img.eq($this).siblings().slideUp();
    // $txt.eq($this).slideToggle();
    // $txt.eq($this).siblings().slideUp();
  }

  /**
  * likingページのliquorの処理。クリックしたら画像を入れ替える
  *
  * @this {クリックした$('.p-liking__liquor li')のindex}
  */
  function toggleImg($this) {
    $('.p-liking__liquor li').eq($this).toggleClass('u-imgRtt');
    $('.p-liking__liquor li').eq($this).siblings().delay().stop().toggle();
    $('.p-liking__liquor li').eq($this).delay(500).stop().toggle();
    $('.p-liking__liquor li').eq($this).siblings().toggleClass('u-imgRtt');
  }

  /**
  * likingページのmangaの処理。クリックしたら画像を入れ替える
  *
  * @this {クリックした$('.p-liking__manga li')}
  */
  function fadeToggleImg($this) {
    const getLength = $('.p-liking__manga li').length;
    if($this.index() !== getLength - 1) {
      $this.toggle().next().toggle();
    } else {
      $this.toggle();
      $('.p-liking__manga li').eq(0).toggle();
    }
  }

  /**
  * サイト右下に表示するトップへ戻るボタンとフッターのボタンの処理。クリックしたらサイトの一番上へスクロールさせる。
  *
  */
  function goBackTop() {
    $('body,html').stop().animate(
      { scrollTop : 0 },
      500);
      return false;
  }

  /**
  * スクロールをしてコンテンツを表示させる処理。
  *
  * @param {number} elmPos 対象コンテンツの位置
  * @param {number} scroll windowのスクロール値
  * @param {number} windowHeight windowの高さ
  * @this {window}
  */
  function scrollFadeIn() {
    $('.u-fadeOut').each(function() {
      const $win = $(window);
      const elmPos = $(this).offset().top;
      const scroll = $win.scrollTop();
      const windowHeight = $win.height();
      if(scroll > elmPos - windowHeight + 100) {
        $(this).addClass('u-fadeIn');
      }
    });
  }

  /**
  * サイト右下に表示するトップへ戻るボタンのイベント
  *
  * @event
  */
  $(window).scroll(function() {
    scrollTopBtn();
  });

  /**
  * スクロールをしてコンテンツを表示させるイベント。
  *
  * @event
  */
  $(window).scroll(function() {
    scrollFadeIn();
  });

  /**
  * サイト右下に表示するトップへ戻るボタンとフッターのボタンのイベント。
  *
  * @event
  */
  $('.l-pageTop , .l-footer__topBtn , .l-topMenu__nowPage , .u-nowPageTop').on('click' , function() {
    goBackTop();
  });

  /**
  * SP状態のメニューの開閉イベント。
  *
  * @event
  */
  $('.l-menuBtn , .u-overlay').on('click' , function() {
      menuSwitch();
  });

  /**
  * PC操作でウィンドウ幅をリサイズしたらメニューを閉じるイベント。
  *
  * @event
  */
  $(window).resize(function() {
    resizeClose();
  });

  /**
  * profileページの一問一答のイベント
  *
  *@event
  */
  $('.p-profile__QandA li:nth-of-type(odd)').on('click' , function() {
    toggleList($(this));
  });

  /**
  * profileページの取扱説明書のイベント
  *
  *@event
  */
  $('.p-profile__about__selecter li').on('click' , function() {
    siblingsList($(this).index());
  });

  /**
  * likingページのliquorのイベント
  *
  *@event
  */
  $('.p-liking__liquor li').on('click' , function() {
    toggleImg($(this).index());
  });

  /**
  * likingページのmangaのイベント
  *
  *@event
  */
  $('.p-liking__manga li').on('click' , function() {
    fadeToggleImg($(this));
  });

});

/**
* ready後に実行。
*/
$(window).on('load' , function() {
  $('.c-loading__bg').fadeOut(500);
  $('.c-loading').fadeOut(500);
  $('.u-hidden').removeClass('u-hidden');
  $('.l-header__ttl').delay(800).queue(function() {
    $(this).addClass('u-fadeIn');
  });
});
