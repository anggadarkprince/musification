<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/../../vendor/autoload.php';
    require_once __DIR__ . '/../../support/helper.php';

    $session = new \App\Session();
    $playlist = new \App\Playlist();

    $playlistId = get_input('playlist_id');
    $songId = get_input('song_id');

    $result = $playlist->removeSong($playlistId, $songId);

    header('Content-Type: application/json');
    echo json_encode([
        'result' => $result
    ]);
}
