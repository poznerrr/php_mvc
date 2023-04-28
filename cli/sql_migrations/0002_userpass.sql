ALTER TABLE users
    ADD COLUMN pass varchar(50),
    ADD COLUMN salt varchar(255);