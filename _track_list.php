<ul class="track-list album">
    <?php $songOrder = 1; ?>
    <?php foreach ($songs as $song): ?>
        <li class="track-list-item" data-id="<?= $song['id'] ?>" data-album="<?= $song['album_id'] ?>">
            <div class="icon-play">
                <img src="assets/images/player/play-white.png" class="control" alt="Play">
                <span><?= $songOrder++ ?></span>
            </div>
            <div class="track-info">
                <p class="track-name"><?= $song['title'] ?></p>
                <span class="artist-name"><?= $song['artist'] ?></span>
            </div>
            <div class="track-album">
                <a href="album.php?id=<?= $song['album_id'] ?>" class="ajax-link">
                    <?= $song['album'] ?>
                </a>
            </div>
            <div class="track-option control">
                <img src="assets/images/player/more.png" alt="More" class="option-button">
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