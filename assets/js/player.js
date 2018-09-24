$(function () {

    function shuffleArray(a) {
        var j, x, i;
        for (i = a.length - 1; i > 0; i--) {
            j = Math.floor(Math.random() * (i + 1));
            x = a[i];
            a[i] = a[j];
            a[j] = x;
        }
        return a;
    }

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
        $('.playback-bar .progress').css('width', progress + '%');
    }

    function updateVolumeProgressBar(audio) {
        var volume = audio.volume * 100;
        $('.volume-bar .progress').css('width', volume + '%');
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

        this.audio.addEventListener('volumechange', function () {
            updateVolumeProgressBar(this);
        });

        this.audio.addEventListener('ended', function () {
            nextSong();
        })

        this.setTrack = function (track) {
            this.currentlyPlaying = track;
            this.audio.src = track.path;
        };

        this.play = function () {
            this.audio.play();
        };

        this.pause = function () {
            this.audio.pause();
        };

        this.setTime = function (seconds) {
            this.audio.currentTime = seconds;
        }
    }

    $('.playing-bar').on('mousedown touchstart mousemove, touchmove', function (e) {
        e.preventDefault();
    });

    let isRepeat = false;
    let isShuffle = false;
    let currentIndex = 0;
    let currentPlaylist = [];
    let tempPlaylist = [];
    let shufflePlaylist = [];
    let audioElement = new Audio();

    function getPageTrackList() {
        var trackList = [];
        $('.track-list-item[data-id]').each(function (index, el) {
            if ($.inArray($(el).data('id'), trackList) === -1) {
                trackList.push($(el).data('id'));
            }
        });
        return trackList;
    }

    if ($('.track-list-item').length) {
        tempPlaylist = getPageTrackList();
        if (tempPlaylist.length > 0) {
            setTrack(tempPlaylist[0], tempPlaylist, false);
        }
    } else {
        $.get('actions/ajax/get_random_songs.php', function (playlist) {
            if (playlist.length > 0) {
                setTrack(playlist[0], playlist, false);
            }
        });
    }

    $(document).on('click', '.track-list-item .icon-play', function () {
        let trackListItem = $(this).closest('.track-list-item');
        let trackId = trackListItem.data('id');

        tempPlaylist = getPageTrackList();
        setTrack(trackId, tempPlaylist, true);

        $('#control-pause').show();
        $('#control-play').hide();
    });

    function setTrack(trackId, newPlaylist, playImmediately) {
        if (newPlaylist != currentPlaylist) {
            currentPlaylist = newPlaylist;
            shufflePlaylist = shuffleArray(currentPlaylist.slice());
        }

        if (isShuffle) {
            currentIndex = shufflePlaylist.indexOf(trackId);
        } else {
            currentIndex = currentPlaylist.indexOf(trackId);
        }
        pauseSong();

        if ($('.track-list-item').length) {
            $('.track-list-item').removeClass('playing');
            $('.track-list-item[data-id="' + trackId + '"]').addClass('playing');
        }

        $.get('actions/ajax/get_song.php', {id: trackId}, function (song) {
            if (song) {
                $('.playing-bar .track-name').text(song.title);
                $('.playing-bar .artist-name').text(song.artist).attr('href', 'artist.php?id=' + song.artist_id);
                $('.playing-bar .album-link').attr('href', 'album.php?id=' + song.album_id);
                $('.playing-bar .album-artwork').attr('src', song.artwork);
                audioElement.setTrack(song);
                if (playImmediately) {
                    playSong();
                }
            }
        });
    }

    $(document).on('click', '#play-all', function () {
        tempPlaylist = getPageTrackList();
        setTrack(tempPlaylist[0], tempPlaylist, true);
    });

    function playSong() {
        audioElement.play();
        if (audioElement.audio.currentTime === 0) {
            $.post('actions/ajax/count_song_play.php', {id: audioElement.currentlyPlaying.id}, function (result) {
                if (!result) {
                    console.error("Something went wrong");
                }
            });
        }

        $('#control-pause').show();
        $('#control-play').hide();
    }

    function pauseSong() {
        audioElement.pause();
    }

    function nextSong(play = true) {
        audioElement.setTime(0);

        if (isRepeat) {
            playSong();
            return;
        }

        if (currentIndex === currentPlaylist.length - 1) {
            currentIndex = 0;
        } else {
            currentIndex++;
        }

        let trackToPlay = isShuffle ? shufflePlaylist[currentIndex] : currentPlaylist[currentIndex];
        setTrack(trackToPlay, currentPlaylist, play);
    }

    function prevSong(play = true) {
        if (audioElement.audio.currentTime >= 3 || currentIndex === 0) {
            audioElement.setTime(0);
            return;
        }

        currentIndex--;
        let trackToPlay = currentPlaylist[currentIndex];
        setTrack(trackToPlay, currentPlaylist, play);
    }

    $('.control-button.play').on('click', function () {
        playSong();
    });

    $('.control-button.pause').on('click', function () {
        pauseSong();
        $('#control-pause').hide();
        $('#control-play').show();
    });

    $('.control-button.next').on('click', function () {
        nextSong(!audioElement.audio.paused);
    });

    $('.control-button.previous').on('click', function () {
        prevSong(!audioElement.audio.paused);
    });

    $('.control-button.repeat').on('click', function () {
        var repeatIcon = isRepeat ? 'repeat.png' : 'repeat-active.png';
        $(this).find('img').attr('src', 'assets/images/player/' + repeatIcon);
        isRepeat = !isRepeat;
    });


    var isMouseDown = false;

    function timeFromOffset(mouse, progressBar) {
        var percentage = mouse.offsetX / $(progressBar).width() * 100;
        var seconds = audioElement.audio.duration * (percentage / 100);
        audioElement.setTime(seconds);
    }

    $('.playback-bar .progress-bar').on('mousedown', function () {
        isMouseDown = true;
    });

    $('.playback-bar .progress-bar').on('mousemove', function (e) {
        if (isMouseDown) {
            timeFromOffset(e, this);
        }
    });

    $('.playback-bar .progress-bar').on('mouseup', function (e) {
        timeFromOffset(e, this);
        isMouseDown = false;
    });

    $(document).on('mouseup', function (e) {
        isMouseDown = false;
    });


    $('.volume-bar .progress-bar').on('mousedown', function () {
        isMouseDown = true;
    });

    $('.volume-bar .progress-bar').on('mousemove', function (e) {
        if (isMouseDown) {
            var percentage = e.offsetX / $(this).width();
            if (percentage >= 0 && percentage <= 1) {
                audioElement.audio.volume = percentage;
            }
        }
    });

    $('.volume-bar .progress-bar').on('mouseup', function (e) {
        var percentage = e.offsetX / $(this).width();
        if (percentage >= 0 && percentage <= 1) {
            audioElement.audio.volume = percentage;
        }
        isMouseDown = false;
    });

    $('.volume-bar .progress-bar').on('wheel', function (event) {
        var currentVolume = audioElement.audio.volume;
        if (event.originalEvent.deltaY < 0) {
            if (currentVolume + 0.1 > 1) {
                audioElement.audio.volume = 1;
            } else {
                audioElement.audio.volume += 0.1;
            }
        } else {
            if (currentVolume - 0.1 < 0) {
                audioElement.audio.volume = 0;
            } else {
                audioElement.audio.volume -= 0.1;
            }
        }
    });

    $('.control-button.volume').on('click', function () {
        audioElement.audio.muted = !audioElement.audio.muted;
        var mutedIcon = audioElement.audio.muted ? 'volume-mute.png' : 'volume.png';
        $(this).find('img').attr('src', 'assets/images/player/' + mutedIcon);
    });

    $('.control-button.shuffle').on('click', function () {
        isShuffle = !isShuffle;
        var shuffleIcon = isShuffle ? 'shuffle-active.png' : 'shuffle.png';
        $(this).find('img').attr('src', 'assets/images/player/' + shuffleIcon);

        if (isShuffle) {
            shuffleArray(shufflePlaylist);
            currentIndex = shufflePlaylist.indexOf(audioElement.currentlyPlaying.id);
        } else {
            currentIndex = currentPlaylist.indexOf(audioElement.currentlyPlaying.id);
        }
    });

});