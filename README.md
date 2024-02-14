# ECF-V.parrot
ECF graduate développeur web et web mobile (Sujet: Garage V.Parrot)

Création d'un administrateur pour le back office:
(Dans la base de données utilisée dans le fichier "BDD.sql" avec le nom d'utilisateur: "psp"et le mot de passe: "PSP2001/"):

SELECT PASSWORD('votre mot de passe')
CREATE USER 'nom_utilisateur'@'mysql-psp.alwaysdata.net' IDENTIFIED BY 'mdp_chiffré';
GRANT ALL PRIVILEGES ON * . * TO 'nom_utilisateur'@'mysql-psp.alwaysdata.net';

Exemple: 

SELECT PASSWORD('AdminBDD');
//Me retourne : *9F24D54F1038EE3B620D71B54D3435603ACBDEA0
//Création de l'utilisateur
CREATE USER 'Admin_BDD'@'mysql-psp.alwaysdata.net' IDENTIFIED BY '*9F24D54F1038EE3B620D71B54D3435603ACBDEA0';
//Attribution des privilèges
GRANT ALL PRIVILEGES ON * . * TO 'Admin_BDD'@'mysql-psp.alwaysdata.net';


Déploiement en local du site web:

- Installer XAMPP ou WAMPP pour avoir accès a un serveur local pour héberger le site web (pour cet exemple je vai utiliser XAMPP).
- Déplacer le dossier du site web (ECF-V.parrot) dans le dossier "htdocs" de XAMPP.
- Dans le panel de configuration de XAMPP, appuyer sur le bouton START de "Apache" et de "MySQL"
- Dans votre navigateur web, taper l'adresse suivante: http://localhost/ECF-V.parrot/index.php