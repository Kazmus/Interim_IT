<?php 
 
require 'fonctions/fonctions.php';

session_start();

?><form action="pageCandidat.php"><p><input type="submit" value="Retour"></p></form><?php

	try {
		$bdd = dbConnexion();

		$table = $bdd->query("SELECT * FROM competences co INNER JOIN candidats ca ON co.ID_Info=ca.ID_Info WHERE ca.ID_Info='" . $_SESSION['id'] . "' ");

		while ($data = $table->fetch()) {
			?>
			<p>
				<?php echo "<h2>Competences de  " . $data['Nom'] . " " . $data['Prenom'] . "</h2>"?>
				<?php echo "Competence Numero : " . $data['ID_Comp']; ?><br />
				<?php echo "Diplome : " . $data['Diplome']; ?><br />
				<?php echo "Certification : " . $data['Certification']; ?><br />
				<?php echo "Annee d'experience : " . $data['Annee_d_experience']; ?><br />
				<?php echo "Permis : " . $data['Permis']; ?><br />
				<?php echo "Langue Primaire : " . $data['Langue_Primaire'];?><br />
				<?php echo "Langue Secondaire : " . $data['Langue_Secondaire']; ?><br />
				<?php echo "Candidat Numero : " . $data['ID_Info']; ?><br />
			</p>
			<?php
		}
	} catch (Exception $e) {
		
	}

?>