<?php require('support/initiator.php') ?>

<?php
$songObj = new \App\Song();

$artistObj = new \App\Artist();
$artist = $artistObj->getArtist(get_param('id'));
$popularSongs = $artistObj->getPopularSong(get_param('id'));

$albumObj = new \App\Album();
$albums = $albumObj->getArtistAlbum(get_param('id'));
?>

<?php ob_start(); ?>
    <div class="artist-title center">
        <h1 class="page-title"><?= $artist['name'] ?></h1>
        <button class="button primary" id="play-all">PLAY ALL</button>
    </div>

    <h2 class="page-subtitle">Popular</h2>
    <ul class="track-list">
        <?php $songOrder = 1; ?>
        <?php foreach ($popularSongs as $song): ?>
            <li class="track-list-item" data-id="<?= $song['id'] ?>">
                <div class="icon-play">
                    <img src="assets/images/player/play-white.png" class="control" alt="Play">
                    <span><?= $songOrder++ ?></span>
                </div>
                <div class="track-info">
                    <p class="track-name"><?= $song['title'] ?></p>
                    <span class="artist-name"><?= $song['artist'] ?></span>
                </div>
                <div class="track-option control">
                    <img src="assets/images/player/more.png" alt="More">
                </div>
                <div class="track-album">
                    <?= $song['album'] ?>
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
            <ul class="track-list album" data-id="<?= $album['id'] ?>">
                <?php $songs = $songObj->getSongAlbum($album['id']); ?>
                <?php $songOrder = 1; ?>
                <?php foreach ($songs as $song): ?>
                    <li class="track-list-item" data-id="<?= $song['id'] ?>">
                        <div class="icon-play">
                            <img src="assets/images/player/play-white.png" class="control" alt="Play">
                            <span><?= $songOrder++ ?></span>
                        </div>
                        <div class="track-info">
                            <p class="track-name"><?= $song['title'] ?></p>
                            <span class="artist-name"><?= $song['artist'] ?></span>
                        </div>
                        <div class="track-option control">
                            <img src="assets/images/player/more.png" alt="More">
                        </div>
                        <div class="track-album">
                            <?= $song['album'] ?>
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
    <?php endforeach; ?>
<?php
$content = ob_get_contents();
ob_end_clean();
?>

<?php if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])): ?>
    <?php echo $content ?>
<?php else: ?>
    <?php include('_layout.php') ?>
<?php endif; ?>