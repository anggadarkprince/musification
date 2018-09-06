<?php require '_header.php' ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Musification - Register</title>
    <meta name="description" content="Modern music streaming">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
    <?php include_once '_alert.php' ?>
	<div id="form-container">
		<form id="login-form" action="actions/login.php" method="POST">
			<h2>Login to your account</h2>
			<p>
				<label for="username">Username</label>
				<input id="username" name="username" type="text" placeholder="Your username" required>
                <?= validation_error('username') ?>
			</p>
			<p>
				<label for="password">Password</label>
				<input id="password" name="password" type="password" placeholder="Your secret password" required>
                <?= validation_error('username') ?>
			</p>

			<button type="submit" name="login">LOG IN</button>
		</form>

        <form id="register-form" action="actions/register.php" method="POST">
            <h2>Create your free account</h2>
            <p>
                <label for="first_name">First Name</label>
                <input id="first_name" name="first_name" type="text" placeholder="Your first name" required maxlength="30">
                <?= validation_error('first_name') ?>
            </p>
            <p>
                <label for="last_name">Last Name</label>
                <input id="last_name" name="last_name" type="text" placeholder="Your last name" required maxlength="30">
                <?= validation_error('last_name') ?>
            </p>
            <p>
                <label for="username">Username</label>
                <input id="username" name="username" type="text" placeholder="Unique user ID" required maxlength="20">
                <?= validation_error('username') ?>
            </p>
            <p>
                <label for="email">Email</label>
                <input id="email" name="email" type="email" placeholder="Email address" required maxlength="50">
                <?= validation_error('email') ?>
            </p>
            <p>
                <label for="password">Password</label>
                <input id="password" name="password" type="password" placeholder="Your secure password" required maxlength="50">
                <?= validation_error('password') ?>
            </p>
            <p>
                <label for="confirm_password">Confirm Password</label>
                <input id="confirm_password" name="confirm_password" type="password" placeholder="Repeat your password" required maxlength="50">
                <?= validation_error('confirm_password') ?>
            </p>

            <button type="submit" name="register">SIGN UP</button>
        </form>
	</div>

</body>
</html>