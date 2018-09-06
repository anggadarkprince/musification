<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Account;

$authentication = new Account();

if (isset($_POST['login'])) {
    $username = htmlentities($_POST['username']);
    $password = $_POST['password'];
    $authentication->login($_POST['username'], $_POST['password']);
} elseif (isset($_POST['register'])) {
    $username = ucfirst(strtolower($_POST['first_name']));
    $username = ucfirst(strtolower($_POST['last_name']));
    $username = str_replace(' ', '-', $_POST['username']);
    $username = htmlentities($_POST['email']);
    $password = $_POST['password'];
    $password = $_POST['confirm_password'];
}

echo '<pre>';
print_r($_POST);
echo '</pre>';