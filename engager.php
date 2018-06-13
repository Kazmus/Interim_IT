<?php

require 'fonctions/fonctions.php';

session_start();

if(isset($_POST['submit'])) {
	$idCandidat = $_POST['hiddenIdInfo'];
}

$bdd = dbConnexion();

$bdd->beginTransaction();

?>