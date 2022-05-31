drop table if exists rating;
drop table if exists cart_element;
drop table if exists stock;
drop table if exists users;


CREATE TABLE `users` (
    `id`          int(11)      NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `handle`      varchar(255) NOT NULL UNIQUE,
    `password`    varchar(255) NOT NULL,
    `email`       varchar(255) NOT NULL,
    `created_at`  datetime     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `profile_pic` varchar(255) NOT NULL DEFAULT "default",
    `bio`         varchar(255) NOT NULL DEFAULT "",
    `admin`       boolean      NOT NULL DEFAULT FALSE
);

CREATE TABLE `stock` (
    `id`          int(11)       NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name`        varchar(255)  NOT NULL,
    `description` text          NOT NULL,
    `image`       varchar(255)  NOT NULL,
    `price`       real          NOT NULL,
    `owner`       int(11)       NOT NULL,
    `created_at`  datetime      NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `tags`        varchar(1024) NOT NULL DEFAULT "",

    foreign key (owner) references users(id) on delete cascade
);

CREATE TABLE `rating` (
    `id`         int(11)     NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `stock_id`   int(11)     NOT NULL,
    `user_id`    int(11)     NOT NULL,
    `rating`     tinyint(11) NOT NULL,
    `created_at` datetime    NOT NULL DEFAULT CURRENT_TIMESTAMP,

    foreign key (stock_id) references stock(id) on delete cascade,
    foreign key (user_id)  references users(id) on delete cascade
);

CREATE TABLE `cart_element` (
    `id`         int(11)  NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user_id`    int(11)  NOT NULL,
    `stock_id`   int(11)  NOT NULL,
    `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,

    foreign key (user_id)  references users(id) on delete cascade,
    foreign key (stock_id) references stock(id) on delete cascade
);


DELETE FROM `users`;
Insert into users (handle, password, email, admin) values ('admin', "8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918", 'admin@admin.com', TRUE);
INSERT INTO users (handle, password, email, profile_pic, bio, admin) VALUES ('arthur', "ca978112ca1bbdcafac231b39a23dc4da786eff8147c4e72b9807785afee48bb", 'arthur2.bossu@gmail.com', "qr-code (1).png", "Programmeur Webdesigner", TRUE);
INSERT INTO users (handle, password, email, admin) VALUES ('chad', "8bf3b44cacf73b35d0a9092c37d1e42684fce8474a484a4a34fe560b7f0d067f", 'Chad@gmail.com', FALSE);
