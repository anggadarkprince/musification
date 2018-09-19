$(function () {

    $(document).on('click', '.ajax-link', function (e) {
        e.preventDefault();

        if ($(this).attr('href')) {
            openPage($(this).attr('href'));
        }
        else if ($(this).data('url')) {
            openPage($(this).data('url'));
        }
    });

    function openPage(url) {
        let encodedUrl = encodeURI(url);
        $('.main-content').load(encodedUrl, function() {
            $('.main-content').hide().fadeIn(300);
        });
        $('body').scrollTop(0);
        history.pushState(null, null, url);
    }

    $(window).on('popstate', function () {
        openPage(window.location.href);
    });
});