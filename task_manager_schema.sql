-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.32-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

CREATE DATABASE IF NOT EXISTS `task_manager`
USE `task_manager`;

CREATE TABLE IF NOT EXISTS `tasks` (
                                       `id` int(11) NOT NULL AUTO_INCREMENT,
    `task_name` varchar(50) NOT NULL DEFAULT '0',
    `task_description` text DEFAULT NULL,
    `created_at` datetime NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
