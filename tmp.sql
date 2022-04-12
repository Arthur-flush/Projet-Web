drop table if exists nft;
drop table if exists seller;
drop table if exists users;

CREATE TABLE `users` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `handle` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL
);

CREATE TABLE `seller` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `display_name` varchar(255) NOT NULL,
    `userid` int(11) NOT NULL,
    `net_worth` real NOT NULL,
    foreign key (userid) references users(id) ON DELETE CASCADE
);

CREATE TABLE `nft` (
    `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` varchar(255) NOT NULL,
    `description` text NOT NULL,
    `image` varchar(255) NOT NULL,
    `price` real NOT NULL,
    `sellerid` int(11) NOT NULL,
    foreign key (sellerid) references seller(id) on delete cascade
);

DELETE FROM `users`;
Insert into users values (1, '@admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'admin@admin.com');

