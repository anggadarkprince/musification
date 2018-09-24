let timer;

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

function setTrackRecentPlayed() {
    if($('.track-recent').length) {
        let trackTemplate = $('#track-list-template').html();
        let songs = readAllData(STORE_HISTORIES);
        songs.onsuccess = function(event) {
            let songData = event.target.result;
            if(songData.length > 0) {
                $('.track-recent').empty();
            }
            songData.sort((a,b) => (a.played_at < b.played_at) ? 1 : ((b.played_at < a.played_at) ? -1 : 0));
            songData.forEach(function (song, index) {
                $('.track-recent').append(
                    trackTemplate
                        .replace(/{{order}}/g, (index + 1))
                        .replace(/{{id}}/g, song.id)
                        .replace(/{{album_id}}/g, song.album_id)
                        .replace(/{{title}}/g, song.title)
                        .replace(/{{artist}}/g, song.artist)
                        .replace(/{{album}}/g, song.album)
                        .replace(/{{duration}}/g, song.duration.substring(0, 5))
                        .replace(/{{plays}}/g, song.plays)
                );
            });
        };
    }
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
        if ($(event.target).data('close') === 'modal') {
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

    let modalPlaylist = $('#modal-playlist');
    let buttonSavePlaylist = modalPlaylist.find('.btn-save-playlist');

    $(document).on('click', '.btn-new-playlist', function (e) {
        e.preventDefault();

        modalPlaylist.find('#playlist-title').val('');
        modalPlaylist.find('#playlist-description').val('');

        setTimeout(function () {
            modalPlaylist.find('#playlist-title').focus();
        }, 200);
    });

    buttonSavePlaylist.on('click', function () {
        let playlist = modalPlaylist.find('#playlist-title').val();
        let description = modalPlaylist.find('#playlist-description').val();

        if (playlist) {
            buttonSavePlaylist.prop('disabled', true);
            $.post('actions/ajax/create_playlist.php', {playlist: playlist, description: description})
                .done(function (data) {
                    buttonSavePlaylist.prop('disabled', false);
                    if (data.result) {
                        modalPlaylist.removeClass('show-modal');
                        $('.playlist-group .create-playlist').before("<div class='nav-item nav-playlist' data-id='" + data.result + "'><a href='playlist.php?id=" + data.result + "' class='nav-item-link ajax-link'>" + playlist + "</div>");
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


    let modalDeletePlaylist = $('#modal-delete-playlist');
    let buttonRemovePlaylist = modalDeletePlaylist.find('.btn-remove-playlist');

    $(document).on('click', '.btn-delete-playlist', function (e) {
        e.preventDefault();
        modalDeletePlaylist.find('#delete-playlist-id').val($(this).data('id'));
        modalDeletePlaylist.find('#playlist-title').text($(this).data('title'));
    });

    buttonRemovePlaylist.on('click', function () {
        let playlistId = modalDeletePlaylist.find('#delete-playlist-id').val();

        $.post('actions/ajax/delete_playlist.php', {id: playlistId})
            .done(function (data) {
                buttonRemovePlaylist.prop('disabled', false);
                if (data.result) {
                    modalDeletePlaylist.removeClass('show-modal');
                    $('.nav-playlist[data-id=' + playlistId + ']').remove();
                    $('.navigation-bar .nav-item').removeClass('active');
                    $('.nav-your-music').addClass('active');
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

    $('.playing-bar .artist-name').on('click', function () {
        $('.navigation-bar .nav-item').removeClass('active');
    });

    $(document).on('click', '.playlist-link', function () {
        $('.navigation-bar .nav-item').removeClass('active');
        $('.nav-playlist[data-id=' + $(this).data('id') + ']').addClass('active');
    });

    let menu = $('.options-menu');
    let menuWidth = menu.width() - 40;

    $(document).on('click', '.option-button', function (e) {
        e.preventDefault();
        let scrollTop = $(window).scrollTop();
        let offset = $(this).offset().top;

        let top = offset - scrollTop;
        let left = $(this).position().left;

        menu.css({
            'top': (top + 20) + 'px',
            'left': (left - menuWidth) + 'px',
            'display': 'inline'
        });

        let songId = $(this).closest('.track-list-item').data('id');
        menu.find('.song_id').val(songId);

        if ($('.playlist-container').length) {
            menu.find('#remove-playlist-song').show();
        } else {
            menu.find('#remove-playlist-song').hide();
        }
    });

    $('.view-container').on('scroll', function () {
        if (menu.css('display') !== 'none') {
            menu.css('display', 'none');
        }
    });

    $(document).on('click', function (e) {
        let target = $(e.target);
        if (!target.hasClass('item') && !target.hasClass('option-button')) {
            menu.css('display', 'none');
        }
    });

    menu.find('#select-playlist').on('change', function () {
        let playlistId = $(this).val();
        let songId = menu.find('.song_id').val();
        if (playlistId) {
            $.post('actions/ajax/add_playlist_song.php', {playlist_id: playlistId, song_id: songId}, function (data) {
                if (data.result) {
                    menu.css('display', 'none');
                } else {
                    console.error("Something went wrong");
                }
            });
            $(this).val('');
        }
    });

    menu.find('#remove-playlist-song').on('click', function () {
        let playlistId = $('.playlist-container').data('id');
        let songId = menu.find('.song_id').val();
        $.post('actions/ajax/remove_playlist_song.php', {playlist_id: playlistId, song_id: songId}, function (data) {
            if (data.result) {
                menu.css('display', 'none');
                openPage('playlist.php?id=' + playlistId, false);
            } else {
                console.error("Something went wrong");
            }
        });
    });
});