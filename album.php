<?php require('support/initiator.php') ?>
<?php if(!$session->getData('auth.is_logged_in')) redirect('register.php') ?>
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

<body>
<div class="player">
    <div class="main-container">
        <?php include('_navbar.php') ?>

        <div class="playlist-container">
            <div class="main-content">
                <?php
                $albumObj = new \App\Album();
                $album = $albumObj->getAlbum(get_param('id'));
                ?>
                <h1 class="page-title">Album</h1>
                <div class="album-container">
                    <div class="artwork-wrapper">
                        <img src="<?= $album['artwork'] ?>" alt="<?= $album['title'] ?>">
                        <div class="artwork-info">
                            <h2 class="album-title"><?= $album['title'] ?></h2>
                            <p class="album-artist">By <?= $album['artist'] ?></p>
                            <p class="total-track"><?= $album['total_song'] ?> songs</p>
                        </div>
                    </div>
                    <ul class="track-list">
                        <?php
                        $songObj = new \App\Song();
                        $songs = $songObj->getSongAlbum(get_param('id'));
                        ?>
                        <?php foreach ($songs as $song): ?>
                            <li class="track-list-item">
                                <div class="icon-play">
                                    <img src="assets/images/player/play-white.png" class="control" alt="Play">
                                    <span><?= $song['order'] ?></span>
                                </div>
                                <div class="track-info">
                                    <p class="track-name"><?= $song['title'] ?></p>
                                    <span class="artist-name"><?= $song['artist'] ?></span>
                                </div>
                                <div class="track-option control">
                                    <img src="assets/images/player/more.png" alt="More">
                                </div>
                                <div class="track-duration">
                                    <?= format_date($song['duration'], 'H:i') ?>
                                </div>
                                <div class="track-played">
                                    <?= number_format($song['plays'], 0, ',', '.') ?>x
                                    plays
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php include('_control.php') ?>
</div>
</body>
</html>
<?php require('support/cleaner.php') ?>