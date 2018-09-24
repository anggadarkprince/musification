<?php require('support/initiator.php') ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Musification - Privacy</title>
    <meta name="description" content="Modern music streaming">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="assets/css/bootstrap-reboot.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/bootstrap-grid.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/app.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="landing-container">
    <div id="login-container">
        <article class="mt-5">
            <h3 class="color-primary">Privacy</h3>
            <p class="fade">Last updated: September 18, 2018</p>

            <h4 class="color-primary">Accounts</h4>

            <p>
                When you create an account with us, you must provide us information that is accurate, complete, and current at all
                times. Failure to do so constitutes a breach of the Terms, which may result in immediate termination of your account
                on our Service.
            </p>

            <p>
                You are responsible for safeguarding the password that you use to access the Service and for any activities or
                actions under your password, whether your password is with our Service or a third-party service.</p>

            <p>
                You agree not to disclose your password to any third party. You must notify us immediately upon becoming aware of
                any breach of security or unauthorized use of your account.
            </p>


            <h4 class="color-primary">Links To Other Web Sites</h4>

            <p>
                Our Service may contain links to third-party web sites or services that are not owned or controlled by
                <?= config('app.name') ?>.
            </p>

            <p>
                <?= config('app.name') ?> has no control over, and assumes no responsibility for, the content, privacy policies, or practices of
                any third party web sites or services. You further acknowledge and agree that <?= config('app.name') ?> shall not be responsible or
                liable, directly or indirectly, for any damage or loss caused or alleged to be caused by or in connection with use
                of or reliance on any such content, goods or services available on or through any such web sites or services.
            </p>

            <p>
                We strongly advise you to read the terms and conditions and privacy policies of any third-party web sites or
                services that you visit.
            </p>

            <h4 class="color-primary">Contact Us</h4>

            <p>If you have any questions about these Terms, please contact us.</p>
        </article>

        <div class="copyright mb-5">
            <p>&copy Copyright <?= date('Y') ?> <strong class="color-primary"><?= config('app.author') ?></strong> all right reserved.</p>
            <ul>
                <li><a href="terms.php">Terms</a></li>
                <li><a href="privacy.php">Privacy</a></li>
                <li><a href="about.php">About</a></li>
            </ul>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="assets/js/register.js"></script>
</body>
</html>
<?php require('support/cleaner.php') ?>