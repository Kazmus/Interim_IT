<?php require 'fonctions/fonctions.php' ?>

<html>
    <head>
        <meta charset="utf-8" />
        <title>Formulaire Competence</title>
        <link rel="stylesheet" href="CSS/indexcs.css"/>
    </head>

    <body>
        <section id="formulaire">
        <div class="element2">
    	<form method="post" action="competencesProcess.php" name="Formulaire Client" autocomplete="on" enctype="">

    		<h1>Formulaire Compétences</h1>
            <p>Champs <strong>EN GRAS</strong> = obligatoires</p>

    		<p><label> Diplômes :  </label> <input type="text" name="diplome" placeholder="Diplome..."></p>
    		<p><label> Certifications :  </label> <input type="text" name="certif" placeholder="Certification..."></p>

            <?php selectionAnneeExpComp(); ?>

            <p>
                <strong> Avez-vous le permis B ? </strong>
                <input type="radio" name="radio" value="Oui"> Oui
                <input type="radio" name="radio" value="Non"> Non<br>
            </p>

            <p>
                <strong> Quelle est votre langue maternelle ? </strong>
                <select name="primaireLang">
                <?php selectionLangues(); ?> 
                </select>

                Quelle est votre langue secondaire ?
                <select name="secondLang">
                <?php selectionLangues(); ?> 
                </select>
            </p>

    		<p class="buttonsForm"><input class="button button3" type="submit" name="submit" value="Valider le formulaire"/>
    		<input class="button button3" type="reset" value="Remettre à 0"></p>
    	</form>
        </div>
        </section>
    </body>      
</html>