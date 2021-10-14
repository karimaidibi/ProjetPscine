<?php
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
                    <li><button class="dropdown-item" type="button">Fiche sans prix</button></li>
                    <li>
                        <button class="dropdown-item" type="button">Etiquette</button>
                    </li>
                </ul>
            </div>
        </div>

        <!--Division pour le formulaire complet de létiquette qui va etre imprimé-->
        <div class="ms-5 me-5 mt-5 " id="imprimer">
            <!--carte qui contient létiquette-->
            <div class="card">
                <h5 class="card-header text-white bg-dark mb-3">(Nom de la fiche technique)</h5>
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
                                </div>
                            </div>
                            <!-- Date de péremption (date de fabrication +3j)-->
                            <div class="row g-2 ms-3" >
                                <div class="col-auto">
                                    <p>Date de péremption :</p>
                                </div>
                                <!--Date calculée avec javascript (date de fabrication +3j)-->
                                <div class="col-auto">
                                    <p>Date calculé avec javascipt</p>
                                </div>
                            </div>
                        </div>

                        <!-- division des ingrédients, ingrédients non allergènes en gras-->
                        <div class="float-start">
                            ingr"dient1, ingrédient2, ... ingr"dient1, ingrédient2, ... ingr"dient1, ingrédient2, ... ingr"dient1, ingrédient2, ... ingr"dient1, ingrédient2, ... ingr"dient1, ingrédient2, ... ingr"dient1, ingrédient2, ... ingr"dient1, ingrédient2, ... ingr"dient1, ingrédient2, ... ingr"dient1, ingrédient2,
                        </div>
                </div>
            </div>
        </div>

                
        <!-- Bouton imprimer  -->
        <div class="mx-auto mt-3 mb-5" align=center>
            <button class="btn btn-dark" type="button" value="Imprimer" onClick="imprimer()">
                <i class="bi bi-printer"></i>
                Imprimer 
            </button>              
        </div>';

?>

<script src="../../../javascript/ImprimerFiches.js"></script>