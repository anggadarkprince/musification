<?php
require_once __DIR__ . '/../vendor/autoload.php';

$environment = config('app.environment');

if ($environment != 'production') {
    error_reporting(-1);
    ini_set('display_errors', 1);
}

date_default_timezone_set(config('app.timezone'));

$session = new \App\Session();