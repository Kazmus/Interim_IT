<?php require 'fonctions/fonctions.php' ?>

<html>
    <head>
        <meta charset="utf-8" />
        <title>Formulaire Competence</title>
    </head>

    <body>
    	<form method="post" action="competencesProcess.php" name="Formulaire Client" autocomplete="on" enctype="">

    		<h1>Formulaire Competence</h1>
            <p>Champs <strong>EN GRAS</strong> = obligatoires</p>

    		<p><label> Diplome :  </label> <input type="text" name="diplome" placeholder="Diplome..."></p>
    		<p><label> Certification :  </label> <input type="text" name="certif" placeholder="Certification..."></p>

            <?php selectionAnneeExpComp(); ?>

            <p>
                <strong> Vous avez le permis ? </strong>
                <input type="radio" name="radio" value="Oui"> Oui
                <input type="radio" name="radio" value="Non"> Non<br>
            </p>

            <p>
                <strong> Quelle est votre langue primaire ? </strong>
                <select name="primaireLang">
                <?php selectionLangues(); ?> 
                </select>

                Quelle est votre langue secondaire ?
                <select name="secondLang">
                <?php selectionLangues(); ?> 
                </select>
            </p>

    		<p><input type="submit" name="submit" value="Valider le formulaire"/>
    		<input type="reset" value="Remettre à 0"></p>
    	</form>
    </body>      
</html>