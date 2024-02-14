<?php
session_start();
//Vérification qu'un admin est bien connecté
if(isset($_SESSION['nom'])) {
    $dsn = 'mysql:host=mysql-psp.alwaysdata.net;dbname=psp_v-parrot';
    $username = 'psp';
    $password = 'PSP2001/';

    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Récupération des messages recus et non lu depuis la page contact
        $stmtMessages = $pdo->prepare('SELECT * FROM messages WHERE messageSee = 0');
        $stmtMessages->execute();
        //Changement des messages "non lu" à "lu"
        if(isset($_POST['lu'])) {
            $formMessageId = $_POST['messageId'];
            $stmtMessageLu = $pdo->prepare('UPDATE messages SET messageSee = 1 WHERE id = :id');
            $stmtMessageLu->bindParam(':id', $formMessageId);
            $stmtMessageLu->execute();
        }
        //Récupération de tout les messages (lu et non lu)
        if(isset($_POST['showAllMessages'])) {
            $stmtAllMessages = $pdo->prepare('SELECT * FROM messages');
            $stmtAllMessages->execute();
        }

        //Récupération des avis des utilisateurs
        $stmtAvisPosted = $pdo->prepare('SELECT * FROM avis WHERE approved = 0');
        $stmtAvisPosted->execute();
        //Confirmation des avis pour affichage sur la page d'accueil du site
        if(isset($_POST['approved'])) {
            $formAvisId = $_POST['avisId'];
            $stmtAvisApprove = $pdo->prepare('UPDATE avis SET approved = 1 WHERE id = :id');
            $stmtAvisApprove->bindParam(':id', $formAvisId);
            $stmtAvisApprove->execute();
        //Suppression de l'avis si le bouton "supprimer" est cliqué
        } else if(isset($_POST['deleteCom'])) {
            $formAvisId = $_POST['avisId'];
            $stmtAvisDelete = $pdo->prepare('DELETE FROM avis WHERE id = :id');
            $stmtAvisDelete->bindParam(':id', $formAvisId);
            $stmtAvisDelete->execute();
        }
    } catch(PDOException $e) {
        echo 'Erreu lors de la connexion à la base de donnée'. $e->getMessage();
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
    <link rel="stylesheet" href="./Styles/adminStyle.css">
    <title>Garage V.Parrot</title>
    <link rel="shortcut icon" href="./Images/icon-garage.png">
</head>
<body>
<?php if(isset($_SESSION['nom'])) { ?>
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
                <?php }else { ?>
                <li><a href="./admin.php" style="color: #D92332">Admin</a></li>
                <li><a href="./Connexion/connexion.php?logout=1">Déconnexion</a></li>
                <?php } ?>
            </ul>
        </div>
    </nav>
    <header class="container">
        <div class="header-nav">
            <ul>
                <?php if($_SESSION['role'] == 1) { ?>
                <li><a href="#employe">Ajouter un employé</a></li>
                <?php } ?>
                <li><a href="#vehicule">Ajouter un véhicule</a></li>
                <li><a href="#messagerie">Messagerie</a></li>
                <li><a href="#avis">Avis des clients</a></li>
            </ul>
        </div>
        <?php if($_SESSION['role'] == 1) { ?>
        <div class="formulaire" id="employe">
            <h2>Inscrire un nouvel employé</h2>
            <form action="./Back/BDDinscription.php" method="POST">
                <div>
                    <label for="nom">Nom</label>
                    <input type="text" name="nom" minlength="3" maxlength="20" pattern="[a-zA-Z]+"  required>
                </div>
                <div>
                    <label for="prenom">Prénom</label>
                    <input type="text" name="prenom" minlength="3" maxlength="20" pattern="[a-zA-Z]+" required>
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
        <?php } ?>
        <div class="formulaire" id="vehicule">
            <h2>Ajouter un nouveau véhicule</h2>
            <form action="./Back//BDDvoiture.php" method="POST" enctype="multipart/form-data">
                <div>
                    <label for="marque">Marque</label>
                    <input type="text" name="marque">
                </div>
                <div>
                    <label for="modele">Modèle</label>
                    <input type="text" name="modele">
                </div>
                <div>
                    <label for="kilometrage">Kilométrage</label>
                    <input type="number" name="kilometrage" min="10000" max="230000">
                </div>
                <div>
                    <label for="annee-MES">Année de mise en circulation</label>
                    <input type="number" min="2000" max="2024" name="annee-MES">
                </div>
                <div>
                    <label for="prix">Prix</label>
                    <input type="number" name="prix" min="5000" max="60000">
                </div>
                <div>
                    <label for="image">Ajoutez une image principale</label>
                    <input type="file" name="image" accept="image/jpeg, image/png" id="docP" required>
                    <p id="img_P"></p>
                </div>
                <div>
                    <label for="imageList">Ajoutez des images supplémentaires</label>
                    <input type="file" name="imageList[]" accept="image/jpeg, image/png" id="docS" multiple="multiple" required>
                    <p id="showDocs"></p>
                </div>
                <div>
                    <label for="caracteristique">Caractéristiques du véhicule</label>
                    <input type="text" name="caracteristique" placeholder="Exemple: puissance, couple, etc... séparé par des virgules">
                </div>
                <div>
                    <label for="options">Options du véhicule</label>
                    <input type="text" name="options" placeholder="séparé par des virgules">
                </div>
                <button type="submit">Inscrire</button>
            </form>
        </div>
        <div id="messagerie">
            <h2>Messagerie</h2>
            <form action="./admin.php" method="POST" class="showAllForm">
                <button type="submit" name="showAllMessages" id="showAllBtn">Afficher les messages lu</button>
            </form>
            <?php if(!isset($_POST['showAllMessages'])) {
                    while ($messagesList = $stmtMessages->fetch(PDO::FETCH_ASSOC)) { ?>
                    <div>
                        <h3><?php echo "<i class='fa-solid fa-user'></i>".$messagesList['prenom']." ".$messagesList['nom']; ?></h3>
                        <h3><?php echo $messagesList['email']." / ".$messagesList['tel']; ?></h3>
                        <h4>Sujet: <?php echo $messagesList['sujet']; ?></h4>
                        <p><?php echo $messagesList['message']; ?></p>
                        <form action="./admin.php" method="POST">
                            <input hidden type="number" name="messageId" value="<?php echo $messagesList['id']; ?>">
                            <button class="messagerieBtn" type="submit" name="lu">Marquer comme lu</button>
                        </form>
                    </div>
            <?php }} else {
                        while ($allMessagesList = $stmtAllMessages->fetch(PDO::FETCH_ASSOC)) { ?>
                        <div>
                            <h3><?php echo "<i class='fa-solid fa-user'></i>".$allMessagesList['prenom']." ".$allMessagesList['nom']; ?></h3>
                            <h3><?php echo $allMessagesList['email']." / ".$allMessagesList['tel']; ?></h3>
                            <p><?php echo $allMessagesList['message']; ?></p>
                            <form action="./admin.php" method="POST">
                                <input hidden type="number" name="messageId" value="<?php echo $allMessagesList['id']; ?>">
                                <?php if($allMessagesList['messageSee'] === 0) { ?>
                                    <button class="messagerieBtn" type="submit" name="lu">Marquer comme lu</button>
                                <?php }; ?>
                            </form>
                        </div>
            <?php }}; ?>
        </div>
        <div id="avis">
            <h2>Avis des clients</h2>
            <?php while ($avisList = $stmtAvisPosted->fetch(PDO::FETCH_ASSOC)) { ?>
            <div>
                <h3><?php echo "<i class='fa-solid fa-user'></i>".$avisList['nom']; ?></h3>
                <h3><?php echo $avisList['note']; ?></h3>
                <p><?php echo $avisList['commentaire']; ?></p>
                <form action="./admin.php" method="POST">
                    <input type="number" name="avisId" hidden value="<?php echo $avisList['id']; ?>">
                    <button class="avisBtn" type="submit" name="deleteCom">Supprimer le commentaire</button>
                    <button class="avisBtn" type="submit" name="approved">Confirmer le commentaire</button>
                </form>
            </div>
            <?php } ?>
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
        <div class="plus">
            <p>© Copyright 2023P.Pinheiro</p>
            <p> | </p>
            <a href="./MentionsLegales.php">Mentions Légales</a>
            <p> | </p>
            <a href="./confidentialité.php">Politique de confidentialité</a>
        </div>
    </footer>
    <?php }else { ?>
        <div class="noAdmin">
            <h1>Erreur! Vous n'avez pas accès a cette page, veuillez vous connecter a un compte administrateur.</h1>
        </div>
    <?php } ?>
    <script src="admin.js"></script>
</body>
</html>