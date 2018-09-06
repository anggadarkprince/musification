<?php if($session->isFlashExist('message')): ?>
    <div class="alert alert-<?= $session->getFlashData('type') ?>">
        <p><?= $session->getFlashData('message') ?></p>
    </div>
<?php endif; ?>