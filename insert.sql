LOCK TABLES `region` WRITE;
/*!40000 ALTER TABLE `region` DISABLE KEYS */;

INSERT INTO `region` (`id_region`, `nom_region`)
VALUES
	(1,'Lorraine'),
	(2,'Alsace'),
	(3,'Bourgogne');

/*!40000 ALTER TABLE `region` ENABLE KEYS */;
UNLOCK TABLES;


LOCK TABLES `photo` WRITE;
/*!40000 ALTER TABLE `photo` DISABLE KEYS */;

INSERT INTO `photo` (`id_photo`, `id_annonce`, `url_photo`)
VALUES
	(1,1,'http://www.routard.com/images_contenu/communaute/Photos/publi/029/pt28199.jpg'),
	(2,1,'http://www.routard.com/images_contenu/communaute/Photos/publi/029/pt28199.jpg'),
	(3,2,'http://www.routard.com/images_contenu/communaute/Photos/publi/029/pt28199.jpg'),
	(4,2,'http://www.routard.com/images_contenu/communaute/Photos/publi/029/pt28199.jpg'),
	(5,2,'http://www.routard.com/images_contenu/communaute/Photos/publi/029/pt28199.jpg');

/*!40000 ALTER TABLE `photo` ENABLE KEYS */;
UNLOCK TABLES;


LOCK TABLES `departement` WRITE;
/*!40000 ALTER TABLE `departement` DISABLE KEYS */;

INSERT INTO `departement` (`id_departement`, `id_region`, `nom_departement`)
VALUES
	(1,1,'Meuse'),
	(2,1,'Vosges'),
	(3,1,'Moselle'),
	(4,1,'Meurthe-et-moselle'),
	(5,2,'Haut-Rhin'),
	(6,2,'Bas-Rhin'),
	(8,3,'Côte-d\'Or'),
	(9,3,'Nièvre'),
	(10,3,'Saône-et-Loire'),
	(11,3,'Yonne');

/*!40000 ALTER TABLE `departement` ENABLE KEYS */;
UNLOCK TABLES;


LOCK TABLES `categorie` WRITE;
/*!40000 ALTER TABLE `categorie` DISABLE KEYS */;

INSERT INTO `categorie` (`id_categorie`, `nom_categorie`)
VALUES
	(1,'Véhicule'),
	(2,'Immobilier'),
	(3,'Multimédia'),
	(4,'Loisirs');

/*!40000 ALTER TABLE `categorie` ENABLE KEYS */;
UNLOCK TABLES;


LOCK TABLES `annonceur` WRITE;
/*!40000 ALTER TABLE `annonceur` DISABLE KEYS */;

INSERT INTO `annonceur` (`id_annonceur`, `email`, `nom_annonceur`, `telephone`)
VALUES
	(1,'annonceur1@exemple.ptdr','Bernard','0607080910'),
	(2,'annonceur1@exemple.ptdr','Dominique','0609136533'),
	(3,'autreannonceur1@exemple.mdr','Danielle','0678126432');

/*!40000 ALTER TABLE `annonceur` ENABLE KEYS */;
UNLOCK TABLES;


LOCK TABLES `annonce` WRITE;
/*!40000 ALTER TABLE `annonce` DISABLE KEYS */;

INSERT INTO `annonce` (`id_annonce`, `id_sous_categorie`, `id_annonceur`, `id_departement`, `prix`, `date`, `titre`, `description`, `ville`, `mdp`)
VALUES
	(1,1,1,1,35,'2014-12-15','Titre de l\'annonce 1','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab alias asperiores, corporis distinctio dolorem\ndolores facere iure, laboriosam minima nostrum odit praesentium, quaerat quia reprehenderit soluta totam\nvoluptatem. Corporis, nemo.\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Ab alias asperiores, corporis distinctio dolorem\ndolores facere iure, laboriosam minima nostrum odit praesentium, quaerat quia reprehenderit soluta totam\nvoluptatem. Corporis, nemo.','Bar-le-Duc','azerty'),
	(2,2,2,3,99,'2014-12-16','Titre de l\'annonce 2','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab alias asperiores, corporis distinctio dolorem\ndolores facere iure, laboriosam minima nostrum odit praesentium, quaerat quia reprehenderit soluta totam\nvoluptatem. Corporis, nemo.','Metz','didierchantal'),
	(3,3,3,5,17.35,'2014-12-17','Titre de l\'annonce 3','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab alias asperiores, corporis distinctio dolorem\ndolores facere iure, laboriosam minima nostrum odit praesentium, quaerat quia reprehenderit soluta totam\nvoluptatem. Corporis, nemo.\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Ab alias asperiores, corporis distinctio dolorem\ndolores facere iure, laboriosam minima nostrum odit praesentium, quaerat quia reprehenderit soluta totam\nvoluptatem. Corporis, nemo.\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Ab alias asperiores, corporis distinctio dolorem\ndolores facere iure, laboriosam minima nostrum odit praesentium, quaerat quia reprehenderit soluta totam\nvoluptatem. Corporis, nemo.','Jjefifi','sauder54');

/*!40000 ALTER TABLE `annonce` ENABLE KEYS */;
UNLOCK TABLES;

LOCK TABLES `sous_categorie` WRITE;
/*!40000 ALTER TABLE `sous_categorie` DISABLE KEYS */;

INSERT INTO `sous_categorie` (`id_sous_categorie`, `id_categorie`, `nom_sous_categorie`)
VALUES
	(1,1,'Voitures'),
	(2,1,'Moto'),
	(3,1,'Caravaning'),
	(4,1,'Nautisme'),
	(5,2,'Ventes immobilières'),
	(6,2,'Locations'),
	(7,2,'Colocations'),
	(8,2,'Bureaux & commerces'),
	(9,3,'Informatique'),
	(10,3,'Consoles & jeux-vidéos'),
	(11,3,'Image & son'),
	(12,4,'DVD / Films'),
	(13,4,'Vin & Gastronomie'),
	(14,4,'Vélos');

/*!40000 ALTER TABLE `sous_categorie` ENABLE KEYS */;
UNLOCK TABLES;
