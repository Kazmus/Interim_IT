<?php 

require 'fonctions/fonctions.php';

session_start();

?>

<form action="_index.php"><p><input type="submit" value="HomePage"></p></form>

<?php checkComp(); ?>

<form action="_index.php"><p><input type="submit" value="Missions"></p></form>

<form action="competencesAfficher.php"><p><input type="submit" value="Competences"></p></form>

<form action="deconnexion.php"><p><input type="submit" value="Deconnexion"></p></form>