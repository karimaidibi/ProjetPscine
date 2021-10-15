<?php

    $NumeroFiche = $cetteFiche -> getNumeroFiche();
    $NomFiche = $cetteFiche ->getNomFiche();
    $nbreCouverts = $cetteFiche -> getNbreCouverts();
    $NomAuteur = $cetteFiche -> getNomAuteur();
    $CoutFluide = $cetteFiche -> getCoutFluide();
    $NumeroCategorie = $cetteFiche->getFK_NumeroCatFiche();

    //objet categorie
    $cetteCategorie = ModelCategorie_Fiche::select($NumeroCategorie);
    $NomCategorie = $cetteCategorie -> getNomCatFiche();

    //les progression ? on a besoin de savoir quelles sont les etapes appartenant a cette fiche et les afficher.
    //select DescriptionEtape from contenir join Etape on FK_NumEtape = NumEtape where NumeroFiche = $NumeroFiche
    // mais ou mettre cette requete? je vais la mettre dans une fonction dans le model fichetechnique et lappeler depuis le controller
    /*echo '<pre>';
    print_r($Progressions);
    echo '</pre>';*/ 
    //on récupère les progressions dans la variable $Progressions


    //les coefficients?
    //echo '<pre>';
      //  print_r($Coefficients);
    //echo '</pre>';
    //les sousfiches?


    //les ingrédients?

        echo'
            <!--Bouton aperçu fiche avec prix, sans prix, ou etiquette -->
            <div class="container-fluid mt-5" align=center>
                <div class="dropdown">
                    <button class="btn btn-dark dropdown-toggle" type="button" id="Aperçu" data-bs-toggle="dropdown" aria-expanded="false">
                    Aperçu de la fiche technique
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="Aperçu">
                        <li><button class="dropdown-item" type="button" >Fiche avec prix</button></li>
                        <li><button class="dropdown-item" type="button">Fiche sans prix</button></li>
                        <li>
                            <a href="index.php?controller=ficheTechnique&action=apercuEtiquette&NumeroFiche=' .$NumeroFiche . ' " style="color:white; text-decoration:none">
                            <button class="dropdown-item" type="button">Etiquette</button>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!---la division qui va etre imprimée contenant toutes les informations à propos de la fiche technique,-->
            <div class="container-fluid mt-5 ps-4 pe-3 bg-light bg-gradient" id="imprimer">
            <!--liste des  Descriptifs et des coeff -->
            <div class="row row-cols-2 justify-content-around pt-4">
                <!-- la liste des descriptifs-->
                <div class="col-6" >
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Descriptifs</strong></li>
                        <li class="list-group-item"><strong>Nom de la fiche : </strong>' .$NomFiche.'</li>
                        <li class="list-group-item"><strong>Nombre de couverts : </strong>' .$nbreCouverts. '</li>
                        <li class="list-group-item"><strong>Auteur : </strong>' .$NomAuteur. '</li>
                        <li class="list-group-item"><strong>Catégorie : </strong> ' .$NomCategorie. '</li>
                    </ul>
                </div>
                <!-- La liste des coefficients utilisés dans la fiche technique-->
                <div class="col-6" >
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Coefficients et couts utlisés</strong></li>';
                foreach($Coefficients as $coeff){
                    echo 
                      ' <li class="list-group-item"><strong>Coeff : </strong> ' .$coeff["valeurCoefficient"]. '</li>';
                }
                    echo '
                        <li class="list-group-item"><strong>Cout de fluide : </strong>' .$CoutFluide.'</li>
                    </ul>
                </div>
            </div>

            <!-- Une ligne qui contient :
                    - une colonne pour la table progression
                    - une colonne pour la table Ingrédients avec les pric etc -->
            <div class="row row-cols-2  pt-4">
                <!-- 1ère colonne (colonne des progressions ) -->
                <div class ="col-4">
                    <!-- Les progressions de la fiche sous forme dune table-->
                    <table class="table table-hover table-striped align-middle">
                        <thead>
                        <tr>
                            <th scope="col">ordre</th>
                            <th scope="col"> Progressions </th>
                        </tr>
                        </thead>
                        <tbody>';
                foreach($Progressions as $p){
            echo  
                        '<tr>
                            <th scope="row"> ' .$p["ordre"]. '</th>
                            <td> ' .$p["DescriptionEtape"]. ' </td>
                        </tr>';
                }
                echo '
                        </tbody>
                    </table>
                </div>
                <!-- Deuxème colonne (colonne des ingrédients ) -->
                <div class ="col-8">
                <!-- Les Ingrédients de la fiche sous forme dune table, en colonne
                    - Dénomination : 
                        -  Code | Ingrédient | Unité 
                    - Valorisation :
                        -  Quantité | PrixU | PTHT-->
                    <table class="table table-striped table-hover align-middle">
                    <thead>
                        <!-- Prémière ligne-->
                        <tr>
                            <!-- première colonne-->
                        <th scope="col" colspan="3">DENOMINATION</th>
                        <!-- Deuxième colonne -->
                        <th scope="col" colspan="3">VALORISATION</th>
                        </tr>
                        <!-- Deuxième ligne-->
                        <tr>
                            <!-- première colonne-->
                            <th scope="col">ALLERGENE</th>
                            <!-- deuxième colonne-->
                            <th scope="col">Ingrédient</th>
                            <!-- 3ème colonne-->
                            <th scope="col">UNITE</th>
                            <!-- 4ème colonne-->
                            <th scope="col">QUANTITE</th>
                            <!-- 5ème colonne-->
                            <th scope="col">PRIXU</th>
                            <!-- 6ème colonne-->
                            <th scope="col">PTHT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- 3ème  ligne-->';
                foreach($Ingredients as $Ing){
                    $NomAllergene = ModelAllergene::select($Ing["FK_NumAllergene"]) -> getNomAllergene();
                    $NomUnite = ModelUnite::select($Ing["FK_NumUnite"]) -> getNomUnite();
                        echo 
                            '<tr>
                                <!-- Première colonne (code) -->
                                <th scope="row"> ' .$NomAllergene. ' </th>
                                <!-- deuxième colonne (ingrédient)-->
                                <td>' .$Ing["NomIng"]. '</td>
                                <!-- 3ème colonne (Unitairé)-->
                                <td>' .$NomUnite. '</td>
                                <!-- 4èmme colonne (Qté_Ing)-->
                                <td> ' .$Ing["QuantiteIngredient"]. '</td>
                                <!-- 5ème colonne (PrixU)-->
                                <td> ' .$Ing["prixUnitaireIng"]. ' </td>
                                <!-- 6èmme colonne(PTHT)-->
                                <td> ptht calculé </td>
                            </tr>';
                }
                echo ' 
                    </tbody>
                    </table>
                </div>
            </div>
                <!-- La table qui contient les prix totales et une table contenante les fiches techniques -->
                <div class="row row-cols-2 ms-3 ">
                <!-- les prix-->
                    <div class="col-4">
                        <table class="table table-striped table-hover align-middle">
                            <thead>
                                <tr>
                                <th scope="col" colspan="2">Prix</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <th scope="row">Total Denrées</th>
                                <td>197,8 €</td>
                                </tr>
                                <tr>
                                <th scope="row">ASS 5%</th>
                                <td>9,8 €</td>
                                </tr>
                                <tr>
                                <th scope="row">Cout Matières</th>
                                <td>197,8 €</td>
                                </tr>
                                <tr>
                                <th scope="row">Cout Personnel</th>
                                <td>197,8 €</td>
                                </tr>
                                <tr>
                                <th scope="row">Cout Fluide</th>
                                <td>197,8 €</td>
                                </tr>
                                <tr>
                                <th scope="row">Cout de production Total</th>
                                <td>197,8 €</td>
                                </tr>
                                <tr>
                                <th scope="row">Cout de production portion</th>
                                <td>197,8 €</td>
                                </tr>
                            </tbody>
                        </table> 
                    </div>
                    <!-- les fiches techniques -->
                    <div class="col-8">
                        <!------LA TABLE QUI CONTIENT LES FICHES TECHNIQUES--------->
                        <table class="table table-striped table-hover align-middle">
                            <thead>
                            <!-- première ligne (fiche technique)-->
                            <tr>
                            <th scop="col" colspan="5"> Fiches techniques : </th>
                            </tr>
                            <tr>
                                <th scope="col">ordre</th>
                                <th scope="col">NomFiche</th>
                                <th scope="col">NbreCouverts</th>
                                <th scope="col">NomAuteur</th>
                                <th scope="col">Catégorie</th>
                            </tr>
                            </thead>
                            <tbody>';
                    foreach($SousFiches as $sousfiche){
                        //recuperer le nom de numero categorie de chaque sous fiche 
                        $NumCatFiche = $sousfiche["FK_NumeroCatFiche"];
                        $cetteCategorie = ModelCategorie_Fiche::select($NumCatFiche);
                        $NomCategorie = $cetteCategorie -> getNomCatFiche();
                        echo
                           '<tr>
                                <th scope="row">' .$sousfiche["ordre"].'</th>
                                <td>' .$sousfiche["NomFiche"]. '</td>
                                <td>' .$sousfiche["NbreCouverts"]. '</td>
                                <td>' .$sousfiche["NomAuteur"]. '</td>
                                <td>' .$NomCategorie. '</td>
                            </tr>';
                    }
                    echo '
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>

        <!-- Bouton imprimer  -->
        <div class="mx-auto mt-3 mb-5" align=center>
            <button class="btn btn-dark" type="button" value="Imprimer" onClick="imprimer()">
                <i class="bi bi-printer"></i>
                Imprimer 
            </button>              
        </div> ';

?>


<script src="../../../javascript/ImprimerFiches.js"></script>