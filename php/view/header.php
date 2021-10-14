    <!---------------------- The navigation bar---------------------->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-gradient">
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
            </div>
          </div>
        </div>
      </div>
    </nav>