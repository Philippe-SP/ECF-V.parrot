<?php

$dsn = 'mysql:host=mysql-psp.alwaysdata.net;dbname=psp_v-parrot';
$username = 'psp';
$password = 'PSP2001/';

$formImg = $_FILES['image']['name'];
$tmpImg = $_FILES['image']['tmp_name'];
//stockage de l'image
move_uploaded_file($tmpImg, "./voitureImg/". $formImg);
var_dump($formImg);


/*try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //Récupération des données du formulaire
    
    $formMarque = $_POST['marque'];
    $formModele = $_POST['modele'];
    $formKilometrage = $_POST['kilometrage'];
    $formDate = $_POST['anne-MES'];
    $formCaracteristique = $_POST['caracteristique'];
    $formPrix = $_POST['prix'];
    $formOptions = $_POST['options'];
} catch(PDOException $e) {
    echo "Erreur lors de la connexion à la base de donnée". $e->getMessage();
}*/