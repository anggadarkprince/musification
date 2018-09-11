<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../support/helper.php';

$songObj = new \App\Song();
$song = $songObj->getSong(get_param('id'));

header('Content-Type: application/json');
echo json_encode($song);
