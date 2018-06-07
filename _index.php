<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Homepage</title>
    </head>
    <body>
        <h1>INTERIM IT</h1>
        <p>Page d'accueill</p>

        <form action="connexion.php" method="post">
            <p>
                <input type="text" name="user" placeholder="Votre mail...">
                <input type="password" name="password" placeholder="Mot de passe...">
                <input type="submit" name="submit" value="Connexion">
            </p>
        </form>

    	<form action="candidat.html">
    		<p>
    			<input  type="submit" value="Insciption Candidat">
    		</p>
    	</form>

        <form action="candidat.php">
            <p>
                <input type="submit" value="Candidats">
            </p>
        </form>
    
    	<form action="client.html">
    		<p>
    			<input  type="submit" value="Insciption Client">
    		</p>
    	</form>

        <form action="client.php">
            <p>
                <input  type="submit" value="Clients">
            </p>
        </form>

         <form action="mission.html">
            <p>
                <input type="submit" value="Ajouter Mission">
            </p>
        </form>

        <form action="mission.php">
            <p>
                <input type="submit" value="Missions">
            </p>
        </form>

        <form action="competences.html">
            <p>
                <input type="submit" value="Ajouter Competences">
            </p>
        </form>

        <form action="competences.php">
            <p>
                <input type="submit" value="Competences">
            </p>
        </form>
    </body>
</html>