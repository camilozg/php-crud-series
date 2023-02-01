CREATE TABLE platform (
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name varchar(255) UNIQUE NOT NULL
) ENGINE=InnoDB;

CREATE TABLE director (
	id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    lastname varchar(255) NOT NULL,
    birth_date date NOT NULL,
    nationality varchar(255) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE actor (
	id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    lastname varchar(255) NOT NULL,
    birth_date date NOT NULL,
    nationality varchar(255) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE languaje (
	id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    iso_code varchar(2) UNIQUE NOT NULL
) ENGINE=InnoDB;

CREATE TABLE serie (
	id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    title varchar(255) UNIQUE NOT NULL,
	synopsis varchar(500) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE serie_platform (
	serie_id int NOT NULL,
	platform_id int NOT NULL,
    PRIMARY KEY(serie_id, platform_id),
    FOREIGN KEY(serie_id) REFERENCES serie(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(platform_id) REFERENCES platform(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE serie_director (
	serie_id int NOT NULL,
	director_id int NOT NULL,
    PRIMARY KEY(serie_id, director_id),
    FOREIGN KEY(serie_id) REFERENCES serie(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(director_id) REFERENCES director(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE serie_actor (
	serie_id int NOT NULL,
	actor_id int NOT NULL,
    PRIMARY KEY(serie_id, actor_id),
    FOREIGN KEY(serie_id) REFERENCES serie(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(actor_id) REFERENCES actor(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE serie_audio_lang (
	serie_id int NOT NULL,
	languaje_id int NOT NULL,
    PRIMARY KEY(serie_id, languaje_id),
    FOREIGN KEY(serie_id) REFERENCES serie(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(languaje_id) REFERENCES languaje(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE serie_caption_lang (
	serie_id int NOT NULL,
	languaje_id int NOT NULL,
    PRIMARY KEY(serie_id, languaje_id),
    FOREIGN KEY(serie_id) REFERENCES serie(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(languaje_id) REFERENCES languaje(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;