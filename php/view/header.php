
<?php
  $Page = strtolower(myGet('controller'));
  //echo $Page;

    echo '
    <!---------------------- The navigation bar---------------------->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-gradient">
      <div class="container-fluid" style="height: 150px;">
        <a class="navbar-brand" href="#">
                  <!--Logo de notre site-->
            <div class="position-relative">
                <div class="ponslate-middle-y">
                    <div class="mt-3 ms-3" >
                        <img src="../html/view/img/restaura_logo1.png" class="rounded mx-auto d-block" alt="Logo de notre site" style="width:170px; height:170px;">
                    </div>
                </div>  
            </div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse ms-3" id="navbarNavAltMarkup">
          <!--Division pour centrer la nav-->
          <div class ="mx-auto">';
            if ($Page == 'acceuil' || empty($Page)){
              echo '
              <!-- Division qui contient les elements de navigations-->
              <div class="navbar-nav">
                <!-- div qui contient les margin-->
                <div class ="me-5 mt-2 mb-3 ">
                  <!-- Division qui contient le flex et définit son shadow-->
                  <div class="d-inline-flex p-2 bd-highlight shadow p-3 rounded"> <p class="fs-4"> <a class="nav-link" href="index.php?controller=ingredient&action=readAll">Ingrédients</a> </p> </div>
                </div>
                <!-- div qui contient les margin-->
                <div class="mb-3">
                  <!-- Division qui contient le flex et définit son shadow-->
                  <div class="d-inline-flex p-2 bd-highlight shadow p-3 rounded rounded-pill"> <p class ="fs-2"> <a class="nav-link active" aria-current="page" href="index.php?controller=Acceuil&action=readAll">Accueil</a> </p> </div>
                </div>
                <!-- div qui contient les margin-->
                <div class ="ms-5 mt-2 mb-3">
                  <!-- Division qui contient le flex et définit son shadow-->
                  <div class ="d-inline-flex p-2 bd-highlight shadow p-3 rounded"> <p class="fs-4"> <a class="nav-link" href="index.php?controller=ficheTechnique&action=readAll">Fiches techniques</a> </p> </div>
                </div>     
              </div>';
            }elseif($Page =='ingredient' || $Page=="categorie_ingredient" || $Page=="allergene" || $Page =="unite" || $Page=="tva"){
              echo '
              <!-- Division qui contient les elements de navigations-->
              <div class="navbar-nav">
                <!-- div qui contient les margin-->
                <div class ="me-5 mt-2 mb-3 ">
                  <!-- Division qui contient le flex et définit son shadow-->
                  <div class="d-inline-flex p-2 bd-highlight shadow p-3 rounded"> <p class="fs-4"><a class="nav-link" aria-current="page" href="index.php?controller=Acceuil&action=readAll">Accueil</a> </p> </div>
                </div>
                <!-- div qui contient les margin-->
                <div class="mb-3">
                  <!-- Division qui contient le flex et définit son shadow-->
                  <div class="d-inline-flex p-2 bd-highlight shadow p-3 rounded rounded-pill"> <p class ="fs-2"> <a class="nav-link active" href="index.php?controller=ingredient&action=readAll">Ingrédients</a> </p> </div>
                </div>
                <!-- div qui contient les margin-->
                <div class ="ms-5 mt-2 mb-3">
                  <!-- Division qui contient le flex et définit son shadow-->
                  <div class ="d-inline-flex p-2 bd-highlight shadow p-3 rounded"> <p class="fs-4"> <a class="nav-link" href="index.php?controller=ficheTechnique&action=readAll">Fiches techniques</a> </p> </div>
                </div>     
              </div>'; 
            }elseif($Page =='fichetechnique' || $Page =="coeffass" || $Page=="coeffcoutpersonnel" || $Page=="categorie_fiche"){
              echo '
              <!-- Division qui contient les elements de navigations-->
              <div class="navbar-nav">
                <!-- div qui contient les margin-->
                <div class ="me-5 mt-2 mb-3 ">
                  <!-- Division qui contient le flex et définit son shadow-->
                  <div class="d-inline-flex p-2 bd-highlight shadow p-3 rounded"> <p class="fs-4"><a class="nav-link" aria-current="page" href="index.php?controller=Acceuil&action=readAll">Accueil</a> </p> </div>
                </div>
                <!-- div qui contient les margin-->
                <div class="mb-3">
                  <!-- Division qui contient le flex et définit son shadow-->
                  <div class="d-inline-flex p-2 bd-highlight shadow p-3 rounded rounded-pill"> <p class ="fs-2"><a class="nav-link active" href="index.php?controller=ficheTechnique&action=readAll">Fiches techniques</a> </p> </div>
                </div>
                <!-- div qui contient les margin-->
                <div class ="ms-5 mt-2 mb-3">
                  <!-- Division qui contient le flex et définit son shadow-->
                  <div class ="d-inline-flex p-2 bd-highlight shadow p-3 rounded"> <p class="fs-4"><a class="nav-link" href="index.php?controller=ingredient&action=readAll">Ingrédients</a>   </p> </div>
                </div>     
              </div>'; 
            }
      echo '
          </div>
        </div>
        <a class="navbar-brand" href="#">
                  <!--Logo de notre site-->
            <div class="position-relative">
                <div class="ponslate-middle-y">
                    <div class="mt-3 me-4" >
                        <img src="../html/view/img/restaura_logo1.png" class="rounded mx-auto d-block" alt="Logo de notre site" style="width:170px; height:170px;">
                    </div>
                </div>  
            </div>
        </a>
      </div>
    </nav>

    ';
?>