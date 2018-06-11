<?php 

require 'fonctions/fonctions.php';
session_start();

try {   

    $bdd = dbConnexion();
    
    if (isset($_POST['submit'])) {
        $diplome = $_POST['diplome'];
        $certif = $_POST['certif'];
        $anneeExp = $_POST['expAnnee'];
        $permis = $_POST['radio'];
        $primLang = $_POST['primaireLang'];
        $secLang = $_POST['secondLang'];
        $idCandidat = $_SESSION['id'];
        $dateDebut = $_POST['dateDebut'];

        switch ($_POST['remuneration']) {

            case 'entre 0 et 999':
            $remunerationMin = 1;
            $remunerationMax = 2;
            break;

            case 'entre 1000 et 1999':
            $remunerationMin = 3;
            $remunerationMax = 5;
            break;

            case 'entre 2000 et 2999':
            $remunerationMin = 6;
            $remunerationMax = 10;
            break;

            case 'entre 3000 et 3999':
            $remunerationMin = 11;
            $remunerationMax = 20;
            break;

            case 'entre 4000 et 4999':
            $remunerationMin = 21;
            $remunerationMax = 30;
            break;

            case 'entre 5000 et 10000':
            $remunerationMin = 5000;
            $remunerationMax = 10000;
            break;
        }
    }

    $table = $bdd->query("SELECT ID_Info FROM competences WHERE ID_Info = '" . $_SESSION['id'] . "' ");
    if ($table && $table->rowCount() == 1) {
        $data = $table->fetch();
        $idInfo = $data['ID_Info'];
        $bdd->query("
            UPDATE competences 
            SET Diplome= '" . $diplome .  "', 
            Certification= '" . $certif . "', 
            Annee_d_experience= '" . $anneeExp . "',
            Permis= '" . $permis . "',
            Langue_Primaire= '" . $primLang . "',
            Langue_Secondaire= '" . $secLang . "'
            WHERE ID_Info= '" . $idInfo . "' ");
    } else {

        $sql = $bdd->prepare('INSERT INTO competences (Diplome, Certification, Annee_d_experience, Permis, Langue_Primaire, Langue_Secondaire, ID_Info)
            VALUES (:diplome, :certif, :anneeExp, :permis, :primLang, :secLang, :idCandidat)');
        $sql->execute(array(
            'diplome' => $diplome,
            'certif' => $certif,
            'anneeExp' => $anneeExp,
            'permis' => $permis,
            'primLang' => $primLang,
            'secLang' => $secLang,
            'idCandidat' =>$idCandidat
        ));
    }
    echo "New record created succesfully";
    ?><meta http-equiv="refresh" content="4; URL=pageCandidat.php"> <h2>Retour dans 4 secondes</h2> <?php

    /*$sql = $bdd->prepare('INSERT INTO exiger (ID_Mission, ID_Comp) VALUES (:idMission, :idComp)');
    $idComp = $bdd->lastInsertId();

    $table = $bdd->query("SELECT ID_Mission FROM missions 
        WHERE dateDebut>='" . $dateDebut . "' AND (Remuneration>='" . $remunerationMin . "' AND Remuneration<='" . $remunerationMax . "' ");

    while ($data = $table->fetch()) {
        $idMission = $data['ID_Mission'];
        $sql->execute(array(
            'idMission' => $idMission,
            'idComp' => $idComp
        ));  
    }*/
} catch(Exception $e) {

    echo $e->getMessage();
    echo $e->getCode();

}
?>