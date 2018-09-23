<?php

namespace App;

class Playlist extends Database
{
    public function __construct()
    {
        self::getConnection();
    }

    /**
     * Get playlists by user.
     *
     * @param $userId
     * @return array
     */
    public function getUserPlaylists($userId)
    {
        $statement = self::getConnection()->prepare('
          SELECT playlists.*, COUNT(DISTINCT playlist_songs.song_id) AS total_song
          FROM playlists
          LEFT JOIN playlist_songs ON playlist_songs.playlist_id = playlists.id
          WHERE playlists.user_id = ?
          GROUP BY playlists.id
        ');
        $statement->bind_param('i', $userId);
        $statement->execute();
        $result = $statement->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Create new playlist.
     *
     * @param $title
     * @param $description
     * @param $cover
     * @param $userId
     * @return bool
     */
    public function create($title, $description, $cover, $userId)
    {
        $query = "INSERT INTO playlists (title, description, cover, user_id) VALUES (?, ?, ?, ?)";
        $statement = $this->getConnection()->prepare($query);
        $statement->bind_param('sssi', $title, $description, $cover, $userId);
        $statement->execute();
        $playlistId = $statement->insert_id;
        $statement->close();

        return $playlistId;
    }
}