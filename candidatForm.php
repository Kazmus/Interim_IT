<?php require 'fonctions/fonctions.php'?>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Formulaire Candidat</title>
    </head>

    <body>
    	<form method="post" action="candidatProcess.php" name="Formulaire Client" autocomplete="on" enctype="">

    		<h1>Formulaire Candidats</h1>
            <p>Champs <strong>EN GRAS</strong> = obligatoires</p>
    		<p><label> <strong>Nom : </strong> </label> <input id="Name" type="text" name="nomCandidat" placeholder="Nom Famille/Entreprise..."></p>
    		<p><label> <strong>Prenom : </strong> </label> <input id="Name" type="text" name="prenomCandidat" placeholder="Prenom..."></p>
            <br>

            <p>
            <input type="radio" name="radio" value="Homme"> Homme
            <input type="radio" name="radio" value="Femme"> Femme<br>
            </p>

            <p><label> <strong>Date de naissance :</strong> </label> <input type="date" name="dateNaissance" value="dateNaissancee"></p>
    		<p><label> <strong>Rue : </strong> </label> <input id="Rue" type="text" name="rueCandidat" placeholder="Rue..."
    		   <label> <strong>N° : </strong> </label> <input id="N°" type="value" name="numeroBatimentCandidat" placeholder="NumeroBatiment..."> </p>
    		
    		<p><label> <strong>Code Postal : </strong> </label> <input id="Code Postal" type="value" name="cpCandidat" placeholder="CP..."> 
    		   <label> <strong>Ville : </strong> </label> <input id="Ville" type="text" name="villeCandidat" placeholder="Ville..."> </p>
    		
    		<?php selectionPays() ?>
    		
    		<p> <label> Telephone : </label> <input id="Telephone" type="value" name="telCandidat" placeholder="Telephone...">
                <label> GSM : </label> <input id="GSM" type="value" name="gsmCandidat" placeholder="GSM..."></p>
    		<p>
                <label for="E-Mail"><strong> E-Mail : </strong></label> <input id="E-Mail" type="text" name="emailCandidat" placeholder="E-Mail...">
                <label for="password"><strong> Mot-de-passe : </strong></label><input type="password" name="password" placeholder="Mot de passe...">
            </p>
    		<p><label for="webURL"> SiteWeb : </label> <input id="webURL" type="text" name="siteCandidat" placeholder="URL..."></p>
    		<p><input type="submit" name="submit" value="Valider le formulaire"/>
    		<input type="reset" value="Remettre à 0"></p>
    	</form>
    </body>      
</html>