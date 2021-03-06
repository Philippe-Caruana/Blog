<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="robots" content="noindex">
		<meta name="viewport" content="width=device-width, maximum-scale=1">
        <title><?= $title ?></title>
        <meta name="description" content="Découvrez le nouveau roman de Jean Forteroche, Billet simple pour l'Alaska. Un nouveau chapitre tous les 15 du mois !" />

		<!-- Twitter Card data -->
		<meta name="twitter:card" content="Découvrez le nouveau roman de Jean Forteroche, Billet simple pour l'Alaska. Un nouveau chapitre tous les 15 du mois !">

		<!-- Open Graph data -->
		<meta property="og:title" content="Jean Forteroche : Billet simple pour l'Alaska" />
		<meta property="og:type" content="website" />
		<meta property="og:url" content="projet8.philippecaruana.fr" />
		<meta property="og:image" content="/public/images/talkeetna.jpg" />
		<meta property="og:description" content="Découvrez le nouveau roman de Jean Forteroche, Billet simple pour l'Alaska. Un nouveau chapitre tous les 15 du mois !">
		
		<link rel="icon" href="book-icon.png" type="image/png" sizes="16x16">
		<link rel="apple-touch-icon" href="book-icon.png" type="image/png" sizes="57x57">
		<link rel="apple-touch-icon" href="book-icon.png" type="image/png" sizes="60x60">
		<link rel="apple-touch-icon" href="book-icon.png" type="image/png" sizes="72x72">
		<link rel="apple-touch-icon" href="book-icon.png" type="image/png" sizes="76x76">
		<link rel="apple-touch-icon" href="book-icon.png" type="image/png" sizes="124x124">
		<link rel="apple-touch-icon" href="book-icon.png" type="image/png" sizes="144x144">
		<link rel="apple-touch-icon" href="book-icon.png" type="image/png" sizes="152x152">
		<link rel="apple-touch-icon" href="book-icon.png" type="image/png" sizes="180x180">

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
        <link href="public/css/style.css?<?= time(); ?>" rel="stylesheet" />
    </head>
        
    <body>

    	<main>
    		
			<header>
				
				<h1>Jean Forteroche</h1>
				
				<h2>Billet simple pour l'Alaska</h2>

				<nav id="nav">

					<ul>
						<li>
							<a href="#" class="close-menu">&#10799;</a>
						</li>
						<?php

							if(!empty($_SESSION)) {
						?>
								<li>Bonjour <?= htmlspecialchars($_SESSION['username']); ?></li>
						<?php		
							}
						?>
						<li>
							<i class="fas fa-home"></i>
							<a href="/">Accueil</a>
						</li>

						<li>
							<i class="fas fa-user"></i>
							<a href="">À propos</a>
						</li>
						
						<?php
							
							if(!empty($_SESSION) && $_SESSION['groups_id'] === "1") {
						?>
								<li>
									
									<i class="fas fa-chalkboard-teacher"></i>

						<?php		
									if(isset($_COOKIE['adminAccess']) && $_COOKIE['adminAccess'] === '1') {
						
									echo '<a href="index.php?action=admin">Administration</a>';
									
								}
								else {
						
									echo '<a href="index.php?action=administration#authentication">Administration</a>';
						
								}
						?>	
								</li>
						<?php
							}
						?>

						<li>
							<?php

								if(!empty($_SESSION)) {
							?>	
									<i class="fas fa-sign-out-alt"></i>
									<a href="index.php?action=sign-out">Se déconnecter</a>	
							<?php	
								}
								else 
								{
							?>
									<i class="fas fa-sign-in-alt"></i>
									<a href="index.php?action=login#login">Se connecter</a>
							<?php
								}
							?>
							
						</li>
					</ul>

				</nav>

				<div id="menu-left">
					<a href="#nav" class="open-menu">&#9776;</a>
					<a href="#" class="close-menu">&#10799;</a>
				</div>

			</header>

			<?php

				if(isset($post)) {
					$img = "aurore-boreale.jpg";
					$hash = "#chapter-content";
				}
				elseif(isset($signIn)) {
					$img = "aurore-boreale.jpg";
					$hash = "#login";
				}
				elseif(isset($signUp)) {
					$img = "aurore-boreale.jpg";
					$hash = "#registration";
				}
				else {
					$img = "talkeetna.jpg";
					$hash = "#chapters";
				}
			
				if(!isset($_GET['action']) || (isset($_GET['action']) && $_GET['action'] !== "admin")) {
			?>	
					<div id="parallax" style="background-image:url('/public/images/<?= $img ?>')">
						<a href="<?= $hash ?>" onclick="scrollWin(event)"><span></span>Scroll</a>
						<img src="/public/images/<?= $img ?>">
					</div>
			<?php
				}
			?>
			
		
			<?php
			
				if(!empty($_SESSION)) {

			        if(isset($_GET['account-status']) && $_GET['account-status'] == "account-successfully-created")
			        {
			    ?>		
			    		<div class="desktop txt-center">
			    			<p class="alert alert-success fade-out inline">Merci. Votre compte a bien été créé et vous êtes à présent connecté.e</p>
			    		</div>
			    <?php
			        }

			        if(isset($_GET['sign-in']) && $_GET['sign-in'] == "success")
			        {
			    ?>		
			    		<div class="desktop txt-center">
			    			<p class="alert alert-success fade-out inline">Vous êtes bien connecté.e. Ravi de vous revoir <b><?= htmlspecialchars($_SESSION['username']); ?></b>.</p>
			    		</div>
			    <?php
			        }
			    }

			    if(isset($_GET['sign-out']) && $_GET['sign-out'] == "success")
		        {
		    ?>		
		    		<div class="desktop txt-center">
		    			<p class="alert alert-success fade-out inline">Vous êtes bien déconnecté.e. À bientôt.</p>
		    		</div>
		    <?php
		        }
			?>

       		<?= $content ?>
			
			<footer>
				
				<p>
					<i class="fas fa-info-circle"></i>
					Site non contractuel, réalisé dans le cadre d'une formation
				</p>
				
				<p>

					<i class="fas fa-balance-scale"></i>
					<a href="#"> Mentions légales</a>

				</p>
				
				<div> Retrouvez-moi également sur les réseaux sociaux :
					<ul>
						<li>
							<i class="fab fa-facebook-square"></i>
							<a href="#">Facebook</a>
						</li>
						<li>
							<i class="fab fa-twitter-square"></i>
							<a href="#">Twitter</a>
						</li>
						<li>
							<i class="fab fa-instagram"></i>
							<a href="#">Instagram</a>
						</li>
					</ul>
				</div>

			</footer>

       	</main>
		
		<?php

			if(isset($signUp)) {
		?>		
				<script src='https://www.google.com/recaptcha/api.js?render=6LcYrXYUAAAAAD733C5SRX9neLpus6OOTXCIm3xP'></script>
		       	<script>
					grecaptcha.ready(function() {
						grecaptcha.execute('6LcYrXYUAAAAAD733C5SRX9neLpus6OOTXCIm3xP', {action: 'homepage'})
						.then(function(token) {
							document.getElementById("g-recaptcha").value = token;
						});
					});
				</script>
		<?php
			}
       	
			if(!isset($_GET['action'])) {
		?>	
				<script src="public/js/frontend/ajax.js"></script>
		<?php
			}
       	?>

       	<script src="public/js/frontend/app.js"></script>
       	<?php

	       	if(!empty($_SESSION) && $_SESSION['groups_id'] == "1") {
	    		if(isset($adminView) || isset($editView)){
	    ?>
	    			<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
	    			<script src="public/js/backend/app.js"></script>
	    <?php
	    		}

	    		if(isset($_GET['action']) && $_GET['action'] == "admin") {
	    ?>
	    			<script src="public/js/backend/modal.js"></script>
	    <?php
	    		}
	       	}
	    ?>
    </body>
</html>