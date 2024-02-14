<?php 
session_start();
if(isset($_GET['logout'])) {
    session_destroy();
}

$dsn = 'mysql:host=mysql-psp.alwaysdata.net;dbname=psp_v-parrot';
$username = 'psp';
$password = 'PSP2001/';

if(isset($_POST['connexion'])) {
    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //Récupération des données du formulaire
        $formEmail = $_POST['email'];
        $formPassword = $_POST['password'];
        //Requette SQL
        $stmtConnect = $pdo->prepare('SELECT * FROM users WHERE email = :email');
        $stmtConnect->bindParam(':email', $formEmail);
        $stmtConnect->execute();
        //Création de variables pour afficher le message dans le formulaire
        $correctPass = true;
        $correctEmail= true;
        //Vérification de l'email dans la base de donnée
        if($stmtConnect->rowCount() == 1) {
            $user = $stmtConnect->fetch(PDO::FETCH_ASSOC);
            if(password_verify($formPassword, $user['password'])) {
                //Vérification du role de l'utilisateur
                $stmtRole = $pdo->prepare('SELECT * FROM roles_users WHERE user_id = :id');
                $stmtRole->bindParam(':id', $user['idUser']);
                $stmtRole->execute();
                $role = $stmtRole->fetch(PDO::FETCH_ASSOC);
                //Création des variables de session
                $_SESSION['nom'] = $user['nom'];
                $_SESSION['prenom'] = $user['prenom'];
                $_SESSION['role'] = $role['role_id'];
                header('location: https://psp.alwaysdata.net/index.php');
            }else {
                $correctPass = false;
            }
        }else {
            $correctEmail = false;
        }
    }catch(PDOException $e) {
        echo 'Erreur lors de la connexion à la base de donnée: '. $e->getMessage();
    }
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
    <link rel="stylesheet" href="../Styles/connexionStyle.css">
    <title>Garage V.Parrot</title>
    <link rel="shortcut icon" href="../Images/icon-garage.png">
</head>
<body>
    <nav id="navigation">
        <a href="../index.php"><img src="../Images/logo-garage.png" class="img-1" width="100%" height="auto"></a>
        <a href="../index.php"><img src="../Images/logo-garage_titre.png" class="img-2" width="100%" height="auto"></a>
        <h1>Garage V.PARROT</h1>
        <div>
            <ul>
                <li><a href="../index.php">Accueil</a></li>
                <li><a href="../vehicules.php">Véhicules</a></li>
                <li><a href="../contact.php">Contact</a></li>
                <li><a href="./connexion.php" style="color: #D92332">Connexion</a></li>
            </ul>
        </div>
    </nav>
    <main>
        <div class="connexion">
            <h1>Connexion</h1>
            <form action="./connexion.php" method="POST">
                <div>
                    <label for="email">Adresse Email</label>
                    <input type="email" name="email" required>
                </div>
                <div>
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" minlength="3" maxlength="10" required>
                </div>
                <button type="submit" name="connexion">Se connecter</button>
                <h2>
                <?php
                    if(isset($_POST['connexion'])) {
                        if($correctPass === false) {
                            echo "Mot de passe incorrect.";
                        }
                        if($correctEmail === false) {
                            echo "Utilisateur introuvable.";
                        }
                    }
                ?>
                </h2>
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
                    <li><a href="../vehicules.php">Véhicules</a></li>
                    <li><a href="../contact.php">Contact</a></li>
                    <li><a href="./connexion.php">Connexion</a></li>
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
            <a href="../MentionsLegales.php">Mentions Légales</a>
            <p> | </p>
            <a href="../confidentialité.php">Politique de confidentialité</a>
        </div>
    </footer>
</body>
</html>