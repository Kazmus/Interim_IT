
<?php 
require "fonctions/fonctions.php"; 
?>

<html>
    <head>
        <meta charset="utf-8" />
        <title>Formulaire Mission</title>
    </head>

    <body>
    	<form method="post" action="missionProcess.php" name="Formulaire Client" autocomplete="on" enctype="">

    		<h1>Formulaire Mission</h1>
            <p>Champs <strong>EN GRAS</strong> = obligatoires</p>
            
            <p>
                <strong> Type de contrat </strong>
                <input type="radio" name="type" value="CDD"> CDD
                <input type="radio" name="type" value="CDI"> CDI<br>
            </p>

            <p><label> <strong>Titre : </strong></label><input type="text" name="titre" placeholder="Nom de la mission..."></p>
            <p><label> <strong>Lieu : </strong></label><input type="text" name="lieu" placeholder="Lieu..."></p> 

            <p><label> <strong>Date de debut : </strong></label> <input type="date" name="dateDebut" value="dateDebut"></p>
            <p><label> <strong>Date de fin : </strong></label><input type="date" name="dateFin" value="dateFin"></p> 

    		<p><label> <strong>Effectif requis : </strong></label> <input type="value" name="effectif" placeholder="Effectif requis..."></p>
    		<p><label> <strong>Description : </strong></label><br /><textarea type="text" name="description" placeholder="Description..."></textarea> </p> 

            <p><label> <strong>Remuneration : </strong></label><input type="value" name="remuneration" placeholder="Remuneration..."></p>
            <p><label> <strong>Reservation maximum : </strong></label><input type="value" name="reservMax" placeholder="Reservation maximum..."></p>

            <h2>Competences requises</h2>
            <p>
                <strong> Permis obligatoire ? : </strong>
                <input type="radio" name="permis" value="Oui"> Oui
                <input type="radio" name="permis" value="Oui"> Non<br>
            </p>
            <?php selectionAnneeExpMission(); ?>
            <p><label><strong> Langue requise ? : </strong></label><select name="langue"><?php selectionLangues(); ?></select></p>

    		<p><input type="submit" name="submit" value="Valider le formulaire"/>
    		<input type="reset" value="Remettre à 0"></p>
    	</form>
    </body>      
</html>