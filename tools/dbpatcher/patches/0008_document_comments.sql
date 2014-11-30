
CREATE TABLE IF NOT EXISTS `document_comment` (
  `documentId`    int(11) UNSIGNED NOT NULL,
  `commentId` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`documentId`,`commentId`),
  KEY `fk_posts_comments_comments` (`commentId`),
  KEY `fk_posts_comments_posts` (`documentId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

