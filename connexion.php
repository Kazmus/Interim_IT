<?php 

require 'fonctions/fonctions.php';

session_start();

try {

	$login = login();
	if ($login == 1) {
		?><meta http-equiv="refresh" content="5; URL=_index.php"> Redirection vers la page d'acceuil dans 5 secondes <?php
	} else if ($login == 0) {
		?><meta http-equiv="refresh" content="5; URL=_index.php"> Redirection vers la page d'acceuil dans 5 secondes <?php
	}
	?>
	
	<?php
} catch (Exception $e) {

	echo $e->getMessage();
	echo $e->getCode();
}

?>