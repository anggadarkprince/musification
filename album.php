<?php require('support/initiator.php') ?>

<?php
$albumId = get_param('id');
$albumObj = new \App\Album();
$album = $albumObj->getAlbum($albumId);

$songObj = new \App\Song();
$songs = $songObj->getSongAlbum($albumId);
?>

<?php ob_start(); ?>
    <h1 class="page-title">Album</h1>
    <div class="album-container" data-id="<?= $album['id'] ?>">
        <div class="artwork-wrapper">
            <img src="<?= $album['artwork'] ?>" alt="<?= $album['title'] ?>">
            <div class="artwork-info">
                <h2 class="album-title"><?= $album['title'] ?></h2>
                <p class="album-artist">By <?= $album['artist'] ?></p>
                <p class="total-track"><?= $album['total_song'] ?> songs</p>
            </div>
        </div>
        <?php include('_track_list.php') ?>
    </div>
    <script>
        var pageTitle = 'Musification - <?= $album['title'] ?>';
    </script>
<?php
$__pageTitle = 'Musification - ' . $album['title'];
$__content = ob_get_contents();
ob_end_clean();
?>

<?php if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])): ?>
    <?php echo $__content ?>
<?php else: ?>
    <?php include('_layout.php') ?>
<?php endif; ?>