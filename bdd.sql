/* SQLEditor (MySQL (2))*/

CREATE TABLE annonceur
(
id_annonceur INT NOT NULL AUTO_INCREMENT,
email VARCHAR(255),
nom_annonceur VARCHAR(255),
telephone INT,
PRIMARY KEY (id_annonceur)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE categorie
(
id_categorie INT NOT NULL AUTO_INCREMENT,
nom_categorie VARCHAR(255),
PRIMARY KEY (id_categorie)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE photo
(
id_photo INT NOT NULL AUTO_INCREMENT,
id_annonce INTEGER,
url_photo INTEGER,
PRIMARY KEY (id_photo)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE region
(
id_region INT NOT NULL AUTO_INCREMENT,
nom_region VARCHAR(255),
PRIMARY KEY (id_region)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE departement
(
id_departement INT NOT NULL AUTO_INCREMENT,
id_region INT,
nom_departement VARCHAR(255),
PRIMARY KEY (id_departement)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE sous_categorie
(
id_sous_categorie INTEGER NOT NULL AUTO_INCREMENT,
id_categorie INTEGER,
nom_sous_categorie VARCHAR(255),
PRIMARY KEY (id_sous_categorie)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

CREATE TABLE annonce
(
id_annonce INT NOT NULL AUTO_INCREMENT,
id_sous_categorie INT,
id_annonceur INTEGER,
id_departement INTEGER,
prix FLOAT,
date DATE,
titre VARCHAR(255),
description TEXT,
ville VARCHAR(255),
mdp VARCHAR(255),
PRIMARY KEY (id_annonce)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

ALTER TABLE photo ADD FOREIGN KEY id_annonce_idxfk (id_annonce) REFERENCES annonce (id_annonce);

ALTER TABLE departement ADD FOREIGN KEY id_region_idxfk (id_region) REFERENCES region (id_region);

ALTER TABLE sous_categorie ADD FOREIGN KEY id_categorie_idxfk (id_categorie) REFERENCES categorie (id_categorie);

ALTER TABLE annonce ADD FOREIGN KEY id_sous_categorie_idxfk (id_sous_categorie) REFERENCES sous_categorie (id_sous_categorie);

ALTER TABLE annonce ADD FOREIGN KEY id_annonceur_idxfk (id_annonceur) REFERENCES annonceur (id_annonceur);

ALTER TABLE annonce ADD FOREIGN KEY id_departement_idxfk (id_departement) REFERENCES departement (id_departement);
