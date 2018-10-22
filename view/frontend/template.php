<!DOCTYPE html>
<html>
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
		<meta property="og:image" content="" />
		<meta property="og:description" content="Découvrez le nouveau roman de Jean Forteroche, Billet simple pour l'Alaska. Un nouveau chapitre tous les 15 du mois !">

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
						<li>
							<i class="fas fa-home"></i>
							<a href="#slider">Accueil</a>
						</li>

						<li>
							<i class="fas fa-user"></i>
							<a href="#carte-stations">À propos</a>
						</li>

						<li>
							<i class="fas fa-sign-in-alt"></i>
							<a href="#">Se connecter</a>
						</li>
					</ul>

				</nav>

				<div id="menu-left">
					<a href="#nav" class="open-menu">&#9776;</a>
					<a href="#" class="close-menu">&#10799;</a>
				</div>

			</header>

			<div>
				<img src="public/images/talkeetna.jpg" alt="Talkeetna | Alaska">
			</div>

       		<section>

       			<?= $content ?>

       		</section>
			
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
    </body>
</html>