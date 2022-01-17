<?php $title='Page d\'accueil '?>

<?php ob_start(); ?>
<header>
  	<img id="logo" src="../../resources/images/logo.svg" alt="logo de E-Event.IO" />
<?php if($UtilisateurCourantIDRole == 0){ ?>
    <section class="connection" id="notConnected">
  		<p>Vous n'êtes pas connecté</p>
		<form id="login" action="/" method="post">
            <input type="hidden" name="action" value="login"/>
        </form>
		<form id="SignIn" action="/" method="post">
                <input type="hidden" name="action" value="SignIn"/>
        </form>
		<ul>
            <li><a class="roundCornerLink" href='#' onclick='document.getElementById("login").submit()'>Se connecter</a></li>
            <li><a class="roundCornerLink" href='#' onclick='document.getElementById("SignIn").submit()'>S'inscrire</a></li>
  		</ul>
    </section>
    <?php }
    else{ ?>
    <section class="connection" id="connected">
        <p> Connecté en tant que :<?php echo $UtilisateurCourantNom; ?></p>
		<form id="MySpace" action="/" method="post">
                <input type="hidden" name="action" value="UserPage"/>
		</form>  					
        <form id="Deco" action="/" method="post">
            <input type="hidden" name="action" value="Deconnexion"/>
        </form>
		<ul>
			<li><a class="roundCornerLink" href='#' onclick='document.getElementById("MySpace").submit()'>Mon espace</a></li>
            <li><a href='#' onclick='document.getElementById("Deco").submit()' id="logoutli"><img id="logout" src="../../resources/images/logout.svg" alt="se d�connecter" /></a></li>
  		</ul>
	</section>
<?php } ?>
</header>
<main>
	<section id="campaignContainer" >
		<h2>
			Campagne en cours : Festival de février
		</h2>
		<p>
			Période de votes
		</p>
	</section>
	<section id="sortMenu">
		<form name="sorter" action="accueil.php" method="get" id="sortForm">
			<label for="sorting-select">
				Trier par :
			</label>
			<select name="sorting-select" form="sorter">						
				<option value="new">nouveauté</option>
				<option value="old">ancienneté</option>
				<option value="mostLiked">popularité</option>
				<option value="lessLiked">impopularité</option>
			</select>
			<button class="roundCornerLink" type="submit" form="sorter" value="">Rechercher</button>
		</form>
	</section>
	<div class="eventContainer" id="eventContainerUp">
		<section>
			<a href="event.php?index=1">
				<span>Soirée étudiante</span>
				<img src="template1.jpg" alt="image" />
			</a>
		</section>
		<section>
			<a href="event.php?index=2">
				<span>Tournoi Valorant</span>
				<img src="template2.jpg" alt="image" />	
			</a>
		</section>
		<section>
			<a href="event.php?index=3">
				<span>Chasse au trésor</span>
				<img src="template3.jpg" alt="image" />	
			</a>
		</section>			
		<section>
			<a href="event.php?index=4">
				<span>Atelier roulage de joints</span>
				<img src="template4.jpg" alt="image" />	
			</a>
				</section>
			</div>
			<div class="eventContainer" id="eventContainerDown">
				<section>
					<a href="event.php?index=5">
						<span>Cinéma en plein air</span>
						<img src="template5.jpg" alt="image" />		
					</a>
				</section>
				<section>
					<a href="event.php?index=6">
						<span>Apéro saucisson pinard comme de bons français</span>
						<img src="template6.jpg" alt="image" />		
					</a>
				</section>
				<section>
					<a href="event.php?index=7">
						<span>reconstitution historique du camp d'Auschwitz</span>
						<img src="template7.jpg" alt="image" />	
					</a>
				</section>
				<section>
					<a href="event.php?index=8">
						<span>Initiation à la culture du cannabis</span>
						<img src="template8.jpg" alt="image" />
					</a>
				</section>
			</div>
		</main>
		<footer>
			<ul>
				<li><a class="roundCornerLink" href="howitworks.php">Fonctionnement du site</a></li>
				<li><div class="split"></div></li>
				<li><a class="roundCornerLink" href="CGU.php">CGU</a></li>
				<li><div class="split"></div></li>
				<li><a class="roundCornerLink" href="legaldisclaimer.php">Mentions légales</a></li>
			</ul>
		</footer>
<?php $content = ob_get_clean(); ?>

<?php require('View/template.php')?>
