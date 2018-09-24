<?php require('support/initiator.php') ?>

<?php
$userId = $session->getData('auth.id');
$accountObj = new \App\Account();
$user = $accountObj->getUser($userId);
?>

<?php ob_start(); ?>
    <h1 class="page-title">My Account</h1>

    <div class="account-wrapper">
        <form action="actions/ajax/update_account.php" method="post" id="form-account">
            <div class="input-group">
                <label for="name">Name</label>
                <input class="input" type="text" name="name" id="name" required
                       maxlength="50" placeholder="Your name" value="<?= get_old('name', $user['name']) ?>">
            </div>
            <div class="input-group">
                <label for="username">Username</label>
                <input class="input" type="text" name="username" id="username" required
                       maxlength="50" placeholder="Your user ID" value="<?= get_old('username', $user['username']) ?>">
            </div>
            <div class="input-group">
                <label for="email">Email</label>
                <input class="input" type="email" name="email" id="email" required
                       maxlength="50" placeholder="Email address" value="<?= get_old('email', $user['email']) ?>">
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input class="input" type="password" name="password" id="password"
                       maxlength="50" placeholder="Your current password">
                <span class="form-info">Current password is required to update your account.</span>
            </div>
            <div class="input-group">
                <label for="password">New Password</label>
                <input class="input" type="password" name="new_password" id="new_password"
                       maxlength="50" placeholder="New password">
                <span class="form-info">Leave it blank if you do not intend to change the password.</span>
            </div>
            <div class="input-group">
                <label for="password">Confirm Password</label>
                <input class="input" type="password" name="confirm_password" id="confirm_password"
                       maxlength="50" placeholder="Confirm new password">
            </div>
            <div class="input-group right">
                <button type="button" class="button primary" id="btn-update-account">Update Account</button>
            </div>
        </form>
    </div>
    <script>
        var pageTitle = 'Musification - My Account';
    </script>
<?php
$__pageTitle = 'Musification - My Account';
$__content = ob_get_contents();
ob_end_clean();
?>

<?php if(isset($_SERVER['HTTP_X_REQUESTED_WITH'])): ?>
    <?php echo $__content ?>
<?php else: ?>
    <?php include('_layout.php') ?>
<?php endif; ?>