
<?php require 'fonctions/fonctions.php' ?>

<html>

<head>
    <meta charset="utf-8" />
    <title>Formulaire du Client</title>
    <link rel="stylesheet" href="CSS/indexcs.css"/>
</head>

<body>
    <section id="formulaire">
        <div class="element2">
            <form method="post" action="clientProcess.php" name="Formulaire Client" autocomplete="on" enctype="">

              <h1>Formulaire du Client</h1>

              <p>Champs <strong>EN GRAS</strong> = obligatoires</p>
              <br>
              <p>
               <input type="radio" name="radio" value="Particulier" > Particulier 
               <input type="radio" name="radio" value="Entreprise" checked> Entreprise <br>
           </p>

           <p><label> <strong>Nom : </strong> </label> <input id="name" type="text" name="nomClient" required placeholder="Nom Famille/Entreprise..."></p>
           <p><label> Prénom : </label> <input id="name" type="text" name="prenomClient" required placeholder="Prenom..."></p>

           <p><label> <strong>Rue : </strong> </label> <input id="rue" type="text" name="rueClient" required placeholder="Rue...">
               <label> <strong>N° : </strong> </label> <input id="N°" type="value" name="numeroBatiment" required placeholder="NumeroBatiment..."></p>

               <p><label> <strong>Code Postal : </strong> </label> <input id="code Postal" type="value" name="cpClient" required placeholder="CP..."> 
                   <label> <strong>Ville : </strong> </label> <input id="ville" type="text" name="villeClient" required placeholder="Ville..."> </p>

                   <?php selectionPays(); ?>

                <p><label for="telClient"> Téléphone : </label> <input id="Telephone" type="text" name="telClient" placeholder="Telephone...">
                <label for="gsmClient"> GSM : </label> <input id="GSM" type="text" name="gsmClient" placeholder="GSM..."></p>
                <p>
                     <label for="emailClient"><strong> E-Mail : </strong></label> <input id="email" type="text" name="emailClient" required placeholder="E-Mail...">
                     <label for="password"><strong> Mot-de-passe : </strong></label><input type="password" name="password" required placeholder="Mot de passe...">
                </p>
                <p><label for="siteClient"> Site-Web : </label> <input id="webUrl" type="text" name="siteClient" placeholder="URL..."></p>
                <p class="buttonsForm"><input class="button button3" type="submit" name="submit" value="Valider le formulaire"/>  
                   <input class="button button3" type="reset" value="Remettre à 0" name="reset"/></p>
            </form>
        </div>
    </section>
</body>      
</html>