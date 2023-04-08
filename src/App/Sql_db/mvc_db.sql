CREATE
DATABASE mvc;
USE
mvc;
CREATE TABLE users
(
    user_id   INT AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(50) NOT NULL
);

CREATE TABLE categories
(
    category_id   INT AUTO_INCREMENT PRIMARY KEY,
    category_name VARCHAR(30) NOT NULL
);

CREATE TABLE posts
(
    post_id     INT AUTO_INCREMENT PRIMARY KEY,
    title       VARCHAR(255) NOT NULL,
    post_text   TEXT         NOT NULL,
    user_id     INT,
    category_id INT,
    post_date   INT,
    CONSTRAINT posts_users_fk
        FOREIGN KEY (user_id) REFERENCES users (user_id) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT posts_categories_fk
        FOREIGN KEY (category_id) REFERENCES categories (category_id) ON DELETE CASCADE ON UPDATE CASCADE
);

