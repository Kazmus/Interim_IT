<?php 

require 'fonctions/fonctions.php';
session_start();

?>

<form action="_index.php"><p><input type="submit" value="HomePage"></p></form>

<?php checkComp(); ?>

<form action="mission.php"><p><input type="submit" value="Missions"></p></form>

<form action="deconnexion.php"><p><input type="submit" value="Deconnexion"></p></form>