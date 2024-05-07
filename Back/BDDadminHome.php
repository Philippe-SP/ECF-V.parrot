<?php
$dsn = 'mysql:host=mysql-psp.alwaysdata.net;dbname=psp_v-parrot';
$username = 'psp';
$password = 'PSP2001/';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Récupération du contenu actuel du contenu de la page d'accueil
    $stmtActualHome = $pdo->prepare('SELECT * FROM accueil');
    $stmtActualHome->execute();
    $actualContent = $stmtActualHome->fetch(PDO::FETCH_ASSOC);

    //Récupération des données du formulaire si les données ont bien été modifiée
    if(empty($_POST['presentation'])) {
        $formPresentation = $actualContent['presentation'];
    } else {
        $formPresentation = $_POST['presentation'];
    };

    if(empty($_POST['carroserie'])) {
        $formCarroserie = $actualContent['carroserie'];
    } else {
        $formCarroserie = $_POST['carroserie'];
    };

    if(empty($_POST['mecanique'])) {
        $formMecanique = $actualContent['mecanique'];
    } else {
        $formMecanique = $_POST['mecanique'];
    };

    if(empty($_POST['vente'])) {
        $formVente = $actualContent['vente'];
    } else {
        $formVente = $_POST['vente'];
    };

    if(empty($_POST['horraires'])) {
        $formHorraires = $actualContent['horraires'];
    } else {
        $formHorraires = $_POST['horraires'];
    };

    //Modification de la base de donnée en fonction du formulaire
    $stmtNewHome = $pdo->prepare('UPDATE accueil SET presentation = :presentation, carroserie = :carroserie, mecanique = :mecanique, 
    vente = :vente, horraires = :horraires WHERE id = 1');
    $stmtNewHome->bindParam(':presentation', $formPresentation);
    $stmtNewHome->bindParam(':carroserie', $formCarroserie);
    $stmtNewHome->bindParam(':mecanique', $formMecanique);
    $stmtNewHome->bindParam(':vente', $formVente);
    $stmtNewHome->bindParam(':horraires', $formHorraires);
    if($stmtNewHome->execute()) {
        //URL pour local -> http://localhost/ECF-V.parrot/index.php
        header('location: http://psp.alwaysdata.net/index.php');
    }
} catch(PDOException $e) {
    echo "Erreur lors de la connexion à la base de donnée". $e->getMessage();
}

// Tous les contenus de base de la page d'accueil si vous voulez modifier puis y remettre pour tester le fonctionnement

//Presentation
/*
Notre engagement envers la satisfaction du client se reflète dans chaque aspect de nos services. Que vous ayez besoin d'une simple réparation, d'une restauration complète, ou que vous soyez à la recherche de votre prochaine voiture d'occasion, notre garage est l'endroit où la qualité et la passion pour l'automobile se rencontrent. Venez nous rendre visite et découvrez comment nous pouvons prendre soin de votre véhicule, de la carrosserie à la mécanique, jusqu'à la route devant vous.
*/

//Carroserie
/* 
Notre équipe experte en carrosserie est dédiée à redonner à votre véhicule son aspect d'origine. Que ce soit pour des réparations suite à un accident, des dommages mineurs ou des travaux de restauration, nous utilisons des techniques avancées pour garantir une finition impeccable.
*/

//Mecanique
/*
Au-delà de l'esthétique, notre équipe de mécaniciens chevronnés assure le bon fonctionnement de votre véhicule. Des réparations mécaniques de routine aux diagnostics complexes, nous utilisons des équipements de pointe pour assurer la fiabilité et la performance de votre voiture.
*/

//Vente
/*
Si vous êtes à la recherche d'un nouveau compagnon de route, explorez notre sélection de véhicules d'occasion soigneusement inspectés et entretenus. Nous proposons des options variées pour répondre à vos besoins et préférences, chacune étant prête à offrir des kilomètres de plaisir de conduite en toute confiance.
*/

//Horraires
/*
Lun: 8h45-12h/14h-18h, Mar: 8h45-12h/14h-18h, Mer: 8h45-12h/14h-18h, Jeu: 8h45-12h/14h-18h, Ven: 8h45-12h/14h-18h, Sam: 8h45-12h, Dim: Fermé
*/