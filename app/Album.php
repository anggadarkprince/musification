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
          SELECT albums.*, artists.name AS artist FROM albums 
          INNER JOIN artists ON artists.id = albums.artist_id
          ORDER BY RAND() LIMIT ?
        ');
        $statement->bind_param('i', $max);
        $statement->execute();
        $result = $statement->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Get album by specific id.
     *
     * @param $id
     * @return mixed
     */
    public function getAlbum($id)
    {
        $statement = self::getConnection()->prepare('
          SELECT albums.*, artists.name AS artist, COUNT(songs.id) AS total_song 
          FROM albums 
          INNER JOIN artists ON artists.id = albums.artist_id
          LEFT JOIN songs ON songs.album_id = albums.id
          WHERE albums.id = ?
          GROUP BY albums.id
        ');
        $statement->bind_param('i', $id);
        $statement->execute();
        $result = $statement->get_result();
        return $result->fetch_assoc();
    }

    /**
     * Get albums of artist.
     *
     * @param $artistId
     * @return array
     */
    public function getArtistAlbum($artistId)
    {
        $statement = self::getConnection()->prepare('
          SELECT albums.*, artists.name AS artist, COUNT(songs.id) AS total_song 
          FROM albums 
          INNER JOIN artists ON artists.id = albums.artist_id
          LEFT JOIN songs ON songs.album_id = albums.id
          WHERE albums.artist_id = ?
          GROUP BY albums.id
        ');
        $statement->bind_param('i', $artistId);
        $statement->execute();
        $result = $statement->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Search album by query.
     *
     * @param $query
     * @param int $limit
     * @return mixed
     */
    public function searchAlbum($query, $limit = 5)
    {
        $statement = self::getConnection()->prepare('
          SELECT albums.*, artists.name AS artist FROM albums 
          INNER JOIN artists ON artists.id = albums.artist_id
          WHERE title LIKE ?
          LIMIT ?
        ');
        $term = "%{$query}%";
        $statement->bind_param('si',$term , $limit);
        $statement->execute();
        $result = $statement->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

}