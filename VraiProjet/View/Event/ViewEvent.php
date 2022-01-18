<?php
      $titre = $_GET['Event'];
      $title = htmlspecialchars($titre);

      $dbLink = mysqli_connect('mysql-e-eventio.alwaysdata.net', 'e-eventio_login', 'php123456$') or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
      mysqli_select_db($dbLink , 'e-eventio_sql') or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));
      $query = "SELECT * FROM event WHERE titre = '" . $title . "'";
      $dbResult = mysqli_query($dbLink, $query);
      $dbRow = mysqli_fetch_row($dbResult);



      ob_start();
?>

	<header>
			<img id="logo" src="../../resources/images/logo.svg" alt="logo de E-Event.IO" />
			<!--
			<section class="connection" id="notConnected">
				<p>Vous n'êtes pas connecté</p>
				<ul>
					<li><div class="split"></div></li>
					<li><a href="login.php">se connecter</a></li>
					<li><a href= "Inscription.php" />s'inscrire</a></li>
				</ul>
			</section> -->
			<section class="connection" id="connected">
				<ul>
					<li><div class="split"></div></li>
					<li><a class="roundCornerLink" href="userPage.php">Mon espace</a></li>
					<li><a class="roundCornerLink" href="logout.php" id="logoutli"><img id="logout" src="logout.svg" alt="se déconnecter" /></a></li>
				</ul>
			</section>
		</header>
		<main>
            <section id="eventImageAndVotes">
                <img src="../../resources/images/thumbnail/ <?php ?> .jpg" alt="image">
                <div>
                    <h1>
                    <?php
                    #echo htmlspecialchars($titre);
                    echo $dbRow['4'];
                    ?>
                    </h1>
                    <div>
                        <div id="progressBar">
                            <div style="width: <?php echo $dbRow['1']; ?>%;">
                            </div>
                        </div>
                        <p><?php echo $dbRow['1']; ?> / 100 votes obtenus</p>
                    </div>
                    <p>Votez pour ce projet et contribuez à sa concrétisation !</p>
                    <?php
                          require_once 'utils.inc.php';
                          $filtre = filterUsers('1');
                          if($filtre == 1){

                              echo '<form name="voteInterface" action="event.php" method="get" id="voteForm">
                                        <label for="pointsToGive">Je donne</label>
                                        <input type="number" max="points restants user" name="pointsToGive"/>
                                        <label for="pointsToGive">points</label>
                                        <button class="roundCornerLink" type="submit" form="voteInterface" value="">Voter</button>
                                    </form>';
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
      require 'template.php';
      #require('View/template.php');
?>
