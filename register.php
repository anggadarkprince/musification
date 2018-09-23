<?php require('support/initiator.php') ?>
<?php if($session->getData('auth.is_logged_in')) redirect('index.php') ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Musification - Register</title>
    <meta name="description" content="Modern music streaming">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="assets/css/bootstrap-reboot.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/bootstrap-grid.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/app.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="landing-container">
    <div id="login-container">
        <div id="form-container">
            <form id="login-form" action="actions/login.php" method="POST"<?= get_old('login') || empty(get_old('register')) ? '' : ' style="display: none"' ?>>
                <h2>Login to your account</h2>
                <?php include_once '_alert.php' ?>
                <div class="input-group">
                    <label for="login_username">Username</label>
                    <input class="input" id="login_username" name="login_username" type="text" value="<?= get_old('login_username') ?>"
                           placeholder="Username or email" required>
                    <?= validation_error('login_username') ?>
                </div>
                <div class="input-group">
                    <label for="login_password">Password</label>
                    <input class="input" id="login_password" name="login_password" type="password" placeholder="Your secret password" required>
                    <?= validation_error('login_password') ?>
                </div>

                <button type="submit" name="login" value="true">LOG IN</button>

                <div class="link-register">
                    <a href="javascript:void(0)">
                        Don't have an account yet, <strong>Sign up</strong> here
                    </a>
                </div>
            </form>

            <form id="register-form" action="actions/register.php" method="POST"<?= get_old('register') ? '' : ' style="display: none"' ?>>
                <h2>Create your free account</h2>
                <div class="input-group">
                    <label for="name">Your Name</label>
                    <input class="input" id="name" name="name" type="text" value="<?= get_old('name') ?>"
                           placeholder="Your full name" required maxlength="30">
                    <?= validation_error('name') ?>
                </div>
                <div class="input-group">
                    <label for="username">Username</label>
                    <input class="input" id="username" name="username" type="text" value="<?= get_old('username') ?>"
                           placeholder="Unique user ID" required maxlength="20">
                    <?= validation_error('username') ?>
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input class="input" id="email" name="email" type="email" value="<?= get_old('email') ?>"
                           placeholder="Email address" required maxlength="50">
                    <?= validation_error('email') ?>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input class="input" id="password" name="password" type="password"
                           placeholder="Your secure password" required maxlength="50">
                    <?= validation_error('password') ?>
                </div>
                <div class="input-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input class="input" id="confirm_password" name="confirm_password" type="password"
                           placeholder="Repeat your password" required maxlength="50">
                    <?= validation_error('confirm_password') ?>
                </div>

                <button type="submit" name="register" value="true">SIGN UP</button>

                <div class="link-login">
                    <a href="javascript:void(0)">Already have an account? <strong>Log in</strong> here</a>
                </div>
            </form>
        </div>

        <div id="login-text">
            <div class="login-caption">
                <h2>Musification</h2>
                <h1>Get the greatest music right now</h1>
                <h2>Listen music freely for free forever</h2>
                <p>The place where the beat comes alive</p>
                <ul>
                    <li>
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAACsSURBVEhLYxgFo2BwAed5HqZO891X2M+354AKUQ+ADV/g/sF5gft/5wWuhVBh6gBUw90Wha4KZYZKUQ5GDccKyDIcqIjNeb7bMpBmqBBWQLbLHRe4lYA0gTXjsISiYDGeaczqPN99NS5LKDIcBuz327MANa9Ct4QqhsMASDMou8MtWeCWRjXDYQBkCDjCwYbCMJUMhwGwTxa4L6GJ4TAA9gkwiGhi+CiAAAYGADGloRbwDtXLAAAAAElFTkSuQmCC">
                        Discover music you'll fall in love with
                    </li>
                    <li>
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAACsSURBVEhLYxgFo2BwAed5HqZO891X2M+354AKUQ+ADV/g/sF5gft/5wWuhVBh6gBUw90Wha4KZYZKUQ5GDccKyDIcqIjNeb7bMpBmqBBWQLbLHRe4lYA0gTXjsISiYDGeaczqPN99NS5LKDIcBuz327MANa9Ct4QqhsMASDMou8MtWeCWRjXDYQBkCDjCwYbCMJUMhwGwTxa4L6GJ4TAA9gkwiGhi+CiAAAYGADGloRbwDtXLAAAAAElFTkSuQmCC">
                        Create your own playlist
                    </li>
                    <li>
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAACsSURBVEhLYxgFo2BwAed5HqZO891X2M+354AKUQ+ADV/g/sF5gft/5wWuhVBh6gBUw90Wha4KZYZKUQ5GDccKyDIcqIjNeb7bMpBmqBBWQLbLHRe4lYA0gTXjsISiYDGeaczqPN99NS5LKDIcBuz327MANa9Ct4QqhsMASDMou8MtWeCWRjXDYQBkCDjCwYbCMJUMhwGwTxa4L6GJ4TAA9gkwiGhi+CiAAAYGADGloRbwDtXLAAAAAElFTkSuQmCC">
                        Follow artist to keep up to date
                    </li>
                </ul>
            </div>

            <div class="copyright">
                <p>&copy Copyright <?= date('Y') ?> <strong>Angga Ari Wijaya</strong> all right reserved.</p>
                <ul>
                    <li><a href="terms.php">Terms</a></li>
                    <li><a href="privacy.php">Privacy</a></li>
                    <li><a href="about.php">About</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="assets/js/register.js"></script>
</body>
</html>
<?php require('support/cleaner.php') ?>