<?php
session_start();

require_once "../logs.php";

//Récupération des infos du véhicule correspondant
try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Récupération de l'id de la voiture correspondante
    $idCar = $_GET['idCar'];
    //Requette SQL pour récupérer les infos
    $stmtDetail = $pdo->prepare('SELECT * FROM voitures WHERE id = :id');
    $stmtDetail->bindParam(':id', $idCar);
    if($stmtDetail->execute()) {
        $carDetail = $stmtDetail->fetch(PDO::FETCH_ASSOC);
        $arrayCaract = preg_split('/[,]/', $carDetail['caracteristique']);
        $arrayOpt = preg_split('/[,]/', $carDetail['options']);
    }

    //Récupération des images correspondants au véhicule
    $stmtImg = $pdo->prepare('SELECT * FROM img_list WHERE car_id = :id');
    $stmtImg->bindParam(':id', $idCar);
    $stmtImg->execute();
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
    <link rel="stylesheet" href="../Styles/detailStyle.css">
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
                <?php } else { ?>
                <li><a href="./admin.php?token=<?php echo $_SESSION['token']; ?>">Admin</a></li>
                <li><a href="../Connexion/connexion.php?logout=1">Déconnexion</a></li>
                <?php }; ?>
            </ul>
        </div>
    </nav>
    <main>
        <h1>Détail du véhicule</h1>
        <!-- Images du véhicule -->
        <div class="car_img">
            <img src="../voitureImg/Principales/<?php echo $carDetail['image_princ']; ?>"/>
            <?php while($imgList = $stmtImg->fetch(PDO::FETCH_ASSOC)) {
                echo '<img src="../voitureImg/Secondaires/'.$imgList["img_link"].'" id="image"/>';
            }?>
        </div>
        <!-- Infos du véhicule -->
        <div class="car_info">
            <h2><i class="fa-solid fa-car"></i> <span><?php echo $carDetail['marque']." ".$carDetail['modele']; ?></span></h2>
            <div class="info_top">
                <h3><i class="fa-solid fa-ruler-horizontal"></i> Kilométrage: <span><?php echo $carDetail['kilometrage']; ?>km</span></h3>
                <h3><i class="fa-regular fa-calendar"></i> Année de mise en circulation du véhicule: <span><?php echo $carDetail['annee_MES']; ?></span></h3>
            </div>
            <div class="info_bottom">
                <div>
                    <h3><i class="fa-solid fa-list"></i> Caractéristiques du véhicules</h3>
                    <ul>
                        <?php
                            foreach ($arrayCaract as $caract) {
                                echo "<li>" . $caract . "</li>";
                            }
                        ?>
                    </ul>
                </div>
                <div>
                    <h3><i class="fa-solid fa-plus"></i> Options du véhicules</h3>
                    <ul>
                        <?php
                            foreach ($arrayOpt as $option) {
                                echo "<li>" . $option . "</li>";
                            }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="boutons">
                <a href="./vehicules.php">Retourner à la liste des véhicules</a>
            </div>
        </div>
        <div class="formContact">
            <h2>Acheter ce véhicule</h2>
            <form action="../Back/BDDcontact.php" method="POST" id="formDetail">
                <div>
                    <label for="nom">Nom</label>
                    <input type="text" name="nom" id="nomDetail" minlength="3" maxlength="20" pattern="[a-zA-Z]+" required>
                </div>
                <div>
                    <label for="prenom">Prenom</label>
                    <input type="text" name="prenom" id="prenomDetail" minlength="3" maxlength="20" pattern="[a-zA-Z]+" required>
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
                    <textarea name="message" id="messageDetail" minlength="3" maxlength="150" placeholder="150 caractères maximum" required></textarea>
                </div>
                <input type="hidden" name="carName" value="<?php echo $carDetail['marque']." ".$carDetail['modele']; ?>">
                <button type="submit">Envoyer</button>
            </form>
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