<?php

namespace App;

class Artist extends Database
{
    public function __construct()
    {
        self::getConnection();
    }

    /**
     * Get artist by specific id.
     *
     * @param $id
     * @return mixed
     */
    public function getArtist($id)
    {
        $statement = self::getConnection()->prepare('
          SELECT artists.*, COUNT(DISTINCT albums.id) AS total_album, COUNT(DISTINCT songs.id) AS total_song 
          FROM artists 
          INNER JOIN albums ON albums.artist_id = artists.id
          LEFT JOIN songs ON songs.album_id = albums.id
          WHERE artists.id = ?
          GROUP BY artists.id
        ');
        $statement->bind_param('i', $id);
        $statement->execute();
        $result = $statement->get_result();
        return $result->fetch_assoc();
    }

    /**
     * Get popular song by artist.
     *
     * @param $id
     * @param int $max
     * @return mixed
     */
    public function getPopularSong($id, $max = 5)
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
          WHERE songs.artist_id = ?
          ORDER BY songs.plays DESC
          LIMIT ?
        ');
        $statement->bind_param('ii', $id, $max);
        $statement->execute();
        $result = $statement->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Search artist by query.
     *
     * @param $query
     * @param int $limit
     * @return array
     */
    public function searchArtist($query, $limit = 5)
    {
        $statement = self::getConnection()->prepare('
          SELECT artists.*, COUNT(DISTINCT albums.id) AS total_album, COUNT(DISTINCT songs.id) AS total_song 
          FROM artists 
          INNER JOIN albums ON albums.artist_id = artists.id
          LEFT JOIN songs ON songs.album_id = albums.id
          WHERE artists.name LIKE ?
          GROUP BY artists.id
          LIMIT ?
        ');
        $term = "%{$query}%";
        $statement->bind_param('si', $term, $limit);
        $statement->execute();
        $result = $statement->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

}