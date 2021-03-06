
<?php
//echo $_COOKIE['TabFiches'];
//echo $_COOKIE['TabProgressions'];
//echo $_COOKIE['TabIng'];
echo 

    '
    <div class="container bg-body bg-gradient border border-dark mt-5 rounded border-1 shadow-lg">
    <div class=" container bg-dark bg-gradient" align=center style="color:whitesmoke;">
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
                <th scope="col"><a href="index.php?controller=Categorie_Fiche&action=readAll">Catégorie</a></th>
                <th scope="col"><a href="index.php?controller=CoeffAss&action=readAll">Coeff ASS</a></th>
                <th scope="col"><a href="index.php?controller=CoeffCoutPersonnel&action=readAll">Coeff Cout Personnel</a></th>
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
    $CodeCoeffAss = $u ->getFK_CodeCoeffAss();
    $CodeCoeffCoutPersonnel = $u ->getFK_CodeCoeffCoutPersonnel();

    $categorieFiche = ModelCategorie_Fiche::select($NumCategorieFiche);
    if(!empty($categorieFiche)){
        $NomCategorieFiche =  $categorieFiche -> getNomCatFiche(); //une ligne = objet
    }else{
        $NomCategorieFiche = "pas de catégorie";
    }
    
    //objet CoefficientsAss
    $coeffAss = ModelCoeffAss::select($CodeCoeffAss);
    if(!empty($coeffAss)){
        $valeurCoeffAss = $coeffAss -> getvaleurCoeffAss();
    }else{
        $valeurCoeffAss = 0;
    }
    //objet coefficnets Cout personnel 
    $coeffCoutPersonnel = ModelCoeffCoutPersonnel::select($CodeCoeffCoutPersonnel);
    if(!empty($coeffCoutPersonnel)){
        $valeurCoeffCoutPersonnel = $coeffCoutPersonnel -> getvaleurCoeffCoutPersonnel();
    }else{
        $valeurCoeffCoutPersonnel = 0;
    }


  
        echo '<tr>
                <td>'.$NomFiche.'</td>
                <td>'.$NbreCouverts.'</td>
                <td>'. $NomAuteur.'</td>
                <td>'. $NomCategorieFiche.'</td>
                <td>'. $valeurCoeffAss.'</td>
                <td>'. $valeurCoeffCoutPersonnel.'</td>
                <td>
                    <div class="d-grid gap-2 d-md-block">
                        <button class="btn btn-success" type="button">
                            <a href="index.php?controller=ficheTechnique&action=update&NumeroFiche=' . $NumeroFiche . '">
                            <i class="bi bi-pencil" style="font-size: 1rem; color:white;" ></i>
                            </a>
                        </button>
                        <button class="btn btn-danger" type="button">
                            <a href="index.php?controller=ficheTechnique&action=delete&NumeroFiche=' . $NumeroFiche . ' ">
                            <i class="bi bi-trash" style="font-size: 1rem; color:white;" ></i>
                            </a>                    
                        </button>
                        <button class="btn btn-primary" type="button">
                        <a href="index.php?controller=ficheTechnique&action=apercu&NumeroFiche=' . $NumeroFiche . ' ">
                            <i class="bi bi-eye" style="font-size: 1rem; color:white;" ></i>    
                        </a>                
                        </button>
                        <button type="button" class="btn btn-warning me-2 mt-1" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
                            <i class="bi bi-file-earmark-arrow-down" style="font-size: 1rem; color:black;"></i>
                            Utiliser cette fiche 
                        </button>
                        <!---- canvas from the right---->
                        <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
                             <div class="offcanvas-header">
                                 <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Utiliser cette fiche</h5>
                                 <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                             </div>
                             <div class="offcanvas-body">
                                 <p>Si vous utilisez cette fiche, les quantités des ingrédients qui sont utilsés dans cette fiche vont etre décrémentées des quantités de stock globaux :  </p>
                                 <!--table dingrédient-->
                                 <table class="table table-striped w-auto">
                                 <thead class = "table-light">
                                     <tr>
                                         <th scope="col">Nom</th>
                                         <th scope="col">Qte utilisé</th>
                                         <th scope="col">Stock avant</th>
                                         <th scope="col">Stock après</th>
                                     </tr>
                                 </thead>
                                 <tbody>';
                                 $Ingredients = ModelFicheTechnique::selectIngredientsOf($NumeroFiche);
                                 if(!empty($Ingredients)){
                                     foreach($Ingredients as $Ing){
                                    $StockFinal = $Ing["QteStockIngredient"] - $Ing["QuantiteIngredient"];
                                    if($StockFinal<0){
                                        $StockFinal = 0;
                                    }
                                 echo '
                                         <tr>
                                             <td>' .$Ing["NomIng"]. '</td>
                                             <td>' .$Ing["QuantiteIngredient"]. '</td>
                                             <td>' .$Ing["QteStockIngredient"]. '</td>
                                             <td>' .$StockFinal. '</td>
                                         </tr>';
                                         
                                     }//fin for
                                 }
                             echo '
                                 </tbody>
                                 </table>
                                 <button class="btn btn-danger" type="button">
                                    <a href="index.php?controller=ficheTechnique&action=gererStock&NumeroFiche=' . $NumeroFiche . ' " style="color:white; text-decoration:none">
                                        Confirmer
                                    </a>                    
                                </button>
                             </div>
                         </div>
                         <!-- FIN CANVASSS-->
                    </div>
                </td>
            </tr>';
}
    echo '</tbody>
        </table>
        </div>
        </div>';
?>

<script src="../../../javascript/AffichageFiches.js"></script>