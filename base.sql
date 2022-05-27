drop table if exists stock;
drop table if exists users;

CREATE TABLE `users` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `handle` varchar(255) NOT NULL UNIQUE,
    `password` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,
    `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `profile_pic` varchar(255) NOT NULL DEFAULT "default" 
);

CREATE TABLE `stock` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` varchar(255) NOT NULL,
    `description` text NOT NULL,
    `image` varchar(255) NOT NULL,
    `price` real NOT NULL,
    `owner` int(11) NOT NULL,
    `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `tags` varchar(1024) NOT NULL DEFAULT "",
    foreign key (owner) references users(id) on delete cascade
);

DELETE FROM `users`;
Insert into users (handle, password, email) values ('admin', "8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918", 'admin@admin.com');

