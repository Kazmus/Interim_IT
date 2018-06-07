<?php  

require 'fonctions/fonctions.php';

	try {
		$bdd = bdConnexion();

		$table = $bdd->query('SELECT * FROM clients');

		while ($data = $table->fetch()) {
			?>
			<p>
				<?php echo "Client Numero : " . $data['ID_Client']; ?><br />
				<?php echo "Nom : " . $data['Nom']; ?><br />
				<?php echo "Prenom : " . $data['Prenom']; ?><br />
				<?php echo "Type : " . $data['Type']; ?><br />
				<?php echo "Adresse : " . $data['Adresse'] . $data['Numero_Adresse'] . ", " . $data['Code_Postal'] . $data['Ville'] . $data['Pays'];?><br />
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