<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../support/helper.php';

$account = new \App\Account();

if ($account->logout()) {
    redirect('../register.php');
}