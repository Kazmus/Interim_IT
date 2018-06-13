<?php 

require 'fonctions/fonctions.php';
session_start();

try {
	$bdd = dbConnexion();

	$table = $bdd->query("SELECT * FROM missions m INNER JOIN clients c ON m.ID_Client=c.ID_Client ORDER BY Date_Debut");

	?><form action="_index.php"><p><input type="submit" value="HomePage"></p></form><?php
	if (isset($_SESSION['user']) && isset($_SESSION['id'])) {

		$tableClient = $bdd->query("SELECT * FROM missions m INNER JOIN clients c ON m.ID_Client=c.ID_Client 
		WHERE m.ID_Client= '" . $_SESSION['id'] . "' ORDER BY Date_Debut");

		$infoCheck = $bdd->query("SELECT ID_Info, E_Mail FROM candidats WHERE ID_Info =  '" . $_SESSION['id'] . "' AND E_Mail = '" . $_SESSION['user'] . "' ");

		$clientCheck = $bdd->query("SELECT ID_Client, E_Mail FROM clients WHERE ID_Client =  '" . $_SESSION['id'] . "' AND E_Mail = '" . $_SESSION['user'] . "' ");

		if ($infoCheck && $infoCheck->rowCount() == 1) {
			while ($data = $table->fetch()) {
				affichageMission($data['ID_Mission'], $data['Type_Mission'], $data['Titre'], $data['Lieu'], $data['Date_Debut'], $data['Date_Fin'], $data['Effectif_Requis'], $data['Description'], $data['Remuneration'], $data['Reservation_Max'], $data['Nom']);

				?><form method="post" action="postuler.php">
					<input type="hidden" name="hiddenIdMission" value="<?php echo $data['ID_Mission'];?>"/>
					<input class="button" name='submit' type="submit" value="Postuler" />
				</form><?php
			}
		} else if ($clientCheck && $clientCheck->rowCount() == 1) {
			while ($data = $tableClient->fetch()) {
				affichageMission($data['ID_Mission'], $data['Type_Mission'], $data['Titre'], $data['Lieu'], $data['Date_Debut'], $data['Date_Fin'], $data['Effectif_Requis'], $data['Description'], $data['Remuneration'], $data['Reservation_Max'], NULL);

				$autreTable = $bdd->query("
					SELECT ca.Nom, ca.Prenom, m.ID_Client, ca.ID_Info, m.ID_Mission
					FROM clients cl 
					INNER JOIN missions m ON cl.ID_Client=m.ID_Client
					INNER JOIN postuler p ON m.ID_Mission=p.ID_Mission
					INNER JOIN candidats ca ON p.ID_Info=ca.ID_Info
					WHERE m.ID_Client= '" . $_SESSION['id'] . "' AND m.ID_Mission = '" . $data['ID_Mission'] . "'
				");

				?><p>Voici les candidats qui ont postuler :  <?php

				while ($dataMission = $autreTable->fetch()) {
					?><p><form method="post" action="candidatAfficher.php">
							<input type="hidden" name="hiddenIdMission" value="<?php echo $dataMission['ID_Mission'];?>" />
							<input type="hidden" name="hiddenIdCandidat" value="<?php echo $dataMission['ID_Info'];?>" />
							<input class="button" name='submit' type="submit" value="<?php echo $dataMission['Nom'] . " " . $dataMission['Prenom'];?>" />
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