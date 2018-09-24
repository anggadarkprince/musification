<?php
require_once __DIR__ . '/../../vendor/autoload.php';

$songObj = new \App\Song();
$songs = $songObj->getSongAlbum(get_param('id'));
$albumSongIds = array_column(if_empty($songs, []), 'id');

header('Content-Type: application/json');
echo json_encode($albumSongIds);
