<?php $title='Page d\'accueil '?>

<?php
  ob_start();
  $titre = GetCampagneName();
?>

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
        <p> Connecté en tant que : <?php echo $UtilisateurCourantNom; ?></p>
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
<main id="accueilMain">
	<section id="campaignContainer" >
		<h2>
			Campagne en cours : <?php echo $titre; ?>
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
	<?php

  $query = "SELECT COUNT(*) FROM event";
  $dbLink = mysqli_connect('mysql-e-eventio.alwaysdata.net', 'e-eventio_login', 'php123456$') or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
  mysqli_select_db($dbLink , 'e-eventio_sql') or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
  $dbResult = mysqli_query($dbLink, $query);
  $dbRow = mysqli_fetch_row($dbResult);
  #echo $dbRow['0'] . '</br>';
  $count = $dbRow['0'];

  $query2 = "SELECT * FROM event WHERE id_campagne = 27";
  $dbResult2 = mysqli_query($dbLink, $query2);

  $i = 0;
  while($dbRow2 = mysqli_fetch_row($dbResult2)){
    #echo $dbRow2['4'] . '</br>';
    $CurrentEvent[$i] = $dbRow2;
    $i++;

  }

  CreateEvent($CurrentEvent, $count);

   ?>

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
