<?php

require_once __DIR__ . '/../vendor/autoload.php';

if (isset($_POST['register'])) {
    $account = new \App\Account();
    $validator = new \App\Validator();

    $validator->validate([
        'name' => 'required|maxLength[50]',
        'email' => 'required|email|maxLength[50]',
        'username' => 'required|username|maxLength[50]|unique[users.username]',
        'password' => 'required|minLength[6]|maxLength[50]',
        'confirm_password' => 'required|confirm[password]',
    ]);

    $name = ucwords(strtolower($_POST['name']));
    $username = str_replace(' ', '-', $_POST['username']);
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], CRYPT_BLOWFISH);
    $avatar = 'assets/images/profile/no-avatar.png';

    $create = $account->register($name, $username, $email, $password, $avatar);

    if($create) {
        flash('success', 'Welcome aboard, beat your soul with musification');
        redirect('_back', false);
    }
}

flash('danger', 'Something is getting wrong');
redirect('_back');