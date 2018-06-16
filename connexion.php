<?php 

require 'fonctions/fonctions.php';

session_start();

try {

	$login = login();

	if ($login == 2) {
		?><meta http-equiv="refresh" content="3; URL=pageClient.php"> <h2>Redirection vers votre page(Client) dans 5 secondes</h2>  <img  src="images/portal.gif" width="100%" height="100%" alt="Loading" /> <?php
	} else if ($login == 1) {
		?><meta http-equiv="refresh" content="3; URL=pageCandidat.php"><img  src="images/portal.gif" width="100%" height="100%" alt="Loading" /> <?php 

	} else {
		?><meta http-equiv="refresh" content="3; URL=_index.php"> <h2>Redirection vers la page d'acceuil dans 5 secondes</h2> <?php
	}
	?>
	
	<?php
} catch (Exception $e) {

	echo $e->getMessage();
	echo $e->getCode();
}

?>