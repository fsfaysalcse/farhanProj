CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user'
);
INSERT INTO users (username, password, role) VALUES ('admin', 'adminpassword', 'admin');
INSERT INTO users (username, password, role) VALUES ('user1', 'user1password', 'user');
INSERT INTO users (username, password, role) VALUES ('user2', 'user2password', 'user');
