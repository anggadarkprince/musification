CREATE TABLE `playlists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `cover` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_playlists_user_idx` (`user_id`),
  CONSTRAINT `fk_playlists_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
