<head>
	
	<meta charset="utf-8" />
	<title>Connexion</title>
	<link rel="stylesheet" href="CSS/indexcs.css"/>

</head>

<?php 

require 'fonctions/fonctions.php';

session_start();

try {

	$login = login();

	if ($login == 2) {
		?><meta http-equiv="refresh" content="4; URL=_index.php"> <img  src="images/portal.gif" width="100%" height="100%" alt="Loading" /> <?php
	} else if ($login == 1) {
		?><meta http-equiv="refresh" content="4; URL=_index.php"> <img  src="images/portal.gif" width="100%" height="100%" alt="Loading" />  <?php 

	} else {?>
		<section id="redirection">
             <div class="element2">
				<h1> YOU SHALL NOT PASS</h1>
                <meta http-equiv="refresh" content="4; URL=_index.php">
                 <h2> Redirection vers la page d'acceuil dans 4 secondes </h2> 
		   </div>
        </section><?php
	}
	?>
	
	<?php
} catch (Exception $e) {

	echo $e->getMessage();
	echo $e->getCode();
}

?>