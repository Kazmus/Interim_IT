<?php 

try {   

    $bdd = new PDO('mysql:host=localhost;port=3307;dbname=interim_it;charset=utf8', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $ID_Info = $bdd->query('SELECT ID_Info FROM candidats');
    $idTmp = 1;
    
    while ($data = $ID_Info->fetch()) {
        $idTmp = intval($data['ID_Info']) + 1;
    }
    
    if (isset($_POST['submit'])) {
        $id = (String) $idTmp;
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

    $sql = $bdd->prepare('INSERT INTO candidats (ID_Info, Nom, Prenom, Genre, Date_de_Naissance, Adresse, Numero_Adresse, Code_Postal, Ville, Pays, Tel, Gsm, E_Mail, SiteWeb)
    VALUES (:id, :nom, :prenom, :genre, :naissance, :adresse, :numAdresse, :cp, :ville, :pays, :tel, :gsm, :mail, :siteWeb)');
    $sql->execute(array(
        'id' => $id, 
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