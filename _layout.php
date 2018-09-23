<?php require('support/initiator.php') ?>
<?php if(!$session->getData('auth.is_logged_in')) redirect('register.php') ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?= isset($__pageTitle) ? $__pageTitle : 'Musification' ?></title>
    <meta name="description" content="Modern music streaming">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="user-id" content="<?= $session->getData('auth.id') ?>">
    <link href="assets/css/bootstrap-reboot.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/bootstrap-grid.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/app.css" rel="stylesheet" type="text/css">
    <link href="assets/css/player.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
<div class="player">
    <div class="main-container">
        <?php include('_navbar.php') ?>

        <div class="view-container">
            <div class="main-content">
                <?php echo $__content ?>
            </div>
        </div>
    </div>
    <?php include('_control.php') ?>
</div>
<div class="modal" id="modal-playlist">
    <div class="modal-content">
        <span class="close-button" data-close="modal">&times;</span>
        <h1 class="modal-title">Create new playlist</h1>
        <div class="input-group">
            <input class="input" type="text" name="playlist_title" id="playlist-title"
                   maxlength="50" placeholder="Playlist name">
        </div>
        <div class="input-group">
            <textarea class="input" name="playlist_description" id="playlist-description"
                      rows="2" maxlength="500" placeholder="Playlist description"></textarea>
        </div>
        <div class="mb-2 right">
            <button type="button" class="button primary btn-save-playlist">Create Playlist</button>
        </div>
    </div>
</div>

<div class="modal" id="modal-delete-playlist">
    <div class="modal-content">
        <span class="close-button" data-close="modal">&times;</span>
        <h1 class="modal-title">Delete playlist</h1>
        <div class="mb-3">
            <input type="hidden" id="delete-playlist-id" value="">
            <p class="mb-1">Are you sure want to delete playlist <strong id="playlist-title"></strong>?</p>
            <span class="fade">This action is irreversible, proceed carefully.</span>
        </div>
        <div class="mb-2 right">
            <button type="button" class="button primary btn-remove-playlist">Delete Playlist</button>
        </div>
    </div>
</div>
<script src="assets/js/app.js"></script>
<script src="assets/js/player.js"></script>
<script src="assets/js/search.js"></script>
</body>
</html>
<?php require('support/cleaner.php') ?>