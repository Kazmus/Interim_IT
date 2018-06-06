<?php 

try {   

    $bdd = new PDO('mysql:host=localhost;port=3307;dbname=interim_it;charset=utf8', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $ID_Client = $bdd->query('SELECT ID_Client FROM clients');
    $idTmp = 1;
    
    while ($data = $ID_Client->fetch()) {
        $idTmp = intval($data['ID_Client']) + 1;
    }
    
    if (isset($_POST['submit'])) {
        $id = (String) $idTmp;
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
    

    echo "value = " . $id . "<br />";
    echo "type = " . gettype ($id) . "<br />";

    $sql = $bdd->prepare('INSERT INTO clients (ID_Client, Nom, Prenom, Type, Adresse, Numero_Adresse, Code_Postal, Ville, Pays, Tel, Gsm, E_Mail, SiteWeb)
    VALUES (:id, :nom, :prenom, :type, :adresse, :numAdresse, :cp, :ville, :pays, :tel, :gsm, :mail, :siteWeb)');
    $sql->execute(array(
        'id' => $id, 
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