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
    <link rel="stylesheet" href="./Styles/vehiculesStyle.css">
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
                <li><a href="./vehicules.php" style="color: #D92332">Véhicules</a></li>
                <li><a href="./contact.php">Contact</a></li>
                <?php if(!isset($_SESSION['nom'])) { ?>
                <li><a href="./Connexion/connexion.php">Connexion</a></li>
                <?php } else { 
                    if($_SESSION['role'] == 1) {
                ?>
                <li><a href="./admin.php">Admin</a></li>
                <?php }; ?>
                <li><a href="./Connexion/connexion.php?logout=1">Déconnexion</a></li>
                <?php }; ?>
            </ul>
        </div>
    </nav>
    <main>
        <h1>Nos véhicules d'occasion</h1>
        <button type="button" class="filtre">Filtre</button>
        <div class="liste-voitures">
            <div>
                <img src="https://scalethumb.leparking.fr/unsafe/331x248/smart/https://cloud.leparking.fr/2021/02/23/16/50/audi-a3-sportback-2017-audi-a3-1-6-tdi-s-line-sportback-69-wk-for-sale-in-cork-for-21-950-on-donedeal-noir_7993428002.jpg">
                <h3>Audi A3</h3>
                <p>Mise en circulation: 2016</p>
                <p>Kilométrage: 95000km</p>
                <p class="prix">18500€</p>
                <button type="button">Infos</button>  
            </div>
            <div>
                <img src="https://images.caradisiac.com/images/7/5/1/5/167515/S1-presentation-ford-focus-2018-dans-la-melee-549623.jpg">
                <h3>Ford Focus</h3>
                <p>Mise en circulation: 2018</p>
                <p>Kilométrage: 60000km</p>
                <p class="prix">22000€</p> 
                <button type="button">Infos</button>
            </div>
            <div>
                <img src="https://dakarvente.com/media/annonces/pics/00ed5614c064d006f99fd8bdcf20ec1a.jpeg">
                <h3>Peugeot 308</h3>
                <p>Mise en circulation: 2014</p>
                <p>Kilométrage: 120000km</p>
                <p class="prix">8600€</p>
                <button type="button">Infos</button>  
            </div>
            <div>
                <img src="https://blogautomobile.fr/wp-content/uploads/2010/05/BMW-320d-EfficientDynamics-29.jpg">
                <h3>BMW 320D</h3>
                <p>Mise en circulation: 2010</p>
                <p>Kilométrage: 110000km</p>
                <p class="prix">19200€</p>
                <button type="button">Infos</button>  
            </div>
            <div>
                <img src="https://4.bp.blogspot.com/-6QJ8N-hsWiA/VtF7vs6Z3yI/AAAAAAAARXk/bsLly5Pe_iw/s1600/alfa-romeo-giulietta-bleu-adriatico-cobalto-blue.png">
                <h3>Alfa Romeo Giulietta</h3>
                <p>Mise en circulation: 2020</p>
                <p>Kilométrage: 45000km</p>
                <p class="prix">23700€</p>
                <button type="button">Infos</button>  
            </div>
            <div>
                <img src="https://cars.usnews.com/static/images/Auto/izmo/i284858/2016_mazda_mazda3_angularfront.jpg">
                <h3>Mazda 3</h3>
                <p>Mise en circulation: 2016</p>
                <p>Kilométrage: 180000km</p>
                <p class="prix">11500€</p>
                <button type="button">Infos</button>  
            </div>
        </div>
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
        <p>© Copyright 2023P.Pinheiro</p>
    </footer>
</body>
</html>