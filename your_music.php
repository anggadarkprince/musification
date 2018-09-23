<?php require('support/initiator.php') ?>

<?php
$playlistObj = new \App\Playlist();
$playlists = $playlistObj->getUserPlaylists($session->getData('auth.id'));
?>

<?php ob_start(); ?>
    <h1 class="page-title">Your Music</h1>
    <div class="playlist-container">
        <div class="center">
            <button class="button primary btn-new-playlist" data-modal="#modal-playlist">NEW PLAYLIST</button>
        </div>
    </div>
<?php
$__pageTitle = 'Musification - Your music';
$__content = ob_get_contents();
ob_end_clean();
?>

<?php if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])): ?>
    <?php echo $__content ?>
<?php else: ?>
    <?php include('_layout.php') ?>
<?php endif; ?>