<?php 
 
require 'fonctions/fonctions.php';

$idInfo = $_POST['hiddenIdCandidat'];
$idMission = $_POST['hiddenIdMission'];

?><form action="missionAfficher.php"><p><input type="submit" value="Retour a la page mission"></p></form><?php

	try {
		$bdd = dbConnexion();

		$table = $bdd->query("SELECT * FROM candidats ca INNER JOIN competences co ON ca.ID_Info=co.ID_Info WHERE ca.ID_Info= '" . $idInfo . "' ");

		if ($table && $table->rowCount() == 1) {
			$data = $table->fetch()
			?>
			<p>
			<?php echo "<h1>Candidat Numero : " . $data['ID_Info'] . "</h1>"; ?><br />
			<?php echo "Nom : " . $data['Nom']; ?><br />
			<?php echo "Prenom : " . $data['Prenom']; ?><br />
			<?php echo "Genre : " . $data['Genre']; ?><br />
			<?php echo "Date de naissance : " . $data['Date_de_Naissance'] ?><br />
			<?php echo "Adresse : " . $data['Adresse'] . " " . $data['Numero_Adresse'] . ", " . $data['Code_Postal'] . " " . $data['Ville'] . " (" . $data['Pays'] . ")";?><br />
			<?php echo "Tel : " . $data['Tel']; ?><br />
			<?php echo "Gsm : " . $data['Gsm']; ?><br />
			<?php echo "E-Mail : " . $data['E_Mail']; ?><br />
			<?php echo "SiteWeb : " . $data['SiteWeb']; ?><br />

			<?php echo "<h2>Voici les differentes competences qu'il possede</h2>"?>
			<?php echo "Diplome : " . $data['Diplome']; ?><br />
			<?php echo "Certification : " . $data['Certification']; ?><br />
			<?php echo "Annee d'experience : " . $data['Annee_d_experience']; ?><br />
			<?php echo "Permis : " . $data['Permis']; ?><br />
			<?php echo "Langue Primaire : " . $data['Langue_Primaire'];?><br />
			<?php echo "Langue Secondaire : " . $data['Langue_Secondaire']; ?><br />
			</p>
			<?php 
			?><form method="post" action="engager.php">
				<input type="hidden" name="hiddenIdMission" value="<?php echo $idMission;?>" />
				<input type="hidden" name="hiddenIdInfo" value="<?php echo $data['ID_Info'];?>"/>
				<input class="button" name='submit' type="submit" value="Engager" />
			</form><?php
		}
	} catch (Exception $e) {
		echo $e->getMessage();
		echo $e->getCode();
	}

?>