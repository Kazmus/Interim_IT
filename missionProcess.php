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
        $anneeExp = $_POST['anneeExp'];

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
            $anneeExpMax = 0;
            break;
        }
    }

    $sql = $bdd->prepare('INSERT INTO missions (Type_Mission, Titre, Lieu, Date_Debut, Date_Fin, Effectif_Requis, Description, Remuneration, Reservation_Max, Annee_d_experience, Permis, Langue, ID_Client)
        VALUES (:type, :titre, :lieu, :dateDebut, :dateFin, :effectif, :description, :remuneration, :reservMax, :anneeExp, :permis, :langue, :idCli)');
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
        'anneeExp' => $anneeExp,
        'permis' => $permis,
        'langue' => $langue,
        'idCli' => $idCli
    ));

    $sql = $bdd->prepare('INSERT INTO exiger (ID_Mission, ID_Comp) VALUES (:idMission, :idComp)');
    $idMission = $bdd->lastInsertId();

    if ($permis == 'Oui') {

        $table = $bdd->query("
            SELECT ID_Comp
            FROM competences 
            WHERE (Annee_d_experience>='" . $anneeExpMin . "' AND Annee_d_experience<= '" . $anneeExpMax . "')  
            AND (Langue_Primaire='" . $langue . "' OR Langue_Secondaire='" . $langue . "') "
        );

    } else {
        $table = $bdd->query("
            SELECT ID_Comp
            FROM competences 
            WHERE (Annee_d_experience>='" . $anneeExpMin . "' AND Annee_d_experience<= '" . $anneeExpMax . "') 
            AND Permis='" . $permis . "' 
            AND (Langue_Primaire='" . $langue . "' OR Langue_Secondaire='" . $langue . "') "
        );
    }

    while ($data = $table->fetch()) {
        $idComp = $data['ID_Comp'];
        $sql->execute(array(
            'idMission' => $idMission, 
            'idComp' => $idComp

        ));
    }   
?>
<section id="redirection">
    <div class="element2">
        <h2>Mission creer avec success !</h2>
?><meta http-equiv="refresh" content="3; URL=_index.php"> <h2>Retour dans 3 secondes</h2> <?php

} catch(Exception $e) {
    echo $e->getMessage();
    echo $e->getCode();
}
?>