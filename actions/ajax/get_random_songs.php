<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../support/helper.php';

$songObj = new \App\Song();
$randomSongs = $songObj->getRandomSongs();
$randomSongIds = array_column(if_empty($randomSongs, []), 'id');

header('Content-Type: application/json');
echo json_encode($randomSongIds);
