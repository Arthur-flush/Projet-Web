drop table if exists nft;
drop table if exists seller;
drop table if exists users;

CREATE TABLE `users` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `handle` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL,
    `created_at` datetime NOT NULL,
    `profile_pic` varchar(255)
);

CREATE TABLE `nft` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` varchar(255) NOT NULL,
    `description` text NOT NULL,
    `image` varchar(255) NOT NULL,
    `price` real NOT NULL,
    `sellerid` int(11) NOT NULL,
    foreign key (sellerid) references users(id) on delete cascade
);

DELETE FROM `users`;
Insert into users values (1, '@admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'admin@admin.com', NOW(), NULL);

