<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../support/helper.php';

$account = new \App\Account();
$validator = new \App\Validator();

if (isset($_POST['register'])) {
    $validator->validate([
        'first_name' => 'required|maxLength[10]',
        'last_name' => 'maxLength[50]',
        'email' => 'required|email|maxLength[50]',
        'username' => 'required|username|maxLength[50]|unique[users.username]',
        'password' => 'required|minLength[6]|maxLength[50]',
        'confirm_password' => 'required|confirm[password]',
    ]);

    $firstName = ucfirst(strtolower($_POST['first_name']));
    $lastName = ucfirst(strtolower($_POST['last_name']));
    $username = str_replace(' ', '-', $_POST['username']);
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], CRYPT_BLOWFISH);
    $avatar = 'assets/images/profile/no-avatar.png';

    $create = $account->register($firstName, $lastName, $username, $email, $password, $avatar);

    if($create) {
        flash('success', 'Welcome aboard, beat your soul with musification');
        redirect('../index.php');
    }
}

flash('danger', 'Something is getting wrong');
redirect('_back');