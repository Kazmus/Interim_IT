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
        $password= $_POST['password'];
    }

    $table = $bdd->query("SELECT E_Mail FROM clients WHERE E_Mail='" . $mail . "' ");

    if ($table && $table->rowCount() == 1) {
        header("Location:mailExistant.php");
    } else {
        $sql = $bdd->prepare('INSERT INTO clients (Nom, Prenom, Type, Adresse, Numero_Adresse, Code_Postal, Ville, Pays, Tel, Gsm, E_Mail, SiteWeb, Mot_de_Passe)
        VALUES (:nom, :prenom, :type, :adresse, :numAdresse, :cp, :ville, :pays, :tel, :gsm, :mail, :siteWeb, :password)');
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
            'siteWeb' => $siteWeb,
            'password' => $password
            ));
        ?>
        <section id="redirection">
            <div class="element2">
                <h2>Inscription réussie !</h2>
                <meta http-equiv="refresh" content="3; URL=_index.php"> <h2>Retour dans 3 secondes</h2> 
            </div>
        </section><?php
    }
}

catch(Exception $e) {

    echo $e->getMessage();
    echo $e->getCode();

}
?>