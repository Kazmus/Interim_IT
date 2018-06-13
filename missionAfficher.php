<?php 

require 'fonctions/fonctions.php';
session_start();

try {
	$bdd = dbConnexion();

	$table = $bdd->query("SELECT * FROM missions m INNER JOIN clients c ON m.ID_Client=c.ID_Client ORDER BY Date_Debut");

	$tableClient = $bdd->query("SELECT * FROM missions m INNER JOIN clients c ON m.ID_Client=c.ID_Client 
		WHERE m.ID_Client= '" . $_SESSION['id'] . "' ORDER BY Date_Debut");

	$infoCheck = $bdd->query("SELECT ID_Info, E_Mail FROM candidats WHERE ID_Info =  '" . $_SESSION['id'] . "' AND E_Mail = '" . $_SESSION['user'] . "' ");

	$clientCheck = $bdd->query("SELECT ID_Client, E_Mail FROM clients WHERE ID_Client =  '" . $_SESSION['id'] . "' AND E_Mail = '" . $_SESSION['user'] . "' ");

	?><form action="_index.php"><p><input type="submit" value="HomePage"></p></form><?php
	if (isset($_SESSION['user']) && isset($_SESSION['id'])) {
		if ($infoCheck && $infoCheck->rowCount() == 1) {
			while ($data = $table->fetch()) {
				affichageMission($data['ID_Mission'], $data['Type_Mission'], $data['Titre'], $data['Lieu'], $data['Date_Debut'], $data['Date_Fin'], $data['Effectif_Requis'], $data['Description'], $data['Remuneration'], $data['Reservation_Max'], $data['Nom']);

				?><form method="post" action="postuler.php">
					<p><input type="submit" name="submit" value="<?php echo $data['ID_Mission'];?>"> <--Postuler</p>
					</form><?php
			}
		} else if ($clientCheck && $clientCheck->rowCount() == 1) {
			while ($data = $tableClient->fetch()) {
				affichageMission($data['ID_Mission'], $data['Type_Mission'], $data['Titre'], $data['Lieu'], $data['Date_Debut'], $data['Date_Fin'], $data['Effectif_Requis'], $data['Description'], $data['Remuneration'], $data['Reservation_Max'], $data['Nom']);

				$autreTable = $bdd->query("
					SELECT ca.Nom, m.ID_Client
					FROM clients cl 
					INNER JOIN missions m ON cl.ID_Client=m.ID_Client
					INNER JOIN postuler p ON m.ID_Mission=p.ID_Mission
					INNER JOIN candidats ca ON p.ID_Info=ca.ID_Info
					WHERE m.ID_Client= '" . $_SESSION['id'] . "' AND m.ID_Mission = '" . $data['ID_Mission'] . "'
				");

				?><p>Voici les candidats qui ont postuler :  <?php

				while ($dataMission = $autreTable->fetch()) {
					?><p><form method="post" action="engager.php">
						<p><input type="submit" name="submit" value="<?php echo $dataMission['Nom'];?>"></p>
						</form></p><?php
				}
			}
		} 
	} else {
		while ($data = $table->fetch()) {
			affichageMission($data['ID_Mission'], $data['Type_Mission'], $data['Titre'], $data['Lieu'], $data['Date_Debut'], $data['Date_Fin'], $data['Effectif_Requis'], $data['Description'], $data['Remuneration'], $data['Reservation_Max'], $data['Nom']);
		}
	}
} catch (Exception $e) {
	echo $e->getMessage();
	echo $e->getCode();
}
?>