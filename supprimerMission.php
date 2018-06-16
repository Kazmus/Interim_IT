<?php

require 'fonctions/fonctions.php';

if (isset($_POST['submit'])) {
	$idMission = $_POST['hiddenIdMission'];
}

$bdd = dbConnexion();

$bdd->query("DELETE FROM engager WHERE ID_Mission= '" . $idMission . "' ");
$bdd->query("DELETE FROM virer WHERE ID_Mission= '" . $idMission . "' ");
$bdd->query("DELETE FROM postuler WHERE ID_Mission= '" . $idMission . "' ");
$bdd->query("DELETE FROM exiger WHERE ID_Mission= '" . $idMission . "' ");
$bdd->query("DELETE FROM missions WHERE ID_Mission= '" . $idMission . "' ");

?><meta http-equiv="refresh" content="0; URL=_index.php"><?php

?>