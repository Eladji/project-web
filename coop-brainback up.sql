-- Recreate the necessary tables with correct constraints

-- Drop tables if they exist to avoid conflicts
DROP TABLE IF EXISTS `comment`;
DROP TABLE IF EXISTS `dev_list`;
DROP TABLE IF EXISTS `image`;
DROP TABLE IF EXISTS `Project`;
DROP TABLE IF EXISTS `user`;

-- Create tables with corrected constraints

-- Table `user`
CREATE TABLE `user` (
                        `id` int NOT NULL AUTO_INCREMENT,
                        `name` varchar(80) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
                        `password` varchar(160) NOT NULL,
                        `email` varchar(255) NOT NULL,
                        `git` text NOT NULL,
                        `score` int NOT NULL,
                        `nbt_project` int NOT NULL,
                        `icon` varchar(80) NOT NULL,
                        PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Table `Project`
CREATE TABLE `Project` (
                           `id` int NOT NULL AUTO_INCREMENT,
                           `name` varchar(80) NOT NULL,
                           `state` tinyint(1) NOT NULL,
                           `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                           `repo_git` text NOT NULL,
                           `id_author` int NOT NULL,
                           `thumbnail` varchar(80) NOT NULL,
                           `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
                           PRIMARY KEY (`id`),
                           FOREIGN KEY (`id_author`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Table `comment`
CREATE TABLE `comment` (
                           `id` int NOT NULL AUTO_INCREMENT,
                           `id_project` int NOT NULL,
                           `id_author` int NOT NULL,
                           `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                           `content` text NOT NULL,
                           PRIMARY KEY (`id`),
                           KEY `projectcomment` (`id_project`),
                           KEY `commentautor` (`id_author`),
                           FOREIGN KEY (`id_project`) REFERENCES `Project` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
                           FOREIGN KEY (`id_author`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Table `dev_list`
CREATE TABLE `dev_list` (
                            `id` int NOT NULL AUTO_INCREMENT,
                            `project_id` int NOT NULL,
                            `dev_id` int NOT NULL,
                            PRIMARY KEY (`id`),
                            UNIQUE KEY `dev_id` (`dev_id`),
                            KEY `project_id` (`project_id`),
                            FOREIGN KEY (`project_id`) REFERENCES `Project` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
                            FOREIGN KEY (`dev_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Table `image`
CREATE TABLE `image` (
                         `id` int NOT NULL AUTO_INCREMENT,
                         `image` varchar(80) NOT NULL,
                         `project_id` int NOT NULL,
                         PRIMARY KEY (`id`),
                         KEY `linkproject` (`project_id`),
                         FOREIGN KEY (`project_id`) REFERENCES `Project` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

COMMIT;
