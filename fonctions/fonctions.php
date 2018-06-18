
<head>
    
    <meta charset="utf-8" />
    <link rel="stylesheet" href="CSS/indexcs.css"/>

</head>

<?php
function dbConnexion() {
	$db = new PDO('mysql:host=localhost;port=3307;dbname=interim_it;charset=utf8', 'root', '');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $db;
}

function checkConnex () {
    if (!isset($_SESSION['id'])) {?>
        <form action="connexion.php" method="post"><p>
            <input class="button button2" type="text" name="user" placeholder="Votre mail...">
            <input class="button button2" type="password" name="password" placeholder="Mot de passe...">
            <input class="button" type="submit" name="submit" value="Connexion"></p></form>

        <form action="candidatForm.php">
            <button class="button"> Inscription Candidat </button>
        </form>

        <form action="clientForm.php">
            <button class="button"> Inscription Client </button>
        </form><?php 

    } else {?>
        <form action="deconnexion.php">
        <p>
        <input class="button" type="submit" value="Déconnexion">
        </p>
        </form><?php
    }
}

function sessionClient () {
    $bdd = dbConnexion();
    if (isset($_SESSION['nom']) && isset($_SESSION['id'])) {
        $table = $bdd->query("SELECT ID_Client, Nom FROM clients WHERE ID_Client =  '" . $_SESSION['id'] . "' AND E_Mail = '" . $_SESSION['user'] . "' ");
        if ($table && $table->rowCount() == 1) {?>
            <form action="missionForm.php"><p><input class="button" type="submit" value="Ajouter Mission"></p></form><?php
        }
    }
}

function sessionCandidat () {
    $bdd = dbConnexion();
    if (isset($_SESSION['nom']) && isset($_SESSION['id'])) {
        $table = $bdd->query("SELECT ID_Info, Nom FROM candidats WHERE ID_Info =  '" . $_SESSION['id'] . "' AND E_Mail = '" . $_SESSION['user'] . "' ");
        if ($table && $table->rowCount() == 1) {
            checkComp();
        }
    }
}

function login() {
	$bdd = dbConnexion();
	if (isset($_POST['submit'])) {
		if (isset($_POST['user']) && (isset($_POST['password']))) {
			$table = $bdd->query("SELECT * FROM clients WHERE E_Mail = '" . $_POST['user'] . "' AND Mot_de_Passe = '" . $_POST['password'] . "'");
			if ($table && $table->rowCount() == 1) {
				$user = $table->fetch();
				$_SESSION['id'] = $user['ID_Client'];
                $_SESSION['user'] = $user['E_Mail'];
                $_SESSION['nom'] = $user['Nom'];
				$table->closeCursor();
				return 2;
			} else if (isset($_POST['user']) && (isset($_POST['password']))) {
				$table = $bdd->query("SELECT * FROM candidats WHERE E_Mail = '" . $_POST['user'] . "' AND Mot_de_Passe = '" . $_POST['password'] . "'");
				if ($table && $table->rowCount() == 1) {
					$user = $table->fetch();
					$_SESSION['id'] = $user['ID_Info'];
                    $_SESSION['user'] = $user['E_Mail'];
                    $_SESSION['nom'] = $user['Nom'];
					$table->closeCursor();
					return 1;
				} 
			} 
		} 
	} 
}

function checkComp () {
    $bdd = dbConnexion();
    $table = $bdd->query("SELECT ID_Info FROM competences WHERE ID_Info =  '" . $_SESSION['id'] . "' ");
    if ($table && $table->rowCount() == 1) {
        ?><form action="competencesForm.php"><p><input class="button" type="submit" value="Modifier Compétences"></p></form><?php
    } else {
        ?><form action="competencesForm.php"><p><input class="button" type="submit" value="Ajouter Compétences"></p></form><?php
    }
}

function affichageMission ($idMission, $typeMission, $titre, $lieu, $dateDebut, $dateFin, $effectif, $description, $remuneration, $reservation, $nomClient) {
    ?>
        <?php //echo '<div class="element">';?>
            <h2>
                Mission numéro :  <?php echo $idMission ?> <br />
                Type de contrat :  <?php echo $typeMission ?> <br />
                Titre :  <?php echo $titre ?> <br />
                Lieu :  <?php echo $lieu ?> <br />
                Date de début :  <?php echo $dateDebut ?> <br />
                Date de fin :  <?php echo $dateFin ?> <br />
                Effectif requis :  <?php echo  $effectif ?> <br />
                Description :  <?php echo $description ?> <br />
                Rémunération :  <?php echo $remuneration ?> <br />
                Réservation restante :  <?php echo $reservation ?> <br />
                <?php if (isset($nomClient)) { ?>
                          Client :  <?php echo  $nomClient ?>
                  <?php } ?><br />
              </h2>
           <?php //echo '</div>';?>
        <?php
}

function selectionAnneeExpMission () {
    ?>  
    <p><label><strong> Année d'expériences ? : </strong></label>
    <select name="anneeExp" required> 
        <option value="Aucune Experience"> Aucune Experience
        <option value="1 ou 2 ans"> 1 ou 2 ans
        <option value="entre 3 et 5 ans"> entre 3 et 5 ans
        <option value="entre 6 et 10 ans"> entre 6 et 10 ans
        <option value="entre 11 et 20 ans"> entre 11 et 20 ans
        <option value="21 ou plus"> 21 ou plus
    </select></p><?php
}

function afficherMission () {
    try {
    $bdd = dbConnexion();

    $table = $bdd->query("SELECT * FROM missions m INNER JOIN clients c ON m.ID_Client=c.ID_Client ORDER BY Date_Debut");

    if (isset($_SESSION['user']) && isset($_SESSION['id'])) {

        $tableClient = $bdd->query("SELECT * FROM missions m INNER JOIN clients c ON m.ID_Client=c.ID_Client 
        WHERE m.ID_Client= '" . $_SESSION['id'] . "' ORDER BY Date_Debut");

        $infoCheck = $bdd->query("SELECT ID_Info, E_Mail FROM candidats WHERE ID_Info=  '" . $_SESSION['id'] . "' AND E_Mail = '" . $_SESSION['user'] . "' ");

        $clientCheck = $bdd->query("SELECT ID_Client, E_Mail FROM clients WHERE ID_Client=  '" . $_SESSION['id'] . "' AND E_Mail = '" . $_SESSION['user'] . "' ");

        $compCheck = $bdd->query("SELECT ID_Comp FROM competences WHERE ID_Info= '" . $_SESSION['id'] . "' ");

        if ($infoCheck && $infoCheck->rowCount() == 1) {
            $dataComp = $compCheck->fetch();
            while ($data = $table->fetch()) {
                $tablePostuler = $bdd->query("SELECT * FROM postuler WHERE ID_Info= '" . $_SESSION['id'] . "' AND ID_Mission='" . $data['ID_Mission'] . "' ");
                $tableEngager = $bdd->query("SELECT ID_Info,ID_Mission FROM engager WHERE ID_Info= '" . $_SESSION['id'] . "' AND ID_Mission='" . $data['ID_Mission'] . "' ");
                $tableVirer = $bdd->query("SELECT ID_Info,ID_Mission FROM virer WHERE ID_Info= '" . $_SESSION['id'] . "' AND ID_Mission='" . $data['ID_Mission'] . "' ");
                $tableExiger = $bdd->query("SELECT ID_Mission, ID_Comp FROM exiger WHERE ID_Mission= '" . $data['ID_Mission'] . "' AND ID_Comp= '" . $dataComp['ID_Comp'] . "' ");
                if ($tableExiger && $tableExiger->fetch()) {
                    echo '<div class="element">';
                    affichageMission($data['ID_Mission'], $data['Type_Mission'], $data['Titre'], $data['Lieu'], $data['Date_Debut'], $data['Date_Fin'], $data['Effectif_Requis'], $data['Description'], $data['Remuneration'], $data['Reservation_Max'], $data['Nom']);

                    if ($compCheck && $compCheck->rowCount() == 1) {
                        if ($tableEngager->rowCount() == 1) {
                        ?><form method="post" action="_index.php">
                            <input type="hidden" name="hiddenIdClient" value="<?php echo $data['ID_Client'];?>"/>
                            <input class="button button3" name='engager' type="submit" value="Vous etes engager" /> 
                        </form> Cliquez pour voir le client en detail<?php
                        } else if ($tableVirer->rowCount() == 1) {
                          ?><input class="button button3" type="submit" value="Vous n'etes pas retenu"><?php
                        } else if ($tablePostuler->rowCount() == 1) {
                          ?><input class="button button3" type="submit" value="DEJA Postuler"><?php
                        } else {
                          ?><form method="post" action="postuler.php">
                            <input type="hidden" name="hiddenIdMission" value="<?php echo $data['ID_Mission'];?>"/>
                            <input class="button button3" name='submit' type="submit" value="Postuler" />
                        </form><?php
                        }
                    } else {
                         ?><input class="button button3" type="submit" value="Vous devez ajouter vos compétences pour postuler"><?php
                    }   echo '</div>';
                }
            }
        } else if ($clientCheck && $clientCheck->rowCount() == 1) {
            while ($data = $tableClient->fetch()) {
                echo '<div class="element">';
                affichageMission($data['ID_Mission'], $data['Type_Mission'], $data['Titre'], $data['Lieu'], $data['Date_Debut'], $data['Date_Fin'], $data['Effectif_Requis'], $data['Description'], $data['Remuneration'], $data['Reservation_Max'], NULL);

                $autreTablePostuler = $bdd->query("
                    SELECT ca.Nom, ca.Prenom, m.ID_Client, ca.ID_Info, m.ID_Mission
                    FROM clients cl 
                    INNER JOIN missions m ON cl.ID_Client=m.ID_Client
                    INNER JOIN postuler p ON m.ID_Mission=p.ID_Mission
                    INNER JOIN candidats ca ON p.ID_Info=ca.ID_Info
                    WHERE m.ID_Client= '" . $_SESSION['id'] . "' AND m.ID_Mission = '" . $data['ID_Mission'] . "'
                ");

                $autreTableEngager = $bdd->query("
                    SELECT ca.Nom, ca.Prenom, m.ID_Client, ca.ID_Info, m.ID_Mission
                    FROM engager e 
                    INNER JOIN missions m ON e.ID_Mission=m.ID_Mission
                    INNER JOIN candidats ca ON e.ID_Info=ca.ID_Info
                    WHERE e.ID_Client= '" . $_SESSION['id'] . "' AND e.ID_Mission = '" . $data['ID_Mission'] . "' 
                ");
                
                  ?> <form method="post" action="supprimerMission.php">
                        <input type="hidden" name="hiddenIdMission" value="<?php echo $data['ID_Mission'];?>" />
                        <input class="button button3" name="submit" type="submit" value="Supprimer cette mission" />
                    </form><?php
                    //echo '</div>';
                    //echo '<div class="element">';
                ?><h2>Voici les candidats qui ont postuler : </h2><?php

                while ($dataMission = $autreTablePostuler->fetch()) {
               ?> 
                    <form method="post" action="_index.php">
                        <input type="hidden" name="hiddenIdMission" value="<?php echo $dataMission['ID_Mission'];?>" />
                        <input type="hidden" name="hiddenIdCandidat" value="<?php echo $dataMission['ID_Info'];?>" />
                        <input class="button button3" name='submit' type="submit" value="<?php echo $dataMission['Nom'] . " " . $dataMission['Prenom'];?>" />
                    </form>
                <?php
                }
               // echo '</div>';
               // echo '<div class="element">';
                ?><h2>Voici les candidats que vous avez engager : </h2><?php

                while ($dataMission = $autreTableEngager->fetch()) {
                ?>
                    <form method="post" action="_index.php">
                        <input type="hidden" name="hiddenIdMission" value="<?php echo $dataMission['ID_Mission'];?>" />
                        <input type="hidden" name="hiddenIdCandidat" value="<?php echo $dataMission['ID_Info'];?>" />
                        <input class="button button3" name='submit' type="submit" value="<?php echo $dataMission['Nom'] . " " . $dataMission['Prenom'];?>" />
                    </form>
                <?php
                }echo '</div>';
            }
        } 
    } else {
        while ($data = $table->fetch()) {
            echo '<div class="element">';
            affichageMission($data['ID_Mission'], $data['Type_Mission'], $data['Titre'], $data['Lieu'], $data['Date_Debut'], $data['Date_Fin'], $data['Effectif_Requis'], $data['Description'], $data['Remuneration'], $data['Reservation_Max'], $data['Nom']);
            echo '</div>';
        }
    }
} catch (Exception $e) {
    echo $e->getMessage();
    echo $e->getCode();
}
}

function afficherCompetence() {
    
    $bdd = dbConnexion();
    if (isset($_SESSION['user']) && isset($_SESSION['id'])) {
        $table = $bdd->query("SELECT ID_Comp FROM competences WHERE ID_Info='" . $_SESSION['id'] . "' ");
        if ($table && $table->rowCount() == 1) {
            $table = $bdd->query("SELECT * FROM competences co INNER JOIN candidats ca ON co.ID_Info=ca.ID_Info WHERE ca.ID_Info='" . $_SESSION['id'] . "' AND ca.E_Mail='" . $_SESSION['user'] . "' ");

            while ($data = $table->fetch()) {
            ?>
        
                <h1>Compétences de  <?php echo $data['Nom'] . " " .  $data['Prenom']; ?> </h1>
                <h2>
                    Compétence Numéro : <?php echo $data['ID_Comp']; ?><br />
                    Diplômes : <?php echo $data['Diplome']; ?><br />
                    Certifications : <?php echo $data['Certification']; ?><br />
                    Année d'expérience : <?php echo $data['Annee_d_experience']; ?><br />
                    Permis : <?php echo $data['Permis']; ?><br />
                    Langue Maternelle : <?php echo $data['Langue_Primaire'];?><br />
                    Langue Secondaire : <?php echo $data['Langue_Secondaire']; ?><br />
                    Candidat Numéro : <?php echo $data['ID_Info']; ?><br />
                </h2>
                <?php
            }
        } else {
            ?>
                <h2> Veuillez rajouter vos compétences pour afficher les missions </h2>
            <?php
        }
    }     
}

function checkUser () {
    $bdd = dbConnexion();

    $table = $bdd->query("SELECT * FROM candidats WHERE ID_Info='" . $_SESSION['id'] . "' AND E_Mail='" . $_SESSION['user'] . "' ");
    if ($table && $table->rowCount() == 1) {
        return 1;
    }
}


function afficherClient () {

    if (isset($_POST['engager'])) {
        $idClient = $_POST['hiddenIdClient'];
        $bdd = dbConnexion();

        $table = $bdd->query("SELECT * FROM clients WHERE ID_Client='" . $idClient . "' ");

        while ($data = $table->fetch()) {
            ?>
            <h2>
                <?php echo "Client Numero : " . $data['ID_Client']; ?><br />
                <?php echo "Nom : " . $data['Nom']; ?><br />
                <?php echo "Prenom : " . $data['Prenom']; ?><br />
                <?php echo "Type : " . $data['Type']; ?><br />
                <?php echo "Adresse : " . $data['Adresse'] . " " . $data['Numero_Adresse'] . ", " . $data['Code_Postal'] . " " . $data['Ville'] . " (" . $data['Pays'] . ")";?><br />
                <?php echo "Tel : " . $data['Tel']; ?><br />
                <?php echo "Gsm : " . $data['Gsm']; ?><br />
                <?php echo "E-Mail : " . $data['E_Mail']; ?><br />
                <?php echo "SiteWeb : " . $data['SiteWeb']; ?><br />
            </h2>
            <?php
        }
    }    
}

function afficherCandidat () {

    if (isset($_POST['submit'])) {
    $idInfo = $_POST['hiddenIdCandidat'];
    $idMission = $_POST['hiddenIdMission'];
    $bdd = dbConnexion();
    $table = $bdd->query("SELECT * FROM candidats ca INNER JOIN competences co ON ca.ID_Info=co.ID_Info WHERE ca.ID_Info= '" . $idInfo . "' ");
    if ($table && $table->rowCount() == 1) {
        $data = $table->fetch()
        ?>
        <div>
            <?php echo "<h1>Candidat Numero : " . $data['ID_Info'] . "</h1>"; ?><br />
            <?php echo "Nom : " . $data['Nom']; ?><br />
            <?php echo "Prenom : " . $data['Prenom']; ?><br />
            <?php echo "Genre : " . $data['Genre']; ?><br />
            <?php echo "Date de naissance : " . $data['Date_de_Naissance'] ?><br />
            <?php echo "Adresse : " . $data['Adresse'] . " " . $data['Numero_Adresse'] . ", " . $data['Code_Postal'] . " " . $data['Ville'] . " (" . $data['Pays'] . ")"?><br />
            <?php echo "Tel : " . $data['Tel']; ?><br />
            <?php echo "Gsm : " . $data['Gsm']; ?><br />
            <?php echo "E-Mail : " . $data['E_Mail']; ?><br />
            <?php echo "SiteWeb : " . $data['SiteWeb']; ?><br />
        </div>
        
        <div>
            <?php echo "<h2>Voici les differentes competences qu'il possede</h2>"?>
            <?php echo "Diplome : " . $data['Diplome']; ?><br />
            <?php echo "Certification : " . $data['Certification']; ?><br />
            <?php echo "Annee d'experience : " . $data['Annee_d_experience']; ?><br />
            <?php echo "Permis : " . $data['Permis']; ?><br />
            <?php echo "Langue Primaire : " . $data['Langue_Primaire'];?><br />
            <?php echo "Langue Secondaire : " . $data['Langue_Secondaire']; ?><br />
        </div>

        <div class="compButtons">
            <form method="post" action="engager.php">
            <input type="hidden" name="hiddenIdMission" value="<?php echo $idMission;?>" />
            <input type="hidden" name="hiddenIdInfo" value="<?php echo $data['ID_Info'];?>"/>
            <input class="button" name='submit' type="submit" value="Engager" />
            </form>
            <form method="post" action="virer.php">
            <input type="hidden" name="hiddenIdMission" value="<?php echo $idMission;?>" />
            <input type="hidden" name="hiddenIdInfo" value="<?php echo $data['ID_Info'];?>"/>
            <input class="button" name='submit' type="submit" value="Virer" />
            </form>
        </div><?php
        }
    }
}

function checkAnneeExp ($expAnnee) {
    
    switch ($expAnnee) {

        case 1:
        $anneeExpMis = '1 ou 2 ans';
        break;

        case 2:
        $anneeExpMis = '1 ou 2 ans';
        break;

        case 3:
        $anneeExpMis = 'entre 3 et 5 ans';
        break;

        case 4:
        $anneeExpMis = 'entre 3 et 5 ans';
        break;

        case 5:
        $anneeExpMis = 'entre 3 et 5 ans';
        break;

        case 6:
        $anneeExpMis = 'entre 6 et 10 ans';
        break;

        case 7:
        $anneeExpMis = 'entre 6 et 10 ans';
        break;

        case 8:
        $anneeExpMis = 'entre 6 et 10 ans';
        break;

        case 9:
        $anneeExpMis = 'entre 6 et 10 ans';
        break;

        case 10:
        $anneeExpMis = 'entre 6 et 10 ans';
        break;

        case 11:
        $anneeExpMis = 'entre 11 et 20 ans';
        break;

        case 12:
        $anneeExpMis = 'entre 11 et 20 ans';
        break;

        case 13:
        $anneeExpMis = 'entre 11 et 20 ans';
        break;

        case 14:
        $anneeExpMis = 'entre 11 et 20 ans';
        break;

        case 15:
        $anneeExpMis = 'entre 11 et 20 ans';
        break;

        case 16:
        $anneeExpMis = 'entre 11 et 20 ans';
        break;

        case 17:
        $anneeExpMis = 'entre 11 et 20 ans';
        break;

        case 18:
        $anneeExpMis = 'entre 11 et 20 ans';
        break;

        case 19:
        $anneeExpMis = 'entre 11 et 20 ans';
        break;

        case 20:
        $anneeExpMis = 'entre 11 et 20 ans';
        break;

        case 21:
        $anneeExpMis = 'entre 21 et 30 ans';
        break;

        case 22:
        $anneeExpMis = 'entre 21 et 30 ans';
        break;

        case 23:
        $anneeExpMis = 'entre 21 et 30 ans';
        break;

        case 24:
        $anneeExpMis = 'entre 21 et 30 ans';
        break;

        case 25:
        $anneeExpMis = 'entre 21 et 30 ans';
        break;

        case 26:
        $anneeExpMis = 'entre 21 et 30 ans';
        break;

        case 27:
        $anneeExpMis = 'entre 21 et 30 ans';
        break;

        case 28:
        $anneeExpMis = 'entre 21 et 30 ans';
        break;

        case 29:
        $anneeExpMis = 'entre 21 et 30 ans';
        break;

        case 30:
        $anneeExpMis = 'entre 21 et 30 ans';
        break;

        default:
        $anneeExpMis = 'Aucune Experience';
        break;
    }
    return $anneeExpMis;
}

function selectionAnneeExpComp () {
    ?><p><label><strong> Annee d'experience : </strong></label>
                <select name="expAnnee" required> 
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
            </p><?php
}

function selectionLangues() {
    ?>  <option value="" selected=></option>
        <option value="Anglais"> Anglais
        <option value="Allemand"> Allemand
        <option value="Arabe"> Arabe
        <option value="Bengali"> Bengali
        <option value="Bulgare"> Bulgare
        <option value="Cantonais"> Cantonais
        <option value="Coréen"> Coréen
        <option value="Croate"> Croate
        <option value="Danois"> Danois
        <option value="Espagnol"> Espagnol
        <option value="Estonien"> Estonien
        <option value="Finois"> Finois
        <option value="Francais"> Francais
        <option value="Grec"> Grec
        <option value="Hindi"> Hindi
        <option value="Hongrois"> Hongrois
        <option value="Italien"> Italien
        <option value="Irlandais"> Irlandais
        <option value="Islandais"> Islandais
        <option value="Japonais"> Japonais
        <option value="Lituanien"> Lituanien
        <option value="Mandarin"> Mandarin
        <option value="Néerlandais"> Néerlandais
        <option value="Norvegien"> Norvegien
        <option value="Polonais"> Polonais
        <option value="Portugais"> Portugais
        <option value="Serbe"> Serbe
        <option value="Slovak"> Slovak
        <option value="Slovene"> Slovene
        <option value="Russe"> Russe
        <option value="Suedois"> Suedois
        <option value="Roumain"> Roumain  
        <option value="Tcheque"> Tcheque 
        <option value="Turc"> Turc
        <option value="Ukrainien"> Ukrainien<?php
}

function selectionPays() {

	?><p><label> <strong>Pays : </strong> </label>

    	<select name="pays" required> 
            <option value="Afghanistan">Afghanistan </option>
            <option value="Afrique_Centrale">Afrique_Centrale </option>
            <option value="Afrique_du_sud">Afrique_du_Sud </option> 
            <option value="Albanie">Albanie </option>
            <option value="Algerie">Algerie </option>
            <option value="Allemagne">Allemagne </option>
            <option value="Andorre">Andorre </option>
            <option value="Angola">Angola </option>
            <option value="Anguilla">Anguilla </option>
            <option value="Arabie_Saoudite">Arabie_Saoudite </option>
            <option value="Argentine">Argentine </option>
            <option value="Armenie">Armenie </option> 
            <option value="Australie">Australie </option>
            <option value="Autriche">Autriche </option>
            <option value="Azerbaidjan">Azerbaidjan </option>
            <option value="Bahamas">Bahamas </option>
            <option value="Bangladesh">Bangladesh </option>
            <option value="Barbade">Barbade </option>
            <option value="Bahrein">Bahrein </option>
            <option value="Belgique" selected>Belgique </option>
            <option value="Belize">Belize </option>
            <option value="Benin">Benin </option>
            <option value="Bermudes">Bermudes </option>
            <option value="Bielorussie">Bielorussie </option>
            <option value="Bolivie">Bolivie </option>
            <option value="Botswana">Botswana </option>
            <option value="Bhoutan">Bhoutan </option>
            <option value="Boznie_Herzegovine">Boznie_Herzegovine </option>
            <option value="Bresil">Bresil </option>
            <option value="Brunei">Brunei </option>
            <option value="Bulgarie">Bulgarie </option>
            <option value="Burkina_Faso">Burkina_Faso </option>
            <option value="Burundi">Burundi </option>
            <option value="Caiman">Caiman </option>
            <option value="Cambodge">Cambodge </option>
            <option value="Cameroun">Cameroun </option>
            <option value="Canada">Canada </option>
            <option value="Canaries">Canaries </option>
            <option value="Cap_vert">Cap_Vert </option>
            <option value="Chili">Chili </option>
            <option value="Chine">Chine </option> 
            <option value="Chypre">Chypre </option> 
            <option value="Colombie">Colombie </option>
            <option value="Comores">Colombie </option>
            <option value="Congo">Congo </option>
            <option value="Congo_democratique">Congo_democratique </option>
            <option value="Cook">Cook </option>
            <option value="Coree_du_Nord">Coree_du_Nord </option>
            <option value="Coree_du_Sud">Coree_du_Sud </option>
            <option value="Costa_Rica">Costa_Rica </option>
            <option value="Cote_d_Ivoire">Côte_d_Ivoire </option>
            <option value="Croatie">Croatie </option>
            <option value="Cuba">Cuba </option>
            <option value="Danemark">Danemark </option>
            <option value="Djibouti">Djibouti </option>
            <option value="Dominique">Dominique </option>
            <option value="Egypte">Egypte </option> 
            <option value="Emirats_Arabes_Unis">Emirats_Arabes_Unis </option>
            <option value="Equateur">Equateur </option>
            <option value="Erythree">Erythree </option>
            <option value="Espagne">Espagne </option>
            <option value="Estonie">Estonie </option>
            <option value="Etats_Unis">Etats_Unis </option>
            <option value="Ethiopie">Ethiopie </option>
            <option value="Falkland">Falkland </option>
            <option value="Feroe">Feroe </option>
            <option value="Fidji">Fidji </option>
            <option value="Finlande">Finlande </option>
            <option value="France">France </option>
            <option value="Gabon">Gabon </option>
            <option value="Gambie">Gambie </option>
            <option value="Georgie">Georgie </option>
            <option value="Ghana">Ghana </option>
            <option value="Gibraltar">Gibraltar </option>
            <option value="Grece">Grece </option>
            <option value="Grenade">Grenade </option>
            <option value="Groenland">Groenland </option>
            <option value="Guadeloupe">Guadeloupe </option>
            <option value="Guam">Guam </option>
            <option value="Guatemala">Guatemala</option>
            <option value="Guernesey">Guernesey </option>
            <option value="Guinee">Guinee </option>
            <option value="Guinee_Bissau">Guinee_Bissau </option>
            <option value="Guinee equatoriale">Guinee_Equatoriale </option>
            <option value="Guyana">Guyana </option>
            <option value="Guyane_Francaise ">Guyane_Francaise </option>
            <option value="Haiti">Haiti </option>
            <option value="Hawaii">Hawaii </option> 
            <option value="Honduras">Honduras </option>
            <option value="Hong_Kong">Hong_Kong </option>
            <option value="Hongrie">Hongrie </option>
            <option value="Inde">Inde </option>
            <option value="Indonesie">Indonesie </option>
            <option value="Iran">Iran </option>
            <option value="Iraq">Iraq </option>
            <option value="Irlande">Irlande </option>
            <option value="Islande">Islande </option>
            <option value="Israel">Israel </option>
            <option value="Italie">italie </option>
            <option value="Jamaique">Jamaique </option>
            <option value="Jan Mayen">Jan Mayen </option>
            <option value="Japon">Japon </option>
            <option value="Jersey">Jersey </option>
            <option value="Jordanie">Jordanie </option>
            <option value="Kazakhstan">Kazakhstan </option>
            <option value="Kenya">Kenya </option>
            <option value="Kirghizstan">Kirghizistan </option>
            <option value="Kiribati">Kiribati </option>
            <option value="Koweit">Koweit </option>
            <option value="Laos">Laos </option>
            <option value="Lesotho">Lesotho </option>
            <option value="Lettonie">Lettonie </option>
            <option value="Liban">Liban </option>
            <option value="Liberia">Liberia </option>
            <option value="Liechtenstein">Liechtenstein </option>
            <option value="Lituanie">Lituanie </option> 
            <option value="Luxembourg">Luxembourg </option>
            <option value="Lybie">Lybie </option>
            <option value="Macao">Macao </option>
            <option value="Macedoine">Macedoine </option>
            <option value="Madagascar">Madagascar </option>
            <option value="Madère">Madère </option>
            <option value="Malaisie">Malaisie </option>
            <option value="Malawi">Malawi </option>
            <option value="Maldives">Maldives </option>
            <option value="Mali">Mali </option>
            <option value="Malte">Malte </option>
            <option value="Man">Man </option>
            <option value="Mariannes du Nord">Mariannes du Nord </option>
            <option value="Maroc">Maroc </option>
            <option value="Marshall">Marshall </option>
            <option value="Martinique">Martinique </option>
            <option value="Maurice">Maurice </option>
            <option value="Mauritanie">Mauritanie </option>
            <option value="Mayotte">Mayotte </option>
            <option value="Mexique">Mexique </option>
            <option value="Micronesie">Micronesie </option>
            <option value="Midway">Midway </option>
            <option value="Moldavie">Moldavie </option>
            <option value="Monaco">Monaco </option>
            <option value="Mongolie">Mongolie </option>
            <option value="Montserrat">Montserrat </option>
            <option value="Mozambique">Mozambique </option>
            <option value="Namibie">Namibie </option>
            <option value="Nauru">Nauru </option>
            <option value="Nepal">Nepal </option>
            <option value="Nicaragua">Nicaragua </option>
            <option value="Niger">Niger </option>
            <option value="Nigeria">Nigeria </option>
            <option value="Niue">Niue </option>
            <option value="Norfolk">Norfolk </option>
            <option value="Norvege">Norvege </option>
            <option value="Nouvelle_Caledonie">Nouvelle_Caledonie </option>
            <option value="Nouvelle_Zelande">Nouvelle_Zelande </option>
            <option value="Oman">Oman </option>
            <option value="Ouganda">Ouganda </option>
            <option value="Ouzbekistan">Ouzbekistan </option>
            <option value="Pakistan">Pakistan </option>
            <option value="Palau">Palau </option>
            <option value="Palestine">Palestine </option>
            <option value="Panama">Panama </option>
            <option value="Papouasie_Nouvelle_Guinee">Papouasie_Nouvelle_Guinee </option>
            <option value="Paraguay">Paraguay </option>
            <option value="Pays_Bas">Pays_Bas </option>
            <option value="Perou">Perou </option>
            <option value="Philippines">Philippines </option> 
            <option value="Pologne">Pologne </option>
            <option value="Polynesie">Polynesie </option>
            <option value="Porto_Rico">Porto_Rico </option>
            <option value="Portugal">Portugal </option>
            <option value="Qatar">Qatar </option>
            <option value="Republique_Dominicaine">Republique_Dominicaine </option>
            <option value="Republique_Tcheque">Republique_Tcheque </option>
            <option value="Reunion">Reunion </option>
            <option value="Roumanie">Roumanie </option>
            <option value="Royaume_Uni">Royaume_Uni </option>
            <option value="Russie">Russie </option>
            <option value="Rwanda">Rwanda </option>
            <option value="Sahara Occidental">Sahara Occidental </option>
            <option value="Sainte_Lucie">Sainte_Lucie </option>
            <option value="Saint_Marin">Saint_Marin </option>
            <option value="Salomon">Salomon </option>
            <option value="Salvador">Salvador </option>
            <option value="Samoa_Occidentales">Samoa_Occidentales</option>
            <option value="Samoa_Americaine">Samoa_Americaine </option>
            <option value="Sao_Tome_et_Principe">Sao_Tome_et_Principe </option> 
            <option value="Senegal">Senegal </option> 
            <option value="Seychelles">Seychelles </option>
            <option value="Sierra Leone">Sierra Leone </option>
            <option value="Singapour">Singapour </option>
            <option value="Slovaquie">Slovaquie </option>
            <option value="Slovenie">Slovenie</option>
            <option value="Somalie">Somalie </option>
            <option value="Soudan">Soudan </option> 
            <option value="Sri_Lanka">Sri_Lanka </option> 
            <option value="Suede">Suede </option>
            <option value="Suisse">Suisse </option>
            <option value="Surinam">Surinam </option>
            <option value="Swaziland">Swaziland </option>
            <option value="Syrie">Syrie </option>
            <option value="Tadjikistan">Tadjikistan </option>
            <option value="Taiwan">Taiwan </option>
            <option value="Tonga">Tonga </option>
            <option value="Tanzanie">Tanzanie </option>
            <option value="Tchad">Tchad </option>
            <option value="Thailande">Thailande </option>
            <option value="Tibet">Tibet </option>
            <option value="Timor_Oriental">Timor_Oriental </option>
            <option value="Togo">Togo </option> 
            <option value="Trinite_et_Tobago">Trinite_et_Tobago </option>
            <option value="Tristan da cunha">Tristan de cuncha </option>
            <option value="Tunisie">Tunisie </option>
            <option value="Turkmenistan">Turmenistan </option> 
            <option value="Turquie">Turquie </option>
            <option value="Ukraine">Ukraine </option>
            <option value="Uruguay">Uruguay </option>
            <option value="Vanuatu">Vanuatu </option>
            <option value="Vatican">Vatican </option>
            <option value="Venezuela">Venezuela </option>
            <option value="Vierges_Americaines">Vierges_Americaines </option>
            <option value="Vierges_Britanniques">Vierges_Britanniques </option>
            <option value="Vietnam">Vietnam </option>
            <option value="Wake">Wake </option>
            <option value="Wallis et Futuma">Wallis et Futuma </option>
            <option value="Yemen">Yemen </option>
            <option value="Yougoslavie">Yougoslavie </option>
            <option value="Zambie">Zambie </option>
            <option value="Zimbabwe">Zimbabwe </option>
        </select></p><?php
}
?>