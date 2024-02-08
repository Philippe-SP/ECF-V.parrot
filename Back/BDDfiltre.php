<?php

$dsn = 'mysql:host=mysql-psp.alwaysdata.net;dbname=psp_v-parrot';
$username = 'psp';
$password = 'PSP2001/';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Récupération des véhicules avec utilisation du filtre depuis la base de donnée
    if(isset($_POST['km_min'])) {
        settype($_POST['km_min'], 'integer');
        settype($_POST['km_max'], 'integer');
        settype($_POST['annee_min'], 'integer');
        settype($_POST['annee_max'], 'integer');
        settype($_POST['prix_min'], 'integer');
        settype($_POST['prix_max'], 'integer');
        $stmtCarFiltred = $pdo->prepare('SELECT * FROM voitures WHERE 
        (kilometrage BETWEEN :kmMin AND :kmMax) AND 
        (annee_MES BETWEEN :anneeMin AND :anneeMax) AND
        (prix BETWEEN :prixMin AND :prixMax)');
        $stmtCarFiltred->bindParam(':kmMin', $_POST['km_min'], PDO::PARAM_INT);
        $stmtCarFiltred->bindParam(':kmMax', $_POST['km_max'], PDO::PARAM_INT);
        $stmtCarFiltred->bindParam(':anneeMin', $_POST['annee_min'], PDO::PARAM_INT);
        $stmtCarFiltred->bindParam(':anneeMax', $_POST['annee_max'], PDO::PARAM_INT);
        $stmtCarFiltred->bindParam(':prixMin', $_POST['prix_min'], PDO::PARAM_INT);
        $stmtCarFiltred->bindParam(':prixMax', $_POST['prix_max'], PDO::PARAM_INT);
        if($stmtCarFiltred->execute()) {
            $Voitures = $stmtCarFiltred->fetchAll(PDO::FETCH_ASSOC);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($Voitures);
        }
    }
} catch(PDOException $e) {
    echo "Erreur lors de la connexion à la base de donnée". $e->getMessage();
    header('Content-Type: application/json');
    echo json_encode(["error" => $e->getMessage()]);
}