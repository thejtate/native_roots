(function ($) {

  Drupal.behaviors.galleryType2 = {
    attach: function (context, settings) {
      $(".fancybox").fancybox({
        afterLoad: function () {
          this.title = '<a href="' + this.title + '">Download</a> ';
        },
        helpers: {
          title: {
            type: 'inside'
          }
        }
      });
    }
  };

}(jQuery));