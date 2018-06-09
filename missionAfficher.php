<?php 

require 'fonctions/fonctions.php';
session_start();

try {
	$bdd = dbConnexion();

	$table = $bdd->query('SELECT * FROM missions INNER JOIN clients ON missions.ID_Client=clients.ID_Client');

	?><form action="_index.php"><p><input type="submit" value="HomePage"></p></form><?php

	while ($data = $table->fetch()) {
		?>
		<p>
			<?php echo "Mission numero : " . $data['ID_Mission'];?><br />
			<?php echo "Type de mission : " . $data['Type_Mission'];?><br />
			<?php echo "Titre : " . $data['Titre'];?><br />
			<?php echo "Lieu : " . $data['Lieu'];?><br />
			<?php echo "Date de debut : " . $data['Date_Debut'];?><br />
			<?php echo "Date de fin : " . $data['Date_Fin'];?><br />
			<?php echo "Effectif requis : " . $data['Effectif_Requis'];?><br />
			<?php echo "Description : " . $data['Description'];?><br />
			<?php echo "Remuneration : " . $data['Remuneration'];?><br />
			<?php echo "Reservation restante : " . $data['Reservation_Max'];?><br />
			<?php echo "Client : " . $data['Nom'];?><br />
		</p>
		<?php
		if (isset($_SESSION['user']) && isset($_SESSION['id'])) {
			$infoCheck = $bdd->query("SELECT ID_Info, E_Mail FROM candidats WHERE ID_Info =  '" . $_SESSION['id'] . "' AND E_Mail = '" . $_SESSION['user'] . "' ");
			if ($infoCheck && $infoCheck->rowCount() == 1) {
				$mission = $data['ID_Mission'];
				?><form method="post" action="postuler.php">
					<p><input type="submit" name="submit" value="<?php echo $mission;?>"> <--Postuler</p>
					</form><?php
				}
			}
			if (isset($_SESSION['user']) && isset($_SESSION['id'])) {
				$clientCheck = $bdd->query("SELECT ID_Client, E_Mail FROM clients WHERE ID_Client =  '" . $_SESSION['id'] . "' AND E_Mail = '" . $_SESSION['user'] . "' ");
				$mission = $data['ID_Mission'];
				$autreTable = $bdd->query("
					SELECT ca.Nom, m.ID_Client
					FROM clients cl 
					INNER JOIN missions m ON cl.ID_Client=m.ID_Client
					INNER JOIN postuler p ON m.ID_Mission=p.ID_Mission
					INNER JOIN candidats ca ON p.ID_Info=ca.ID_Info
					WHERE m.ID_Client= '" . $_SESSION['id'] . "' AND m.ID_Mission = '" . $data['ID_Mission'] . "'
					");

				?> Voici les candidats qui ont postuler :  <?php
				if ($clientCheck && $clientCheck->rowCount() == 1) {
					while ($dataMission = $autreTable->fetch()) {
						echo " " . $dataMission['Nom'] . " ";
					}
				}
			}
		}
		


	} catch (Exception $e) {
		echo $e->getMessage();
		echo $e->getCode();
	}

	?>