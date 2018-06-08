
<?php 

require 'fonctions/fonctions.php';

session_start(); 
echo "Session de " . $_SESSION['user'] . "</br>";
echo 'ID_CLIENT = ' . $_SESSION['id'];
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
    
    <form action="mission.php"><p><input type="submit" value="Missions"></p></form>
    
    <form action="candidat.php"><p><input type="submit" value="Candidats"></p></form>
    
    <form action="client.php"><p><input  type="submit" value="Clients"></p></form>

    <form action="competences.php"><p><input type="submit" value="Competences"></p></form>

    <form action="test.php"><p><input type="submit" value="test"></p></form>

</body>
</html>