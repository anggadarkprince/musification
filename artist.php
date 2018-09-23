<?php require('support/initiator.php') ?>

<?php
$songObj = new \App\Song();

$artistObj = new \App\Artist();
$artist = $artistObj->getArtist(get_param('id'));
$songs = $artistObj->getPopularSong(get_param('id'));

$albumObj = new \App\Album();
$albums = $albumObj->getArtistAlbum(get_param('id'));
?>

<?php ob_start(); ?>
    <div class="artist-title center">
        <h1 class="page-title"><?= $artist['name'] ?></h1>
        <button class="button primary" id="play-all">PLAY ALL</button>
    </div>

    <h2 class="page-subtitle">Popular</h2>
    <?php include('_track_list.php') ?>

    <h2 class="page-subtitle">Albums</h2>
    <?php foreach ($albums as $album): ?>
        <div class="album-container">
            <div class="artwork-wrapper">
                <img src="<?= $album['artwork'] ?>" alt="<?= $album['title'] ?>">
                <div class="artwork-info">
                    <h2 class="album-title"><?= $album['title'] ?></h2>
                    <p class="album-artist">By <?= $album['artist'] ?></p>
                    <p class="total-track"><?= $album['total_song'] ?> songs</p>
                </div>
            </div>
            <?php $songs = $songObj->getSongAlbum($album['id']); ?>
            <?php include('_track_list.php') ?>
        </div>
    <?php endforeach; ?>
    <script>
        var pageTitle = 'Musification - <?= $artist['name'] ?>';
    </script>

<?php
$__pageTitle = 'Musification - ' . $artist['name'];
$__content = ob_get_contents();
ob_end_clean();
?>

<?php if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])): ?>
    <?php echo $__content ?>
<?php else: ?>
    <?php include('_layout.php') ?>
<?php endif; ?>