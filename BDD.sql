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

--Insertion de Vincent Parrot
--Hash du mot de passe trouvé grace a un convertisseur Bcrypt pour qu'il fonctionne avec le formulaire de connexion
INSERT INTO users (idUser, nom, prenom, email, password) VALUES (UUID(), 'Parrot', 'Vincent', 'vincentParrot@mail.com','$2y$10$YsqTJvIpmvD0l3YcTbRxQONlg3.NcsQKS3Bfxqm.OIizDVxe17/fm');

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
