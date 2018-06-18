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
        $pays = $_POST['pays'];
        $tel = $_POST['telCandidat'];
        $gsm = $_POST['gsmCandidat'];
        $mail = $_POST['emailCandidat'];
        $siteWeb = $_POST['siteCandidat'];
        $password = $_POST['password'];
    }

    $table = $bdd->query("SELECT E_Mail FROM candidats WHERE E_Mail='" . $mail . "' ");

    if ($table && $table->rowCount() == 1) {
        header("Location:mailExistant.php");
    } else {
        $sql = $bdd->prepare('INSERT INTO candidats (Nom, Prenom, Genre, Date_de_Naissance, Adresse, Numero_Adresse, Code_Postal, Ville, Pays, Tel, Gsm, E_Mail, SiteWeb, Mot_de_Passe)
        VALUES (:nom, :prenom, :genre, :naissance, :adresse, :numAdresse, :cp, :ville, :pays, :tel, :gsm, :mail, :siteWeb, :password)');
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