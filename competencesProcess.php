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
    }
    
    $table = $bdd->query("SELECT ID_Info, ID_Comp FROM competences WHERE ID_Info = '" . $_SESSION['id'] . "' ");
    if ($table && $table->rowCount() == 1) {
        $data = $table->fetch();
        $idInfo = $data['ID_Info'];
        $deleteIdComp = $bdd->query("SELECT ID_Comp FROM exiger WHERE ID_Comp = '" . $data['ID_Comp'] . "' ");
        while ($deleteIdComp && $delete = $deleteIdComp->fetch()) {
            echo $delete['ID_Comp'] . " ";
            $bdd->query("
            DELETE FROM exiger WHERE ID_Comp= '" . $delete['ID_Comp'] . "'
            ");
        }
        $bdd->query("
            UPDATE competences 
            SET Diplome= '" . $diplome .  "', 
            Certification= '" . $certif . "', 
            Annee_d_experience= '" . $anneeExp . "',
            Permis= '" . $permis . "',
            Langue_Primaire= '" . $primLang . "',
            Langue_Secondaire= '" . $secLang . "'
            WHERE ID_Info= '" . $idInfo . "' ");
        $idComp = $data['ID_Comp'];
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
        $idComp = $bdd->lastInsertId();
    }

    $sql = $bdd->prepare('INSERT INTO exiger (ID_Mission, ID_Comp) VALUES (:idMission, :idComp)');

    $anneeExpMis = checkAnneeExp($_POST['expAnnee']);

    $tableMission = $bdd->query("
        SELECT ID_Mission
        FROM missions 
        WHERE Annee_d_experience = '" . $anneeExpMis . "' 
        AND Permis= '" . $permis . "' 
        AND (Langue= '" . $primLang . "' OR Langue= '" . $secLang . "') "
    );

    
    while ($data = $tableMission->fetch()) {
        $idMission = $data['ID_Mission'];


        $sql->execute(array(
            'idMission' => $idMission, 
            'idComp' => $idComp

        ));
    } 

    echo "<h2>Competence ajouter avec succes !</h2>";
    ?><meta http-equiv="refresh" content="3; URL=pageCandidat.php"> <h2>Retour dans 3 secondes</h2> <?php

} catch(Exception $e) {

    echo $e->getMessage();
    echo $e->getCode();

}
?>