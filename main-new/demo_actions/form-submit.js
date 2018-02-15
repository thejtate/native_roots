/**
 * Created by dimateus on 19/11/15.
 */
(function ($) {

    $(function () {

        $('form.ajax-submit').each(function (i, f) {
            var $form = $(this),
                $formWrap = $form.parents('.site-container'),
                $submit = $form.find('input[type="submit"]'),
                action = $form.attr('action');

            init();

            function init() {
                $submit.on('click', ajaxSubmit);
            }

            function ajaxSubmit(e) {
                $.ajax({
                    type: "POST",
                    url: action,
                    data: $form.serialize(),
                    success: function (data) {
                        if (!$formWrap.hasClass('form-sent')) {
                            $formWrap.addClass('form-sent');
                        }
                    }
                });

                e.preventDefault();
            }

        });
    });

}(jQuery));