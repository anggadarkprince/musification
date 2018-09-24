<?php require('support/initiator.php') ?>

<?php ob_start(); ?>
    <h1 class="page-title">Recent</h1>
    <ul class="track-list track-recent">
        <li class="track-list-item">No recent played song</li>
    </ul>

    <script id="track-list-template" type="text/x-custom-template">
        <li class="track-list-item" data-id="{{id}}" data-album="{{album_id}}">
            <div class="icon-play">
                <img src="assets/images/player/play-white.png" class="control" alt="Play">
                <span>{{order}}</span>
            </div>
            <div class="track-info">
                <p class="track-name">{{title}}</p>
                <span class="artist-name">{{artist}}</span>
            </div>
            <div class="track-album">
                <a href="album.php?id={{album_id}}" class="ajax-link">
                    {{album}}
                </a>
            </div>
            <div class="track-option control">
                <img src="assets/images/player/more.png" alt="More" class="option-button">
            </div>
            <div class="track-duration">
                {{duration}}
            </div>
            <div class="track-played">
                {{plays}}x plays
            </div>
        </li>
    </script>
    <script>
        var pageTitle = 'Musification - Recent Played';
    </script>
    <script defer>
        $(function () {
            setTrackRecentPlayed();
        });
    </script>
<?php
$__pageTitle = 'Musification - Recent Played';
$__content = ob_get_contents();
ob_end_clean();
?>

<?php if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])): ?>
    <?php echo $__content ?>
<?php else: ?>
    <?php include('_layout.php') ?>
<?php endif; ?>