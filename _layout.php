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

        <div class="playlist-container">
            <div class="main-content">
                <?php echo $content ?>
            </div>
        </div>
    </div>
    <?php include('_control.php') ?>
</div>
<script src="assets/js/app.js"></script>
<script src="assets/js/player.js"></script>
<script src="assets/js/search.js"></script>
</body>
</html>
<?php require('support/cleaner.php') ?>