<?php
$dsn = 'mysql:host=mysql-psp.alwaysdata.net;dbname=psp_v-parrot';
$username = 'psp';
$password = 'PSP2001/';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //Récupération des données du formulaire
    $formNom = $_POST['nom'];
    $formPrenom = $_POST['prenom'];
    $formEmail = $_POST['email'];
    $formPassword = $_POST['password'];
    //Hash du mot de passe
    $hashedPassword = password_hash($formPassword, PASSWORD_DEFAULT);
    //Requette SQL
    $stmtInscription = $pdo->prepare('INSERT INTO users(idUser, nom, prenom, email, password) VALUES (UUID(), :nom, :prenom, :email, :password)');
    $stmtInscription->bindParam(':nom', $formNom);
    $stmtInscription->bindParam(':prenom', $formPrenom);
    $stmtInscription->bindParam(':email', $formEmail);
    $stmtInscription->bindParam(':password', $hashedPassword);
    if($stmtInscription->execute()) {
        //Recherche de l'utilisateur créé
        $stmtNewUser = $pdo->prepare('SELECT * FROM users WHERE email = :email');
        $stmtNewUser->bindParam(':email', $formEmail);
        $stmtNewUser->execute();
        $newUser = $stmtNewUser->fetch(PDO::FETCH_ASSOC);
        //Affectation du role de l'utilisateur
        $stmtRole = $pdo->prepare('INSERT INTO roles_users(user_id, role_id) VALUES (:id, 2)');//2 étant le role d'employé
        $stmtRole->bindParam(':id', $newUser['idUser']);
        $stmtRole->execute();
        header('location: http://localhost/ECF-V.parrot/admin.php?success=true');
    } else {
        echo "Erreur lors de l'inscription de l'utilisateur";
    }
}catch(PDOException $e) {
    echo "Erreur lors de la connection à la bse de donnée". $e->getMessage();
}
?>