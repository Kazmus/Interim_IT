<?php require 'fonctions/fonctions.php'?>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Formulaire du Candidat</title>
        <link rel="stylesheet" href="CSS/indexcs.css"/>
    </head>

    <body>
        <section id="formulaire">
            <div class="element2">
    	   <form method="post" action="candidatProcess.php" name="Formulaire Client" autocomplete="on" enctype="">
        
    		<h1>Formulaire du Candidats</h1>
            <p>Champs <strong>EN GRAS</strong> = obligatoires</p>
    		<p><label> <strong>Nom : </strong> </label> <input id="Name" type="text" name="nomCandidat" required placeholder="Nom Famille/Entreprise..."></p>
    		<p><label> <strong>Prénom : </strong> </label> <input id="Name" type="text" name="prenomCandidat" required placeholder="Prenom..."></p>
            <br>

            <p >
            <input type="radio" name="radio" value="Homme" checked> Homme
            <input type="radio" name="radio" value="Femme"> Femme<br>
            </p>

            <p><label> <strong>Date de naissance :</strong> </label> <input type="date" name="dateNaissance" required value="dateNaissancee"></p>
    		<p><label> <strong>Rue : </strong> </label> <input id="Rue" type="text" name="rueCandidat" required placeholder="Rue..."
    		   <label> <strong>N° : </strong> </label> <input id="N°" type="value" name="numeroBatimentCandidat" required placeholder="NumeroBatiment..."> </p>
    		
    		<p><label> <strong>Code Postal : </strong> </label> <input id="Code Postal" type="value" name="cpCandidat" required placeholder="CP..."> 
    		   <label> <strong>Ville : </strong> </label> <input id="Ville" type="text" name="villeCandidat" required placeholder="Ville..."> </p>
    		
    		<?php selectionPays() ?>
    		
    		<p> <label> Téléphone : </label> <input id="Telephone" type="value" name="telCandidat" placeholder="Telephone...">
                <label> GSM : </label> <input id="GSM" type="value" name="gsmCandidat" placeholder="GSM..."></p>
    		<p>
                <label for="E-Mail"><strong> E-Mail : </strong></label> <input id="E-Mail" type="text" name="emailCandidat" required placeholder="E-Mail...">
                <label for="password"><strong> Mot-de-passe : </strong></label><input type="password" name="password" required placeholder="Mot de passe...">
            </p>
    		<p><label for="webURL"> Site-Web : </label> <input id="webURL" type="text" name="siteCandidat" placeholder="URL..."></p>
    		<p class="buttonsForm"><input class="button button3" type="submit" name="submit" value="Valider le formulaire"/>
    		<input class="button button3" type="reset" value="Remettre à 0"></p>
            </div>
        </section>
    	</form>
    </body>      
</html>