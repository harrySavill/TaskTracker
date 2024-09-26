-- Database: task_management

-- Drop tables if they exist
DROP TABLE IF EXISTS `tasks`;
DROP TABLE IF EXISTS `users`;

-- Table for storing user information
CREATE TABLE `users` (
    `user_id` INT(11) NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(100) NOT NULL UNIQUE,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL, -- Password should be stored as a hash
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Table for storing tasks
CREATE TABLE `tasks` (
    `task_id` INT(11) NOT NULL AUTO_INCREMENT,
    `user_id` INT(11) NOT NULL, -- Foreign key linking to the users table
    `task_name` VARCHAR(255) NOT NULL,
    `description` TEXT,
    `status` ENUM('pending', 'completed') DEFAULT 'pending',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`task_id`),
    FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Indexing and Constraints
CREATE INDEX `idx_user_tasks` ON `tasks` (`user_id`);
