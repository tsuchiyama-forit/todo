CREATE DATABASE todo;

CREATE TABLE posts (
    id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
    title varchar(255) NOT NULL,
    content text NOT NULL,
    created_at date not null DEFAULT GETDATE();
    updated_at date not null DEFAULT GETDATE();
    edit_flg tinyint(4) not null DEFAULT 0;
);