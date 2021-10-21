
<?php
//echo $_COOKIE['TabFiches'];
//echo $_COOKIE['TabProgressions'];
//echo $_COOKIE['TabIng'];
echo '<div class=" container mt-5 bg-dark bg-gradient" align=center style="color:whitesmoke;">
        <p class="fs-5"> Chercher par catégorie, par fiche ou par auteur ! </p>
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
                    <div class="flex-fill ms-3 ">
                        <div class="input-group">
                            <select class="form-select btn btn-dark" type="button" id="chercherpar" >
                                <option selected > Chercher par : </option>
                                <option>Nom fiche</option>
                                <option>Auteur</option>
                                <option>Categorie</option>
                                <option>Nombre de couverts</option>
                            </select>
                            <input class="form-control" list="datalistOptions" id="chercherFiche" onkeyup="recherche()" placeholder="Chercher..." type="text">
                            <datalist id="datalistOptions">
                                <option>
                            </datalist>
                        </div>
                    </div>                   
                </div>
            </div>
            <!--deuxieme colonne-->
            <div class="col-3">
                <!--- Bouton pour trier les fiches techniques-->
                <div class="dropdown">
                    <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-sort-alpha-down"></i>
                      Trier par
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                      <li><button class="dropdown-item" type="button" onClick="TrierNomAZ()" >a--z</button></li>
                      <li><button class="dropdown-item" type="button" onClick="TrierNomZA()" >z--a</button></li>
                    </ul>
                </div>
            </div>
            <!--3eme colonne colonne-->
            <div class="col-4">
                <button type="button" class="btn btn-dark">
                    <a href="index.php?controller=ficheTechnique&action=update" style="color:white; text-decoration:none">
                    <i class="bi bi-plus-square"></i>
                    Créer une ficher technique</a>
                </button>
            </div>
        </div>
      </div>



      <div class="container-fluid pt-5 ps-5 pe-5">
        <!------LA TABLE QUI CONTIENT LES FICHES TECHNIQUES--------->
        <table class="table table-striped table-hover align-middle " id="TableFiche">
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
    $NumCategorieFiche = $u->getFK_NumeroCatFiche();

    $categorieFiche = ModelCategorie_Fiche::select($NumCategorieFiche);
    if(!empty($categorieFiche)){
        $NomCategorieFiche =  $categorieFiche -> getNomCatFiche(); //une ligne = objet
    }else{
        $NomCategorieFiche = "pas de catégorie";
    }


  
        echo '<tr>
                <td>'.$NomFiche.'</td>
                <td>'.$NbreCouverts.'</td>
                <td>'. $NomAuteur.'</td>
                <td>'. $NomCategorieFiche.'</td>
                <td>
                    <div class="d-grid gap-2 d-md-block">
                        <button class="btn btn-success" type="button">
                            <a href="index.php?controller=ficheTechnique&action=update&NumeroFiche=' . $NumeroFiche . '">
                            <i class="bi bi-pencil" style="font-size: 1rem; color:black;" ></i>
                            </a>
                        </button>
                        <button class="btn btn-danger" type="button">
                            <a href="index.php?controller=ficheTechnique&action=delete&NumeroFiche=' . $NumeroFiche . ' ">
                            <i class="bi bi-trash" style="font-size: 1rem; color:black;" ></i>
                            </a>                    
                        </button>
                        <button class="btn btn-primary" type="button">
                        <a href="index.php?controller=ficheTechnique&action=apercu&NumeroFiche=' . $NumeroFiche . ' ">
                            <i class="bi bi-eye" style="font-size: 1rem; color:black;" ></i>    
                        </a>                
                        </button>
                    </div>
                </td>
            </tr>';
}
    echo '</tbody>
        </table>
        </div>';
?>

<script src="../../../javascript/AffichageFiches.js"></script>