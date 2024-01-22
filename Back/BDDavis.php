<?php
$dsn = 'mysql:host=mysql-psp.alwaysdata.net;dbname=psp_v-parrot';
$username = 'psp';
$password = 'PSP2001/';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Insertion de l'avis dans la bdd
    $formNom = $_POST['nom'];
    $formNote = $_POST['note'];
    $formCom = $_POST['commentaire'];

    $stmtAvis = $pdo->prepare('INSERT INTO avis (nom, note, commentaire, approved) VALUES (:nom, :note, :commentaire, 0)');
    $stmtAvis->bindParam(':nom', $formNom);
    $stmtAvis->bindParam(':note', $formNote);
    $stmtAvis->bindParam(':commentaire', $formCom);
    if($stmtAvis->execute()) {
        header('location: http://localhost/ECF-V.parrot/index.php?comSend=1');
    }
} catch(PDOException $e) {
    echo "Erreur lors de la connexion à la base de donnée". $e->getMessage();
}