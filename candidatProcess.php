<?php 

require 'fonctions/fonctions.php';

try {   

    $bdd = dbConnexion();
    
    if (isset($_POST['submit'])) {
        $nom = $_POST['nomCandidat'];
        $prenom = $_POST['prenomCandidat'];
        $genre = $_POST['radio'];
        $naissance = $_POST['dateNaissance'];
        $adresse = $_POST['rueCandidat'];
        $numAdresse = $_POST['numeroBatimentCandidat'];
        $cp = $_POST['cpCandidat'];
        $ville = $_POST['villeCandidat'];
        $pays = $_POST['paysCandidat'];
        $tel = $_POST['telCandidat'];
        $gsm = $_POST['gsmCandidat'];
        $mail = $_POST['emailCandidat'];
        $siteWeb = $_POST['siteCandidat'];
    }
    
    echo "value = " . $genre . "<br />";
    echo "type = " . gettype ($genre) . "<br />";

    $sql = $bdd->prepare('INSERT INTO candidats (Nom, Prenom, Genre, Date_de_Naissance, Adresse, Numero_Adresse, Code_Postal, Ville, Pays, Tel, Gsm, E_Mail, SiteWeb)
    VALUES (:nom, :prenom, :genre, :naissance, :adresse, :numAdresse, :cp, :ville, :pays, :tel, :gsm, :mail, :siteWeb)');
    $sql->execute(array(
        'nom' => $nom,
        'prenom' => $prenom,
        'genre' => $genre,
        'naissance' => $naissance,
        'adresse' => $adresse,
        'numAdresse' => $numAdresse,
        'cp' => $cp,
        'ville' => $ville,
        'pays' => $pays,
        'tel' => $tel,
        'gsm' => $gsm,
        'mail' => $mail,
        'siteWeb' => $siteWeb
        ));

    echo "New record created succesfully";
}

catch(Exception $e) {

    echo $e->getMessage();
    echo $e->getCode();

}
?>
<form action="_index.php" > <input type="submit" name="submit" value="HomePage"></form>