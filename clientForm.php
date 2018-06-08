
<?php require 'fonctions/fonctions.php' ?>

<html>

    <head>
    <meta charset="utf-8" />
    <title>Formulaire Client</title>
    </head>

    <body>
    	<form method="post" action="clientProcess.php" name="Formulaire Client" autocomplete="on" enctype="">

    		<h1>Formulaire Client</h1>

    		<p>Champs <strong>EN GRAS</strong> = obligatoires</p>
    		<br>
            <p>
    		   <input type="radio" name="radio" value="Particulier" > Particulier 
    	       <input type="radio" name="radio" value="Entreprise" > Entreprise <br>
            </p>

    		<p><label> <strong>Nom : </strong> </label> <input id="name" type="text" name="nomClient" placeholder="Nom Famille/Entreprise..."></p>
    		<p><label> Prenom : </label> <input id="name" type="text" name="prenomClient" placeholder="Prenom..."></p>
    		
    		<p><label> <strong>Rue : </strong> </label> <input id="rue" type="text" name="rueClient" placeholder="Rue...">
    		   <label> <strong>N° : </strong> </label> <input id="N°" type="value" name="numeroBatiment" placeholder="NumeroBatiment..."></p>
    		
    		<p><label> <strong>Code Postal : </strong> </label> <input id="code Postal" type="value" name="cpClient" placeholder="CP..."> 
    		   <label> <strong>Ville : </strong> </label> <input id="ville" type="text" name="villeClient" placeholder="Ville..."> </p>

            <?php selectionPays() ?>
    		
    		<p><label for="telClient"> Telephone : </label> <input id="Telephone" type="text" name="telClient" placeholder="Telephone...">
                <label for="gsmClient"> GSM : </label> <input id="GSM" type="text" name="gsmClient" placeholder="GSM..."></p>
    		<p>
                <label for="emailClient"><strong> E-Mail : </strong></label> <input id="email" type="text" name="emailClient" placeholder="E-Mail...">
                <label for="password"><strong> Mot-de-passe : </strong></label><input type="password" name="password" placeholder="Mot de passe...">
            </p>
    		<p><label for="siteClient"> SiteWeb : </label> <input id="webUrl" type="text" name="siteClient" placeholder="URL..."></p>
    		<p><input type="submit" name="submit" value="Valider le formulaire"/>  
    		<input type="reset" value="Remettre à 0" name="reset"/></p>
    	</form>
    </body>      
</html>