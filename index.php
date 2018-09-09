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
                <h1 class="page-title">You might also like</h1>
                <div class="grid-view-container">
                    <?php
                    $albumObj = new \App\Album();
                    $albums = $albumObj->getAlbums();
                    ?>
                    <?php foreach ($albums as $album): ?>
                        <div class="grid-view-item">
                            <a href="album.php?id=<?= $album['id'] ?>">
                                <img src="<?= $album['artwork'] ?>" alt="<?= $album['title'] ?>">
                                <div class="grid-view-info">
                                    <p class="info-title"><?= $album['title'] ?></p>
                                    <p class="info-subtitle">By <?= $album['artist'] ?></p>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <?php include('_control.php') ?>
</div>
</body>
</html>
<?php require('support/cleaner.php') ?>