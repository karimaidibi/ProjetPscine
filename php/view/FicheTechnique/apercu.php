<?php
        echo '
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
                            <a href="index.php?controller=ficheTechnique&action=apercuEtiquette&NumeroFiche=' . myGet('NumeroFiche') . ' " style="color:white; text-decoration:none">
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
                        <li class="list-group-item"><strong>Nom de la fiche : </strong>Malakoff</li>
                        <li class="list-group-item"><strong>Nombre de couverts : </strong>4</li>
                        <li class="list-group-item"><strong>Auteur : </strong>karim</li>
                        <li class="list-group-item"><strong>Catégorie : </strong>Dessert</li>
                    </ul>
                </div>
                <!-- La liste des coefficients utilisés dans la fiche technique-->
                <div class="col-6" >
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Coefficients utlisés</strong></li>
                        <li class="list-group-item"><strong>Coeff Ass : </strong>0.5</li>
                        <li class="list-group-item"><strong>Coeff cout personnel : </strong>7</li>
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
                            <th scope="col"></th>
                            <th scope="col"> Progressions </th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Verser 3ml du lait puis chauffer à feu douce</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Couper la viande en morceaux </td>
                        </tr>
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
                            <th scope="col">CODE</th>
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
                        <!-- 3ème  ligne-->
                        <tr>
                            <!-- Première colonne (code) -->
                            <th scope="row">1</th>
                            <!-- deuxième colonne (ingrédient)-->
                            <td>Tomate</td>
                            <!-- 3ème colonne (Unitairé)-->
                            <td>Kg</td>
                            <!-- 4èmme colonne (Qté_Ing)-->
                            <td> 5</td>
                            <!-- 5ème colonne (PrixU)-->
                            <td>5€</td>
                            <!-- 6èmme colonne(PTHT)-->
                            <td>0.2€</td>
                        </tr>
                        <!--4ème lignne-->
                            <!-- 3ème  ligne-->
                            <tr>
                            <!-- Première colonne (code) -->
                            <th scope="row">1</th>
                            <!-- deuxième colonne (ingrédient)-->
                            <td>Tomate</td>
                            <!-- 3ème colonne (Unitairé)-->
                            <td>Kg</td>
                            <!-- 4èmme colonne (Qté_Ing)-->
                            <td> 5</td>
                            <!-- 5ème colonne (PrixU)-->
                            <td>5€</td>
                            <!-- 6èmme colonne(PTHT)-->
                            <td>0.2€</td>
                            </tr>
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
                                <th scope="col">Code</th>
                                <th scope="col">NomFiche</th>
                                <th scope="col">NbreCouverts</th>
                                <th scope="col">NomAuteur</th>
                                <th scope="col">Catégorie</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Malakoff</td>
                                <td>4</td>
                                <td>karim</td>
                                <td>Dessert</td>
                            </tr>
                            <tr>
                                <th scope="row">1</th>
                                <td>Malakoff</td>
                                <td>4</td>
                                <td>karim</td>
                                <td>Dessert</td>
                            </tr>
                            <tr>
                                <th scope="row">1</th>
                                <td>Malakoff</td>
                                <td>4</td>
                                <td>karim</td>
                                <td>Dessert</td>
                            </tr>
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