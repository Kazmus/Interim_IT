<?php 
 
require 'fonctions/fonctions.php';

	try {
		$bdd = dbConnexion();

		$table = $bdd->query('SELECT * FROM missions');

		while ($data = $table->fetch()) {
			?>
			<p>
				<?php echo "Mission numero : " . $data['ID_Mission']; ?><br />
				<?php echo "Type de mission : " . $data['Type']; ?><br />
				<?php echo "Lieu : " . $data['Lieu']; ?><br />
				<?php echo "Date de debut : " . $data['Date_Debut']; ?><br />
				<?php echo "Date de fin : " . $data['Date_Fin']; ?><br />
				<?php echo "Effectif requis : " . $data['Effectif_Requis'];?><br />
				<?php echo "Description : " . $data['Description']; ?><br />
				<?php echo "Remuneration : " . $data['Remuneration'];?><br />
				<?php echo "Client numero : " . $data['ID_Client']; ?><br />
			</p>
			<?php
		}
	} catch (Exception $e) {
		
	}

?>