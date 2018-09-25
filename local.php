<?php require('support/initiator.php') ?>

<?php ob_start(); ?>
    <h1 class="page-title">Local Files</h1>
    <div class="center mb-4">
        <input type="file" id="local-input" multiple accept="audio/mp3,audio/wav,audio/aac" style="position: fixed; top: -100em" />
        <button class="button primary" id="add-local-file">Add Local File</button>
    </div>
    <ul class="track-list track-local">
        <li class="track-list-item">No local files available</li>
    </ul>

    <script>
        var pageTitle = 'Musification - Local Files';
    </script>
    <script defer>
        $(function () {
            setLocalFile();
        });
    </script>
<?php
$__pageTitle = 'Musification - Local Files';
$__content = ob_get_contents();
ob_end_clean();
?>

<?php if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])): ?>
    <?php echo $__content ?>
<?php else: ?>
    <?php include('_layout.php') ?>
<?php endif; ?>