CREATE
DATABASE MVC;
USE
MVC;
CREATE TABLE Users
(
    UserId   INT AUTO_INCREMENT PRIMARY KEY,
    UserName VARCHAR(50) NOT NULL
);

CREATE TABLE Categories
(
    CategoryId   INT AUTO_INCREMENT PRIMARY KEY,
    CategoryName VARCHAR(30) NOT NULL
);

CREATE TABLE Posts
(
    PostId     INT AUTO_INCREMENT PRIMARY KEY,
    Title      VARCHAR(255) NOT NULL,
    PostText   TEXT         NOT NULL,
    UserId     INT,
    CategoryId INT,
    PostDate   INT,
    CONSTRAINT posts_users_fk
        FOREIGN KEY (UserId) REFERENCES Users (UserId) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT posts_categories_fk
        FOREIGN KEY (CategoryId) REFERENCES Categories (CategoryId) ON DELETE CASCADE ON UPDATE CASCADE
);

