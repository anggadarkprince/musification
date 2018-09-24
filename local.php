<?php require('support/initiator.php') ?>

<?php ob_start(); ?>
    <h1 class="page-title">Local Files</h1>

    <script>
        var pageTitle = 'Musification - Local Files';
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