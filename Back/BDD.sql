--Création de la base de donnée
CREATE DATABASE psp_v-parrot;
USE psp_v-parrot;

--Création des tables
CREATE TABLE users
(
    idUser CHAR(36) NOT NULL PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    email VARCHAR(150) NOT NULL,
    password VARCHAR(250) NOT NULL
);

--Insertion de Vincent Parrot et d'un employé
--Hash du mot de passe trouvé grace a un convertisseur Bcrypt pour qu'il fonctionne avec le formulaire de connexion
INSERT INTO users (idUser, nom, prenom, email, password) VALUES (UUID(), 'Parrot', 'Vincent', 'vincentParrot@mail.com','$2y$10$YsqTJvIpmvD0l3YcTbRxQONlg3.NcsQKS3Bfxqm.OIizDVxe17/fm');
INSERT INTO users (idUser, nom, prenom, email, password) VALUES (UUID(), 'Doe', 'John', 'johnDoe@mail.com', '$2y$10$7t3Hks7KblGa8dCDX9UyAOQ8fP7C7PqNpxgS2fAyCVXziS9rONHJu');

CREATE TABLE roles
(
    idRole INT(11) NOT NULL PRIMARY KEY,
    nom VARCHAR(100) NOT NULL
);

--Insertion des deux roles (Le role de Vincent Parrot et celui des employés)
INSERT INTO roles (idRole, nom)
VALUES
	(1, 'V-parrot'),
    (2, 'Employe');

CREATE TABLE roles_users
(
    user_id CHAR(36) NOT NULL,
    role_id INT(11) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(idUser),
    FOREIGN KEY (role_id) REFERENCES roles(idRole),
    PRIMARY KEY (user_id, role_id)
);

--Attribution du role a Vincent Parrot
INSERT INTO roles_users (user_id, role_id) VALUES ('cac48ef6-afd7-11ee-99c7-525400536f6e', 1);
INSERT INTO roles_users (user_id, role_id) VALUES ('76017c4f-b16e-11ee-99c7-525400536f6e', 2);

--Contenu de la page d'accueil modifiable par Mr. Parrot
CREATE TABLE accueil
(
    id INT(11) NOT NULL PRIMARY KEY,
    presentation LONGTEXT NOT NULL,
    carroserie LONGTEXT NOT NULL,
    vente LONGTEXT NOT NULL,
    horraires VARCHAR(255) NOT NULL
)

INSERT INTO accueil (id, presentation, carroserie, mecanique, vente, horraires) VALUES (1, "Notre engagement envers la satisfaction du client se reflète dans chaque aspect de nos services. Que vous ayez besoin d'une simple réparation, d'une restauration complète, ou que vous soyez à la recherche de votre prochaine voiture d'occasion, notre garage est l'endroit où la qualité et la passion pour l'automobile se rencontrent. Venez nous rendre visite et découvrez comment nous pouvons prendre soin de votre véhicule, de la carrosserie à la mécanique, jusqu'à la route devant vous.", "Notre équipe experte en carrosserie est dédiée à redonner à votre véhicule son aspect d'origine. Que ce soit pour des réparations suite à un accident, des dommages mineurs ou des travaux de restauration, nous utilisons des techniques avancées pour garantir une finition impeccable.", "Au-delà de l'esthétique, notre équipe de mécaniciens chevronnés assure le bon fonctionnement de votre véhicule. Des réparations mécaniques de routine aux diagnostics complexes, nous utilisons des équipements de pointe pour assurer la fiabilité et la performance de votre voiture.", "Si vous êtes à la recherche d'un nouveau compagnon de route, explorez notre sélection de véhicules d'occasion soigneusement inspectés et entretenus. Nous proposons des options variées pour répondre à vos besoins et préférences, chacune étant prête à offrir des kilomètres de plaisir de conduite en toute confiance.", "Lun: 8h45-12h/14h-18h, Mar: 8h45-12h/14h-18h, Mer: 8h45-12h/14h-18h, Jeu: 8h45-12h/14h-18h, Ven: 8h45-12h/14h-18h, Sam: 8h45-12h, Dim: Fermé");

--Messages envoyé depuis la page contact
CREATE TABLE messages
(
    id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    prenom VARCHAR(50) NOT NULL,
    nom VARCHAR(50) NOT NULL,
    email VARCHAR(150) NOT NULL,
    tel CHAR(10) NOT NULL,
    message LONGTEXT NOT NULL,
    messageSee TINYINT(1) NOT NULL
);

--Avis des utilisateurs
CREATE TABLE avis
(
    id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50) NOT NULL,
    note INT(5) NOT NULL,
    commentaire LONGTEXT NOT NULL,
    approved TINYINT(1) NOT NULL
);