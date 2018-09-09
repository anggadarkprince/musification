<?php

namespace App;

class Album extends Database
{
    public function __construct()
    {
        self::getConnection();
    }

    /**
     * Get albums by specific number.
     *
     * @param int $max
     * @return mixed
     */
    public function getAlbums($max = 10)
    {
        $statement = self::getConnection()->prepare('
          SELECT albums.*, artists.name FROM albums 
          INNER JOIN artists ON artists.id = albums.artist_id
          ORDER BY RAND() LIMIT ?
        ');
        $statement->bind_param('i', $max);
        $statement->execute();
        $result = $statement->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

}