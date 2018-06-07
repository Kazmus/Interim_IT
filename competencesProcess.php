<?php 

require 'fonctions/fonctions.php';

try {   

    $bdd = dbConnexion();
    
    if (isset($_POST['submit'])) {
        $diplome = $_POST['diplome'];
        $certif = $_POST['certif'];
        $anneeExp = $_POST['expAnnee'];
        $permis = $_POST['radio'];
        $primLang = $_POST['primaireLang'];
        $secLang = $_POST['secondlang'];
    }
    

    echo "value = " . $diplome . "<br />";
    echo "type = " . gettype ($diplome) . "<br />";

    $sql = $bdd->prepare('INSERT INTO competences (Diplome, Certification, Annee_d_experience, Permis, Langue_Primaire, Langue_Secondaire)
    VALUES (:diplome, :certif, :anneeExp, :permis, :primLang, :secLang)');
    $sql->execute(array(
        'diplome' => $diplome,
        'certif' => $certif,
        'anneeExp' => $anneeExp,
        'permis' => $permis,
        'primLang' => $primLang,
        'secLang' => $secLang
        ));

    echo "New record created succesfully";
}

catch(Exception $e) {

    echo $e->getMessage();
    echo $e->getCode();

}
?>
<form action="_index.php" > <input type="submit" name="submit" value="HomePage"></form>