<?php

require_once __DIR__ . '/../vendor/autoload.php';

$account = new \App\Account();
$validator = new \App\Validator();

if (isset($_POST['login'])) {
    $validator->validate([
        'login_username' => 'required',
        'login_password' => 'required',
    ]);

    $username = get_input('login_username');
    $password = get_input('login_password');

    if($account->login($username, $password)) {
        flash('success', 'You are logged in!');
        redirect('../index.php');
    } else {
        flash('warning', 'Username or password is wrong');
        redirect('_back');
    }
}

flash('danger', 'Something is getting wrong');
redirect('_back');