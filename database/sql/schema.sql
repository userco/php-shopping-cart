CREATE  DATABASE IF NOT EXISTS `e_store`;
USE `e_store`;

CREATE TABLE IF NOT EXISTS `users` (
	  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
	  `email` varchar(255) NOT NULL,
	  `name` varchar(255) NOT NULL,
	  `password` varchar(255) NOT NULL,
	  `role_id` int NOT NULL,
	  PRIMARY KEY (`id`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT COLLATE=utf8_general_ci;


CREATE TABLE IF NOT EXISTS `books` (
	 `id` bigint unsigned NOT NULL AUTO_INCREMENT,
	 `title`  varchar(255) NOT NULL,
	 `author` varchar(255) NOT NULL,
	 `price` decimal(10, 2) NOT NULL,
	 `amount` int NOT NULL DEFAULT 0,
	 `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	 `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	  PRIMARY KEY (`id`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `order_details`(
	`id` bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`address` varchar(255) NOT NULL,
	`total_price` decimal(10, 2) NOT NULL,
	`status` varchar(100) NOT NULL,
	`created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	`updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `orders`(
	`id` bigint unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`book_id` bigint unsigned NOT NULL,
	`user_id` bigint unsigned NOT NULL,
	`amount` int  NOT NULL DEFAULT 1,
	`order_detail_id` bigint unsigned NOT NULL,
	`created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	`updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	FOREIGN KEY(book_id) REFERENCES books(id),
	FOREIGN KEY(user_id) REFERENCES users(id),
	FOREIGN KEY(order_detail_id) REFERENCES order_details(id)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT COLLATE=utf8_general_ci;


