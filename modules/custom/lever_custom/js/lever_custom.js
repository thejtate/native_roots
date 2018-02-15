(function ($) {

    Drupal.behaviors.leverCustomActions = {
      attach: function (context, settings) {
          var $wrap = $('.lever-posts-wrapper', context);

          $wrap.once('lever-posts',function() {

              var posts = $wrap.find('.lever-posts');
              var filter = $wrap.find('.job-category-filter');

              filter.val('all');

              filter.once('filter').on('change', function(){
                    var category = $(this).val();

                  if(category !== 'all') {
                      posts.find('.job').not('.team-' + category).fadeOut("fast");
                      posts.find('.team-' + category).fadeIn("fast");
                  } else {
                      posts.find('.job').fadeIn("fast");
                  }
              });
          });

      }
    };

})(jQuery);