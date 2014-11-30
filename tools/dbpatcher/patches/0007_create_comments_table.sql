
CREATE TABLE IF NOT EXISTS `comments` (
  `id`         int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `message`    text COLLATE utf8_unicode_ci,
  `userId`     int(11) UNSIGNED DEFAULT NULL,
  `createDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comments_userId` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
