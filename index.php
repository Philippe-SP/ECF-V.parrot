<?php
session_start();

$dsn = 'mysql:host=mysql-psp.alwaysdata.net;dbname=psp_v-parrot';
$username = 'psp';
$password = 'PSP2001/';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Récupération du contenu de la page d'accueil modifiable par Mr. Parrot
    $stmtDescription = $pdo->prepare('SELECT * FROM accueil');
    $stmtDescription->execute();
    $Content = $stmtDescription->fetch(PDO::FETCH_ASSOC);
    //Division de la chaine de caractères entrée par l'admin pour afficher les horraires
    $array = preg_split('/[,]/', $Content['horraires']);

    //Récupération des avis des utilisateurs approuvés par un employé
    $stmtAvisApproved = $pdo->prepare('SELECT * FROM avis WHERE approved = 1');
    $stmtAvisApproved->execute();
} catch(PDOException $e) {
    echo "Erreur lors de la connexion à la base de donnée". $e->getMessage();
}
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
            <?php 
                if(isset($_SESSION['nom'])) {
                    echo "<h3><i class='fa-solid fa-user'></i>".$_SESSION['prenom'].' '.$_SESSION['nom']."</h3>";
                };
            ?>
            <ul>
                <li><a href="./index.php" style="color: #D92332">Accueil</a></li>
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
    <header class="presentation">
        <?php if(isset($_SESSION['nom']) && $_SESSION['role'] === 1) { ?>
                <a href="./AdminHome.php">Modifier les informations</a>
        <?php }; ?>
        <h2>Présentation</h2>
        <p>Bienvenue dans notre garage automobile polyvalent <span>V.parrot</span>, votre destination complète pour l'entretien, la réparation, et 
            l'acquisition de véhicules d'occasion de qualité. Nous sommes fiers d'être bien plus qu'un simple atelier - nous sommes 
            votre partenaire de confiance pour toutes vos besoins automobiles. 
        </p>
        <br>
        <p>
            <?php echo $Content['presentation']; ?>
        </p>
    </header>
    <main class="services">
        <h2>Nos services</h2>
        <div class="service-cards">
            <div class="card" id="card_1">
                <img src="./Images/img-carroserie.jpg">
                <div class="card-text1">
                <h2>Carroserie</h2>
                <p>
                    <?php echo $Content['carroserie']; ?>
                </p>
                </div>
            </div>
            <div class="card" id="card_2">
                <img src="./Images/img-mecanique.jpg">
                <div class="card-text2">
                <h2>Mécanique / Réparation</h2>
                <p>
                    <?php echo $Content['mecanique']; ?>
                </p>
                </div>
            </div>
            <div class="card" id="card_3">
                <img src="./Images/img-ventesVehicules.jpg">
                <div class="card-text3">
                <h2>Ventes de véhicules d'occasion</h2>
                <p>
                    <?php echo $Content['vente']; ?>
                </p>
                </div>
            </div>
        </div>
    </main>
    <main class="avisList">
        <?php while ($avisApproved = $stmtAvisApproved->fetch(PDO::FETCH_ASSOC)) { ?>
            <div class="userAvis">
                <h3><?php echo "<i class='fa-solid fa-user'></i> ".$avisApproved['nom']; ?></h3>
                <h3>
                    <?php
                        if($avisApproved['note'] === 1) {
                            echo "&#9734;";
                        }else if($avisApproved['note'] === 2) {
                            echo "&#9734;"."&#9734;";
                        }else if($avisApproved['note'] === 3) {
                            echo "&#9734;"."&#9734;"."&#9734;";
                        }else if($avisApproved['note'] === 4) {
                            echo "&#9734;"."&#9734;"."&#9734;"."&#9734;";
                        }else if($avisApproved['note'] === 5) {
                            echo "&#9734;"."&#9734;"."&#9734;"."&#9734;"."&#9734;";
                        }
                    ?>
                </h3>
                <p><?php echo $avisApproved['commentaire']; ?></p>
            </div>
        <?php } ?>
    </main>
    <main class="avisForm">
        <h2>Laisser un avis</h2>
        <form action="./Back/BDDavis.php" method="POST">
            <label for="nom">Nom</label>
            <input type="text" name="nom" required>
            <label for="commentaire">Note</label>
            <input type="number" name="note" placeholder="de 1 à 5" min="0" max="5" required>
            <label for="message">Commentaire</label>
            <textarea name="commentaire" id="text-area" required></textarea>
            <h2>
                <?php
                    if(isset($_GET['comSend'])) {
                        echo "Votre avis a bien été enregistré.";
                ?>
                <br>
                <?php
                        echo "Un personnel du garage va consulter votre commentaire afin de le poster sur le site.";
                    } 
                ?>
            </h2>
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
                    <?php 
                        foreach($array as $value) {
                            echo "<li>".$value."</li>";
                        };
                    ?>
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
            <a href="#">Mentions Légales</a>
            <p> | </p>
            <a href="#">Politique de confidentialité</a>
        </div>
    </footer>
    <script src="script.js"></script>
</body>
</html>