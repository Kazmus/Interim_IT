<?php

require 'fonctions/fonctions.php';

session_start();

if (isset($_POST['submit'])) {
	$idMission = $_POST['hiddenIdMission'];
	$idInfo = $_SESSION['id'];
}


$bdd = dbConnexion();

$bdd->beginTransaction();

$table = $bdd->query("
		SELECT p.ID_Mission, p.ID_Info FROM missions m 
		INNER JOIN postuler p ON m.ID_Mission=p.ID_Mission 
		INNER JOIN candidats c ON p.ID_Info=c.ID_Info 
		WHERE p.ID_Mission='" . $idMission . "' AND p.ID_Info = '" . $idInfo . "' 
	");

if ($table && $table->rowCount() != 1) {
	$sql = $bdd->prepare('INSERT INTO postuler (ID_Mission, ID_Info) VALUES (:idMission, :idInfo)');
	$sql->execute(array(
		'idMission' => $idMission, 
		'idInfo' => $idInfo
	));
}

$tableReserv = $bdd->query("
		SELECT Reservation_Max FROM missions m 
		INNER JOIN postuler p ON m.ID_Mission=p.ID_Mission 
		INNER JOIN candidats c ON p.ID_Info=c.ID_Info 
		WHERE m.ID_Mission='" . $idMission . "' AND p.ID_Info = '" . $idInfo . "' 
	");

$data = $table->fetch();
if ($idMission == $data['ID_Mission'] && $idInfo == $data['ID_Info']) {
	$bdd->rollBack();
	header("Location:dejaReserv.php");
} else {

	if ($tableReserv && $tableReserv->rowCount() == 1) {
		$user = $tableReserv->fetch();
		$reserv = $user['Reservation_Max'];
		if ($reserv > 0) {
			$reserv = $reserv - 1;
			$bdd->query("UPDATE missions SET Reservation_Max= '" . $reserv .  "' WHERE ID_Mission= '" . $idMission . "' ");
			$bdd->commit();
		} else {
			$bdd->rollBack();
			header("Location:plusDePlace.php");
		}
	}
}
?><meta http-equiv="refresh" content="0; URL=missionAfficher.php"><?php
?>