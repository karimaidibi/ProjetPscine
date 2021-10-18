<?php

if($type=='readonly'){
    $NomIng = $ingredient->getNomIng();
    $prixUnitaireIng = $ingredient->getPrixUnitaireIng();
    $QteStockIngredient = $ingredient->getQteStockIngredient();
    $FK_NumUnite = $ingredient->getFK_NumUnite();
    $FK_NumAllergene = $ingredient->getFK_NumAllergene();
    $FK_CodeTVA = $ingredient->getFK_CodeTVA();
    $FK_NumCategorie = $ingredient->getFK_NumCategorie();
}
    echo'
            <!--Titre ajout et modification dun ingrédient -->
            <div class="container mt-5 bg-dark bg-gradient" align=center>
            <p class="fs-2" style="color:white;"> Ajout ou modification dun ingrédient </p>
            </div>
            <!-- Formulaire pour lajout et/ou la modification dun ingrédient-->
            <div class="container-fluid mt-5 ps-4 pe-3 bg-light bg-gradient">
            <form>
                <!--Liste dinput des caractéristiques de lingrédient-->
                <div class="row row-cols-2 justify-content-around pt-4">
                    <!-- liste dinput présents sur la même colonne-->
                    <div class="col-6 bg-dark" >
                        <ul class="list-group list-group-flush">
                            <!-- Input Nom -->
                            <li class="list-group-item list-group-item-dark">
                                <!-- Ligne contenant deux colonnes  -->
                                <div class="row g-2 align-items-center">
                                    <!-- première sous colonne -->
                                    <div class="col-auto">
                                        <label for="NumIngredient_id" class="col-form-label">
                                        Nom de l\'ingrédient :
                                        </label>
                                    </div>
                                    <!-- Deuxième sous colonne -->
                                    <div class="col-auto">';
                                    if($type=='readonly'){
                                        echo '<input type="hidden" id="NumIngredient_id" name="NumIngredient" class="form-control" value="'. $NumIngredient . '" required/>';
                                        echo '<input type="text" id="NomIng_id" name="NomIng" class="form-control" value="' . $NomIng . '">';
                                    }
                                    else{
                                        echo '<input type="text" id="NomIng_id" name="NomIng" class="form-control" placeholder="Ajouter un text..." required/>';
                                    }
                                    echo '</div>
                                </div>
                            </li>
                            <!-- Input Unité de lingrédient-->
                            <li class="list-group-item">
                                <!-- Ligne dans la colonne -->
                                <div class="row g-2 align-items-center">
                                    <!-- Première sous colonne -->
                                    <div class="col-auto">
                                        <label for="FK_NumUnite_id" class="col-form-label">
                                            Unité :
                                        </label>
                                    </div>
                                    <!-- Deuxième sous colonne -->
                                    <div class="col-auto">
                                        <select name="FK_NumUnite" id="FK_NumUnite_id">
                                            <option value="">--Choisissez une unité--</option>';
                                        if($type=='readonly'){
                                            foreach($liste_unite as $unite){
                                                $NumeroUnite = $unite->getNumUnite();
                                                $NomUnite = $unite->getNomUnite();
                                                if($NumeroUnite==$FK_NumUnite){
                                                    echo '<option selected value="'. $NumeroUnite .'">'. $NomUnite .'</option>';
                                                }
                                                else {
                                                    echo '<option value="'. $NumeroUnite .'">'. $NomUnite .'</option>';
                                                }
                                            }
                                        }
                                        else {
                                            foreach ($liste_unite as $unite) {
                                                $NumeroUnite = $unite->getNumUnite();
                                                $NomUnite = $unite->getNomUnite();
                                                echo '<option value="'. $NumeroUnite .'">'. $NomUnite .'</option>';
                                            }
                                        }
                                        echo '</select>
                                    </div>
                                </div>   
                            </li>
                            <!-- Input Prix Unitaire-->
                            <li class="list-group-item list-group-item-dark">
                                <!-- Ligne dans la liste, contenante deux colonnes, une label et un input--->
                                <div class="row g-2 align-items-center">
                                <!-- première sous colonne -->
                                <div class="col-auto">
                                    <label for="prixUnitaireIng_id" class="col-form-label">
                                    Prix Unitaire <small class="text-muted"><em>(€)</em></small> : 
                                    </label>
                                </div>
                                <!-- Deuxième sous colonne -->
                                <div class="col-auto">';
                                if($type=='readonly'){
                                    echo '<input type="text" id="prixUnitaireIng_id" name="prixUnitaireIng" class="form-control" value="' . $prixUnitaireIng . '">';
                                }
                                else{
                                    echo '<input type="number" id="prixUnitaireIng_id" name="prixUnitaireIng" class="form-control" placeholder="Ajouter un nombre..." required/>';
                                }
                                echo '</div>
                                </div>
                            </li>
                            <!-- Input Catégorie de lingrédient-->
                            <li class="list-group-item">
                                <!-- Ligne contenant deux colonnes, un label et un input -->
                                <div class="row g-2 align-items-center">
                                <!-- première sous colonne -->
                                <div class="col-auto">
                                    <label for="FK_NumCategorie_id" class="col-form-label">
                                    Catégorie de l\'ingrédient : 
                                    </label>
                                </div>
                                <!-- Deuxième sous colonne -->
                                <div class="col-auto">
                                <select name="FK_NumCategorie" id="FK_NumCategorie_id">
                                    <option value="">--Choisissez une catégorie--</option>';
                                if($type=='readonly'){
                                    foreach ($liste_categorie as $categorie) {
                                        $NumeroCategorie = $categorie->getNumCategorie();
                                        $NomCategorie = $categorie->getNomCategorie();
                                        if($NumeroCategorie==$FK_NumCategorie){
                                            echo '<option selected value="'. $NumeroCategorie .'">'. $NomCategorie .'</option>';
                                        }
                                        else {
                                            echo '<option value="'. $NumeroCategorie .'">'. $NomCategorie .'</option>';
                                        }
                                    }
                                }
                                else {
                                    foreach ($liste_categorie as $categorie) {
                                        $NumeroCategorie = $categorie->getNumCategorie();
                                        $NomCategorie = $categorie->getNomCategorie();
                                        echo '<option value="'. $NumeroCategorie .'">'. $NomCategorie .'</option>';
                                    }
                                }
                                    echo '</select>
                                </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- Liste dinput des caractéristiques des ingrédients-->
                    <div class="col-6">
                        <ul class="list-group list-group-flush">
                            <!-- input Quantité présente dans le stock -->
                            <li class="list-group-item list-group-item-dark">
                                <!-- Ligne contenant deux colonnes, un label et un input -->
                                <div class="row g-2 align-items-center">
                                    <!-- première sous colonne -->
                                    <div class="col-auto">
                                    <label for="QteStockIngredient_id" class="col-form-label">
                                        Quantitée présente en stock : 
                                    </label>
                                    </div>
                                    <!-- Deuxième sous colonne -->
                                    <div class="col-auto">';
                                    if($type=='readonly'){
                                        echo '<input type="text" id="QteStockIngredient_id" name="QteStockIngredient" class="form-control" value="' . $QteStockIngredient . '">';
                                    }
                                    else{
                                        echo '<input type="number" id="QteStockIngredient_id" name="QteStockIngredient" class="form-control" placeholder="Ajouter un nombre...">';
                                    }
                                    echo '</div>
                                </div>  
                            </li>
                            <!--input correspondant à la TVA-->
                            <li class="list-group-item">
                                <!-- Ligne contenante deux colonnes, un label et un input -->
                                <div class="row g-2 align-items-center">
                                    <!-- première sous colonne -->
                                    <div class="col-auto">
                                    <label for="FK_CodeTVA_id" class="col-form-label">
                                        TVA : 
                                    </label>
                                    </div>
                                    <!-- Deuxième sous colonne -->
                                    <div class="col-auto">
                                    <select name="FK_CodeTVA" id="FK_CodeTVA_id">
                                        <option value="">--Choisissez une TVA--</option>';
                                    if($type=='readonly'){
                                        foreach ($liste_TVA as $TVA) {
                                            $NumeroTVA = $TVA->getCodeTVA();
                                            $NomTVA = $TVA->getNomTVA();
                                            $CoefTVA = $TVA->getCoefTVA();
                                            if($NumeroTVA==$FK_CodeTVA) {
                                                echo '<option selected value="'. $NumeroTVA .'">'. $NomTVA .' ('. $CoefTVA*100 .'%)</option>';
                                            }
                                            else {
                                                echo '<option value="'. $NumeroTVA .'">'. $NomTVA .' ('. $CoefTVA*100 .'%)</option>';
                                            }
                                        } 
                                    }
                                    else {
                                        foreach ($liste_TVA as $TVA) {
                                            $NumeroTVA = $TVA->getCodeTVA();
                                            $NomTVA = $TVA->getNomTVA();
                                            $CoefTVA = $TVA->getCoefTVA();
                                            echo '<option value="'. $NumeroTVA .'">'. $NomTVA .' ('. $CoefTVA*100 .'%)</option>';
                                        }
                                    }
                                        echo '</select>
                                    </div>
                                </div> 
                            </li>
                            <!-- input Allergène -->
                            <li class="list-group-item list-group-item-dark">
                                <!-- Ligne contenante deux colonnes, un label et un input -->
                                <div class="row g-2 align-items-center">
                                    <!-- première sous colonne -->
                                    <div class="col-auto">
                                    <label for="AllergeneOUIouNON" class="col-form-label">
                                        Allergène : 
                                    </label>
                                    </div>
                                    <!-- Deuxième sous colonne -->
                                    <div class="col-auto">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                        <label class="form-check-label" for="inlineRadio1">Oui</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                        <label class="form-check-label" for="inlineRadio2">Non</label>
                                        </div>           
                                    </div>
                                </div> 
                            </li>
                            <!--input pour le type dallergène si il a été indiqué que lingrédient été un allergène-->
                            <li class="list-group-item">
                                <!-- Ligne contenante deux colonnes, un label et un input -->
                                <div class="row g-2 align-items-center">
                                    <!-- première sous colonne -->
                                    <div class="col-auto">
                                    <label for="FK_NumAllergene" class="col-form-label">
                                        <em><small class="text-muted">(si allergène, veuillez renseigner son type)</em></small> Type d\'allergène  : 
                                    </label>
                                    </div>
                                    <!-- Deuxième sous colonne -->
                                    <div class="col-auto">
                                    <select name="FK_NumAllergene" id="FK_NumAllergene_id">
                                        <option value="">--Choisissez un allergène--</option>';
                                    if($type=='readonly'){
                                        foreach ($liste_allergene as $allergene) {
                                            $NumeroAllergene = $allergene->getNumAllergene();
                                            $NomAllergene = $allergene->getNomAllergene();
                                            if($NumeroAllergene==$FK_NumAllergene){
                                                echo '<option selected value="'. $NumeroAllergene .'">'. $NomAllergene .'</option>';
                                            }
                                            else {
                                                echo '<option value="'. $NumeroAllergene .'">'. $NomAllergene .'</option>';
                                            }
                                        }
                                    }
                                    else {
                                        foreach ($liste_allergene as $allergene) {
                                            $NumeroAllergene = $allergene->getNumAllergene();
                                            $NomAllergene = $allergene->getNomAllergene();
                                            echo '<option value="'. $NumeroAllergene .'">'. $NomAllergene .'</option>';
                                        }
                                    }
                                        echo '</select>
                                    </div>
                                </div> 
                            </li>
                        </ul>
                    </div>
                </div>
                <!--Validation du formulmaire et donc de l\'ajout de l\'ingrédient-->
                <div class="mt-3 mb-5 " align=center>
                    <button class="btn btn-dark" type="button">
                    <i class="bi bi-cloud-arrow-up-fill"></i>
                    <input type="hidden" name="controller" value="Ingredient">';
                    
                    if($type=='readonly'){
                        echo '<input type="hidden" name="action" value="updated">';
                        echo '<input class="btn btn-dark" type="submit" value="Modifier l\'ingrédient" />';
                    } else {
                        echo '<input type="hidden" name="action" value="created">';
                        echo '<input class="btn btn-dark" type="submit" value="Créer l\'ingrédient" />';
                    }

                    echo '</button>
                    </div>
            </form>
            </div>';

?>