<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../support/helper.php';

error_reporting(-1);
ini_set('display_errors', 1);

$session = new \App\Session();
$playlist = new \App\Playlist();

$playlistName = get_input('playlist');
$result = $playlist->create($playlistName, '', '', $session->getData('auth.id'));

header('Content-Type: application/json');
echo json_encode([
    'result' => $result
]);
