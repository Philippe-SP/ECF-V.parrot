<?php

$dsn = 'mysql:host=mysql-psp.alwaysdata.net;dbname=psp_v-parrot';
$username = 'psp';
$password = 'PSP2001/';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Récupération des données du formulaire de création 
    $formMarque = htmlspecialchars($_POST['marque']);
    $formModele = htmlspecialchars($_POST['modele']);
    $formKilometrage = (int)$_POST['kilometrage'];
    $formAnnee = (int)$_POST['annee-MES'];
    $formPrix = (int)$_POST['prix'];
    //Récupération de l'image principale
    $formImgP = $_FILES['image']['name'];
    $tmpImgP = $_FILES['image']['tmp_name'];
    move_uploaded_file($tmpImgP, '../voitureImg/Principales/'. $formImgP);
    //Récupération du reste du formulaire
    $formCaract = $_POST['caracteristique'];
    $formOption = $_POST['options'];

    //Requette SQL pour la création de la voiture sur le site
    $stmtAddCar = $pdo->prepare('INSERT INTO voitures (marque, modele, kilometrage, annee_MES, prix, image_princ, caracteristique, options) VALUES (:marque, :modele, :kilometrage, :annee_MES, :prix, :imageP, :caracteristique, :options)');
    $stmtAddCar->bindParam(':marque', $formMarque);
    $stmtAddCar->bindParam(':modele', $formModele);
    $stmtAddCar->bindParam(':kilometrage', $formKilometrage, PDO::PARAM_INT);
    $stmtAddCar->bindParam(':annee_MES', $formAnnee, PDO::PARAM_INT);
    $stmtAddCar->bindParam(':prix', $formPrix, PDO::PARAM_INT);
    $stmtAddCar->bindParam(':imageP', $formImgP);
    $stmtAddCar->bindParam(':caracteristique', $formCaract);
    $stmtAddCar->bindParam(':options', $formOption);
    if($stmtAddCar->execute()) {

        //Récupération de la voiture qui viens d'etre ajoutée a la bdd
        $stmtCarAdded = $pdo->prepare('SELECT * FROM voitures WHERE marque = :marque AND modele = :modele');
        $stmtCarAdded->bindParam(':marque', $formMarque);
        $stmtCarAdded->bindParam('modele', $formModele);
        if($stmtCarAdded->execute()) {
            $newCar = $stmtCarAdded->fetch(PDO::FETCH_ASSOC);
        }
    }

    //Récupération et insertions des images secondaires en base de donnée
    $formImgS = $_FILES['imageList']['name'];
    $formTmpS = $_FILES['imageList']['tmp_name'];
    //Stocke chaques images récupérée via le formulaire en bdd
    foreach((array)$formImgS as $img) {
        //Récupère le chemin du TMP de l'image et l'ajoute au dossier secondaires
        $tmp = $formTmpS[0];
        move_uploaded_file($tmp, '../voitureImg/Secondaires/'. $img);
        //Enleve le TMP, qui viens d'etre ajouté, du tableau pour qu'a la prochaine image le TMP récupéré soit le bon
        $tmpDeleted = array_shift($formTmpS);
        //Requette SQL pour insérer les images secondaires en base de donnée
        $stmtCarImg = $pdo->prepare('INSERT INTO img_list (car_id, img_link) VALUES (:id, :img_link)');
        $stmtCarImg->bindParam(':id', $newCar['id']);
        $stmtCarImg->bindParam(':img_link', $img);
        $stmtCarImg->execute();
    }
    //URL pour local -> http://localhost/ECF-V.parrot/vehicules.php
    header('location: https://psp.alwaysdata.net/Pages/vehicules.php');
} catch(PDOException $e) {
    echo "Erreur lors de la connexion à la base de donnée". $e->getMessage();
}