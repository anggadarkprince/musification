<?php

namespace App;

class Playlist extends Database
{
    public function __construct()
    {
        self::getConnection();
    }

    /**
     * Get playlist data.
     *
     * @param $id
     * @return array
     */
    public function getPlaylist($id)
    {
        $statement = self::getConnection()->prepare('
          SELECT playlists.*, users.name AS owner, COUNT(DISTINCT playlist_songs.song_id) AS total_song
          FROM playlists
          LEFT JOIN users ON users.id = playlists.user_id
          LEFT JOIN playlist_songs ON playlist_songs.playlist_id = playlists.id
          WHERE playlists.id = ?
          GROUP BY playlists.id
        ');
        $statement->bind_param('i', $id);
        $statement->execute();
        $result = $statement->get_result();
        return $result->fetch_assoc();
    }

    /**
     * Get playlist song.
     *
     * @param $id
     * @return mixed
     */
    public function getPlaylistSongs($id)
    {
        $statement = self::getConnection()->prepare('
          SELECT 
            playlists.title AS playlist, 
            albums.title AS album, 
            artists.name AS artist, 
            genres.genre AS genre, 
            songs.*
          FROM playlists
          INNER JOIN playlist_songs ON playlist_songs.playlist_id = playlists.id
          LEFT JOIN songs ON songs.id = playlist_songs.song_id
          LEFT JOIN albums ON albums.id = songs.album_id
          LEFT JOIN artists ON artists.id = songs.artist_id
          LEFT JOIN genres ON genres.id = songs.genre_id
          WHERE playlists.id = ?
          ORDER BY playlist_songs.order
        ');
        $statement->bind_param('i', $id);
        $statement->execute();
        $result = $statement->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
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

    /**
     * Delete playlist and song data.
     *
     * @param $playlistId
     * @param $userId
     * @return bool
     */
    public function delete($playlistId, $userId)
    {
        $query = "DELETE FROM playlists WHERE id = ? AND user_id = ?";
        $statement = $this->getConnection()->prepare($query);
        $statement->bind_param('ii', $playlistId, $userId);
        $delete = $statement->execute();
        $statement->close();

        return $delete;
    }

    /**
     * Add song to playlist.
     *
     * @param $playlistId
     * @param $songId
     * @param $order
     * @return int
     */
    public function addSong($playlistId, $songId, $order)
    {
        $query = "INSERT INTO playlist_songs (playlist_id, song_id, `order`) VALUES (?, ?, ?)";
        $statement = $this->getConnection()->prepare($query);
        $statement->bind_param('iii', $playlistId, $songId, $order);
        $result = $statement->execute();
        $statement->close();

        return $result;
    }

    /**
     * Remove song from playlist.
     *
     * @param $playlistId
     * @param $songId
     * @return bool
     */
    public function removeSong($playlistId, $songId)
    {
        $query = "DELETE FROM playlist_songs WHERE playlist_id = ? AND song_id = ?";
        $statement = $this->getConnection()->prepare($query);
        $statement->bind_param('ii', $playlistId, $songId);
        $delete = $statement->execute();
        $statement->close();

        return $delete;
    }

    /**
     * Get total song of playlist.
     *
     * @param $playlistId
     * @return int
     */
    public function nextPlaylistOrder($playlistId)
    {
        $statement = self::getConnection()->prepare('
          SELECT MAX(playlist_songs.order) + 1 AS next_order FROM playlist_songs
          WHERE playlist_id = ?
        ');
        $statement->bind_param('i', $playlistId);
        $statement->execute();
        $result = $statement->get_result();
        $next = $result->fetch_assoc();

        return $next['next_order'];
    }
}