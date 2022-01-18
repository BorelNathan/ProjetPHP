<?php
      $titre = $_GET['Event'];
      $title = htmlspecialchars($titre);
      session_start();
      $dbLink = mysqli_connect('mysql-e-eventio.alwaysdata.net', 'e-eventio_login', 'php123456$') or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
      mysqli_select_db($dbLink , 'e-eventio_sql') or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
      $query = "SELECT * FROM event WHERE titre = '" . $title . "'";
      $dbResult = mysqli_query($dbLink, $query);
      $dbRow = mysqli_fetch_row($dbResult);
      require_once(__DIR__.'/../../Utils/utils.inc.php');
      $UtilisateurCourantIDRole = $_SESSION['CurrentUserIDRole'];
      $UtilisateurCourantNom = $_SESSION['CurrentUserName'];
      $indiceimage = $dbRow['7'];
      $retour = $_SESSION['RetourEvent'];
      $_SESSION['CurrentEventSee'] = $titre;

      ob_start();

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

		  <main>
            <section id="eventImageAndVotes">
                <?php echo '<img src="../../resources/images/thumbnail/' . $indiceimage . '.jpg" alt="image">'; ?>
                <div>
                    <h1>
                    <?php
                    #echo htmlspecialchars($titre);
                    echo $dbRow['4'];
                    ?>
                    </h1>
                    <div>
                        <div id="progressBar">
                            <div style="width: <?php echo ($dbRow['1'])/2; ?>%;">
                            </div>
                        </div>
                        <p><?php echo $dbRow['1']; ?> / 200 votes obtenus</p>
                    </div>
                    <p>Votez pour ce projet et contribuez à sa concrétisation !</p>
                    <p> <?php echo $retour; ?> </p>
                    <?php
                      if($UtilisateurCourantIDRole == 0){}

                      else{
                        ?>
                         <form name="voteInterface" action="event.php" method="post" id="voteForm">
                                         <label for="pointsToGive">Je donne</label>
                                         <input type="number" max="points restants user" min=1 name="pointsToGive"/>
                                         <label for="pointsToGive">points</label>
                                         <input class="roundCornerLink" type="submit" name="action" value="Valider"/> <br/>
                         </form>
                    <?php
                      }


                    ?>
                </div>
            </section>
            <div id="eventDescriptionAndBonusIdeas">
                <section id="description">
                    <p> <?php echo $dbRow['5']; ?> </p>
                </section>
                <section id="bonusIdeas">
                    <ul>
                        <li>
                            <p>
                                120 votes :
                            </p>
                        </li>
                        <li>
                            <p>
                                150 votes :
                            </p>
                        </li>
                        <li>
                            <p>
                                200 votes :
                            </p>
                        </li>
                    </ul>
                </section>
            </div>
          <!--  <a href="../Accueil/ViewAccueil.php">Retour a la page principale</a>  --> 

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

<?php $content = ob_get_clean();
      #require 'template.php';
      require(__DIR__.'/../template.php');
?>
