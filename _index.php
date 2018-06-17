<?php 

require 'fonctions/fonctions.php';

session_start(); 

?>
<html>
<head>
	
	<meta charset="utf-8" />
	<title>Homepage</title>
	<link rel="stylesheet" href="CSS/indexcs.css"/>

</head>
<body>

	<section id="banner">
				<div class="inner">
					<h1><img  src="images/phenix3.png" width="300px" alt="Photo de montagne" />	</h1>
					<p>NOUS VENONS DU FUTUR<br />
					VOTRE MISSION EST NOTRE MISSION</p>
				</div>
				<video  autoplay loop muted playsinline src="images/banner.mp4"></video>
	</section>


	<nav>
		<div class="menu">
			<?php 
			checkConnex(); 
        	if (isset($_SESSION['nom']) && isset($_SESSION['id'])) {
        	 ?> <h2> Session de <?php echo $_SESSION['nom']; ?>  </h2> <?php   
      		}
        	sessionClient(); 
			sessionCandidat();
			?>
		</div>
	</nav>

	<section>
		<div id="panneau">
			<?php afficherMission();?>
        </div>
	</section>

	<aside>
		<div id="tabComp">
			<div class="comp">

				<div class="globe">
			 	<?php if (!isset($_POST['submit']) && !isset($_POST['engager']) && !isset($_SESSION['id'])) { ?>
				<video autoplay loop muted playsinline height="100%" width="100%" src="images/world.webm"></video>
				<?php }
				?></div><?php
				afficherCompetence();
		
				afficherCandidat();
		
				afficherClient();
			?>
			</div>
		</div>
	</aside>
	

	<aside id="image">
		<img  src="imageweb/im2.jpg" width="49%" height="524" alt="Photo de montagne" />	
	</aside>

	<footer id="pied_page">

	</footer>
		

</body>
</html>