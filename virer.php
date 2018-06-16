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
		SELECT e.ID_Info, e.ID_Client, e.ID_Mission FROM engager e
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
		SELECT Reservation_Max FROM missions m 
		INNER JOIN postuler p ON m.ID_Mission=p.ID_Mission 
		INNER JOIN candidats c ON p.ID_Info=c.ID_Info 
		WHERE p.ID_Mission='" . $idMission . "' AND p.ID_Info = '" . $idInfo . "' 
	");

$tableMission = $bdd->query("
		SELECT Effectif_Requis FROM missions WHERE ID_Mission= '" . $idMission . "'
	");

$data = $table->fetch();
if ($idInfo == $data['ID_Info'] && $idClient == $data['ID_Client'] && $idMission == $data['ID_Mission']) {
	$bdd->rollBack();
	header("Location:dejaVirer.php");
} else if ($tableEngager->rowCount() == 1) {
	if ($tableMission && $tableMission->rowCount() == 1) {
		$userEffectif = $tableMission->fetch();
		$effectif = $userEffectif['Effectif_Requis'];
		$effectif = $effectif + 1;
		$bdd->query("UPDATE missions SET Effectif_Requis= '" . $effectif . "' WHERE ID_Mission= '" . $idMission . "' ");
		$bdd->query("DELETE FROM engager WHERE ID_Client= '" . $idClient . "' AND ID_Info= '" . $idInfo . "' AND ID_Mission= '" . $idMission . "' ");
		$bdd->commit();
	} else {
			$bdd->rollBack();
			header("Location:oups.php");
	}
} else {
	if ($tableReserv && $tableReserv->rowCount() == 1) {
		$userReserv = $tableReserv->fetch();
		$reserv = $userReserv['Reservation_Max'];
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
?><meta http-equiv="refresh" content="0; URL=_index.php"><?php
?>