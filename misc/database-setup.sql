CREATE DATABASE IF NOT EXISTS dynamiccleanblogdb;
USE dynamiccleanblogdb;

CREATE TABLE post_body (
    id              INT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
    body_text       TEXT,
    PRIMARY KEY (id)
) ENGINE=InnoDB;

CREATE TABLE authors (
    id              INT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
    name            VARCHAR(255) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE (name)
) ENGINE=InnoDB;

CREATE TABLE tags (
    id              INT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
    tagname         VARCHAR(255) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE (tagname)
) ENGINE=InnoDB;

CREATE TABLE posts (
    id              INT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
    title           VARCHAR(255) NOT NULL,
    clean_url_title VARCHAR(255) NOT NULL,
    subtitle        VARCHAR(255) DEFAULT NULL,
    post_body_id    INT(5) UNSIGNED,
    created         DATE NOT NULL,
    modified        DATE DEFAULT NULL,
    author_id       INT(5) UNSIGNED,
    PRIMARY KEY (id),
    FOREIGN KEY (post_body_id) REFERENCES post_body(id) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (author_id) REFERENCES authors(id) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE tagged_posts (
    post_id         INT(5) UNSIGNED NOT NULL,
    tag_id          INT(5) UNSIGNED NOT NULL,
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE CASCADE ON UPDATE CASCADE ,
    FOREIGN KEY (tag_id) REFERENCES tags(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE images (
    id              INT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
    post_id         INT(5) UNSIGNED,
    name            VARCHAR(255) NOT NULL,
    location        VARCHAR(255) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (post_id) REFERENCES posts(id) ON DELETE SET NULL ON UPDATE CASCADE,
    UNIQUE (name, location)
) ENGINE=InnoDB;