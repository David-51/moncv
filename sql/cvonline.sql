-- ai = accent insensitive
-- ci = case insensitive
-- 0900 algorithm version

\! echo "\033[33m*** Create Database mycv ***\033[m";
CREATE DATABASE IF NOT EXISTS mycv CHARACTER SET = utf8mb4;

USE mycv;

\! echo "\033[33m*** Create Table 'blog' ***\033[m";
CREATE Table IF NOT EXISTS blog 
(
    id VARCHAR(36) NOT NULL UNIQUE PRIMARY KEY DEFAULT (UUID()),
    date DATETIME DEFAULT CURRENT_TIMESTAMP,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    picture_id VARCHAR(36),
    FOREIGN KEY (picture_id) REFERENCES pictures(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;

\! echo "\033[33m*** Create Table 'pictures' ***\033[m";
CREATE Table IF NOT EXISTS pictures
(
    id VARCHAR(36) NOT NULL UNIQUE PRIMARY KEY DEFAULT(UUID()),
    link VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL
)ENGINE = InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;