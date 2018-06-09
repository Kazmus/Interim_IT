
<?php 

require 'fonctions/fonctions.php';

session_start(); 
if (isset($_SESSION['nom']) && isset($_SESSION['id'])) {
    echo "Session de " . $_SESSION['nom'] . "</br>";
    echo 'ID_CLIENT = ' . $_SESSION['id'];
}

?>

<html>
<head>
    <meta charset="utf-8" />
    <title>Homepage</title>
</head>
<body>
    <h1>INTERIM IT</h1>
    <p>Page d'accueil</p>

    <?php 
    checkConnex(); 
    sessionClient();
    sessionCandidat();
    ?>
    
    <form action="missionAfficher.php"><p><input type="submit" value="Missions"></p></form>
    
    <form action="candidatAfficher.php"><p><input type="submit" value="Candidats"></p></form>
    
    <form action="clientAfficher.php"><p><input  type="submit" value="Clients"></p></form>

    <form action="competencesAfficher.php"><p><input type="submit" value="Competences"></p></form>

</body>
</html>