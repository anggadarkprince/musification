<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/../../vendor/autoload.php';

    $session = new \App\Session();
    $playlist = new \App\Playlist();

    $playlistId = get_input('playlist_id');
    $songId = get_input('song_id');
    $order = $playlist->nextPlaylistOrder($playlistId);

    $result = $playlist->addSong($playlistId, $songId, $order);

    header('Content-Type: application/json');
    echo json_encode([
        'result' => $result
    ]);
}
