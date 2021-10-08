<?php

echo '<div class=" container mt-5 bg-dark bg-gradient" align=center style="color:whitesmoke;">
        <p class="fs-5"> Chercher par catégorie, par fiche ou par ingrédient ! </p>
      </div>

      <!---La barre de recherche, trier les fiches et bouton ajouter une fiches-->
      <div class="container-fluid pt-4">
        <div class="row rows-cols-3">
            <!--premiére colonne-->
            <div class="col-5">
                <!---- Barre de recherche des fiches techniques 
                    - soit par nom de la fiche
                    - soit par catégorie 
                    - soit par nom de l auteur-->
                <div class="container d-inline-flex bd-highlight">
                    <div class="flex-shrink-0 mt-1">
                            <i class="bi bi-search"></i>
                    </div>
                    <div class="flex-grow-1 ms-3 ">
                        <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Chercher..." type="text">
                        <datalist id="datalistOptions">
                            <option value="choco framboise">
                            <option value="coeur choco">
                            <option value="malakoff">
                            <option value="arrancini pesto">
                            <option value="arrancini boeuf">
                        </datalist> 
                    </div>                   
                </div>
            </div>
            <!--deuxieme colonne-->
            <div class="col-3">
                <!--- Bouton pour trier les fiches d ingrédients-->
                <div class="dropdown">
                    <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-sort-alpha-down"></i>
                      Trier par
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                      <li><button class="dropdown-item" type="button">Catégorie</button></li>
                      <li><button class="dropdown-item" type="button">a--z</button></li>
                      <li><button class="dropdown-item" type="button">z--a</button></li>
                    </ul>
                  </div>
            </div>
            <!--3eme colonne colonne-->
            <div class="col-4">
                <button type="button" class="btn btn-dark">
                    <i class="bi bi-plus-square"></i>
                    Créer une ficher technique
                </button>
            </div>
        </div>
      </div>



      <div class="container-fluid pt-5 ps-5 pe-5">
        <!------LA TABLE QUI CONTIENT LES FICHES TECHNIQUES--------->
        <table class="table table-striped table-hover align-middle">
            <thead class = "table-dark">
            <tr>
                <th scope="col">NomFiche</th>
                <th scope="col">NbreCouverts</th>
                <th scope="col">NomAuteur</th>
                <th scope="col">Catégorie</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>';


foreach ($tab_u as $u)
{
    $NumeroFiche = $u->getNumeroFiche();
    $NomFiche = $u->getNomFiche();
    $NbreCouverts = $u->getNbreCouverts();
    $NomAuteur = $u->getNomAuteur();
    $CoutFluide = $u->getCoutFluide();
    
  

    echo '<tr>
        <td>'.$NomFiche.'</td>
        <td>'.$NbreCouverts.'</td>
        <td>'. $NomAuteur.'</td>
        <td>@mdo</td>
        <td>
            <div class="d-grid gap-2 d-md-block">
                <button class="btn btn-success" type="button">
                    <i class="bi bi-pencil" style="font-size: 1rem;" ></i>
                </button>
                <button class="btn btn-danger" type="button">
                    <i class="bi bi-trash" style="font-size: 1rem;" ></i>
                </button>
                <button class="btn btn-primary" type="button">
                    <i class="bi bi-eye" style="font-size: 1rem;" ></i>                        
                </button>
            </div>
        </td>
    </tr>';
}
echo "</tbody>
</table>
</div>";
?>