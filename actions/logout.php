<?php

require_once __DIR__ . '/../vendor/autoload.php';

$account = new \App\Account();

if ($account->logout()) {
    redirect('../register.php');
}