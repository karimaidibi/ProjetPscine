<?php
ini_set('display_errors', 'on'); 

    echo '<!--Label pour laffichage des ingrédients-->
        <div class=" container mt-5 bg-dark bg-gradient" align=center style="color:whitesmoke;">
        <p class="fs-5"> Liste des ingrédients </p>
        </div>
        <!--Barre de recherche dingrédents et boutton ajouter un ingrédient-->
        <div class="container-fluid pt-4">
        <div class="row rows-cols-3">
            <!--premiére colonne-->
            <div class="col-5">
                <!---- Barre de recherche pour les ingrédients qui peuvent êtres recherchez par nom et catégorie-->
                <div class="container d-inline-flex bd-highlight">
                    <div class="flex-shrink-0 mt-1">
                            <i class="bi bi-search"></i>
                    </div>
                    <div class="flex-fill ms-3 ">
                        <select class="form-select btn btn-dark  bg-gradient" type="button" id="chercherpar" >
                            <option selected >Chercher par : </option>
                            <option>Nom Ingredient</option>
                            <option>Categorie</option>
                            <option>Unite</option>
                            <option>Type allergene</option>
                            <option>PrixUnitaire</option>
                            <option>TVA</option>
                        </select>
                        <input class="form-control" list="datalistOptions" placeholder="Chercher un ingrédient..." type="text" id="chercherIngredient" onkeyup="recherche()">
                        <datalist id="datalistOptions">
                            <option value="">
                        </datalist> 
                    </div>                   
                </div>
            </div>
            <!--deuxieme colonne-->
            <div class="col-3">
                <!--- Bouton pour trier les ingrédients par ordre alphabétique croissant/décroissant ou par catégorie-->
                <div class="dropdown">
                    <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-sort-alpha-down"></i>
                    Trier par
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                    <li><button class="dropdown-item" type="button">a--z</button></li>
                    <li><button class="dropdown-item" type="button">z--a</button></li>
                    </ul>
                </div>
            </div>
            <!--3eme colonne-->
            <div class="col-4">
                <button type="button" class="btn btn-dark">
                    <a href="index.php?controller=Ingredient&action=update" style="color:white; text-decoration:none">
                    <i class="bi bi-plus-square"></i>
                    Ajouter un ingrédient
                    </a>
                </button>
            </div>
        </div>
        </div>

        <div class="container-fluid pt-5 ps-5 pe-5">
        <!--Tableau qui contient les ingrédients triés-->
        <table class="table table-striped table-hover align-middle" id="TableIngredient">
            <thead class = "table-dark">
            <tr>
                <th scope="col">Nom</th>
                <th scope="col">Catégorie</th>
                <th scope="col">Unité</th>
                <th scope="col">Type d\'allergène</th>
                <th scope="col">Prix Unitaire <em>(en €)</em></th>
                <th scope="col">TVA</th>
                <th scope ="col">Stock</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>';
    foreach ($tab_u as $u)
    {
        $NumIngredient = $u->getNumIngredient();
        $NomIng = $u->getNomIng();
        $PrixUnitaire = $u->getPrixUnitaireIng();
        $QuantiteStock = $u->getQteStockIngredient();
        $FK_NumUnite = $u->getFK_NumUnite();
        $FK_NumAllergene = $u->getFK_NumAllergene();
        $FK_CodeTVA = $u->getFK_CodeTVA();
        $FK_NumCategorie = $u->getFK_NumCategorie();

        $Unite = ModelUnite::select($FK_NumUnite)->getNomUnite();
        $TVA = ModelTVA::select($FK_CodeTVA)->getCoefTVA();
        if($FK_NumAllergene==NULL) {
            $Allergene = "";
        } else {
            $Allergene = ModelAllergene::select($FK_NumAllergene)->getNomAllergene();
        }
        if($FK_NumCategorie==NULL) {
            $Categorie = "";
        } else {
            $Categorie = ModelCategorie_Ingredient::select($FK_NumCategorie)->getNomCategorie();
        }

      echo '<tr>
                <td>' .$NomIng. '</td>
                <td>' .$Categorie. '</td>
                <td>' .$Unite. '</td>
                <td >'.$Allergene.'</td>
                <td>' .$PrixUnitaire. '</td>
                <td>' .$TVA*100 .'%</td>
                <td>
            <!-- Boutons stock -->
                    <div class="input-group pt-2">
                        <button type="button" class="btn btn-danger">
                            <i class="bi bi-dash-square"></i>
                        </button>
                        <input type="number" style="width: 12.5%;" value="'.$QuantiteStock.'">
                        <button type="button" class="btn btn-primary me-2">
                            <i class="bi bi-plus-square"></i>
                        </button>
                        <!--Boutons modifier et supprimer-->
                        <div class="d-grid gap-2 d-md-block">
                            <button class="btn btn-success" type="button">
                                <a href="index.php?controller=Ingredient&action=update&NumIngredient=' . $NumIngredient . '">
                                <i class="bi bi-pencil" style="font-size: 1rem; color:black;" ></i>
                                </a>
                            </button>
                            <button class="btn btn-danger" type="button">
                                <a href="index.php?controller=Ingredient&action=delete&NumIngredient=' . $NumIngredient . ' ">
                                <i class="bi bi-trash" style="font-size: 1rem; color:black;" ></i>
                                </a>  
                            </button>
                        </div>
                    </div>
                </td>
            </tr>';
    }

    echo '            
            </tbody>
        </table>
        </div> ';

?>

<script src="../../../javascript/AffichageIngredient.js"></script>