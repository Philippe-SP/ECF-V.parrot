<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:wght@300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/60d2a6fbef.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./Styles/indexStyle.css">
    <title>Garage V.Parrot</title>
    <link rel="shortcut icon" href="./Images/icon-garage.png">
</head>
<body>
    <nav id="navigation">
        <a href="./index.php"><img src="./Images/logo-garage.png" class="img-1" width="100%" height="auto"></a>
        <a href="./index.php"><img src="./Images/logo-garage_titre.png" class="img-2" width="100%" height="auto"></a>
        <h1>Garage V.PARROT</h1>
        <div>
            <ul>
                <li><a href="./index.php" style="color: #D92332">Accueil</a></li>
                <li><a href="./vehicules.php">Véhicules</a></li>
                <li><a href="./contact.php">Contact</a></li>
                <li><a href="./Connexion/connexion.php">Connexion</a></li>
            </ul>
        </div>
    </nav>
    <header class="presentation">
        <h2>Présentation</h2>
        <p>Bienvenue dans notre garage automobile polyvalent <span>V.parrot</span>, votre destination complète pour l'entretien, la réparation, et 
            l'acquisition de véhicules d'occasion de qualité. Nous sommes fiers d'être bien plus qu'un simple atelier - nous sommes 
            votre partenaire de confiance pour toutes vos besoins automobiles. 
        </p>
        <br>
        <p>
            Notre engagement envers la satisfaction du client se reflète dans chaque aspect de nos services. Que vous ayez besoin 
            d'une simple réparation, d'une restauration complète, ou que vous soyez à la recherche de votre prochaine voiture d'occasion, 
            notre garage est l'endroit où la qualité et la passion pour l'automobile se rencontrent. Venez nous rendre visite et découvrez 
            comment nous pouvons prendre soin de votre véhicule, de la carrosserie à la mécanique, jusqu'à la route devant vous.
        </p>
    </header>
    <main class="services">
        <h2>Nos services</h2>
        <div class="service-cards">
            <div class="card">
                <img src="./Images/img-carroserie.jpg">
                <div class="card-text1">
                <h2>Carroserie</h2>
                <p>
                    Notre équipe experte en carrosserie est dédiée à redonner à votre véhicule son aspect d'origine. Que ce soit pour 
                    des réparations suite à un accident, des dommages mineurs ou des travaux de restauration, nous utilisons des 
                    techniques avancées pour garantir une finition impeccable.
                </p>
                </div>
            </div>
            <div class="card">
                <img src="./Images/img-mecanique.jpg">
                <div class="card-text2">
                <h2>Mécanique / Réparation</h2>
                <p>
                    Au-delà de l'esthétique, notre équipe de mécaniciens chevronnés assure le bon fonctionnement de votre véhicule. 
                    Des réparations mécaniques de routine aux diagnostics complexes, nous utilisons des équipements de pointe pour assurer 
                    la fiabilité et la performance de votre voiture.
                </p>
                </div>
            </div>
            <div class="card">
                <img src="./Images/img-ventesVehicules.jpg">
                <div class="card-text3">
                <h2>Ventes de véhicules d'occasion</h2>
                <p>
                    Si vous êtes à la recherche d'un nouveau compagnon de route, explorez notre sélection de véhicules d'occasion 
                    soigneusement inspectés et entretenus. Nous proposons des options variées pour répondre à vos besoins et préférences, 
                    chacune étant prête à offrir des kilomètres de plaisir de conduite en toute confiance.
                </p>
                </div>
            </div>
        </div>
    </main>
    <main class="avisForm">
        <h2>Laisser un avis</h2>
        <form>
            <label for="nom">Nom</label>
            <input type="text" name="nom" required>
            <label for="commentaire">Commentaire</label>
            <input type="text" name="commentaire" required>
            <label for="message">Message</label>
            <textarea name="message" id="text-area" required></textarea>
            <div>
                <button type="submit">Envoyer</button>
            </div>
        </form>
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
                    <li><a href="./Connexion/connexion.php">Connexion</a></li>
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
    <script src="script.js"></script>
</body>
</html>