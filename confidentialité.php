<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:wght@300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/60d2a6fbef.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./Styles/confidentialitéStyle.css">
    <title>Garage V.Parrot</title>
    <link rel="shortcut icon" href="./Images/icon-garage.png">
</head>
<body>
    <nav id="navigation">
        <a href="./index.php"><img src="./Images/logo-garage.png" class="img-1" width="100%" height="auto"></a>
        <a href="./index.php"><img src="./Images/logo-garage_titre.png" class="img-2" width="100%" height="auto"></a>
        <h1>Garage V.PARROT</h1>
        <div>
            <?php 
                if(isset($_SESSION['nom'])) {
                    echo "<h3><i class='fa-solid fa-user'></i>".$_SESSION['prenom'].' '.$_SESSION['nom']."</h3>";
                };
            ?>
            <ul>
                <li><a href="./index.php">Accueil</a></li>
                <li><a href="./vehicules.php">Véhicules</a></li>
                <li><a href="./contact.php">Contact</a></li>
                <?php if(!isset($_SESSION['nom'])) { ?>
                <li><a href="./Connexion/connexion.php">Connexion</a></li>
                <?php }else { ?>
                <li><a href="./admin.php">Admin</a></li>
                <li><a href="./Connexion/connexion.php?logout=1">Déconnexion</a></li>
                <?php } ?>
            </ul>
        </div>
    </nav>
    <main>
        <h1>Politique de confidentialité</h1>
        <p>
            La présente Politique de confidentialité décrit la manière dont [Nom de l'entreprise] collecte, utilise et protège les 
            informations personnelles que vous pouvez fournir lorsque vous utilisez ce site web.
        </p>
        <!-- Collecte et utilisation des informations -->
        <h2>Collecte et utilisation des informations</h2>
        <p>Nous pouvons collecter et traiter les types d'informations suivants : </p>
        <ul>
            <li>
                Informations que vous nous fournissez en remplissant des formulaires sur notre site, telles que votre nom, adresse e-mail, 
                numéro de téléphone, etc.
            </li>
            <li>
                Informations recueillies automatiquement lors de votre navigation sur notre site, y compris votre adresse IP, le type de 
                navigateur que vous utilisez, les pages que vous consultez et les liens sur lesquels vous cliquez.
            </li>
        </ul>
        <p>Nous utilisons ces informations dans le but de comprendre vos besoins et de vous fournir un meilleur service, notamment pour :</p>
            <ul>
                <li>Répondre à vos demandes de renseignements.</li>
                <li>Vous envoyer des informations que vous avez demandées concernant nos produits ou services.</li>
                <li>Vous envoyer des communications marketing si vous avez accepté de les recevoir.</li>
                <li>Améliorer notre site web et nos services en fonction de vos commentaires.</li>
            </ul>
        <!-- Confidentialité et sécurité des données -->
        <h2>Confidentialité et sécurité des données</h2>
        <p>
            Nous nous engageons à assurer la sécurité de vos informations personnelles. Pour empêcher tout accès non autorisé ou 
            divulgation, nous avons mis en place des procédures physiques, électroniques et de gestion appropriées pour sécuriser et 
            protéger les informations que nous collectons en ligne.
        </p>
        <!-- Partage des informations -->
        <h2>Partage des informations</h2>
        <p>
            Nous ne vendons, ne louons ni ne distribuons vos informations personnelles à des tiers sans votre consentement, sauf 
            si la loi l'exige.
        </p>
        <!-- Vos droits -->
        <h2>Vos droits</h2>
        <p>
            Vous avez le droit de demander l'accès aux informations personnelles que nous détenons à votre sujet, de les rectifier ou 
            de les supprimer. Pour exercer ces droits, veuillez nous contacter à l'adresse : <span>vincentParrot@mail.com</span>
            ou par notre formulaire de contact.
        </p>
        <!-- Modifications de la politique de confidentialité -->
        <h2>Modifications de la politique de confidentialité</h2>
        <p>
            Nous nous réservons le droit de modifier cette politique de confidentialité à tout moment. Toute modification sera publiée sur 
            cette page. Veuillez vérifier régulièrement cette page pour vous assurer que vous êtes satisfait des modifications.
        </p>
        <!-- Contact -->
        <h2>Contact</h2>
        <p>
            Si vous avez des questions concernant cette politique de confidentialité, veuillez nous contacter 
            à l'adresse suivante : <span>vincentParrot@mail.com</span> ou par notre formulaire de contact.
        </p>
    </main>
    <footer class="footer">
        <div class="top-div">
            <div class="horraires">
                <h2>Horraires</h2>
                <ul>
                    <li>Lun: 8h45-12h, 14h-18h</li>
                    <li>Mar: 8h45-12h, 14h-18h</li>
                    <li>Mer: 8h45-12h, 14h-18h</li>
                    <li>Jeu: 8h45-12h, 14h-18h</li>
                    <li>Ven: 8h45-12h, 14h-18h</li>
                    <li>Sam: 8h45-12h</li>
                    <li>Dim: Fermé</li>
                </ul>
            </div>
            <div class="nav-link">
                <ul>
                    <li><a href="./index.php">Accueil</a></li>
                    <li><a href="./vehicules.php">Véhicules</a></li>
                    <li><a href="./contact.php">Contact</a></li>
                    <?php if(!isset($_SESSION['nom'])) { ?>
                    <li><a href="./Connexion/connexion.php">Connexion</a></li>
                    <?php } else { 
                        if($_SESSION['role'] == 1) {
                    ?>
                    <li><a href="#">Admin</a></li>
                    <?php }; ?>
                    <li><a href="./Connexion/connexion.php?logout=1">Déconnexion</a></li>
                    <?php }; ?>
                </ul>
            </div>
        </div>
        <div class="bottom-div">
            <i class="fa-brands fa-instagram"><a href="#"></a></i>
            <i class="fa-brands fa-x-twitter"><a href="#"></a></i>
            <i class="fa-brands fa-facebook"><a href="#"></a></i>
        </div>
        <div class="plus">
            <p>© Copyright 2023P.Pinheiro</p>
            <p> | </p>
            <a href="./MentionsLegales.php">Mentions Légales</a>
            <p> | </p>
            <a href="./confidentialité.php">Politique de confidentialité</a>
        </div>
    </footer>
    <script src="script.js"></script>
</body>
</html>