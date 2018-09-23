<?php require('support/initiator.php') ?>
<?php
$query = get_param('q');

$songObj = new \App\Song();
$songs = $songObj->searchSong($query);

$artistObj = new \App\Artist();
$artistResults = $artistObj->searchArtist($query);

$albumObj = new \App\Album();
$albumResults = $albumObj->searchAlbum($query);
?>
<?php ob_start(); ?>
    <div class="search-container">
        <input type="search" class="search-input" placeholder="Search for anything..." value="<?= $query ?>"
               autofocus onfocus="this.selectionStart = this.selectionEnd = this.value.length">
    </div>
    <div class="search-result-container">
        <h2 class="page-subtitle">Song</h2>
        <div class="search-section">
            <?php if(empty($songs)): ?>
                <p class="mb-5">No songs found matching term <?= $query ?></p>
            <?php else: ?>
                <?php include('_track_list.php') ?>
            <?php endif; ?>
        </div>

        <div class="search-section">
            <h2 class="page-subtitle">Artist</h2>
            <?php if(empty($artistResults)): ?>
                <p class="mb-5">No artists found matching term <?= $query ?></p>
            <?php else: ?>
                <ul class="track-list">
                    <?php foreach ($artistResults as $artist): ?>
                        <li class="track-list-item">
                            <a href="artist.php?id=<?= $artist['id'] ?>" class="ajax-link d-flex justify-content-between" style="width: 100%">
                                <span><?= $artist['name'] ?></span>
                                <span><?= $artist['total_album'] ?> albums</span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>

        <div class="search-section">
            <h2 class="page-subtitle">Album</h2>
            <?php if(empty($albumResults)): ?>
                <p class="mb-5">No albums found matching term <?= $query ?></p>
            <?php else: ?>
                <?php foreach ($albumResults as $album): ?>
                    <div class="grid-view-item">
                        <a href="album.php?id=<?= $album['id'] ?>" class="ajax-link">
                            <img src="<?= $album['artwork'] ?>" alt="<?= $album['title'] ?>">
                            <div class="grid-view-info">
                                <p class="info-title"><?= $album['title'] ?></p>
                                <p class="info-subtitle">By <?= $album['artist'] ?></p>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    <script>
        $('.search-input').focus();
        var pageTitle = 'Musification - Result of <?= $query ?>';
    </script>
<?php
$__pageTitle = 'Musification - Result of ' . $query;
$__content = ob_get_contents();
ob_end_clean();
?>

<?php if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])): ?>
    <?php echo $__content ?>
<?php else: ?>
    <?php include('_layout.php') ?>
<?php endif; ?>