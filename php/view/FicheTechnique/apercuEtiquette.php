<?php

    $NomFiche = $cetteFiche -> getNomFiche();
    echo '
        <!--Bouton aperçu fiche avec prix, sans prix, ou etiquette -->
        <div class="container-fluid mt-5" align=center>
            <div class="dropdown">
                <button class="btn btn-dark dropdown-toggle" type="button" id="Aperçu" data-bs-toggle="dropdown" aria-expanded="false">
                Aperçu de la fiche technique
                </button>
                <ul class="dropdown-menu" aria-labelledby="Aperçu">
                    <li>
                        <a href="index.php?controller=ficheTechnique&action=apercu&NumeroFiche=' . myGet('NumeroFiche') . ' " style="color:white; text-decoration:none">                    
                            <button class="dropdown-item" type="button" >Fiche avec prix</button>
                        </a>
                    </li>
                    <li>
                        <a href="index.php?controller=ficheTechnique&action=apercuSP&NumeroFiche=' .$NumeroFiche . ' " style="color:white; text-decoration:none">
                            <button class="dropdown-item" type="button">Fiche sans prix</button>
                        </a>
                    </li>
                    <li>
                        <button class="dropdown-item" type="button">Etiquette</button>
                    </li>
                </ul>
            </div>
        </div>';

    if($type=="ticketUsed"){
        echo '<div class="alert alert-success mt-5" role="alert">
		<p align="center">les étiquettes ont bien été pris en compte ! </p>	
		</div>';
    }
echo '
        <div class="container">
        <!-Les boutons pour confirmer ou paas letiquette-->
        <div class="float-end d-grid gap-2 d-md-block">
            <button class="btn btn-dark" type="button" onclick="confirmer()">
            <i class="bi bi-hand-thumbs-up"></i>
            </button>  
            <button class="btn btn-dark" type="button" onclick="annuler()">
            <i class="bi bi-hand-thumbs-down"></i>
            </button>  
        </div>
        <!--Division pour le formulaire complet de létiquette qui va etre imprimé-->
        <div class="ms-5 me-5 mt-5 mb-3" id="imprimer">
            <!--carte qui contient létiquette-->
            <div class="card">
                <h5 class="card-header text-white bg-dark mb-3">' .$NomFiche. '</h5>
                    <div class="card-body">
                        <!--Division qui permet daligner les dates à droite, elle contient :
                                - deux lignes, chaque ligne contient deux colonnes-->
                        <div class="float-end pe-5 me-3 mb-3">
                            <!--Input pour la date de fabrication-->
                            <div class="row g-2 ms-3 mb-1">
                                <div class="col-auto">
                                    <label for="DateFabric" class="col-form-label">Date de fabrication :</label>
                                </div>
                                <div class="col-auto">
                                    <input type="date" class="form-control-plaintext" id="DateFabric">
                                    <p id ="DateFabricCache" class="mt-2" ></p>
                                </div>
                            </div>
                            <!-- Date de péremption (date de fabrication +3j)-->
                            <div class="row g-2 ms-3" >
                                <div class="col-auto">
                                    <p>Date de péremption :</p>
                                </div>
                                <!--Date calculée avec javascript (date de fabrication +3j)-->
                                <div class="col-auto">
                                    <p id ="DatePeremption"></p>
                                </div>
                            </div>
                        </div>

                        <!-- division des ingrédients, ingrédients non allergènes en gras-->
                        <div class="float-start">';
                foreach($Ingredients as $Ing){
                    $NomIngredient = $Ing["NomIng"];
                    $NumAllergene = $Ing["FK_NumAllergene"];
                    if(is_null($NumAllergene)){
                        echo $NomIngredient. ', ';
                    }else{
                        $NomAllergene = ModelAllergene::select($NumAllergene) ->getNomAllergene();
                        echo ' <strong> '.$NomIngredient.'</strong><em class="text-muted">('.$NomAllergene.'),</em></p>';
                    }
                }
                echo '
                            
                        </div>
                </div>
            </div>
        </div>

    <form class="was-validated">
        <!-- Ligne contenant deux colonnes  -->
        <div class="row g-2 align-items-center card">
            <!-- première sous colonne -->
            <div class="col-auto">
                <label for="nbreTickets" class="col-form-label">
                <p><strong>Donner le nombre d\'étiquettes que vous voulez imprimer, on s\'occupe du stock : </strong></p>
                </label>
            </div>
            <!-- Deuxième sous colonne -->
            <div class="col-auto">
                <input type="number" id="nbreTickets" class="form-control" name="nbreTickets" placeholder="ajouter" required/>
                <input type="hidden" name="NumeroFiche" value = "'.$NumeroFiche.'" required/>
            </div>
            <div class ="col-auto mb-2">
            <button type="submit" class="btn btn-warning me-2" >
                    <input type="hidden" name="controller" value="FicheTechnique">
                    <input type="hidden" name="action" value="gererStockEtiquette">
                    <i class="bi bi-file-earmark-arrow-down" style="font-size: 1rem; color:black;"></i>
                    seulement utiliser les étiquettes 
            </button>
            </div>
            <div class ="col-auto">
                <button type="submit" class="btn btn-warning me-2" onclick="imprimer()">
                        <input type="hidden" name="controller" value="FicheTechnique">
                        <input type="hidden" name="action" value="gererStockEtiquette">
                        <i class="bi bi-file-earmark-arrow-down" style="font-size: 1rem; color:black;"></i>
                        Utiliser les étiquettes et imprimer 
                </button>
            </div>
        </div>
        </div>
    </form>

              
        <!-- Bouton imprimer  -->
        <div class="mx-auto mt-3 mb-5" align=center>
            <button class="btn btn-dark" type="button" value="Imprimer" onclick="imprimer()">
                <i class="bi bi-printer"></i>
                Seulement Imprimer 
            </button>              
        </div>';

?>

<script src="../../../javascript/ImprimerFiches.js"></script>