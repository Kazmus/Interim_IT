<?php 

require 'fonctions/fonctions.php';
	
	try {
		$bdd = dbConnexion();

		if (isset($_POST['submit'])) {
			if (isset($_POST['user']) && (isset($_POST['password']))) {
				$table = $bdd->query('SELECT * FROM clients');
				while ($data = $table->fetch()) {
					if ($data['E_Mail'] == $_POST['user'] && $data['Mot_de_Passe'] == $_POST['password']  ) {
					echo "Bienvenu sur notre site " . $data['Nom'];
					} else {
						echo "Vous n'etes pas dans la databse ou mauvaise coordoney";
					}
				}
			}
		}	

	} catch (Exception $e) {
		echo $e->getMessage();
    	echo $e->getCode();
	}

	
?>