<?php
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
                                        <label for="inputIngredient" class="col-form-label">
                                        Nom de l\'ingrédient :
                                        </label>
                                    </div>
                                    <!-- Deuxième sous colonne -->
                                    <div class="col-auto">
                                        <input type="text" id="inputIngredient" class="form-control" placeholder="Ajouter un text...">                
                                    </div>
                                </div>
                            </li>
                            <!-- Input Unité de lingrédient-->
                            <li class="list-group-item">
                                <!-- Ligne dans la colonne -->
                                <div class="row g-2 align-items-center">
                                    <!-- Première sous colonne -->
                                    <div class="col-auto">
                                        <label for="inputUnite" class="col-form-label">
                                            Unité :
                                        </label>
                                    </div>
                                    <!-- Deuxième sous colonne -->
                                    <div class="col-auto">
                                        <input type="text" id="inputUnite" class="form-control" list="ListeDesUnites" placeholder="Chercher une unité...">
                                        <datalist id="ListeDesUnites">
                                            <option value="Kg (Kilos gramme)">
                                            <option value="L (Litre)">
                                            <option value="g (gramme)">
                                        </datalist>                 
                                    </div>
                                </div>   
                            </li>
                            <!-- Input Prix Unitaire-->
                            <li class="list-group-item list-group-item-dark">
                                <!-- Ligne dans la liste, contenante deux colonnes, une label et un input--->
                                <div class="row g-2 align-items-center">
                                <!-- première sous colonne -->
                                <div class="col-auto">
                                    <label for="inputPrixU" class="col-form-label">
                                    Prix Unitaire <small class="text-muted"><em>(€)</em></small> : 
                                    </label>
                                </div>
                                <!-- Deuxième sous colonne -->
                                <div class="col-auto">
                                    <input type="number" id="inputPrixU" class="form-control" placeholder="Ajouter un nombre...">                
                                </div>
                                </div>
                            </li>
                            <!-- Input Catégorie de lingrédient-->
                            <li class="list-group-item">
                                <!-- Ligne contenant deux colonnes, un label et un input -->
                                <div class="row g-2 align-items-center">
                                <!-- première sous colonne -->
                                <div class="col-auto">
                                    <label for="Categorie" class="col-form-label">
                                    Catégorie de l\'ingrédient : 
                                    </label>
                                </div>
                                <!-- Deuxième sous colonne -->
                                <div class="col-auto">
                                    <input type="text" id="Categorie" class="form-control" list="ListeDesCategories" placeholder="Chercher une catégorie...">
                                    <datalist id="ListeDesCategories">
                                    <option value="Viande">
                                    <option value="Poisson">
                                    <option value="Autre">
                                    </datalist>               
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
                                    <label for="Qtestock" class="col-form-label">
                                        Quantitée présente en stock : 
                                    </label>
                                    </div>
                                    <!-- Deuxième sous colonne -->
                                    <div class="col-auto">
                                    <input type="number" id="Qtestock" class="form-control" placeholder="Ajouter un nombre...">                
                                    </div>
                                </div>  
                            </li>
                            <!--input correspondant à la TVA-->
                            <li class="list-group-item">
                                <!-- Ligne contenante deux colonnes, un label et un input -->
                                <div class="row g-2 align-items-center">
                                    <!-- première sous colonne -->
                                    <div class="col-auto">
                                    <label for="TVA" class="col-form-label">
                                        TVA : 
                                    </label>
                                    </div>
                                    <!-- Deuxième sous colonne -->
                                    <div class="col-auto">
                                    <input type="number" id="TVA" class="form-control" list="ListeTVA" placeholder="Chercher une valeur...">
                                    <datalist id="ListeTVA">
                                        <option value="0.5">
                                        <option value="0.7">
                                        <option value="0.8">
                                    </datalist>               
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
                                    <label for="TypeAllergene" class="col-form-label">
                                        <em><small class="text-muted">(si allergène, veuillez renseigner son type)</em></small> Type d\'allergène  : 
                                    </label>
                                    </div>
                                    <!-- Deuxième sous colonne -->
                                    <div class="col-auto">
                                    <input type="text" id="TypeAllergene" class="form-control" list="ListeTypeAllergene" placeholder="Ajouter un type...">
                                    <datalist id="ListeTypeAllergene">
                                        <option value="Arachide">
                                        <option value="Fruit à coque">
                                        <option value="Protéine de lait de vache">
                                    </datalist>               
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
                    Ajouter l\'ingrédient 
                    </button>
                </div>
            </form>
            </div>';

?>