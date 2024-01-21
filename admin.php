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
    <link rel="stylesheet" href="./Styles/adminStyle.css">
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
                <?php } else { 
                    if($_SESSION['role'] == 1) {
                ?>
                <li><a href="./admin.php" style="color: #D92332">Admin</a></li>
                <?php }; ?>
                <li><a href="./Connexion/connexion.php?logout=1">Déconnexion</a></li>
                <?php }; ?>
            </ul>
        </div>
    </nav>
    <header class="container">
        <div class="header-nav">
            <ul>
                <li><a href="#employe">Ajouter un employé</a></li>
                <li><a href="#vehicule">Ajouter un véhicule</a></li>
                <li><a href="#messagerie">Messagerie</a></li>
                <li><a href="#avis">Avis des clients</a></li>
            </ul>
        </div>
        <div class="formulaire" id="employe">
            <h2>Inscrire un nouvel employé</h2>
            <form action="./Back/BDDinscription.php" method="POST">
                <div>
                    <label for="nom">Nom</label>
                    <input type="text" name="nom"  required>
                </div>
                <div>
                    <label for="prenom">Prénom</label>
                    <input type="text" name="prenom" required>
                </div>
                <div>
                    <label for="email">Adresse Email</label>
                    <input type="email" name="email" required>
                </div>
                <div>
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" required>
                </div>
                <button type="submit">Inscrire</button>
                <?php
                    if(isset($_GET['success'])) {
                        echo "<span>Inscription réussite!</span>";
                    }
                ?>
            </form>
        </div>
        <div class="formulaire" id="vehicule">
            <h2>Ajouter un nouveau véhicule</h2>
            <form action="./BDDadmin.php" method="POST" enctype="multipart/form-data">
                <div>
                    <label for="marque">Marque</label>
                    <input type="text" name="marque">
                </div>
                <div>
                    <label for="modele">Modèle</label>
                    <input type="text" name="modele">
                </div>
                <div>
                    <label for="kilométrage">Kilométrage</label>
                    <input type="number" name="kilométrage">
                </div>
                <div>
                    <label for="annee-MES">Année de mise en circulation</label>
                    <input type="date" name="annee-MES">
                </div>
                <div>
                    <label for="prix">Prix</label>
                    <input type="number" name="prix">
                </div>
                <div>
                    <label for="image">Ajoutez une image principale</label>
                    <input type="file" name="image" accept="image/jpeg, image/png" required>
                </div>
                <div>
                    <label for="image">Ajoutez des images supplémentaires</label>
                    <input type="file" name="imageList" accept="image/jpeg, image/png" multiple required>
                </div>
                <div>
                    <label for="caracteristique">Caractéristiques du véhicule</label>
                    <input type="text" name="caracteristique" placeholder="Exemple: puissance, couple, etc... séparé par des virgules">
                </div>
                <div>
                    <label for="option">Options du véhicule</label>
                    <input type="text" name="option" placeholder="séparé par des virgules">
                </div>
                <button type="submit">Inscrire</button>
            </form>
        </div>
        <div id="messagerie">
            <h2>Messagerie</h2>
            <div>
                <h3>Nom / Prenom du gars</h3>
                <h3>Email / Tel du gars</h3>
                <p>Message du gars</p>
            </div>
            <div>
                <h3>Nom / Prenom du gars</h3>
                <h3>Email / Tel du gars</h3>
                <p>Message du gars</p>
            </div>
            <div>
                <h3>Nom / Prenom du gars</h3>
                <h3>Email / Tel du gars</h3>
                <p>Message du gars</p>
            </div>
        </div>
        <div id="avis">
            <h2>Avis des clients</h2>
            <div>
                <h3>Nom du gars</h3>
                <h3>Note sur 5</h3>
                <p>Commentaire du gars</p>
            </div>
            <div>
                <h3>Nom du gars</h3>
                <h3>Note sur 5</h3>
                <p>Commentaire du gars</p>
            </div>
            <div>
                <h3>Nom du gars</h3>
                <h3>Note sur 5</h3>
                <p>Commentaire du gars</p>
            </div>
        </div>
    </header>
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