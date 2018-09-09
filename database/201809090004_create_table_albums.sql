CREATE TABLE `albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `artist_id` int(11) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  `artwork` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_albums_artist_idx` (`artist_id`),
  CONSTRAINT `fk_albums_artist` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
