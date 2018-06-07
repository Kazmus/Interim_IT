<?php 
 
require 'fonctions/fonctions.php';

	try {
		$bdd = dbConnexion();

		$table = $bdd->query('SELECT * FROM candidats');

		while ($data = $table->fetch()) {
			?>
			<p>
			<?php echo "Candidat Numero : " . $data['ID_Info']; ?><br />
			<?php echo "Nom : " . $data['Nom']; ?><br />
			<?php echo "Prenom : " . $data['Prenom']; ?><br />
			<?php echo "Genre : " . $data['Genre']; ?><br />
			<?php echo "Date de naissance : " . $data['Date_de_Naissance'] ?><br />
			<?php echo "Adresse : " . $data['Adresse'] . " " . $data['Numero_Adresse'] . ", " . $data['Code_Postal'] . " " . $data['Ville'] . " (" . $data['Pays'] . ")";?><br />
			<?php echo "Tel : " . $data['Tel']; ?><br />
			<?php echo "Gsm : " . $data['Gsm']; ?><br />
			<?php echo "E-Mail : " . $data['E_Mail']; ?><br />
			<?php echo "SiteWeb : " . $data['SiteWeb']; ?><br />
			</p>
			<?php
		}
	} catch (Exception $e) {
		
	}

?>