<?php
session_start();

require_once "../logs.php";

//Récupération du contenu de la page d'accueil modifiable par Mr. Parrot
try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmtDescription = $pdo->prepare('SELECT * FROM accueil');
    $stmtDescription->execute();
    $Content = $stmtDescription->fetch(PDO::FETCH_ASSOC);
    //Division de la chaine de caractères entrée par l'admin pour afficher les horraires
    $array = preg_split('/[,]/', $Content['horraires']);
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
    <link rel="stylesheet" href="../Styles/AdminHomeStyle.css">
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
                <li><a href="../index.php" style="color: #D92332">Accueil</a></li>
                <li><a href="./vehicules.php">Véhicules</a></li>
                <li><a href="./contact.php">Contact</a></li>
                <?php if(!isset($_SESSION['nom'])) { ?>
                <li><a href="../Connexion/connexion.php">Connexion</a></li>
                <?php } else { 
                    if($_SESSION['role'] == 1) {
                ?>
                <li><a href="./admin.php?token=<?php echo $_SESSION['token']; ?>">Admin</a></li>
                <?php }; ?>
                <li><a href="../Connexion/connexion.php?logout=1">Déconnexion</a></li>
                <?php }; ?>
            </ul>
        </div>
    </nav>
    <main class="content">
        <div class="container">
            <h1>Modifier la page d'accueil</h1>
            <form action="../Back//BDDadminHome.php" method="POST">
                <div>
                    <label for="presentation">Partie présentation</label>
                    <textarea type="text" name="presentation" placeholder="Actuel: voir ci-dessous"></textarea>
                </div>
                <div>
                    <label for="carroserie">Partie carroserie</label>
                    <textarea type="text" name="carroserie" placeholder="Actuel: voir ci-dessous"></textarea>
                </div>
                <div>
                    <label for="mecanique">Partie mécanique</label>
                    <textarea type="text" name="mecanique" placeholder="Actuel: voir ci-dessous"></textarea>
                </div>
                <div>
                    <label for="vente">Partie vente de véhicules</label>
                    <textarea type="text" name="vente" placeholder="Actuel: voir ci-dessous"></textarea>
                </div>
                <div>
                    <label for="horraires">Partie horraires</label>
                    <textarea type="text" name="horraires" placeholder="Séparer les horraires par des virgules, Exemple: Lun: 8h-12h/14h-18h, Mar:..."></textarea>
                </div>
                <button type="submit">Confirmer</button>
            </form>
        </div>
        <div class="actual-content">
            <div>
                <h2>Présentation</h2>
                <p>
                    <?php echo $Content['presentation']; ?>
                </p>
            </div>
            <div>
                <h2>Carroserie</h2>
                <p>
                    <?php echo $Content['carroserie']; ?>
                </p>
            </div>
            <div>
                <h2>Mécanique</h2>
                <p>
                    <?php echo $Content['mecanique']; ?>
                </p>
            </div>
            <div>
                <h2>Ventes de véhicules</h2>
                <p>
                    <?php echo $Content['vente']; ?>
                </p>
            </div>
        </div>
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
                    <li><a href="../index.php">Accueil</a></li>
                    <li><a href="./vehicules.php">Véhicules</a></li>
                    <li><a href="./contact.php">Contact</a></li>
                    <?php if(!isset($_SESSION['nom'])) { ?>
                    <li><a href="../Connexion/connexion.php">Connexion</a></li>
                    <?php } else { 
                        if($_SESSION['role'] == 1) {
                    ?>
                    <li><a href="./admin.php">Admin</a></li>
                    <?php }; ?>
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