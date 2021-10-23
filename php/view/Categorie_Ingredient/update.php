<?php
if($type=='readonly'){
  $NumCategorie = $Categorie->getNumCategorie();
  $NomCategorie = $Categorie->getNomCategorie();

}

echo '<form class= "was-validated">
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
                                    <label for="NomCategorie" class="col-form-label">
                                    Nom de la catégorie à créer 
                                    </label>
                                </div>
                                <!-- Deuxième sous colonne -->
                                <div class="col-auto">';
                                if($type=='readonly'){
                                  echo '<input type="hidden" id="NumCategorie_id" name="NumCategorie" class="form-control" value="'. $NumCategorie . '" required/>';
                                    echo '<input type="text" id="NomCategorie_id" name="NomCategorie" class="form-control" value="' . $NomCategorie . '" required/>';
                                }
                                else{
                                  echo '<input type="text" id="NomFiche_id" name="NomCategorie" class="form-control" placeholder="Ajoutez un nom" required/>';
                                }
                                echo '</div>
                            </div>
                        </li>
                        <div class="mt-3 mb-5 " align=center>
              <input type=\'hidden\' name=\'controller\' value=\'Categorie_Ingredient\'>';
              if($type=='readonly'){
                echo '<button class="btn btn-dark" type="submit" onclick="submit()">
                <input type=\'hidden\' name=\'action\' value=\'updated\'>
                    <i class="bi bi-cloud-arrow-up"></i>
                    Modifier la catégorie 
                    </button>';
              }
              else{
                echo '<button class="btn btn-dark" type="submit" >
                <input type=\'hidden\' name=\'action\' value=\'created\'>
                  <i class="bi bi-cloud-arrow-up"></i>
                  Créer la catégorie
                    </button>';
              }
          echo '         
          </div>
        </form>
      </div>';

?>