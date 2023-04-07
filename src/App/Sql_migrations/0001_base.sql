CREATE TABLE migrations
(
    id      INT AUTO_INCREMENT PRIMARY KEY,
    name    VARCHAR(50) NOT NULL,
    created TIMESTAMP DEFAULT current_timestamp
);
