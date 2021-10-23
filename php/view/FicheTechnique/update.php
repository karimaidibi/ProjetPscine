<?php


// si on update la fiche 
if($type=='readonly'){
  $NomFiche = $fiche->getNomFiche();
  $NbreCouverts = $fiche->getNbreCouverts();
  $NomAuteur = $fiche->getNomAuteur();
  $CoutFluide = $fiche->getCoutFluide();
  $FK_NumeroCatFiche = $fiche->getFK_NumeroCatFiche();
  $FK_CodeCoeffAss = $fiche->getFK_CodeCoeffAss();
  $FK_CodeCoeffCoutPersonnel = $fiche->getFK_CodeCoeffCoutPersonnel();

  //categorie de la fiche
  $categorie = ModelCategorie_Fiche::select($FK_NumeroCatFiche);
  $NomCatFiche = $categorie -> getNomCatFiche();

  //coefficients de la fiche
  $coeffAss = ModelCoeffAss::select($FK_CodeCoeffAss);
  $valeurCoeffAss = $coeffAss -> getvaleurCoeffAss();
  
  $coeffCoutPersonnel = ModelCoeffCoutPersonnel::select($FK_CodeCoeffCoutPersonnel);
  $valeurCoeffCoutPersonnel = $coeffCoutPersonnel -> getvaleurCoeffCoutPersonnel();

}

echo '
    <div class="container mt-5 ps-4 pe-3 bg-light bg-gradient border border-dark">
      <!--Titré création de fiche technique -->
      <div class="container-fluid  bg-dark bg-gradient" align=center>
          <p class="fs-2" style="color:white;"> Création d\'une fiche technique </p>
      </div>

      <!---la division qui  contient tout le form de création de la fiche technique
            - en appuyant sur submit, tout le contenu de ce form va etre validé en meme temps-->
        <form class= "was-validated">
            <!--liste d input des  Descriptifs et des coeff -->
            <div class="row row-cols-2 justify-content-around pt-4">
                <!-- la liste d inpput des descriptifs dans une colonne-->
                <div class="col-6 " >
                    <ul class="list-group list-group-flush">
                        <!-- Descriptifs-->
                        <li class="list-group-item"><strong>Descriptifs</strong></li>
                        <!-- Input Nom de la fiche -->
                        <li class="list-group-item list-group-item-dark">
                            <!-- Ligne contenante deux colonnes  -->
                            <div class="row g-2 align-items-center">
                                <!-- première sous colonne -->
                                <div class="col-auto">
                                    <label for="NomFiche_id" class="col-form-label">
                                    Nom de la fiche  
                                    </label>
                                </div>
                                <!-- Deuxième sous colonne -->
                                <div class="col-auto">';
                                if($type=='readonly'){
                                  echo '<input type="hidden" id="NumeroFiche_id" name="NumeroFiche" class="form-control" value="'. $NumeroFiche . '" required/>';
                                    echo '<input type="text" id="NomFiche_id" name="NomFiche" class="form-control" value="' . $NomFiche . '" required/>';
                                }
                                else{
                                  echo '<input type="text" id="NomFiche_id" name="NomFiche" class="form-control" placeholder="Ajoutez un nom" required/>';
                                }
                                echo '</div>
                            </div>
                        </li>
                        <!-- Input nombre de couverts-->
                        <li class="list-group-item">
                            <!-- Ligne dans la colonne -->
                            <div class="row g-2 align-items-center">
                                <!-- première sous colonne -->
                                <div class="col-auto">
                                    <label for="NbreCouverts_id" class="col-form-label">
                                        Nombre de couverts  
                                    </label>
                                </div>
                                <!-- Deuxième sous colonne -->
                                <div class="col-auto">';
                                if($type=='readonly'){
                                    echo '<input type="number" id="NbreCouverts_id" name="NbreCouverts" class="form-control" value="' . $NbreCouverts . '" required/>';
                                  }
                                  else{
                                    echo '<input type="number" id="NbreCouverts_id" name="NbreCouverts" class="form-control" placeholder="Ajoutez un nombre de couverts" required />';
                                  }
                                echo '</div>
                            </div>   
                        </li>
                        <!-- Input auteur-->
                        <li class="list-group-item list-group-item-dark">
                          <!-- Ligne dans la liste, contenante deux colonnes, une label et un input--->
                          <div class="row g-2 align-items-center">
                            <!-- première sous colonne -->
                            <div class="col-auto">
                              <label for="NomAuteur_id" class="col-form-label">
                                Nom de l\'auteur  
                              </label>
                            </div>
                            <!-- Deuxième sous colonne -->
                            <div class="col-auto">';
                            if($type=='readonly'){
                              echo '<input type="text" id="NomAuteur_id" name="NomAuteur" class="form-control" value="' . $NomAuteur . '" required>';
                            }
                            else{
                              echo '<input type="text" id="NomAuteur_id" name="NomAuteur" class="form-control" placeholder="Ajoutez le nom de l\'auteur" required>';
                            }
                            echo '</div>
                          </div>
                       </li>
                       <!-- Input Catégorie-->
                       <li class="list-group-item">
                          <!-- Ligne contenante deux colonnes, un label et un input -->
                          <div class="row g-2 align-items-center">
                            <!-- première sous colonne -->
                            <div class="col-auto">
                              <label for="FK_NumeroCatFiche_id" class="col-form-label">
                                Catégorie de la fiche  
                              </label>
                            </div>
                            <!-- Deuxième sous colonne -->
                            <div class="col-auto">
                              <select id="FK_NumeroCatFiche_id" name="FK_NumeroCatFiche" class="form-select">';
                            if($type=='readonly'){
                              foreach($categories as $cat){
                                $NumCategorie = $cat->getNumeroCatFiche();
                                $NomCategorie = $cat->getNomCatFiche();
                                if(empty($FK_NumeroCatFiche)){
                                  echo '<option value="">--choisissez une catégorie--</option>' ;
                                }
                                elseif($NumCategorie==$FK_NumeroCatFiche){
                                  echo '<option selected value = "'.$FK_NumeroCatFiche.'"> '.$NomCatFiche.' </option>';
                                }
                                else{
                                  echo  
                                  '<option value="'.$NumCategorie.'">'.$NomCategorie.'</option>';
                                }
                              }
                            }else{
                              echo '<option value="">--choisissez une catégorie--</option>';
                              foreach($categories as $cat){
                                $NumCategorie = $cat->getNumeroCatFiche();
                                $NomCategorie = $cat->getNomCatFiche();
                                echo  
                                    '<option value="'.$NumCategorie.'">'.$NomCategorie.'</option>';
                              }
                            }
                          echo '
                               </select>           
                            </div>
                          </div>
                        </li>
                    </ul>
                </div>
                <!-- La liste d input des coefficients utilisés dans la fiche technique dans une colonne-->
                <div class="col-6">
                    <ul class="list-group list-group-flush">
                        <!-- La liste d input des Coefficients utilisés-->
                        <li class="list-group-item"><strong>Couts et Coefficients utlisés</strong></li>
                        <!-- input Coeff Ass -->
                        <li class="list-group-item list-group-item-dark">
                            <!-- Ligne contenante deux colonnes, un label et un input pour le coeff Ass -->
                            <div class="row g-2 align-items-center">
                              <!-- première sous colonne -->
                              <div class="col-auto">
                                <label for="CoeffAss" class="col-form-label">
                                  Coefficient ASS :  
                                </label>
                              </div>
                              <!-- Deuxième sous colonne -->
                              <div class="col-auto">
                              <select id="coeffASS" name="CodeCoeffAss" class="form-select" required>';
                            if($type=='readonly'){
                              foreach($coefficientsAss as $c){ // pour chaque coefficients dans la BD 
                                $CodeCoeff = $c->getCodeCoeffAss();
                                $valeurCoeff = $c->getvaleurCoeffAss(); 
                                  if($CodeCoeff==$FK_CodeCoeffAss){
                                    echo '<option selected value = "'.$CodeCoeff.'"> '.$valeurCoeff.' </option>';
                                  }
                                  else{
                                    echo  
                                    '<option value="'.$CodeCoeff.'">'.$valeurCoeff.'</option>';
                                  }
                              }
                            }else{
                              foreach($coefficientsAss as $c){
                                $CodeCoeff = $c->getCodeCoeffAss();
                                $valeurCoeff = $c->getvaleurCoeffAss(); 
                                echo  
                                    '<option value="'.$CodeCoeff.'">'.$valeurCoeff.'</option>';
                              }
                            }
                            echo '</select>             
                              </div>
                            </div>    
                        </li>
                        <!--input Coeff cout personnel-->
                        <li class="list-group-item">
                            <!-- Ligne contenante deux colonnes, un label et un input pour le coeff Ass -->
                            <div class="row g-2 align-items-center">
                              <!-- première sous colonne -->
                              <div class="col-auto">
                                <label for="CoeffPersonnel" class="col-form-label">
                                  Coefficient cout personnel  
                                </label>
                              </div>
                              <!-- Deuxième sous colonne -->
                              <div class="col-auto">
                              <select id="coeffCoutPersonnel" name="CodeCoeffCoutPersonnel" class="form-select" required>';
                              if($type=='readonly'){
                                foreach($coefficientsCoutPersonnel as $c){ // pour chaque coefficients dans la BD 
                                  $CodeCoeff = $c->getCodeCoeffCoutPersonnel();
                                  $valeurCoeff = $c->getvaleurCoeffCoutPersonnel(); 
                                    if($CodeCoeff==$FK_CodeCoeffCoutPersonnel){
                                      echo '<option selected value = "'.$CodeCoeff.'"> '.$valeurCoeff.' </option>';
                                    }
                                    else{
                                      echo  
                                      '<option value="'.$CodeCoeff.'">'.$valeurCoeff.'</option>';
                                    }
                                }
                              }else{
                                foreach($coefficientsCoutPersonnel as $c){
                                  $CodeCoeff = $c->getCodeCoeffCoutPersonnel();
                                  $valeurCoeff = $c->getvaleurCoeffCoutPersonnel(); 
                                  echo  
                                      '<option value="'.$CodeCoeff.'">'.$valeurCoeff.'</option>';
                                }
                              }
                        echo '  </select>   
                              </div>
                            </div> 
                        </li>
                        <!-- input Cout de fluide -->
                        <li class="list-group-item list-group-item-dark">
                            <!-- Ligne contenante deux colonnes, un label et un input pour le coeff Ass -->
                            <div class="row g-2 align-items-center">
                              <!-- première sous colonne -->
                              <div class="col-auto">
                                <label for="CoutFluide_id" class="col-form-label">
                                  Cout de fluide  
                                </label>
                              </div>
                              <!-- Deuxième sous colonne -->
                              <div class="col-auto">';
                              if($type=='readonly'){
                                echo '<input type="number" step="any" id="CoutFluide_id" name="CoutFluide" class="form-control" value="' . $CoutFluide . '" required>';   
                              }
                              else{
                                echo '<input type="number" step="any" id="CoutFluide_id" name="CoutFluide" class="form-control" placeholder="Ajoutez un coût fluide" required/>';
                              }
                              echo '</div>
                            </div> 
                        </li>
                    </ul>
                </div>
            </div>
          <!-- Une ligne qui contient :
                - une colonne pour ajouter des progressions dans la table de progression
                - une colonne pour ajouter des ingrédients dans la table Ingrédients avec les prix etc -->
            <div class="row row-cols-2 justify-content-around pt-4">
              <!-- 1ère colonne (colonne des progressions ) -->
              <div class ="col-4 pt-4 ">
                  <!-- Area text pour une nouvelle progression-->
                  <!-- Premier group d input -->
                  <label for="inputProgressionInDB" class="form-label">J\'ajoute une nouvelle progression : </label>
                  <div class="input-group">
                    <button class="btn btn-dark" type="button" onclick="CreateLigneProgressionInDB()">
                      <i class="bi bi-plus-square"></i>
                    </button>
                    <textarea class="form-control" id="inputProgressionInDB" rows="3" name ="AjouterProgressionDirect" ></textarea>
                  </div>';
                  echo '
                  <!-- Barre de recherche pour une progression existante -->
                  <!-- Deuxième group d\'input -->
                  <p class ="mt-3">Ou je choisis une progression que j\'ai déjà créée : </p>
                  <div class="input-group">
                    <button class="btn btn-dark" type="button" onclick="CreateLigneProgressionExistante()">
                      <i class="bi bi-plus-square"></i>
                    </button>
                    <input class="form-control" list="listeDesProgressions" id="inputProgressionExistante" placeholder="Chercher une progression..">
                    <datalist id="listeDesProgressions" >';
                  foreach($progressions as $prog){
                    $NumEtape = $prog -> getNumEtape();
                    $DescriptionEtape = $prog ->getDescriptionEtape();
                    echo 
                          '<option value="'.$DescriptionEtape.'" class="nomProgression">
                          <input type="hidden" value ="'.$NumEtape.'" class="NumProgression">';
                    
                  }
                  echo '
                    </datalist></div>
                  <!-- Les progressions de la fiche sous forme d\'une table-->
                  <div class="container-fluid mt-3">
                    <table class="table table-striped table-hover">
                      <thead class="table-dark">
                        <tr>
                          <th scope="col"></th>
                          <th scope="col"> Progressions </th>
                          <th scope="col"></th>
                        </tr>
                      </thead>
                      <!- gerer avec javascript et php->
                      <tbody id="bodyProgressions">';
                      if($type=='readonly'){
                        echo '<input type = "hidden" id ="readonly">';
                        foreach($Progressions as $p){
                          echo 
                            '<tr>
                                <th scope="row"> ' .$p["ordre"]. '</th>
                                <td> ' .$p["DescriptionEtape"]. ' </td>
                                <td id ="'.$p["NumEtape"].'">
                                  <button class="btn btn-danger" type="button" onclick="DeleteRowProgressions(this)">
                                  <i class="bi bi-trash" style="font-size: 1rem;" ></i>
                                  </button>
                                </td>
                            </tr>';
                        }
                      }
                     echo '
                      </tbody>
                    </table>
                  </div>
              </div>
              <!-- Deuxème colonne (colonne des ingrédients ) -->
              <div class ="col-8 pt-4">
                  <!-- Barre de recherche des ingrédients pour rajouter un ingrédient-->
                  <div class="ps-5 ms-2">
                    <label for="inputIngredient" class="form-label"> J\'ajoute un ingrédient : </label>
                  </div>
                  <!-- Flex pour regrouper licon recherche avec la barre de recherche -->
                  <div class="container d-inline-flex bd-highlight">
                    <!-- L\'icon de recherche -->
                    <div class="flex-shrink-0 mt-1">
                            <i class="bi bi-search"></i>
                    </div>
                    <datalist id="compositions" >';
                    foreach($compositions as $c){
                      $FK_NumeroFiche = $c->getFK_NumeroFiche();
                      $FK_NumIngredient = $c->getFK_NumIngredient();
                      $QuantiteIngredient = $c->getQuantiteIngredient();

                      echo '<input type="hidden" value ="'.$FK_NumeroFiche.'" class="FK_NumeroFiche">
                          <input type="hidden" value ="'.$FK_NumIngredient.'" class="FK_NumeroIngredient">
                          <input type="hidden" value ="'.$QuantiteIngredient.'" class="QuantiteIngredient">';
                      }
                      echo  '</datalist>
                      <datalist id="listeDesProgressionsA" >';
                      foreach($contenir as $ct){
                        $NumEtape2 = $ct->getNumEtape();
                        $NumeroFiche2 = $ct->getNumeroFiche();
                        print_r($ct);
                        echo $ct->getNumEtape();
                        echo $NumEtape2;
                        echo $NumeroFiche2;
                        echo '<input type="hidden" value ="'.$NumEtape2.'" class="NumEtapeA">
                        <input type="hidden" value ="'.$NumeroFiche2.'" class="NumeroFicheA"></datalist>';
                      }
                    echo '<!-- La barre de recherche -->
                    <div class="flex-grow-1 ms-3 ">
                      <!-- Input group qui rassemble le bouton d\'ajout a la barre de recherche -->
                      <div class="input-group">
                        <button class="btn btn-dark" type="button" onclick="CreateLigneIngredient()">
                          <i class="bi bi-plus-square"></i>
                        </button>
                        <input class="form-control" list="listeDesIngredients" id="inputIngredient" placeholder="Chercher un ingrédient..">
                        <datalist id="listeDesIngredients">';
                        foreach($ingredients as $i){
                          $NumIngredient = $i->getNumIngredient();
                          $NomIng = $i->getNomIng();
                          $PrixUnitaire = $i->getPrixUnitaireIng();
                          $QuantiteStock = $i->getQteStockIngredient();
                          $FK_NumUnite = $i->getFK_NumUnite();
                          $FK_NumAllergene = $i->getFK_NumAllergene();
                          $FK_CodeTVA = $i->getFK_CodeTVA();
                          $FK_NumCategorie = $i->getFK_NumCategorie();
                  
                          $Unite = ModelUnite::select($FK_NumUnite)->getNomUnite();
                          $objetAllergene = ModelAllergene::select($FK_NumAllergene); //recuperer son allergene si existe
                          if(!empty($objetAllergene)){
                              $NomAllergene = $objetAllergene ->getNomAllergene();
                          }else{
                              $NomAllergene = "";
                          }
                          //$TVA = ModelTVA::select($FK_CodeTVA)->getCoefTVA();
                          //$Categorie = ModelCategorie_Ingredient::select($FK_NumCategorie)->getNomCategorie();
                          //<option value="'.$NomIng.'" class="nomIngredient">
                          echo '<option value="'.$NomIng.'" class="nomIngredient">
                                <input type="hidden" value ="'.$NumIngredient.'" class="NumIngredient">
                                <input type="hidden" value ="'.$PrixUnitaire.'" class="PrixUnitaire">
                                <input type="hidden" value ="'.$Unite.'" class="Unite">
                                <input type="hidden" value ="'.$NomAllergene.'" class="Allergene">
                                <datalist id=associerIngredient>
                                    <input type="hidden" value ="'.$NomAllergene.'" class="NomAllergene2">
                                    <input type="hidden" value ="'.$Ing["NomIng"].'" class="NomIngredient2">
                                    <input type="hidden" value ="'.$NomUnite.'" class="Unite2">
                                    <input type="hidden" value ="'.$Ing["QuantiteIngredient"].'" class="QuantiteIngredient2">
                                    <input type="hidden" value ="'.$Ing["prixUnitaireIng"].'" class="PrixUnitaire2">
                                  </datalist>';

                        }
                  echo' </datalist>
                      </div> 
                    </div>                   
                  </div>
                  <!-- Les Ingrédients de la fiche sous forme d une table, en colonne
                      - Dénomination : 
                          -  Code | Ingrédient | Unité 
                      - Valorisation :
                          -  Quantité | PrixU | PTHT-->
                  <div class="pt-4 ms-4">
                    <table class="table table-striped table-hover align-middle" id="tableIngredients" >
                      <thead class="table-dark">
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
                            <th scope="col">INGREDIENT</th>
                            <!-- 3ème colonne-->
                            <th scope="col">UNITE</th>
                            <!-- 4ème colonne-->
                            <th scope="col">QUANTITE</th>
                            <!-- 5ème colonne-->
                            <th scope="col">PRIXU</th>
                            <!-- 6ème colonne-->
                            <th scope="col">PTHT</th>
                            <!-- 7ème colonne-->
                            <th scope="col"></th> 
                          </tr>
                      </thead>
                      <!- gerer avec javascript et php->
                      <tbody id="bodyIngredients">';
                    if($type=="readonly"){
                      echo '<input type = "hidden" id ="readonly">';
                      //<!-- 3ème  ligne-->
                      $TotalDenree = 0; // le total Denree = somme des PTHT
                      foreach($Ingredients as $Ing){
                          $objetAllergene = ModelAllergene::select($Ing["FK_NumAllergene"]); //recuperer son allergene si existe
                          if(!empty($objetAllergene)){
                              $NomAllergene = $objetAllergene ->getNomAllergene();
                          }else{
                              $NomAllergene = "";
                          }
                          $objetcateg = ModelCategorie_Ingredient::select($Ing["FK_NumCategorie"]);// recuperer la categorie de l'ingredient
                          if(!empty($objetcateg)){
                              $CategorieIng = $objetcateg -> getNomCategorie(); 
                          }else{
                              $CategorieIng = "Autre";
                          }
                          $NomUnite = ModelUnite::select($Ing["FK_NumUnite"]) -> getNomUnite(); //recuperer son nom unité
                          $PTHT = $Ing["QuantiteIngredient"] * $Ing["prixUnitaireIng"]; // calculer son PTHT
                          $TotalDenree = $TotalDenree + $PTHT;
                              echo 
                                  '<tr>
                                      <!-- Première colonne (code) -->
                                      <th scope="row"> ' .$NomAllergene. '</th>
                                      <!-- deuxième colonne (ingrédient)-->
                                      <td>' .$Ing["NomIng"]. '</td>
                                      <!-- 3ème colonne (Unitairé)-->
                                      <td>' .$NomUnite. '</td>
                                      <!-- 4èmme colonne (Qté_Ing)-->
                                      <td>
                                      <input type="number" step="any" class="form-control w-50" id="QteIng" value ="' .$Ing["QuantiteIngredient"]. '" required>
                                      </td>
                                      <!-- 5ème colonne (PrixU)-->
                                      <td> ' .$Ing["prixUnitaireIng"]. ' </td>
                                      <!-- 6èmme colonne(PTHT)-->
                                      <td>  </td>
                                      <!-7èemme colonne (bouton delete)->
                                      <td id ="'.$Ing["NumIngredient"].'">
                                      <button class="btn btn-danger" type="button" onclick="DeleteRowIngredients(this)">
                                      <i class="bi bi-trash" style="font-size: 1rem;" ></i>
                                      </button>
                                      </td>
                                  </tr>
                                  ';
                      }
                    }
                    echo '
                      </tbody>
                    </table>
                  </div>
              </div>
            </div>
            <!-- une ligne contenante un input pour rajouter des fiches techniques  -->
            <div class="row row-cols-2 pt-4">
                <!-- Les prix de la fichetechniques géré avec javascript -->
                <div class="col-4">
                  <table class="table table-striped table-hover>
                    <thead class="table-dark">
                        <tr>
                        <th scope="col" colspan="2"> Prix </th>
                        </tr>
                    </thead>
                    <tbody id="bodyPrix">
                        <tr>
                        <th scope="row">Total Denrées</th>
                        <td>0</td>
                        </tr>
                        <tr>
                        <th scope="row">ASS 5%</th>
                        <td>0</td>
                        </tr>
                        <tr>
                        <th scope="row">Cout Matières</th>
                        <td>0</td>
                        </tr>
                        <tr>
                        <th scope="row">Cout Personnel</th>
                        <td>0</td>
                        </tr>
                        <tr>
                        <th scope="row">Cout Fluide</th>
                        <td>0</td>
                        </tr>
                        <tr>
                        <th scope="row">Cout de production Total</th>
                        <td>0</td>
                        </tr>
                        <tr>
                        <th scope="row">Cout de production portion</th>
                        <td>0</td>
                        </tr>
                    </tbody>
                  </table> 
                </div> 
                <!-- les fiches techniques -->
                <div class="col-8">
                  <!-- Barre de recherche pour une fiche technique existante -->
                  <!--  group d input -->
                  <lable class="form-label" for="FichesTechniques">
                    Je rajoute une autre fiche technique à ma fiche technique : 
                  </lable>
                  <div class="input-group pt-4">
                    <button class="btn btn-dark" type="button" onclick="CreateLigneFiche()">
                      <i class="bi bi-plus-square"></i>
                    </button>
                    <input id="inputFiches" class="form-control" list="listeDesFichesTechniques" placeholder="Chercher une fiche..">
                    <datalist id="listeDesFichesTechniques" >';
                    foreach($LesFiches as $f){
                      $NomFiche = $f->getNomFiche();
                      $NumeroFiche = $f->getNumeroFiche();
                      $NbreCouverts = $f->getNbreCouverts();
                      $NomAuteur = $f->getNomAuteur();
                      $CoutFluide = $f->getCoutFluide();
                      $NumCategorieFiche = $f->getFK_NumeroCatFiche();
                  
                      $categorieFiche = ModelCategorie_Fiche::select($NumCategorieFiche);
                      $NomCategorieFiche =  $categorieFiche -> getNomCatFiche(); //une ligne = objet
                  echo '<option value="'.$NomFiche.'" class="nomFiche">
                          <input type="hidden" value ="'.$NumeroFiche.'" class="NumeroFiche">
                          <input type="hidden" value ="'.$NbreCouverts.'" class="NbreCouverts">
                          <input type="hidden" value ="'.$NomAuteur.'" class="NomAuteur">
                          <input type="hidden" value ="'.$CoutFluide.'" class="CoutFluide">
                          <input type="hidden" value ="'.$NomCategorieFiche.'" class="NomCategorieFiche">';
                    }
              echo  '</datalist>
                  </div>
                  <div class="pt-4">
                      <!------LA TABLE QUI CONTIENT LES FICHES TECHNIQUES--------->
                      <table class="table table-striped table-hover align-middle">
                      <input type="hidden" id="inputTableIngredients"> 
                        <thead class = "table-dark">
                        <tr>
                            <th scope="col">Ordre</th>
                            <th scope="col">NomFiche</th>
                            <th scope="col">NbreCouverts</th>
                            <th scope="col">NomAuteur</th>
                            <th scope="col">Catégorie</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <!- gerer avec javascript et php->
                        <tbody id="bodyFiche">';
                        if($type=='readonly'){
                          foreach($SousFiches as $sousfiche){
                            echo '<input type = "hidden" id ="readonly">';
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
                                    <td id="'.$NumCatFiche.'">
                                      <button class="btn btn-danger" type="button" onclick="DeleteRowFiches(this)">
                                      <i class="bi bi-trash" style="font-size: 1rem;" ></i>
                                      </button>
                                    </td>
                                </tr>';
                          }
                        }
                      echo '
                        </tbody>
                    </table>
                  </div>
                </div>
            </div>
              <!-- validation -->
          <div class="mt-3 mb-5 " align=center>
              <input type=\'hidden\' name=\'controller\' value=\'ficheTechnique\'>';
              if($type=='readonly'){
                echo '<button class="btn btn-dark" type="submit" onclick="submit()">
                <input type=\'hidden\' name=\'action\' value=\'updated\'>
                    <i class="bi bi-cloud-arrow-up"></i>
                    Modifier la fiche 
                    </button>';
              }
              else{
                echo '<button class="btn btn-dark" type="submit" >
                <input type=\'hidden\' name=\'action\' value=\'created\'>
                  <i class="bi bi-cloud-arrow-up"></i>
                  Créer la fiche
                    </button>';
              }
          echo '         
          </div>
        </form>
      </div>';

?>

<script src="../javascript/CreationFiches.js" ></script>