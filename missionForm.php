
<?php 
require "fonctions/fonctions.php"; 
?>

<html>
    <head>
        <meta charset="utf-8" />
        <title>Formulaire de la Mission</title>
        <link rel="stylesheet" href="CSS/indexcs.css"/>
    </head>

    <body>
        <section id="formulaire">
        <div class="element2">
    	<form method="post" action="missionProcess.php" name="Formulaire Client" autocomplete="on" enctype="">

    		<h1>Formulaire de la Mission</h1>
            <p>Champs <strong>EN GRAS</strong> = obligatoires</p>
            
            <p>
                <strong> Type de contrat </strong>
                <input type="radio" name="type" value="Court" checked> Court
                <input type="radio" name="type" value="Long"> Long<br>
            </p>

            <p><label> <strong>Titre : </strong></label><input type="text" name="titre" required placeholder="Nom de la mission..."></p>
            <p><label> <strong>Lieu : </strong></label><input type="text" name="lieu" required placeholder="Lieu..."></p> 

            <p><label> <strong>Date de début : </strong></label> <input type="date" name="dateDebut" required value="dateDebut"></p>
            <p><label> <strong>Date de fin : </strong></label><input type="date" name="dateFin" required value="dateFin"></p> 

    		<p><label> <strong>Effectif requis : </strong></label> <input type="value" name="effectif" required placeholder="Effectif requis..."></p>
    		<p><label> <strong>Description : </strong></label><br /><textarea type="text" name="description" required placeholder="Description..."></textarea> </p> 

            <p><label> <strong>Rémunération : </strong></label><input type="value" name="remuneration" required placeholder="Remuneration..."></p>
            <p><label> <strong>Réservation maximum : </strong></label><input type="value" name="reservMax" required placeholder="Reservation maximum..."></p>

            <h2>Compétences requises</h2>
            <p>
                Permis obligatoire ? : 
                <input type="radio" name="permis" value="Oui"> Oui
                <input type="radio" name="permis" value="Non" checked> Non<br>
            </p>
            <?php selectionAnneeExpMission(); ?>
            <p><label> Langue requise ? : </label><select name="langue" required><?php selectionLangues(); ?></select></p>

    		<p class="buttonsForm"><input class="button button3" type="submit" name="submit" value="Valider le formulaire"/>
    		<input class="button button3" type="reset" value="Remettre à 0"></p>
    	</form>
    </div>
    </section>
    </body>      
</html>