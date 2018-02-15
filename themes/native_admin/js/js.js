(function ($) {

  $(window).load(function () {
    initNavMenu();
  });

  function initNavMenu() {
    var $nav = $('.admin-menu #navigation');

    $nav.prepend('<a href="#" class="menu-btn"></a>');

    var $btn = $('.menu-btn');

    $btn.on('click', function (e) {
      e.preventDefault();

      if ($btn.hasClass('active')) {
        $(this).removeClass('active');
        $nav.find('.tabs').removeClass('opened');
      } else {
        $(this).addClass('active');
        $nav.find('.tabs').addClass('opened');
      }
    })
  }
})(jQuery);