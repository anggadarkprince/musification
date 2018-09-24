<?php require('support/initiator.php') ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Musification - Terms</title>
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
            <h3 class="color-primary">Terms and Conditions</h3>
            <p class="fade">Last updated: September 18, 2018</p>

            <p>
                Please read these Terms and Conditions ("Terms", "Terms and Conditions") carefully before using the <?= config('app.name') ?>
                website (the "Service") operated by <?= config('app.name') ?> ("us", "we", or "our").
            </p>

            <p>
                Your access to and use of the Service is conditioned on your acceptance of and compliance with these Terms. These
                Terms apply to all visitors, users and others who access or use the Service.
            </p>

            <p>
                By accessing or using the Service you agree to be bound by these Terms. If you disagree with any part of the terms
                then you may not access the Service. Terms & Conditions created by
                <a href="https://termsfeed.com" rel="nofollow">TermsFeed</a> for <?= config('app.name') ?>.
            </p>

            <h4 class="color-primary">Termination</h4>

            <p>
                We may terminate or suspend access to our Service immediately, without prior notice or liability, for any reason
                whatsoever, including without limitation if you breach the Terms.</p>

            <p>
                All provisions of the Terms which by their nature should survive termination shall survive termination, including,
                without limitation, ownership provisions, warranty disclaimers, indemnity and limitations of liability.</p>

            <p>
                We may terminate or suspend your account immediately, without prior notice or liability, for any reason whatsoever,
                including without limitation if you breach the Terms.
            </p>

            <p>
                Upon termination, your right to use the Service will immediately cease. If you wish to terminate your account, you
                may simply discontinue using the Service.
            </p>

            <p>
                All provisions of the Terms which by their nature should survive termination shall survive termination, including,
                without limitation, ownership provisions, warranty disclaimers, indemnity and limitations of liability.
            </p>


            <h4 class="color-primary">Governing Law</h4>

            <p>
                These Terms shall be governed and construed in accordance with the laws of Indonesia, without regard to its
                conflict of law provisions.
            </p>

            <p>
                Our failure to enforce any right or provision of these Terms will not be considered a waiver of those rights. If
                any provision of these Terms is held to be invalid or unenforceable by a court, the remaining provisions of these
                Terms will remain in effect. These Terms constitute the entire agreement between us regarding our Service, and
                supersede and replace any prior agreements we might have between us regarding the Service.
            </p>


            <h4 class="color-primary">Changes</h4>

            <p>
                We reserve the right, at our sole discretion, to modify or replace these Terms at any time. If a revision is
                material we will try to provide at least 30 days notice prior to any new terms taking effect. What constitutes a
                material change will be determined at our sole discretion.
            </p>

            <p>
                By continuing to access or use our Service after those revisions become effective, you agree to be bound by the
                revised terms. If you do not agree to the new terms, please stop using the Service.
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