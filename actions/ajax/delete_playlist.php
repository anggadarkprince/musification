<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/../../vendor/autoload.php';

    error_reporting(-1);
    ini_set('display_errors', 1);

    $session = new \App\Session();
    $playlist = new \App\Playlist();

    $playlistId = get_input('id');
    $result = $playlist->delete($playlistId, $session->getData('auth.id'));

    header('Content-Type: application/json');
    echo json_encode([
        'result' => $result
    ]);
}
