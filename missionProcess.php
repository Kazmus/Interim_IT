<?php 

require 'fonctions/fonctions.php';
session_start();

try {   

    $bdd = dbConnexion();

    if (isset($_POST['submit'])) {
        $type = $_POST['type'];
        $titre = $_POST['titre'];
        $lieu = $_POST['lieu'];
        $dateDebut = $_POST['dateDebut'];
        $dateFin = $_POST['dateFin'];
        $effectif = $_POST['effectif'];
        $description = $_POST['description'];
        $remuneration = $_POST['remuneration'];
        $reservMax = $_POST['reservMax'];
        $idCli = $_SESSION['id'];
        $permis = $_POST['permis'];
        $langue = $_POST['langue'];

        switch ($_POST['anneeExp']) {

            case '1 ou 2 ans':
            $anneeExpMin = 1;
            $anneeExpMax = 2;
            break;

            case 'entre 3 et 5 ans':
            $anneeExpMin = 3;
            $anneeExpMax = 5;
            break;

            case 'entre 6 et 10 ans':
            $anneeExpMin = 6;
            $anneeExpMax = 10;
            break;

            case 'entre 11 et 20 ans':
            $anneeExpMin = 11;
            $anneeExpMax = 20;
            break;

            case 'entre 21 et 30 ans':
            $anneeExpMin = 21;
            $anneeExpMax = 30;
            break;

            default:
            $anneeExpMin = 0;
            break;
        }
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

    $sql = $bdd->prepare('INSERT INTO exiger (ID_Mission, ID_Comp) VALUES (:idMission, :idComp)');
    $idMission = $bdd->lastInsertId();

    if ($anneeExpMin == 0) {

        $anneeExp = 0;

        $table = $bdd->query("
            SELECT ID_Comp
            FROM competences 
            WHERE Annee_d_experience='" . $anneeExp . "' AND Permis='" . $permis . "' AND (Langue_Primaire='" . $langue . "' OR Langue_Secondaire='" . $langue . "') "
        );

        while ($data = $table->fetch()) {
            $idComp = $data['ID_Comp'];
            $sql->execute(array(
                'idMission' => $idMission, 
                'idComp' => $idComp
                
            ));

        }
    } else {

        for ($i=$anneeExpMin; $i <= $anneeExpMax; $i++) { 

            $anneeExp = $i;

            $table = $bdd->query("
                SELECT ID_Comp
                FROM competences
                WHERE Annee_d_experience='" . $anneeExp . "' AND Permis='" . $permis . "' AND (Langue_Primaire='" . $langue . "' OR Langue_Secondaire='" . $langue . "') "
            );

            while ($data = $table->fetch()) {
                $idComp = $data['ID_Comp'];
                $sql->execute(array(
                    'idMission' => $idMission, 
                    'idComp' => $idComp
                ));
            }
        }
    }
} catch(Exception $e) {

    echo $e->getMessage();
    echo $e->getCode();

}
?>