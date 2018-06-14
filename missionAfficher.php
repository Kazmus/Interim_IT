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

		$infoCheck = $bdd->query("SELECT ID_Info, E_Mail FROM candidats WHERE ID_Info=  '" . $_SESSION['id'] . "' AND E_Mail = '" . $_SESSION['user'] . "' ");

		$clientCheck = $bdd->query("SELECT ID_Client, E_Mail FROM clients WHERE ID_Client=  '" . $_SESSION['id'] . "' AND E_Mail = '" . $_SESSION['user'] . "' ");

		$compCheck = $bdd->query("SELECT ID_Comp FROM competences WHERE ID_Info= '" . $_SESSION['id'] . "' ");

		if ($infoCheck && $infoCheck->rowCount() == 1) {
			while ($data = $table->fetch()) {
				$tablePostuler = $bdd->query("SELECT * FROM postuler WHERE ID_Info= '" . $_SESSION['id'] . "' AND ID_Mission='" . $data['ID_Mission'] . "' ");
				$tableEngager = $bdd->query("SELECT ID_Info,ID_Mission FROM engager WHERE ID_Info= '" . $_SESSION['id'] . "' AND ID_Mission='" . $data['ID_Mission'] . "' ");
				$tableVirer = $bdd->query("SELECT ID_Info,ID_Mission FROM virer WHERE ID_Info= '" . $_SESSION['id'] . "' AND ID_Mission='" . $data['ID_Mission'] . "' ");

				affichageMission($data['ID_Mission'], $data['Type_Mission'], $data['Titre'], $data['Lieu'], $data['Date_Debut'], $data['Date_Fin'], $data['Effectif_Requis'], $data['Description'], $data['Remuneration'], $data['Reservation_Max'], $data['Nom']);

				if ($compCheck && $compCheck->rowCount() == 1) {
					if ($tableEngager->rowCount() == 1) {
					?><form method="post" action="clientAfficher.php">
						<input type="hidden" name="hiddenIdClient" value="<?php echo $data['ID_Client'];?>"/>
						<input class="button" name='submit' type="submit" value="Vous etes engager" /> Cliquez pour voir le client en detail
					</form><?php
					} else if ($tableVirer->rowCount() == 1) {
					  ?><input class="button" type="submit" value="Vous n'etes pas retenu"><?php
					} else if ($tablePostuler->rowCount() == 1) {
				  	  ?><input class="button" type="submit" value="DEJA Postuler"><?php
					} else {
					  ?><form method="post" action="postuler.php">
						<input type="hidden" name="hiddenIdMission" value="<?php echo $data['ID_Mission'];?>"/>
						<input class="button" name='submit' type="submit" value="Postuler" />
					</form><?php
					}
				} else {
					 ?><input class="button" type="submit" value="Vous devez ajouter vos competences pour postuler"><?php
				}	
			}
		} else if ($clientCheck && $clientCheck->rowCount() == 1) {
			while ($data = $tableClient->fetch()) {
				affichageMission($data['ID_Mission'], $data['Type_Mission'], $data['Titre'], $data['Lieu'], $data['Date_Debut'], $data['Date_Fin'], $data['Effectif_Requis'], $data['Description'], $data['Remuneration'], $data['Reservation_Max'], NULL);
				$autreTablePostuler = $bdd->query("
					SELECT ca.Nom, ca.Prenom, m.ID_Client, ca.ID_Info, m.ID_Mission
					FROM clients cl 
					INNER JOIN missions m ON cl.ID_Client=m.ID_Client
					INNER JOIN postuler p ON m.ID_Mission=p.ID_Mission
					INNER JOIN candidats ca ON p.ID_Info=ca.ID_Info
					WHERE m.ID_Client= '" . $_SESSION['id'] . "' AND m.ID_Mission = '" . $data['ID_Mission'] . "'
				");

				$autreTableEngager = $bdd->query("
					SELECT ca.Nom, ca.Prenom, m.ID_Client, ca.ID_Info, m.ID_Mission
					FROM engager e 
					INNER JOIN missions m ON e.ID_Mission=m.ID_Mission
					INNER JOIN candidats ca ON e.ID_Info=ca.ID_Info
					WHERE e.ID_Client= '" . $_SESSION['id'] . "' AND e.ID_Mission = '" . $data['ID_Mission'] . "' 
				");

				?><p>Voici les candidats qui ont postuler :  <?php

				while ($dataMission = $autreTablePostuler->fetch()) {
					?><p><form method="post" action="candidatAfficher.php">
							<input type="hidden" name="hiddenIdMission" value="<?php echo $dataMission['ID_Mission'];?>" />
							<input type="hidden" name="hiddenIdCandidat" value="<?php echo $dataMission['ID_Info'];?>" />
							<input class="button" name='submit' type="submit" value="<?php echo $dataMission['Nom'] . " " . $dataMission['Prenom'];?>" />
						</form></p><?php

				}
				?><p>Voici les candidats que vous avez engager :  <?php

				while ($dataMission = $autreTableEngager->fetch()) {
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