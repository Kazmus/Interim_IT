<?php 
 
require 'fonctions/fonctions.php';

	try {
		$bdd = dbConnexion();

		$table = $bdd->query('SELECT * FROM competences');

		while ($data = $table->fetch()) {
			?>
			<p>
				<?php echo "Competence Numero : " . $data['ID_Comp']; ?><br />
				<?php echo "Diplome : " . $data['Diplome']; ?><br />
				<?php echo "Certification : " . $data['Certification']; ?><br />
				<?php echo "Annee d'experience : " . $data['Annee_d_experience']; ?><br />
				<?php echo "Permis : " . $data['Permis']; ?><br />
				<?php echo "Langue Primaire : " . $data['Langue_Primaire'];?><br />
				<?php echo "Langue Secondaire : " . $data['Langue_Secondaire']; ?><br />
				<?php echo "Candidat Numero : " . $data['ID_Info']; ?>
			</p>
			<?php
		}
	} catch (Exception $e) {
		
	}

?>