$(function () {

    function formatTime(sec) {
        let time = Math.round(sec);
        let minutes = Math.floor(time / 60);
        let seconds = time - (minutes * 60);
        if (seconds < 10) {
            seconds = '0' + seconds;
        }
        return minutes + ':' + seconds;
    }

    function updateTimeProgressBar(audio) {
        $('.progress-time.current').text(formatTime(audio.currentTime));
        $('.progress-time.remaining').text(formatTime(audio.duration - audio.currentTime));
        var progress = audio.currentTime / audio.duration * 100;
        $('.progress-bar .progress').css('width', progress + '%');
    }

    function Audio() {

        this.currentlyPlaying;
        this.audio = document.createElement('audio');

        this.audio.addEventListener('canplay', function () {
            $('.progress-time.remaining').text(formatTime(this.duration));
        });

        this.audio.addEventListener('timeupdate', function () {
            if (this.duration) {
                updateTimeProgressBar(this);
            }
        });

        this.setTrack = function (track) {
            this.currentlyPlaying = track;
            this.audio.src = track.path;
        };

        this.play = function () {
            this.audio.play();
        };

        this.pause = function () {
            this.audio.pause();
        }
    }

    let currentPlaylist = [];
    let audioElement = new Audio();

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
                $('.playing-bar .album-artwork').attr('src', song.artwork);
                audioElement.setTrack(song);
                if (playImmediately) {
                    playSong();
                }
            }
        });
    }

    function playSong() {
        audioElement.play();
        console.log(audioElement.audio.currentTime);
        if (audioElement.audio.currentTime == 0) {
            $.post('actions/ajax/count_song_play.php', {id: audioElement.currentlyPlaying.id}, function (result) {
                if (result) {
                    console.log(result);
                }
            });
        }
    }

    function pauseSong() {
        audioElement.pause();
    }

    $('#control-play').on('click', function () {
        playSong();
        $('#control-pause').show();
        $('#control-play').hide();
    });

    $('#control-pause').on('click', function () {
        pauseSong();
        $('#control-pause').hide();
        $('#control-play').show();
    });

});