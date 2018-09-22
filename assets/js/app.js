var timer;

function openPage(url, fade = true) {
    if(timer != null) clearTimeout(timer);

    let encodedUrl = encodeURI(url);
    $('.main-content').load(encodedUrl, function() {
        if(fade) $('.main-content').hide().fadeIn(300);
        $('.playlist-container').scrollTop(0);
    });
    history.pushState(null, null, url);
}

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

    $(window).on('popstate', function () {
        openPage(window.location.href);
    });
});