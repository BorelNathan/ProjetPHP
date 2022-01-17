<?php $title='Page d\'accueil '?>

<?php ob_start(); ?>
<header>
  <img id="logo" src="logo.svg" alt="logo de E-Event.IO" />';

<?php if($UtilisateurCourantIDRole == 0){ ?>
        <section class="connection" id="notConnected">
  				<p>Vous n\'êtes pas connecté</p>
  				<ul>
            <form id="login" action="/" method="post">
                <input type="hidden" name="action" value="login"/>
            </form>
            <li><a href='#' onclick='document.getElementById("login").submit()'>Se connecter</a></li>
            <form id="SignIn" action="/" method="post">
                <input type="hidden" name="action" value="SignIn"/>
            </form>
            <li><a href='#' onclick='document.getElementById("SignIn").submit()'>S'inscrire</a></li>
  				</ul>
        </section>
        </header>
    <?php }
    else{ ?>
        <section class="connection" id="connected">
        <p> Connecté en tant que '<?php echo $UtilisateurCourantNom; ?>'</p>
  				<ul>
            <form id="MySpace" action="/" method="post">
                <input type="hidden" name="action" value="UserPage"/>
            </form>
  					<li><a href='#' onclick='document.getElementById("MySpace").submit()'>Mon espace</a></li>
            <form id="Deco" action="/" method="post">
                <input type="hidden" name="action" value="Deconnexion"/>
            </form>
            <li><a href='#' onclick='document.getElementById("Deco").submit()' id="logoutli"><img id="logout" src="logout.svg" alt="se d�connecter" /></a></li>
  				</ul>
  </header>
<?php } ?>
<?php $content = ob_get_clean(); ?>

<?php require('View/template.php')?>
