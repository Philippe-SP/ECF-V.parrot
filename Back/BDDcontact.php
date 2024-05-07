<?php
$dsn = 'mysql:host=mysql-psp.alwaysdata.net;dbname=psp_v-parrot';
$username = 'psp';
$password = 'PSP2001/';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Insertion des messages envoyé depuis le forulaire de contact dans la bdd
    $formPrenom = htmlspecialchars($_POST['prenom']);
    $formNom = htmlspecialchars($_POST['nom']);
    $formEmail = $_POST['email'];
    $formTel = $_POST['tel'];
    $formMessage = htmlspecialchars($_POST['message']);
    $formSujet = $_POST['carName'];

    $stmtNewMessage = $pdo->prepare('INSERT INTO messages (prenom, nom, email, tel, message, messageSee, sujet) VALUES (:prenom, :nom, :email, :tel, :message, 0, :sujet)');
    $stmtNewMessage->bindParam(':prenom', $formPrenom);
    $stmtNewMessage->bindParam(':nom', $formNom);
    $stmtNewMessage->bindParam(':email', $formEmail);
    $stmtNewMessage->bindParam(':tel', $formTel);
    $stmtNewMessage->bindParam(':message', $formMessage);
    $stmtNewMessage->bindParam(':sujet', $formSujet);
    if($stmtNewMessage->execute()) {
        //Renvois a la page de contact avec une variable via methode GET pour afficher un message
        //URL pour local -> http://localhost/ECF-V.parrot/contact.php?messageSend=1
        header('location: https://psp.alwaysdata.net/Pages/contact.php?messageSend=1');
    }
} catch(PDOException $e) {
    echo "Erreur lors de la connexion à la base de donnée". $e->getMessage();
}