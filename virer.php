<?php

require 'fonctions/fonctions.php';

session_start();

if (isset($_POST['submit'])) {
	$idInfo = $_POST['hiddenIdInfo'];
	$idClient = $_SESSION['id'];
	$idMission = $_POST['hiddenIdMission'];
}

$bdd = dbConnexion();

$table = $bdd->query("
		SELECT ca.ID_Info, cl.ID_Client, m.ID_Mission FROM virer v
		INNER JOIN candidats ca ON v.ID_Info=ca.ID_Info 
		INNER JOIN clients cl ON v.ID_Client=cl.ID_Client
		INNER JOIN missions m ON v.ID_Mission=m.ID_Mission
		WHERE v.ID_Info='" . $idInfo . "' AND v.ID_Client= '" . $idClient . "' AND v.ID_Mission= '" . $idMission . "'
		
	");

$tableEngager = $bdd->query("
		SELECT ca.ID_Info, cl.ID_Client, m.ID_Mission FROM engager e
		INNER JOIN candidats ca ON e.ID_Info=ca.ID_Info
		INNER JOIN clients cl ON e.ID_Client=cl.ID_Client
		INNER JOIN missions m ON e.ID_Mission=m.ID_Mission
		WHERE e.ID_Info='" . $idInfo . "' AND e.ID_Client= '" . $idClient . "' AND e.ID_Mission= '" . $idMission . "'
	");

$bdd->beginTransaction();

if ($table && $table->rowCount() != 1) {
	$sql = $bdd->prepare('INSERT INTO virer (ID_Info, ID_Client, ID_Mission) VALUES (:idInfo, :idClient, :idMission)');
	$sql->execute(array(
		'idInfo' => $idInfo,
		'idClient' => $idClient,
		'idMission' => $idMission
	));
}

$tableReserv = $bdd->query("
		SELECT Reservation_Max, Effectif_Requis FROM missions m 
		INNER JOIN engager e ON m.ID_Mission=e.ID_Mission 
		INNER JOIN candidats c ON e.ID_Info=c.ID_Info 
		WHERE e.ID_Mission='" . $idMission . "' AND e.ID_Info = '" . $idInfo . "' 
	");

$data = $table->fetch();
if ($idInfo == $data['ID_Info'] && $idClient == $data['ID_Client'] && $idMission == $data['ID_Mission']) {
	$bdd->rollBack();
	header("Location:dejaVirer.php");
} else if ($tableEngager && $tableEngager->rowCount() == 1) {
		$user = $tableReserv->fetch();
		$effectif = $user['Effectif_Requis'];
		$effectif = $effectif + 1;
		$bdd->query("UPDATE missions SET Effectif_Requis= '" . $effectif . "' WHERE ID_Mission= '" . $idMission . "' ");
		$bdd->query("DELETE FROM engager WHERE ID_Client= '" . $idClient . "' AND ID_Info= '" . $idInfo . "' AND ID_Mission= '" . $idMission . "' ");
		$bdd->commit();
} else {
	if ($tableReserv && $tableReserv->rowCount() == 1) {
		$user = $tableReserv->fetch();
		$reserv = $user['Reservation_Max'];
		if ($reserv >= 0) {
			$reserv = $reserv + 1;
			$bdd->query("UPDATE missions SET Reservation_Max= '" . $reserv .  "' WHERE ID_Mission= '" . $idMission . "' ");
			$bdd->query("DELETE FROM postuler WHERE ID_Info= '" . $idInfo . "' AND ID_Mission= '" . $idMission . "' ");
			$bdd->commit();
		} else {
			$bdd->rollBack();
			header("Location:effectifRemplis.php");
		}
	}
}
?><meta http-equiv="refresh" content="0; URL=missionAfficher.php"><?php
?>