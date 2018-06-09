<?php 

require 'fonctions/fonctions.php';
session_start();

try {   

    $bdd = dbConnexion();

    if (isset($_POST['submit'])) {
        $type = $_POST['radio'];
        $titre = $_POST['titre'];
        $lieu = $_POST['lieu'];
        $dateDebut = $_POST['dateDebut'];
        $dateFin = $_POST['dateFin'];
        $effectif = $_POST['effectif'];
        $description = $_POST['description'];
        $remuneration = $_POST['remuneration'];
        $reservMax = $_POST['reservMax'];
        $idCli = $_SESSION['id'];
    }
    
    echo "value = " . $idCli . "<br />";
    echo "type = " . gettype ($idCli) . "<br />";

    $sql = $bdd->prepare('INSERT INTO missions (Type_Mission, Titre, Lieu, Date_Debut, Date_Fin, Effectif_Requis, Description, Remuneration, Reservation_Max, ID_Client)
    VALUES (:type, :titre, :lieu, :dateDebut, :dateFin, :effectif, :description, :remuneration, :reservMax, :idCli)');
    $sql->execute(array(
        'type' => $type,
        'titre' => $titre,
        'lieu' => $lieu,
        'dateDebut' => $dateDebut,
        'dateFin' => $dateFin,
        'effectif' => $effectif,
        'description' => $description,
        'remuneration' => $remuneration,
        'reservMax' => $reservMax,
        'idCli' => $idCli
        ));

    echo "<h2>New record created succesfully</h2>";
    ?><meta http-equiv="refresh" content="4; URL=pageClient.php"> <h2>Retour dans 4 secondes</h2> <?php
}

catch(Exception $e) {

    echo $e->getMessage();
    echo $e->getCode();

}
?>