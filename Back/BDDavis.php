<?php
require_once "../logs.php";

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Insertion de l'avis dans la bdd
    $formNom = htmlspecialchars($_POST['nom']);
    $formNote = htmlspecialchars($_POST['note']);
    $formCom = htmlspecialchars($_POST['commentaire']);

    $stmtAvis = $pdo->prepare('INSERT INTO avis (nom, note, commentaire, approved) VALUES (:nom, :note, :commentaire, 0)');
    $stmtAvis->bindParam(':nom', $formNom);
    $stmtAvis->bindParam(':note', $formNote);
    $stmtAvis->bindParam(':commentaire', $formCom);
    if($stmtAvis->execute()) {
        //URL pour local -> http://localhost/ECF-V.parrot/index.php?comSend=1
        header('location: http://psp.alwaysdata.net/index.php?comSend=1');
    }
} catch(PDOException $e) {
    echo "Erreur lors de la connexion à la base de donnée". $e->getMessage();
}