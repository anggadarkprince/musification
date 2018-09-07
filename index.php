<?php require 'support/initiator.php' ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Welcome to Musification!</title>
    <meta name="description" content="Modern music streaming">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="assets/css/bootstrap-reboot.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/bootstrap-grid.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/app.css" rel="stylesheet" type="text/css">
    <link href="assets/css/player.css" rel="stylesheet" type="text/css">
</head>

<body class="player">
<div class="playing-bar">
    <div class="now-playing-bar">
        <div class="album-wrapper">
            <a href="#" class="album-link">
                <img src="https://s.mxmcdn.net/site/images/album-placeholder.png" class="album-artwork" alt="Album Cover">
            </a>
            <div class="track-info">
                <span class="track-name">Track name</span>
                <span class="artist-name">Artist name</span>
            </div>
        </div>
        <div class="control-wrapper">
            <div class="player-control">
                <div class="buttons">
                    <button class="control-button shuffle" title="Shuffle Button">
                        <img src="assets/images/player/shuffle.png" alt="Shuffle">
                    </button>
                    <button class="control-button previous" title="Previous Button">
                        <img src="assets/images/player/previous.png" alt="Previous">
                    </button>
                    <button class="control-button play" title="Play Button">
                        <img src="assets/images/player/play.png" alt="Play">
                    </button>
                    <button class="control-button pause" title="Pause Button" style="display: none">
                        <img src="assets/images/player/pause.png" alt="Pause">
                    </button>
                    <button class="control-button next" title="Next Button">
                        <img src="assets/images/player/next.png" alt="Next">
                    </button>
                    <button class="control-button repeat" title="Repeat Button">
                        <img src="assets/images/player/repeat.png" alt="Repeat">
                    </button>
                </div>

                <div class="playback-bar">
                    <span class="progress-time current">0:00</span>
                    <div class="progress-bar">
                        <div class="progress-bar-base">
                            <div class="progress"></div>
                        </div>
                    </div>
                    <span class="progress-time remaining">0:00</span>
                </div>
            </div>
        </div>
        <div class="volume-wrapper">
            <div class="volume-bar">
                <button class="control-button volume" title="Volume Button">
                    <img src="assets/images/player/volume.png" alt="Volume">
                </button>
                <div class="progress-bar">
                    <div class="progress-bar-base">
                        <div class="progress"></div>
                    </div>
                </div>
                <button class="control-button mute" title="Mute Button" style="display: none">
                    <img src="assets/images/player/volume-mute.png" alt="Mute">
                </button>
            </div>
        </div>
    </div>
</div>
</body>

</html>
<?php require 'support/cleaner.php' ?>