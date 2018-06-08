<?php 

require 'fonctions/fonctions.php';

session_start();

try {

	$login = login();

	if ($login == 2) {
		?><meta http-equiv="refresh" content="5; URL=pageClient.php"> <h2>Redirection vers votre page(Client) dans 5 secondes</h2>  <?php
	} else if ($login == 1) {
		?><meta http-equiv="refresh" content="5; URL=pageCandidat.php"> <h2>Redirection vers votre page(Candidat) dans 5 secondes</h2> <?php
	} else {
		?><meta http-equiv="refresh" content="5; URL=_index.php"> <h2>Redirection vers la page d'acceuil dans 5 secondes</h2> <?php
	}
	?>
	
	<?php
} catch (Exception $e) {

	echo $e->getMessage();
	echo $e->getCode();
}

?>