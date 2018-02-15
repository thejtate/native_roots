(function() {
    if (document.getElementById('weedmenuPane') == null) {
        document.write('<div id="weedmenuPane"></div>');
    }

    if(mobileDetect()) {

        if(typeof wmenu_mobile_url == 'undefined' || wmenu_mobile_url != null) {


            var iframe_element = '<iframe src=' + wmenu_mobile_url + ' width=100% height=1000 frameborder="0"></iframe>';
            var iframe;
            iframe = document.getElementById('weedmenuPane');
            iframe.innerHTML = iframe_element;

        }

    } else {

        if (typeof wmenu_id == 'undefined' || wmenu_id == null) {
            var listing_id = document.getElementById('weedmenuPane').getAttribute('data-listing-id');
        }
        else {
            var listing_id = wmenu_id;
        }
        if (typeof wmenu_type == 'undefined' || wmenu_type == null) {
            var listing_type = 'dispensaries';
        }
        else {
            var listing_type = wmenu_type;
        }

        var iframe_src_url = "//weedmaps.com/" + listing_type + '/' + listing_id + '/menu/embed';
        var iframe_element;
        iframe_element = '<iframe src=' + iframe_src_url + ' width=100% height=1000 frameborder="0"></iframe>';

        var iframe;
        iframe = document.getElementById('weedmenuPane');
        iframe.innerHTML = iframe_element;
    }

    function mobileDetect() {
        return (navigator.userAgent.match(/Android/i)
            || navigator.userAgent.match(/webOS/i)
            || navigator.userAgent.match(/iPhone/i)
            || navigator.userAgent.match(/iPad/i)
            || navigator.userAgent.match(/iPod/i)
            || navigator.userAgent.match(/BlackBerry/i)
            || navigator.userAgent.match(/Windows Phone/i)
        );
    }

})(); // We call our anonymous function immediately