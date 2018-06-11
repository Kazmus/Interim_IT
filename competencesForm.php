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
    		<p><label> Diplome :  </label> <input id="Name" type="text" name="diplome" placeholder="Diplome..."></p>
    		<p><label> Certification :  </label> <input id="Name" type="text" name="certif" placeholder="Certification..."></p>
            <p><label>  Annee d'experience : </label>
                <select name="expAnnee"> 
                    <option value="0" selected="selected">0 </option>
                    <option value="1">1 </option>
                    <option value="2">2 </option>
                    <option value="3">3 </option>
                    <option value="4">4 </option>
                    <option value="5">5 </option>
                    <option value="6">6 </option>
                    <option value="7">7 </option>
                    <option value="8">8 </option>
                    <option value="9">9 </option>
                    <option value="10">10 </option>
                    <option value="11">11 </option>
                    <option value="12">12 </option>
                    <option value="13">13 </option>
                    <option value="14">14 </option>
                    <option value="15">15 </option>
                    <option value="16">16 </option>
                    <option value="17">17 </option>
                    <option value="18">18 </option>
                    <option value="18">18 </option>
                    <option value="19">19 </option>
                    <option value="20">20 </option>
                    <option value="21">21 </option>
                    <option value="22">22 </option>
                    <option value="23">23 </option>
                    <option value="24">24 </option>
                    <option value="25">25 </option>
                    <option value="26">26 </option>
                    <option value="27">27 </option>
                    <option value="28">28 </option>
                    <option value="29">29 </option>
                    <option value="30">30 </option>
                </select>
            </p>
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