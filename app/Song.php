<?php

namespace App;

class Song extends Database
{
    public function __construct()
    {
        self::getConnection();
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