<?php


// si on update la fiche 
if($type=='readonly'){
  $NomFiche = $fiche->getNomFiche();
  $NbreCouverts = $fiche->getNbreCouverts();
  $NomAuteur = $fiche->getNomAuteur();
  $CoutFluide = $fiche->getCoutFluide();
  $FK_NumeroCatFiche = $fiche->getFK_NumeroCatFiche();

  //categorie de la fiche
  $categorie = ModelCategorie_Fiche::select($FK_NumeroCatFiche);
  $NomCatFiche = $categorie -> getNomCatFiche();

  //coefficients de la fiche
  print_r($coefficientASS);
  print_r($coefficientCoutPersonnel);

}

echo '<!--Titré création de fiche technique -->
      <div class="container mt-5 bg-dark bg-gradient" align=center>
          <p class="fs-2" style="color:white;"> Création d\'une fiche technique </p>
      </div>

      <!---la division qui  contient tout le form de création de la fiche technique
            - en appuyant sur submit, tout le contenu de ce form va etre validé en meme temps-->
      <div class="container-fluid mt-5 ps-4 pe-3 bg-light bg-gradient">
        <form>
            <!--liste d input des  Descriptifs et des coeff -->
            <div class="row row-cols-2 justify-content-around pt-4">
                <!-- la liste d inpput des descriptifs dans une colonne-->
                <div class="col-6 bg-dark" >
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
                                    echo '<input type="text" id="NomFiche_id" name="NomFiche" class="form-control" value="' . $NomFiche . '">';
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
                                    echo '<input type="number" id="NbreCouverts_id" name="NbreCouverts" class="form-control" value="' . $NbreCouverts . '">';
                                  }
                                  else{
                                    echo '<input type="number" id="NbreCouverts_id" name="NbreCouverts" class="form-control" placeholder="Ajoutez un nombre de couverts" required/>';
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
                              echo '<input type="text" id="NomAuteur_id" name="NomAuteur" class="form-control" value="' . $NomAuteur . '">';
                            }
                            else{
                              echo '<input type="text" id="NomAuteur_id" name="NomAuteur" class="form-control" placeholder="Ajoutez le nom de l\'auteur" required/>';
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
                                if($NumCategorie==$FK_NumeroCatFiche){
                                  echo '<option selected value = "'.$FK_NumeroCatFiche.'"> '.$NomCatFiche.' </option>';
                                }
                                else{
                                  echo  
                                  '<option value="'.$NumCategorie.'">'.$NomCategorie.'</option>';
                                }
                              }
                            }else{
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
                              <select id="coeffASS" name="CodeCoeffAss" class="form-select">';
                            if($type=='readonly'){
                              foreach($coefficients as $coeff){ // pour chaque coefficients dans la BD 
                                $CodeCoeff = $coeff->getCodeCoeff();
                                $valeurCoefficient = $coeff->getvaleurCoefficient(); 
                                  if($CodeCoeff==$coefficientASS[0][0]){
                                    echo '<option selected value = "'.$CodeCoeff.'"> '.$valeurCoefficient.' </option>';
                                  }
                                  else{
                                    echo  
                                    '<option value="'.$CodeCoeff.'">'.$valeurCoefficient.'</option>';
                                  }
                              }
                            }else{
                              foreach($coefficients as $coeff){
                                $CodeCoeff = $coeff->getCodeCoeff();
                                $valeurCoefficient = $coeff->getvaleurCoefficient();
                                echo  
                                    '<option value="'.$CodeCoeff.'">'.$valeurCoefficient.'</option>';
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
                              <select id="coeffASS" name="CodeCoeffCoutPersonnel" class="form-select">';
                              if($type=='readonly'){
                                foreach($coefficients as $coeff){ // pour chaque coefficients dans la BD 
                                  $CodeCoeff = $coeff->getCodeCoeff();
                                  $valeurCoefficient = $coeff->getvaleurCoefficient(); 
                                    if($CodeCoeff==$coefficientCoutPersonnel[0][0]){
                                      echo '<option selected value = "'.$CodeCoeff.'"> '.$valeurCoefficient.' </option>';
                                    }
                                    else{
                                      echo  
                                      '<option value="'.$CodeCoeff.'">'.$valeurCoefficient.'</option>';
                                    }
                                }
                              }else{
                                foreach($coefficients as $coeff){
                                  $CodeCoeff = $coeff->getCodeCoeff();
                                  $valeurCoefficient = $coeff->getvaleurCoefficient();
                                  echo  
                                      '<option value="'.$CodeCoeff.'">'.$valeurCoefficient.'</option>';
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
                                echo '<input type="number" step="any" id="CoutFluide_id" name="CoutFluide" class="form-control" value="' . $CoutFluide . '">';   
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
                    <textarea class="form-control" id="inputProgressionInDB" rows="3"></textarea>
                  </div>
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
                          '<option value="'.$DescriptionEtape.'" class="nomProgression">';
                    
                  }
                  echo '
                    </datalist>
                  </div>
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
                      <tbody id="bodyProgressions">
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
                    <!-- La barre de recherche -->
                    <div class="flex-grow-1 ms-3 ">
                      <!-- Input group qui rassemble le bouton d\'ajout a la barre de recherche -->
                      <div class="input-group">
                        <button class="btn btn-dark" type="button" onclick="CreateLigneIngredient()">
                          <i class="bi bi-plus-square"></i>
                        </button>
                        <input class="form-control" list="listeDesIngredients" id="inputIngredient" placeholder="Chercher un ingrédient..">
                        <datalist id="listeDesIngredients">';
                        foreach($ingredients as $i){
                          $NumIngredient = $i -> getNumIngredient();
                          $NomIng = $i -> getNomIng();
                          echo '<option value="'.$NomIng.'" class="nomIngredient">
                          <input type="hidden" value ="'.$NumIngredient.'" class="NumIngredient">';
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
                    <table class="table table-striped table-hover align-middle">
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
                            <!-- 7ème colonne-->
                            <th scope="col"></th> 
                          </tr>
                      </thead>
                      <!- gerer avec javascript et php->
                      <tbody id="bodyIngredients">
                      </tbody>
                    </table>
                  </div>
              </div>
            </div>
            <!-- une ligne contenante un input pour rajouter des fiches techniques  -->
            <div class="row row-cols-2 pt-4">
                <!-- Les prix de la fichetechniques -->
                <div class="col-4">
                  <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                        <th scope="col" colspan="2"> Prix </th>
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
                  echo '<option value="'.$NomFiche.'" class="nomFiche">
                          <input type="hidden" value ="'.$NumeroFiche.'" class="NumeroFiche">
                        </option>' ;
                    }
              echo  '</datalist>
                  </div>
                  <div class="pt-4">
                      <!------LA TABLE QUI CONTIENT LES FICHES TECHNIQUES--------->
                      <table class="table table-striped table-hover align-middle">
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
                        <tbody id="bodyFiche">
                        </tbody>
                    </table>
                  </div>
                </div>
            </div>
              <!-- validation -->
          <div class="mt-3 mb-5 " align=center>
            <button class="btn btn-dark" type="button">
              <i class="bi bi-folder-plus"></i>
              <input type=\'hidden\' name=\'controller\' value=\'ficheTechnique\'>';
              if($type=='readonly'){
                echo '<input type=\'hidden\' name=\'action\' value=\'updated\'>';
                echo '<input class="btn btn-dark" type="submit" value="Modifier la fiche technique" />';
              }
              else{
                echo '<input type=\'hidden\' name=\'action\' value=\'created\'>';
                echo '<button class="btn btn-dark" type="button" onclick="submit()">';
                echo '<input class="btn btn-dark" type="submit" value="Créer la fiche technique" />';
              }
      echo '</button>
            <button class="btn btn-dark" type="button">
              <i class="bi bi-emoji-heart-eyes"></i>
              Aperçu fiche 
            </button>             
          </div>
        </form>
      </div>
      <!-- Optional JavaScript; choose one of the two! -->

      <!-- Option 1: Bootstrap Bundle with Popper -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

      <!-- Option 2: Separate Popper and Bootstrap JS -->
      <!--
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
      -->'

?>

<script src="../javascript/CreationFiches.js" ></script>
