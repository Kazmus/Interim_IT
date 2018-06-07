<?php 

require 'fonctions/fonctions.php';

try {   

    $bdd = dbConnexion();
    
    if (isset($_POST['submit'])) {
        $nom = $_POST['nomClient'];
        $prenom = $_POST['prenomClient'];
        $type = $_POST['radio'];
        $adresse = $_POST['rueClient'];
        $numAdresse = $_POST['numeroBatiment'];
        $cp = $_POST['cpClient'];
        $ville = $_POST['villeClient'];
        $pays = $_POST['pays'];
        $tel = $_POST['telClient'];
        $gsm = $_POST['gsmClient'];
        $mail = $_POST['emailClient'];
        $siteWeb = $_POST['siteClient'];
    }
    

    echo "value = " . $nom . "<br />";
    echo "type = " . gettype ($nom) . "<br />";

    $sql = $bdd->prepare('INSERT INTO clients (Nom, Prenom, Type, Adresse, Numero_Adresse, Code_Postal, Ville, Pays, Tel, Gsm, E_Mail, SiteWeb)
    VALUES (:nom, :prenom, :type, :adresse, :numAdresse, :cp, :ville, :pays, :tel, :gsm, :mail, :siteWeb)');
    $sql->execute(array(
        'nom' => $nom,
        'prenom' => $prenom,
        'type' => $type,
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