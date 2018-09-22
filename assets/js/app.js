var timer;

function openPage(url, fade = true) {
    if(timer != null) clearTimeout(timer);

    let encodedUrl = encodeURI(url);
    $('.main-content').load(encodedUrl, function() {
        if(fade) $('.main-content').hide().fadeIn(300);
        $('.view-container').scrollTop(0);
        if (typeof pageTitle !== 'undefined') {
            $('title').text(pageTitle);
        } else {
            $('title').text('Musification');
        }
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

    $(document).on('click', '.btn-new-playlist', function (e) {
        e.preventDefault();

        var playlistName = prompt("Enter the name of your playlist");
        if (playlistName) {
            $.post('actions/ajax/create_playlist.php', {playlist: playlistName})
                .done(function (data) {
                    if (!data.result) {
                        console.error("Something went wrong");
                    }
                });
        }
    });

});