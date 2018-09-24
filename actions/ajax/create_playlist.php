<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/../../vendor/autoload.php';

    $session = new \App\Session();
    $playlist = new \App\Playlist();

    $playlistName = get_input('playlist');
    $playlistDesc = get_input('description');
    $result = $playlist->create($playlistName, $playlistDesc, '', $session->getData('auth.id'));

    header('Content-Type: application/json');
    echo json_encode([
        'result' => $result
    ]);
}
