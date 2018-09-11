$(function () {

    function Audio() {

        this.currentlyPlaying;
        this.audio = document.createElement('audio');

        this.setTrack = function (src) {
            this.currentlyPlaying = src;
            this.audio.src = src;
        }

        this.play = function () {
            this.audio.play().then(function (currentlyPlaying) {
                console.log('Play track ' + currentlyPlaying);
            }(this.currentlyPlaying));
        }

        this.pause = function () {
            this.audio.pause();
        }
    }

    var currentPlaylist = [];
    var audioElement = new Audio();

    $.get('actions/ajax/get_random_songs.php', function (data) {
        if (data.length > 0) {
            currentPlaylist = data;
            setTrack(currentPlaylist[0], currentPlaylist, false);
        }
    });

    function setTrack(trackId, newPlaylist, playImmediately) {
        $.get('actions/ajax/get_song.php', {id: trackId}, function (song) {
            if (song) {
                $('.playing-bar .track-name').text(song.title);
                $('.playing-bar .artist-name').text(song.artist);
                audioElement.setTrack(song.path);
                if (playImmediately) {
                    audioElement.play();
                }
            }
        });
    }

    $('#control-play').on('click', function () {
        audioElement.play();
        $('#control-pause').show();
        $('#control-play').hide();
    });

    $('#control-pause').on('click', function () {
        audioElement.pause();
        $('#control-pause').hide();
        $('#control-play').show();
    });

});