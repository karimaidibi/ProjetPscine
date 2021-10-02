<!DOCTYPE html>
<?php
    
    require_once File::build_path(array("model", "ModelCategorie.php"));
    require_once File::build_path(array("lib", "Session.php"));
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/style_general.css">
        <link rel="stylesheet" type="text/css" href="../css/the.css">
        <link rel="stylesheet" type="text/css" href="../css/connexion.css">
        <link rel="stylesheet" type="text/css" href="../css/inscription.css">
        <link rel="stylesheet" type="text/css" href="../css/panier.css">
        <link rel="stylesheet" type="text/css" href="../css/detail.css">
        <link rel="stylesheet" type="text/css" href="../css/commande.css">

        <title><?php echo $pagetitle; ?></title>
    </head>
    <body>
        <header>
            <div class="header_container">
                <div id="header_presentation">
                    <div id="header_profil">
                        <nav>
                            <h3><a href='?action=create&controller=utilisateur'>Inscription</a></h3>";
        					<?php
        					if(Session::is_admin()){
        						echo '<h3><a href="index.php?action=readAll&controller=utilisateur">Accueil Utilisateur</a></h3>';
        					}
            				if(empty(($_SESSION['mdp']))){
                				if($view!='connect'){
                    				echo"<h3><a href='?action=connect&controller=utilisateur'>Connexion</a></h3>";
                				}
            				}
            				else{
            					echo '<a href="?action=read&controller=utilisateur&login='.$_SESSION['login'].'"><img id="image_header" src="../img/profil.png" alt=""></a>';
                				echo "<h3><a href='?action=deconnect&controller=utilisateur'>Se déconnecter</a></h3>";
            				}
            				?>
        				</nav>
                    </div>
                    <div id="header_titre">
                        <h1>Au paradis du thé</h1>
                    </div>
                    <div id="header_bouton">
                        <a href='?action=afficher&controller=panier'><img id="image_header" src="../img/panier.png" alt=""></a>;
                    </div>
                </div>
                <nav>
                    <div id="menu1">
                        <div><a href="index.php?action=readAll">Produits</a></div>
                        <div><a >Catégorie de produits</a>
                        <ul>
                        <?php
	                        $tab_option = ModelCategorie::selectAll();
	                        foreach ($tab_option as $o){
	                            echo('<li><a href="index.php?controller=produit&action=choixCategorie&idCategorie='.$o->getIdCategorie().'">'.htmlspecialchars($o->getNomCategorie()).'</a></li>');
	                        }
                    	?>
                        </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </header>
        <main>
            <div id="main_sans_aside">
                <?php
                $filepath = File::build_path(array("view", static::$object , "$view.php"));
                require $filepath;
                ?>
            </div>
        </main>
    </body>
    <footer>
    	<p style="border: 1px solid black;text-align:center;padding-right:1em;">
  		Les thés du monde
		</p>
	</footer>
</html>