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
        var encodedUrl = encodeURI(url);
        $('.main-content').load(encodedUrl);
    }
});