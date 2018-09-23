<?php require('support/initiator.php') ?>

<?php
$playlistObj = new \App\Playlist();
$playlist = $playlistObj->getPlaylist(get_param('id'));
$songs = $playlistObj->getPlaylistSongs(get_param('id'));
?>

<?php ob_start(); ?>
    <h1 class="page-title">Playlist: <?= $playlist['title'] ?></h1>
    <div class="playlist-container" data-id="<?= $playlist['id'] ?>">
        <div class="album-container">
            <div class="artwork-wrapper">
                <img src="assets/images/player/playlist.png" alt="Playlist" class="cover-playlist">
                <div class="artwork-info">
                    <h2 class="album-title"><?= $playlist['title'] ?></h2>
                    <p class="album-artist">By <?= $playlist['owner'] ?></p>
                    <p class="fade"><?= if_empty($playlist['description'], 'No description') ?></p>
                    <p class="total-track"><?= $playlist['total_song'] ?> songs</p>
                    <button class="button btn-delete-playlist my-3"
                            data-modal="#modal-delete-playlist"
                            data-id="<?= $playlist['id'] ?>"
                            data-title="<?= $playlist['title'] ?>">
                        Delete Playlist
                    </button>
                </div>
            </div>
            <?php if(empty($songs)): ?>
                <p class="fade">It's lonely here, no any songs in the playlist</p>
            <?php else: ?>
                <?php include('_track_list.php') ?>
            <?php endif; ?>
        </div>
    </div>
    <script>
        var pageTitle = 'Musification - <?= $playlist['title'] ?>';
    </script>
<?php
$__pageTitle = 'Musification - ' . $playlist['title'];
$__content = ob_get_contents();
ob_end_clean();
?>

<?php if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])): ?>
    <?php echo $__content ?>
<?php else: ?>
    <?php include('_layout.php') ?>
<?php endif; ?>