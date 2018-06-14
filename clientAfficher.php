<?php  

require 'fonctions/fonctions.php';

?><form action="missionAfficher.php"><p><input type="submit" value="Retour a la page mission"></p></form><?php

if (isset($_POST['submit'])) {
	$idClient = $_POST['hiddenIdClient'];
}
try {
	$bdd = dbConnexion();

	$table = $bdd->query("SELECT * FROM clients WHERE ID_Client='" . $idClient . "' ");

	while ($data = $table->fetch()) {
		?>
		<p>
			<?php echo "Client Numero : " . $data['ID_Client']; ?><br />
			<?php echo "Nom : " . $data['Nom']; ?><br />
			<?php echo "Prenom : " . $data['Prenom']; ?><br />
			<?php echo "Type : " . $data['Type']; ?><br />
			<?php echo "Adresse : " . $data['Adresse'] . " " . $data['Numero_Adresse'] . ", " . $data['Code_Postal'] . " " . $data['Ville'] . " (" . $data['Pays'] . ")";?><br />
			<?php echo "Tel : " . $data['Tel']; ?><br />
			<?php echo "Gsm : " . $data['Gsm']; ?><br />
			<?php echo "E-Mail : " . $data['E_Mail']; ?><br />
			<?php echo "SiteWeb : " . $data['SiteWeb']; ?><br />
		</p>
		<?php
	}
} catch (Exception $e) {
	echo $e->getMessage();
	echo $e->getCode();
}

?>