<!DOCTYPE html>
<?php
    
?>
<html>
    <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <title>Restaurant du chef</title>
  </head>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Restaurant du chef</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <!--Division pour centrer la nav-->
            <div class ="mx-auto">
              <!-- Division qui contient les elements de navigations-->
              <div class="navbar-nav">
                <!-- div qui contient les margin-->
                <div class ="me-5 mt-2 mb-3 ">
                  <!-- Division qui contient le flex et définit son shadow-->
                  <div class="d-inline-flex p-2 bd-highlight shadow p-3 rounded"> <p class="fs-4"> <a class="nav-link" href="#">Ingrédients</a> </p> </div>
                </div>
                <!-- div qui contient les margin-->
                <div class="mb-3">
                  <!-- Division qui contient le flex et définit son shadow-->
                  <div class="d-inline-flex p-2 bd-highlight shadow p-3 rounded rounded-pill"> <p class ="fs-2"> <a class="nav-link active" aria-current="page" href="#">Accueil</a> </p> </div>
                </div>
                <!-- div qui contient les margin-->
                <div class ="ms-5 mt-2 mb-3">
                  <!-- Division qui contient le flex et définit son shadow-->
                  <div class ="d-inline-flex p-2 bd-highlight shadow p-3 rounded"> <p class="fs-4"> <a class="nav-link" href="index.php?controller=ficheTechnique&action=readAll">Fiches techniques</a> </p> </div>
                </div>     
              </div>
            </div>
          </div>
        </div>
      </nav>
    <body>
        <header>
            <div class="header_container">
                <div id="header_presentation">
                    <div id="header_profil">
                    </div>
                    <div id="header_bouton">
                        <a href='?action=afficher&controller=panier'><img id="image_header" src="../img/panier.png" alt=""></a>;
                    </div>
                </div>
                <nav>
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