(function ($) {

  Drupal.theme.prototype.NativeGoldenTicketModal = function () {
    var html = '';

    html += '<div id="ctools-modal" class="popups-box">';
    html += ' <div class="ctools-modal-content modal form">';
    html += '   <div class="popups-container">';
    html += '     <span class="popups-close"><a class="close" href="#">' + Drupal.CTools.Modal.currentSettings.closeText + '</a></span>';
    html += '     <div id="modal-content" class="modal-content popups-body"></div>';
    html += '   </div>';
    html += '  </div>';
    html += '</div>';

    return html;
  };

  Drupal.theme.prototype.NativeGoldenTicketDoneModal = function () {
    var html = '';

    html += '<div id="ctools-modal" class="popups-box">';
    html += ' <div class="ctools-modal-content modal form-done form">';
    html += '   <div class="popups-container">';
    html += '     <span class="popups-close"><a class="close" href="#">' + Drupal.CTools.Modal.currentSettings.closeText + '</a></span>';
    html += '     <div id="modal-content" class="modal-content popups-body"></div>';
    html += '   </div>';
    html += '  </div>';
    html += '</div>';

    return html;
  };

  Drupal.behaviors.NativeGoldenTicketModalClose = {
    attach: function (context, settings) {
      $('#modal-close').once('ctools_backdrop_close', function () {
        $(this).click(function () {
          Drupal.CTools.Modal.dismiss();
        });
      });
    }
  };

})(jQuery);