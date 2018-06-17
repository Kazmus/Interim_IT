<?php 

require 'fonctions/fonctions.php';

session_start();

try {

	$login = login();

	if ($login == 2) {
		?><meta http-equiv="refresh" content="4; URL=_index.php"> <h2>Redirection vers votre page(Client) dans 4 secondes</h2>  <img  src="images/portal.gif" width="100%" height="100%" alt="Loading" /> <?php
	} else if ($login == 1) {
		?><meta http-equiv="refresh" content="4; URL=_index.php"> <h2>Redirection vers votre page(Candidat) dans 4 secondes</h2> <img  src="images/portal.gif" width="100%" height="100%" alt="Loading" />  <?php 

	} else {
		?><meta http-equiv="refresh" content="4; URL=_index.php"> <h2>Redirection vers la page d'acceuil dans 4 secondes</h2> <?php
	}
	?>
	
	<?php
} catch (Exception $e) {

	echo $e->getMessage();
	echo $e->getCode();
}

?>