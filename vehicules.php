<?php
session_start();

$dsn = 'mysql:host=mysql-psp.alwaysdata.net;dbname=psp_v-parrot';
$username = 'psp';
$password = 'PSP2001/';

require_once "./Back/BDDfiltre.php";

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Récupération de toute les voitures de la bdd
    $stmtCar = $pdo->prepare('SELECT * FROM voitures');
    $stmtCar->execute();

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
    <main id="mainContent">
        <h1>Nos véhicules d'occasion</h1>
        <button type="button" id="filtreBtn">Filtre</button>
        <div id="filtreForm">
            <form method="POST" id="formulaire" enctype="multipart/form-data">
                <div class="filtreInput">
                    <div>
                        <h3>Kilométrage</h3>
                        <label for="km_min">Min</label>
                        <input type="range" id="km_min" name="km_min" class="range_input" min="10000" max="230000" step="10000" value="10000">
                        <span id="kmMin_text"></span>
                        <label for="km_max">Max</label>
                        <input type="range" id="km_max" name="km_max" class="range_input" min="10000" max="230000" step="10000" value="230000">
                        <span id="kmMax_text"></span>
                    </div>
                    <div>
                        <h3>Année de mise en circualtion</h3>
                        <label for="anneeMES_min">Min</label>
                        <input type="range" id="anneeMES_min" name="anneeMES_min" class="range_input" min="2000" max="2024" step="1" value="2000">
                        <span id="anneeMin_text"></span>
                        <label for="anneeMES_max">Max</label>
                        <input type="range" id="anneeMES_max" name="anneeMES_max" class="range_input" min="2000" max="2024" step="1" value="2024">
                        <span id="anneeMax_text"></span>
                    </div>
                    <div>
                        <h3>Prix</h3>
                        <label for="prix_min">Min</label>
                        <input type="range" id="prix_min" name="prix_min" class="range_input" min="5000" max="60000" step="2000" value="5000">
                        <span id="prixMin_text"></span>
                        <label for="prix_max">Max</label>
                        <input type="range" id="prix_max" name="prix_max" class="range_input" min="5000" max="60000" step="2000" value="60000">
                        <span id="prixMax_text"></span>
                    </div>
                </div>
                <div class="form_buttons">
                    <button type="submit" name="submit" class="formBtn" id="formBtn">Effectuer le filtre</button>
                    <button type="button" id="DropFilter" class="formBtn">Réinitialiser le filtre</button>
                </div>
            </form>
        </div>
        <div id="liste-voitures">
            <?php if(!isset($_POST['submit'])) {
                    while($carList = $stmtCar->fetch(PDO::FETCH_ASSOC)) { ?>
                        <div>
                            <img src="<?php echo "./voitureImg/Principales/".$carList['image_princ']; ?>">
                            <h3><?php echo $carList['marque']." ".$carList['modele']; ?></h3>
                            <p><?php echo "Mise en circulation: ".$carList['annee_MES']; ?></p>
                            <p><?php echo "Kilométrage: ".$carList['kilometrage']; ?></p>
                            <hr class="separation">
                            <p class="prix"><?php echo $carList['prix']."€"; ?></p>
                            <a href="./detail_vehicule.php?idCar=<?php echo $carList['id']; ?>" class="infos">Infos</a>  
                        </div>
            <?php }} ?>
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
    <script src="./vehicules.js"></script>
</body>
</html>