<?php require '_header.php' ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Welcome to Musification!</title>
    <meta name="description" content="Modern music streaming">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>

<body>
	Hello!
    <?php include_once '_alert.php' ?>

<?= \App\Account::getLoginData('first_name') ?>
</body>

</html>