<?php 
require 'fonctions/fonctions.php';

try {

	$bdd = dbConnexion();
	$table = $bdd->query("
		SELECT *
		FROM candidats c 
		INNER JOIN postuler p ON c.ID_Info=p.ID_Info 
		INNER JOIN missions m ON p.ID_Mission=m.ID_Mission");

	while ($data = $table->fetch()) {
		echo $data['Nom'] . $data['Titre'];
	}
	

} catch (Exception $e) {
	echo $e->getMessage();
    echo $e->getCode();
}

?>