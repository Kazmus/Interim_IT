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
    
    echo "value = " . $idCandidat . "<br />";
    echo "type = " . gettype ($idCandidat) . "<br />";

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

    echo "New record created succesfully";
    ?><meta http-equiv="refresh" content="4; URL=pageCandidat.php"> <h2>Retour dans 4 secondes</h2> <?php
}

catch(Exception $e) {

    echo $e->getMessage();
    echo $e->getCode();

}
?>