<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/../../vendor/autoload.php';
    require_once __DIR__ . '/../../support/helper.php';

    $songObj = new \App\Song();
    $count = $songObj->countSongPlay(get_input('id'));

    header('Content-Type: application/json');
    echo json_encode([
        'total_play' => $count
    ]);
}