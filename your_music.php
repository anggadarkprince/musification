<?php require('support/initiator.php') ?>

<?php
$playlistObj = new \App\Playlist();
$playlists = $playlistObj->getUserPlaylists($session->getData('auth.id'));
?>

<?php ob_start(); ?>
    <h1 class="page-title">Your Music</h1>
    <div class="center">
        <button class="button primary btn-new-playlist" data-modal="#modal-playlist">NEW PLAYLIST</button>
    </div>
    <div class="playlist-container">
        <div class="grid-view-container">
            <?php foreach ($playlists as $playlist): ?>
                <div class="grid-view-item">
                    <a href="playlist.php?id=<?= $playlist['id'] ?>" class="playlist-link ajax-link" data-id="<?= $playlist['id'] ?>">
                        <img src="assets/images/player/playlist.png" alt="Playlist" class="cover-playlist">
                        <div class="grid-view-info">
                            <p class="info-title"><?= $playlist['title'] ?></p>
                            <p class="info-subtitle"><?= $playlist['total_song'] ?> songs</p>
                            <p class="info-subtitle fade"><?= if_empty($playlist['description'], 'No description') ?></p>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
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