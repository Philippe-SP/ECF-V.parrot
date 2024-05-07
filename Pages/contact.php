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
    <link rel="stylesheet" href="../Styles/contactStyle.css">
    <title>Garage V.Parrot</title>
    <link rel="shortcut icon" href="../Images/icon-garage.png">
</head>
<body>
    <nav id="navigation">
        <a href="../index.php"><img src="../Images/logo-garage.png" class="img-1" width="100%" height="auto"></a>
        <a href="../index.html"><img src="../Images/logo-garage_titre.png" class="img-2" width="100%" height="auto"></a>
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
                <li><a href="./contact.php" style="color: #D92332">Contact</a></li>
                <?php if(!isset($_SESSION['nom'])) { ?>
                <li><a href="../Connexion/connexion.php">Connexion</a></li>
                <?php } else { ?>
                <li><a href="./admin.php?token=<?php echo $_SESSION['token']; ?>">Admin</a></li>
                <li><a href="../Connexion/connexion.php?logout=1">Déconnexion</a></li>
                <?php }; ?>
            </ul>
        </div>
    </nav>
        <h1>Nous contacter</h1>
        <main class="telephone">
            <div class="tel">
                <h2>Par téléphone</h2>
                <h3>04.05.06.07.08</h3>
            </div>
            <div>
                <h3>Horraires</h3>
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
        </main>
        <h2>Par formulaire de contact</h2>
        <main class="form-contact">
            <form action="../Back/BDDcontact.php" method="POST" id="formContact">
                <div>
                    <label for="nom">Nom</label>
                    <input type="text" name="nom" id="nomContact" minlength="3" maxlength="20" pattern="[a-zA-Z]+" required>
                </div>
                <div>
                    <label for="prenom">Prenom</label>
                    <input type="text" name="prenom" id="prenomContact" minlength="3" maxlength="20" pattern="[a-zA-Z]+" required>
                </div>
                <div>
                    <label for="email">Adresse Email</label>
                    <input type="email" name="email" required>
                </div>
                <div>
                    <label for="tel">N° de téléphone</label>
                    <input type="tel" name="tel" pattern="[0-9]{10}" placeholder="Format FR +33" required>
                </div>
                <div>
                    <label for="message">Message</label>
                    <textarea name="message" id="messageContact" minlength="3" maxlength="150" placeholder="150 caractères maximum" required></textarea>
                </div>
                <input type="hidden" name="carName" value="Autre sujet">
                <button type="submit">Envoyer</button>
                <h2>
                <?php 
                if(isset($_GET['messageSend'])) {
                    echo "Message envoyé avec succès!";
                } 
                ?>
                </h2>
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