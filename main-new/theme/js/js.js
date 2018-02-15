(function ($) {

  if (typeof Drupal != 'undefined') {
    Drupal.behaviors.projectName = {
      attach: function (context, settings) {
        init();
      },

      completedCallback: function () {
        // Do nothing. But it's here in case other modules/themes want to override it.
      }
    }
  }

  $(function () {

    if (typeof Drupal == 'undefined') {
      init();
    }

    $(window).load(function () {
      window.initMasonry();
      initFlexslider();
    });
  });

  $(window).bind("ajaxComplete", function (e, xhr, settings) {
    window.initMasonry();
  });

  function init() {
    initSectionTopRetinaImg();
    initAnimateScroll();
    mobileDetect();
    initPopup();
    initNewsletterFormAnimation();
    //initJustifyBlocks();
    initNewLocationFromSelect('.form-pick-your-strain select');
    initNewLocationFromSelect('.form-filter select');
    initNewLocationFromSelect('.form-redirect-select select');//need it for custom selects redirect
    initNewLocationFromSelect('.form-location-select select');
    initNewLocationFromSelect('.form-cannabis-select select');
    initSortSelect();
    initSelect();
    initFullWidthBlock();
    initSoundManager();
    initPriceCents();
    initCircles();
    initMobileNav();
    initMobileFormTypes();
    initMobileTitle();
    initFancybox();

    initLandingPageFormWantTo();
  }

  function initSectionTopRetinaImg() {
    var $section = $('.section-top');

    if(!$section.length) return;

    var $img = $section.find('.title-2 img');

    $img.on('load', function() {
      timer = setTimeout(function() {
        setWidth();
      }, 50);
    });

    var timer;
    $(window).on('resize', function() {
      clearTimeout(timer);
      timer = setTimeout(function() {
        setWidth();
      }, 50);
    }).resize();

    function setWidth(val) {
      val = val == undefined ? 0 : val;

      $img.width($img[0].naturalWidth/2 - val);

      if($img.height() > $section.height() - 40) {
        setWidth(100);
      } else {
        $img.css('visibility', 'visible');
      }
    }
  }

  function initFlexslider() {
    $('#carousel').flexslider({
      animation: "slide",
      controlNav: false,
      animationLoop: false,
      slideshow: false,
      itemWidth: 129,
      itemMargin: 6,
      asNavFor: '#slider'
    });

    $('#slider').flexslider({
      animation: "slide",
      controlNav: false,
      animationLoop: false,
      slideshow: false,
      sync: "#carousel"
    });
  }

  function initMobileTitle() {
    var $el = $('.title-mobile');
    var $appendTo = $('.content-wrapper:not(.no-title)');

    if (!$el.length || $el.hasClass('title-processed')) return;

    $el.addClass('title-processed');
    $appendTo.prepend($el);
  }

  function initMobileFormTypes() {
    var config = {
      $sortBy: 'edit-term-node-tid-depth-wrapper',
      $typeOfExtract: 'edit-tid-wrapper',
      textSortBy: 'Sort by',
      textTypeOfExtract: 'Type',
      $elSortByFilter: '',
      $elTypeOfExtractFilter: '',
      $wrapper: '',
      $header: ''
    };

    var $body = $('body');

    if (!$body.hasClass('page-cannabis-all') || $body.find('.widget-header').length) return;

    config.$sortBy = $('#' + config.$sortBy);
    config.$typeOfExtract = $('#' + config.$typeOfExtract);

    if (!config.$sortBy.length && !config.$typeOfExtract.length) return false;

    createNav();

    if (config.$sortBy.length) {
      var radios1 = config.$sortBy.find('input[type=radio]');

      radios1.on('change', function () {
        checkCurrentFilter(radios1);
      });

      checkCurrentFilter(radios1);
    }

    if (config.$typeOfExtract.length) {
      var radios2 = config.$typeOfExtract.find('input[type=radio]');

      radios2.on('change', function () {
        checkCurrentFilter(radios2);
      });

      checkCurrentFilter(radios2);
    }

    config.$header.on('click touch', function (e) {
      e.preventDefault();

      $body.toggleClass('filter-is-active');
    });

    $body.on('click touch', function (e) {
      if (!$(e.target).closest('#views-exposed-form-taxonomy-term-page').length && $body.hasClass('filter-is-active')) {
        $body.removeClass('filter-is-active');
      }
    });

    function checkCurrentFilter(radios) {
      for (var x = 0; x < radios.length; x++) {
        var $current = radios.eq(x);

        if (!$current.is(':checked')) continue;

        addText($current);
      }
    }

    function addText(el) {
      var text = el.siblings('label').text();

      if (el.closest(config.$sortBy).length) {
        config.$elSortByFilter.text(text);
      }

      if (el.closest(config.$typeOfExtract).length) {
        config.$elTypeOfExtractFilter.text(text);
      }
    }

    function createNav() {
      var header = document.createElement('div');
      header.className = 'widget-header';

      if (config.$sortBy.length) {
        var elSortBy = document.createElement('div');
        elSortBy.className = 'widget-header-sort-by';
        elSortBy.innerText = config.textSortBy;

        var span1 = document.createElement('span');
        span1.className = 'el-text';
        elSortBy.appendChild(span1);

        header.appendChild(elSortBy);
      }

      if (config.$typeOfExtract.length) {
        var elTypeOfExtract = document.createElement('div');
        elTypeOfExtract.className = 'widget-header-type-of-extract';
        elTypeOfExtract.innerText = config.textTypeOfExtract;

        var span2 = document.createElement('span');
        span2.className = 'el-text';
        elTypeOfExtract.appendChild(span2);

        header.appendChild(elTypeOfExtract);
      }

      if (config.$sortBy.length) {
        config.$wrapper = config.$sortBy.parent();
      } else {
        config.$wrapper = config.$typeOfExtract.parent();
      }

      if (config.$sortBy.length || config.$typeOfExtract.length) {
        config.$wrapper.prepend(header);
        config.$header = config.$wrapper.find('.widget-header');
        config.$elSortByFilter = config.$wrapper.find('.widget-header-sort-by .el-text');
        config.$elTypeOfExtractFilter = config.$wrapper.find('.widget-header-type-of-extract .el-text');
      }
    }
  }

  function initMobileNav() {
    var $wrapper = $('.nav');
    var $navigation = $('#site-header .navigation li');
    var $listWrapper = $wrapper.find('.menu-wrapper > ul.menu');
    var $list = $listWrapper.find('li');
    var $listLinks = $list.find('a');
    var $btn = $('.nav .btn-nav');
    var $body = $('body');

    if ($wrapper.hasClass('nav-processed')) return;

    $wrapper.addClass('nav-processed');

    for (var y = 0; y < $navigation.length; y++) {
      $listWrapper.append($navigation.eq(y).clone().addClass('navigation-link'));
    }

    for (var i = 0; i < $listLinks.length; i++) {
      var $current = $listLinks.eq(i);

      if (!$current.siblings('ul').length) continue;

      $current.siblings('ul').prepend('<li class="back-nav-btn"><a href="#">back</a></li>');
      $current.append('<span class="icon-next-menu"></span>');
    }

    var $btnNextMenu = $wrapper.find('.icon-next-menu');
    var $btnBack = $wrapper.find('.back-nav-btn a');

    if ($body.hasClass('mobile-device')) {
      $btnNextMenu = $btnNextMenu.parent();
    }

    $btnNextMenu.on('click touch', function (e) {
      e.preventDefault();

      var $this = $(this).parents('li');

      if($('html').hasClass('tablet')) {
        $list.removeClass('active-next-level');
        $this.addClass('active-next-level');
      } else {
        if ($this.hasClass('active-next-level')) {
          $this.removeClass('active-next-level');
          $body.removeClass('second-nav-level-active');
          return;
        }

        $list.removeClass('active-next-level');
        $this.toggleClass('active-next-level');
        $body.toggleClass('second-nav-level-active');
      }
    });

    $btnBack.on('click touch', function (e) {
      e.preventDefault();

      var $this = $(this).parents('.active-next-level');

      setTimeout(function () {
        $this.removeClass('active-next-level');
      }, 300);

      $body.removeClass('second-nav-level-active');
    });

    $btn.on('click touch', function (e) {
      e.preventDefault();

      $body.toggleClass('mobile-nav-active');
    });

    $body.on('click touch', function (e) {
      if (!$(e.target).closest($wrapper).length) {
        if($body.hasClass('mobile-nav-active')) $body.removeClass('mobile-nav-active');
        $list.removeClass('active-next-level');
      }
    });
  }

  window.initMasonry = function () {
    var $wrapper = $('.items-list');

    if (typeof $.fn.masonry == 'undefined' || !$wrapper.length) return;

    $wrapper.masonry({
      itemSelector: '.item',
      columnWidth: 300,
      gutter: 36
    });
  };

  function initAnimateScroll() {

    var $hash = window.location.hash;

    var $el = $('body').find('[id="' + $hash.replace('#', '') + '"]');

    if (!$el.length) return;

    $('html, body').animate({
      scrollTop: $el.offset().top-120
    }, 700);
  }

  function initSortSelect() {
    var $body = $('body');
    if (!$body.hasClass('page-cannabis-all')) return;

    var $select = $('#edit-items-per-page');
    var $formSort = $('.top-controls .form-sort');

    if ($formSort.html() === '') {
      $formSort.html($select.parents('.form-item-items-per-page').clone());
      var $selectFictitious = $formSort.find('.form-select');

      $selectFictitious.on('change', function () {
        var val = $(this).val();

        $select.val(val);
        $select.trigger('change');
      });
    }
  }

  function initPriceCents() {
    var $pricesBlocks = $('.content-wrapper .price');

    $pricesBlocks.each(function () {
      var $this = $(this);

      checkPrice($pricesBlocks);
    });

    function checkPrice(price) {
      var $priceItems = price.find('.item .bd-item'),
        current,
        arr;

      for (var i = 0; i < $priceItems.length; i++) {
        current = $priceItems.eq(i);
        arr = current.text().split('.');

        if (arr.length !== 2) continue;

        current.text(arr[0]);
        current.append('<span>.' + arr[1] + '</span>');
      }
    }
  }

  function mobileDetect() {
    if (navigator.userAgent.match(/Android/i)
      || navigator.userAgent.match(/webOS/i)
      || navigator.userAgent.match(/iPhone/i)
      || navigator.userAgent.match(/iPad/i)
      || navigator.userAgent.match(/iPod/i)
      || navigator.userAgent.match(/BlackBerry/i)
      || navigator.userAgent.match(/Windows Phone/i)
    ) {
      $('body').addClass('mobile-device');
    }
  }

  function initJustifyBlocks() {
    var $page = $('body');
    var $sections = $('.section-text');

    if ($page.hasClass('mobile-device') || !$sections.length) return;

    var $sectionRight = $page.find('.section-right');
    var $sectionRightImg = $sectionRight.find('.col-3');
    var $sectionLeft = $page.find('.section-left');
    var $sectionLeftImg = $sectionLeft.find('.col-3');

    var sectionWidth = 981;
    var windowWidth, space, edge;

    setSpace();
    $(window).on('resize', setSpace);

    function setSpace() {
      windowWidth = $(window).outerWidth();
      space = (windowWidth - sectionWidth) / 2;

      if (windowWidth > 1920) {
        $sectionRight.css('margin-right', 0);
        $sectionRightImg.css('width', space);
        $sectionLeft.css('margin-left', 0);
        $sectionLeftImg.css('width', space);
      } else if (windowWidth > 1170) {
        edge = $sectionRightImg.outerWidth() - space;

        $sectionRight.css('margin-right', -edge);
        $sectionRightImg.css('width', '470px');
        $sectionLeft.css('margin-left', -edge);
        $sectionLeftImg.css('width', '470px');
      }
    }
  }

  function initSelect() {
    $('select:not(.with-search)').select2({
      width: 'full',
      minimumResultsForSearch: Infinity,
      adaptDropdownCssClass: function (c) {
        return c;
      }
    });

    $('select.with-search').select2({
      width: 'full',
      adaptDropdownCssClass: function (c) {
        return c;
      }
    });
  }

  function initNewLocationFromSelect(el) {
    var $select = $(el);

    $select.on('change', checkControl);

    function checkControl() {
      var val = $select.val();

      if (val == null || val == 'none') return;

      window.location = $select.val();
    }

    if ($select.closest('.form-filter').length) {
      $select.val(window.location.pathname);
      return false;
    } else {
      $select.val('none');
    }

    $select.trigger('change');
  }

  function initLandingPageFormWantTo() {
    var $wrapper = $('.form-want-to');
    var $firstControl = $wrapper.find('.first-control');
    var $secondControls = $wrapper.find('[data-filter]');
    var current = $firstControl.val();

    checkControl();
    $firstControl.on('change', checkControl);

    function checkControl() {
      current = $firstControl.val();
      $secondControls.removeClass('active');
      $secondControls.eq(current).addClass('active');
    }
  }

  function initCircles() {
    var $wrapper = $('.b-ingredients');
    var $window = $(window);

    if (!$wrapper.length) return;

    initScroll();

    $window.on('scroll', function () {
      initScroll();
    });

    function initScroll() {
      if ($wrapper.hasClass('b-ingredients-processed')) return;

      if ($window.height() + $window.scrollTop() > $wrapper.offset().top + $wrapper.height() / 2 + 50) {
        $wrapper.addClass('b-ingredients-processed');

        var options = {
          id: '',
          radius: 66,
          value: 0,
          maxValue: 100,
          width: 34,
          text: function (value) {
            return value + '%';
          },
          colors: ['#ececec', '#3caf49'],
          duration: 400,
          wrpClass: 'circles-wrp',
          textClass: 'circles-text',
          valueStrokeClass: 'circles-valueStroke',
          maxValueStrokeClass: 'circles-maxValueStroke',
          styleWrapper: true,
          styleText: false
        };

        var $circles = $wrapper.find('.circle');

        $circles.each(function () {
          var $circle = $(this);
          var id = $circle.parents('.item').attr('id');
          var $text = $circle.parents('.item').find('.item-title').clone();

          Circles.create($.extend(options, {
            id: id,
            value: $wrapper.find('#' + id + ' .circle').attr('data-percent')
          }));

          console.log($('#' + id).append($text));
        });
      }
    }
  }

  function initPopup() {
    var $wrapper = $('.b-popup');
    var $btnsWrapper = $wrapper.find('.btns-control');
    var $btns = $btnsWrapper.find('.btn');

    if (!$.cookie('person-21')) {
      $wrapper.addClass('visible');
      $('html, body').css('overflow', 'hidden');
    } else {
      initElmsAnimation();
    }

    $btns.on('mouseover', checkHover);
    $btns.on('mouseout', function () {
      $btnsWrapper.removeClass('btn-no-active');
    });
    $btns.on('click touch', checkItem);

    function checkItem(e) {
      e.preventDefault();
      var $this = $(this);

      if ($this.hasClass('btn-no')) {
        $wrapper.addClass('hidden-text-active');
      } else {
        $wrapper.removeClass('visible');
        initElmsAnimation();
        $.cookie('person-21', true, {expires: 365 * 10, path: '/'});
        $('html, body').css('overflow', 'visible');
      }
    }

    function checkHover() {
      var $this = $(this);

      if ($this.hasClass('btn-no')) {
        $btnsWrapper.addClass('btn-no-active');
      } else {
        $btnsWrapper.removeClass('btn-no-active');
      }
    }
  }

  function initElmsAnimation() {
    var $elms = $('.el-with-animation');
    var animationEnd = [];

    $(window).on('resize scroll', checkScroll);

    checkScroll();

    function checkScroll() {
      if (animationEnd.length === $elms.length) return;

      for (var i = 0; i < $elms.length; i++) {
        var $currentEl = $elms.eq(i);
        if (!$currentEl.hasClass('animating-end') && $(window).height() + $(window).scrollTop() > $currentEl.offset().top + $currentEl.height() / 2 + 50) {
          animate($currentEl);
        }
      }
    }

    function animate(el) {
      el.addClass('animating-end');
      animationEnd.push(1);
    }
  }

  function initNewsletterFormAnimation() {
    var $wrapper = $('.section-newsletter-type-2');
    var $btn = $wrapper.find('.btn-wrap:not(.style-black) a');

    $btn.on('click', checkItem);

    function checkItem(e) {
      e.preventDefault();

      if ($wrapper.hasClass('active')) {
        $wrapper.removeClass('active');
      } else {
        $wrapper.addClass('active');
      }
    }
  }

  function initFullWidthBlock() {
    var $elements = $('.full-block'),
      minWidth = 0;

    $(window).on('resize', setPosition);
    setPosition();

    function setPosition() {
      var $winWidth = $(window).outerWidth(),
        width;

      if ($winWidth > minWidth) {
        width = $winWidth;
      } else {
        width = minWidth;
      }

      $elements.width(width);
      $elements.css('margin-left', '-' + width / 2 + 'px');
    }
  }

  function initSoundManager() {
    if (typeof soundManager == 'undefined') return;

    soundManager.setup({
      onready: function () {
        soundManager.createSound();
      }
    });
  }

  function initFancybox() {
    $(".fancybox").fancybox({
      openEffect: 'elastic',
      closeEffect: 'elastic',
      padding: 10
    });
  }

})(jQuery);