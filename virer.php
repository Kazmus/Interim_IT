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
		INNER JOIN postuler p ON m.ID_Mission=p.ID_Mission 
		INNER JOIN candidats c ON p.ID_Info=c.ID_Info 
		WHERE m.ID_Mission='" . $idMission . "' AND p.ID_Info = '" . $idInfo . "' 
	");

$data = $table->fetch();
if ($idInfo == $data['ID_Info'] && $idClient == $data['ID_Client'] && $idMission == $data['ID_Mission']) {
	$bdd->rollBack();
	header("Location:dejaEngager.php");
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