<?php
ini_set('display_errors', 'on'); 

    echo '<!--Label pour laffichage des ingrédients-->
    <div class="container bg-light bg-gradient border border-dark mt-5">
        <div class=" container-fluid bg-dark bg-gradient" align=center style="color:whitesmoke;">
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
                        <div class="input-group">
                            <select class="form-select btn btn-dark" type="button" id="chercherpar" >
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
                    <li><button class="dropdown-item" type="button" onclick="TrierNomAZ()">a--z</button></li>
                    <li><button class="dropdown-item" type="button" onclick="TrierNomZA()">z--a</button></li>
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
                <th scope="col"><a href="index.php?controller=categorie_Ingredient&action=readAll">Catégorie</a></th>
                <th scope="col"><a href="index.php?controller=Unite&action=readAll">Unite</a></th>
                <th scope="col"><a href="index.php?controller=Allergene&action=readAll">Type d\'allergène</a></th>
                <th scope="col">Prix Unitaire <em>(en €)</em></th>
                <th scope="col"><a href="index.php?controller=TVA&action=readAll">TVA</a></th>
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

        $objetUnite = ModelUnite::select($FK_NumUnite);
        if(empty($objetUnite)){
            $Unite = "pas d'unité";
        }else{
            $Unite = $objetUnite->getNomUnite();
        }
        
        $objTVA = ModelTVA::select($FK_CodeTVA);
        if(empty($objTVA)){
             $TVA= "pas de TVA";
        }else{
            $TVA = $objTVA ->getCoefTVA();
        }
        $Allergene = ModelAllergene::select($FK_NumAllergene);
        if(empty($Allergene)){
            $NomAllergene = "Non allergène";
        } else {
            $NomAllergene = $Allergene->getNomAllergene();
        }
        $Categorie = ModelCategorie_Ingredient::select($FK_NumCategorie);
        if(empty($Categorie)) {
            $NomCategorie = "pas de catégorie";
        } else {
            $NomCategorie = $Categorie ->getNomCategorie();
        }

      echo '<tr>
                <td>' .$NomIng. '</td>';
            if(empty($Categorie)){
                echo '<td  class="text-muted"><em>'.$NomCategorie.'</em></td>';
            }else{
                echo '<td >'.$NomCategorie.'</td>';
            }     
            echo '
                <td>' .$Unite. '</td>';
            if(empty($Allergene)){
                echo '<td  class="text-muted"><em>'.$NomAllergene.'</em></td>';
                }else{
                    echo '<td >'.$NomAllergene.'</td>';
                }
            echo '
                <td>' .$PrixUnitaire. '</td>';
                if(is_numeric($TVA)){
                    $TVApourc = $TVA*100;
                }else{
                    $TVApourc = $TVA;
                }
                echo '
                <td>' . $TVApourc.'%</td>
                <td>
            <!-- Boutons stock -->
                    <form>
                    <div class="input-group pt-2">
                        <input name="QteStockIngredient" type="number" style="width: 14%;" value="'.$QuantiteStock.'">
                        <input type="hidden" name="NumIngredient" value = "'.$NumIngredient.'">
                        <button type="submit" class="btn btn-primary me-2">
                            <input type="hidden" name="controller" value="Ingredient">
                            <input type="hidden" name="action" value="updateStock">
                            OK 
                        </button>
                    </form>
                        <!--Boutons modifier et supprimer-->
                        <div class="d-grid gap-2 d-md-block">
                            <button class="btn btn-success" type="button">
                                <a href="index.php?controller=Ingredient&action=update&NumIngredient=' . $NumIngredient . '">
                                <i class="bi bi-pencil" style="font-size: 1rem; color:white;" ></i>
                                </a>
                            </button>
                            <button class="btn btn-danger" type="button">
                                <a href="index.php?controller=Ingredient&action=delete&NumIngredient=' . $NumIngredient . ' ">
                                <i class="bi bi-trash" style="font-size: 1rem; color:white;" ></i>
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
        </div> 
    </div>';

?>

<script src="../../../javascript/AffichageIngredient.js"></script>