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
    <link rel="stylesheet" href="../Styles/MentionsStyle.css">
    <title>Garage V.Parrot</title>
    <link rel="shortcut icon" href="../Images/icon-garage.png">
</head>
<body>
    <nav id="navigation">
        <a href="../index.php"><img src="../Images/logo-garage.png" class="img-1" width="100%" height="auto"></a>
        <a href="../index.php"><img src="../Images/logo-garage_titre.png" class="img-2" width="100%" height="auto"></a>
        <h1>Garage V.PARROT</h1>
        <div>
            <?php 
                if(isset($_SESSION['nom'])) {
                    echo "<h3><i class='fa-solid fa-user'></i>".$_SESSION['prenom'].' '.$_SESSION['nom']."</h3>";
                };
            ?>
            <ul>
                <li><a href="../index.php">Accueil</a></li>
                <li><a href="./vehicules.php">Véhicules</a></li>
                <li><a href="./contact.php">Contact</a></li>
                <?php if(!isset($_SESSION['nom'])) { ?>
                <li><a href="../Connexion/connexion.php">Connexion</a></li>
                <?php }else { ?>
                <li><a href="./admin.php?token=<?php echo $_SESSION['token']; ?>">Admin</a></li>
                <li><a href="../Connexion/connexion.php?logout=1">Déconnexion</a></li>
                <?php } ?>
            </ul>
        </div>
    </nav>
    <main>
        <h1>Mentions Légales</h1>
        <!-- Informations légales -->
        <h2>Informations légales</h2>
        <h3>Ce site est édité par <span>Philippe SP</span></h3>
        <hr>
        <h3><span>Garage V.Parrot</span></h3>
        <h4>25 Rue de l'Automobile</h4>
        <h4>31000 Toulouse, France</h4>
        <hr>
        <h3>Email: <span>vincentParrot@mail.com</span></h3>
        <hr>
        <h3>Société immatriculée au Registre du Commerce et des Sociétés de Toulouse sous le numéro <span>RCS Toulouse 123 456 789</span></h3>
        <hr>
        <h3>Numéro de TVA intracommunautaire : <span>FR12345678901</span></h3>
        <hr>
        <h3>Directeur de la publication : <span>Philippe SP</span></h3>
        <!-- Partie de l'hebergeur -->
        <h2>Hébergeur</h2>
        <h3>Ce site est hébergé par <span>AlwaysData</span></h3>
        <hr>
        <h3>Site de l'hébergeur: <a href="https://www.alwaysdata.com/fr/">AlwaysData</a></h3>
        <hr>
        <h3>Téléphone de l'hébergeur: <span>+33 1 84 16 23 40</span></h3>
        <hr>
        <!-- Propriété intellectuelle -->
        <h2>Propriété intellectuelle</h2>
        <p>
            Tous les contenus présents sur ce site, incluant, mais sans s'y limiter, les textes, images, graphismes, logos, icônes, 
            clips audio et vidéo, sont la propriété exclusive du garage <span>V.Parrot</span> ou de ses partenaires et sont protégés par les lois 
            françaises et internationales relatives à la propriété intellectuelle.
        </p>
        <p>
            Toute reproduction, distribution, modification, adaptation, retransmission ou publication, même partielle, de ces différents 
            éléments est strictement interdite sans l'accord exprès par écrit du garage <span>V.Parrot</span>.
        </p>
        <!-- Données personnelles -->
        <h2>Données personnelles</h2>
        <p>
            Les données personnelles collectées sur ce site sont uniquement destinées à <span>V.Parrot</span> et ne seront en aucun 
            cas cédées à des tiers. Conformément à la loi « Informatique et Libertés » du 6 janvier 1978 modifiée et au Règlement Général 
            sur la Protection des Données (RGPD), vous disposez d'un droit d'accès, de modification, de rectification et de suppression 
            des données vous concernant. Vous pouvez exercer ce droit en nous contactant à l'adresse suivante : 
            <span>vincentParrot@mail.com</span> ou par notre formulaire de contact.
        </p>
        <!-- Liens externes -->
        <h2>Liens externes</h2>
        <p>
            Ce site peut contenir des liens vers des sites externes. [Nom de l'entreprise] décline toute responsabilité quant au contenu de 
            ces sites et ne saurait être tenu responsable des dommages ou préjudices résultant de l'utilisation de ces liens.
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
                    <li><a href="../index.php">Accueil</a></li>
                    <li><a href="./vehicules.php">Véhicules</a></li>
                    <li><a href="./contact.php">Contact</a></li>
                    <?php if(!isset($_SESSION['nom'])) { ?>
                    <li><a href="../Connexion/connexion.php">Connexion</a></li>
                    <?php } else { ?>
                    <li><a href="./admin.php?token=<?php echo $_SESSION['token']; ?>">Admin</a></li>
                    <li><a href="../Connexion/connexion.php?logout=1">Déconnexion</a></li>
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
            <a href="./confidentialite.php">Politique de confidentialité</a>
        </div>
    </footer>
    <script src="../Scripts/script.js"></script>
</body>
</html>