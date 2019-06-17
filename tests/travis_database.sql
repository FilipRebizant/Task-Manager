CREATE USER 'dev'@'localhost' IDENTIFIED BY 'dev';
GRANT SELECT,INSERT,UPDATE,DELETE,CREATE,DROP ON *.* TO 'dev'@'localhost';

CREATE DATABASE IF NOT EXISTS `task-manager` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `task-manager`;

CREATE TABLE `users` (
   `id` binary(16) NOT NULL,
   `username` varchar(45) NOT NULL,
   `email` varchar(45) NOT NULL,
   `created_at` datetime DEFAULT NULL,
   `password` varchar(60) DEFAULT NULL,
   `role` varchar(15) DEFAULT NULL,
   PRIMARY KEY (`id`),
   UNIQUE KEY `username_UNIQUE` (`username`),
   UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tasks` (
  `id` binary(16) NOT NULL,
  `user_id` binary(16) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` varchar(45) NOT NULL,
  `priority` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `title` varchar(45) NOT NULL,
PRIMARY KEY (`id`),
KEY `user_id_idx` (`user_id`),
CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `activation_tokens` (
     `id` binary(16) NOT NULL,
     `token` varchar(36) DEFAULT NULL,
     `created_at` timestamp NULL DEFAULT NULL,
     `activated_at` timestamp NULL DEFAULT NULL,
     `user_id` binary(16) DEFAULT NULL,
     PRIMARY KEY (`id`),
     KEY `used_id_idx` (`user_id`),
     CONSTRAINT `used_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8

