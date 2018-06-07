<?php 

require 'fonctions/fonctions.php';

try {   

    $bdd = dbConnexion();
    $table = $bdd->query('SELECT ID_Client FROM clients'); 
    $data = $table->fetch();

    if (isset($_POST['submit'])) {
        $type = $_POST['radio'];
        $lieu = $_POST['lieu'];
        $dateDebut = $_POST['dateDebut'];
        $dateFin = $_POST['dateFin'];
        $effectif = $_POST['effectif'];
        $description = $_POST['description'];
        $remuneration = $_POST['remuneration'];
        $idCli = $data['ID_Client'];
    }
    
    echo "value = " . $idCli . "<br />";
    echo "type = " . gettype ($idCli) . "<br />";

    $sql = $bdd->prepare('INSERT INTO missions (Type, Lieu, Date_Debut, Date_Fin, Effectif_Requis, Description, Remuneration, ID_Client)
    VALUES (:type, :lieu, :dateDebut, :dateFin, :effectif, :description, :remuneration, :idCli)');
    $sql->execute(array(
        'type' => $type,
        'lieu' => $lieu,
        'dateDebut' => $dateDebut,
        'dateFin' => $dateFin,
        'effectif' => $effectif,
        'description' => $description,
        'remuneration' => $remuneration,
        'idCli' => $idCli
        ));

    echo "New record created succesfully";
}

catch(Exception $e) {

    echo $e->getMessage();
    echo $e->getCode();

}
?>
<form action="_index.php" > <input type="submit" name="submit" value="HomePage"></form>