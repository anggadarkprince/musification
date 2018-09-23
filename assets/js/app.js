var timer;

function openPage(url, fade = true) {
    if (timer != null) clearTimeout(timer);

    let encodedUrl = encodeURI(url);
    $('.main-content').load(encodedUrl, function () {
        if (fade) $('.main-content').hide().fadeIn(300);
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

    // modal functionality
    $(document).on('click', '[data-modal]', function (e) {
        e.preventDefault();
        $($(this).data('modal')).addClass('show-modal');
    });

    $(window).on('click', function (event) {
        if ($(event.target).hasClass('modal')) {
            $(event.target).removeClass('show-modal');
        }
    });

    $(document).on('click', '.modal', function (event) {
        if ($(event.target).data('close') == 'modal') {
            $(event.target).closest('.modal').removeClass('show-modal');
        }
    });

    // navigation functionality
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

    var modalPlaylist = $('#modal-playlist');
    var buttonSavePlaylist = modalPlaylist.find('.btn-save-playlist');

    $(document).on('click', '.btn-new-playlist', function (e) {
        e.preventDefault();

        modalPlaylist.find('#playlist-title').val('');
        modalPlaylist.find('#playlist-description').val('');

        setTimeout(function () {
            modalPlaylist.find('#playlist-title').focus();
        }, 200);
    });

    buttonSavePlaylist.on('click', function () {
        var playlist = modalPlaylist.find('#playlist-title').val();
        var description = modalPlaylist.find('#playlist-description').val();

        if (playlist) {
            buttonSavePlaylist.prop('disabled', true);
            $.post('actions/ajax/create_playlist.php', {playlist: playlist, description: description})
                .done(function (data) {
                    buttonSavePlaylist.prop('disabled', false);
                    if (data.result) {
                        modalPlaylist.removeClass('show-modal');
                        $('.playlist-group .create-playlist').before("<div class='nav-item'><a href='playlist.php?id=" + data.result + "' class='nav-item-link ajax-link'>" + playlist + "</div>")
                        if ($('.playlist-container').length) {
                            openPage('your_music.php');
                        }
                    } else {
                        console.error("Something went wrong");
                    }
                });
        } else {
            alert('Playlist title is required');
        }
    });


    var modalDeletePlaylist = $('#modal-delete-playlist');
    var buttonRemovePlaylist = modalDeletePlaylist.find('.btn-remove-playlist');

    $(document).on('click', '.btn-delete-playlist', function (e) {
        e.preventDefault();
        modalDeletePlaylist.find('#delete-playlist-id').val($(this).data('id'));
        modalDeletePlaylist.find('#playlist-title').text($(this).data('title'));
    });

    buttonRemovePlaylist.on('click', function () {
        var playlistId = modalDeletePlaylist.find('#delete-playlist-id').val();

        $.post('actions/ajax/delete_playlist.php', {id: playlistId})
            .done(function (data) {
                buttonRemovePlaylist.prop('disabled', false);
                if (data.result) {
                    modalDeletePlaylist.removeClass('show-modal');
                    $('.nav-playlist[data-id=' + playlistId + ']').remove();
                    openPage('your_music.php');
                } else {
                    console.error("Something went wrong");
                }
            });
    });

    $('.navigation-bar').on('click', '.nav-item', function () {
        $('.navigation-bar .nav-item').removeClass('active');
        $(this).addClass('active');
    });

    $(document).on('click', '.playlist-link', function () {
        $('.navigation-bar .nav-item').removeClass('active');
        $('.nav-playlist[data-id=' + $(this).data('id') + ']').addClass('active');
    });

});