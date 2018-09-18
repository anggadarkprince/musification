<?php require('support/initiator.php') ?>
<?php ob_start(); ?>

    <h1 class="page-title">You might also like</h1>
    <div class="grid-view-container">
        <?php
        $albumObj = new \App\Album();
        $albums = $albumObj->getAlbums();
        ?>
        <?php foreach ($albums as $album): ?>
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