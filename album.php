<?php require('support/initiator.php') ?>

<?php
$albumObj = new \App\Album();
$album = $albumObj->getAlbum(get_param('id'));
?>

<?php ob_start(); ?>
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
        <ul class="track-list album" data-id="<?= get_param('id') ?>">
            <?php
            $songObj = new \App\Song();
            $songs = $songObj->getSongAlbum(get_param('id'));
            ?>
            <?php foreach ($songs as $song): ?>
                <li class="track-list-item" data-id="<?= $song['id'] ?>">
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
<?php
$content = ob_get_contents();
ob_end_clean();
?>

<?php if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])): ?>
    <?php echo $content ?>
<?php else: ?>
    <?php include('_layout.php') ?>
<?php endif; ?>