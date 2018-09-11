<?php

namespace App;

class Song extends Database
{
    public function __construct()
    {
        self::getConnection();
    }

    /**
     * Get single song data.
     *
     * @param $id
     * @return array
     */
    public function getSong($id)
    {
        $statement = self::getConnection()->prepare('
          SELECT 
            songs.*, 
            artists.name AS artist, 
            albums.title AS album,
            albums.artwork
          FROM songs
          LEFT JOIN artists ON artists.id = songs.artist_id
          LEFT JOIN albums on songs.album_id = albums.id
          WHERE songs.id = ?
        ');
        $statement->bind_param('i', $id);
        $statement->execute();
        $result = $statement->get_result();
        return $result->fetch_assoc();
    }

    /**
     * Get random playing songs.
     *
     * @param int $limit
     * @return array
     */
    public function getRandomSongs($limit = 10)
    {
        $statement = self::getConnection()->prepare('
          SELECT * FROM songs
          ORDER BY RAND()
          LIMIT ?
        ');
        $statement->bind_param('i', $limit);
        $statement->execute();
        $result = $statement->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Get songs by specific album.
     *
     * @param $albumId
     * @return mixed
     */
    public function getSongAlbum($albumId)
    {
        $statement = self::getConnection()->prepare('
          SELECT songs.*, artists.name AS artist FROM songs
          INNER JOIN artists ON artists.id = songs.artist_id
          WHERE album_id = ?
          ORDER BY songs.order ASC
        ');
        $statement->bind_param('i', $albumId);
        $statement->execute();
        $result = $statement->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

}