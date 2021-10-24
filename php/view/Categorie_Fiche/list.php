<?php
ini_set('display_errors', 'on'); 

    echo '<!--Label pour laffichage des ingrédients-->
    <div class="container bg-light bg-gradient border border-dark mt-5">
        <div class=" container-fluid bg-dark bg-gradient" align=center style="color:whitesmoke;">
            <p class="fs-5"> Liste des allergènes </p>
        </div>

        <div class="container pt-5 ps-5 pe-5">
                <!--3eme colonne-->
            <form class="was-verified">
            <div class="mb-4">
                <div class="row g-2 align-items-center">
                    <!-- première sous colonne -->
                    <div class="col-auto">
                        <label for="NomCatFiche" class="col-form-label">
                            Nom de la catégorie :   
                        </label>
                    </div>
                    <!-- Deuxième sous colonne -->
                    <div class="col-auto">
                        <div class="input-group">
                            <input type="text" id="NomCatFiche" name="NomCatFiche" class="form-control" placeholder="Ajoutez une catégorie" required/>
                            <input type="hidden" name="controller" value="Categorie_Fiche" >
                            <button class="btn btn-dark" type="submit">
                                <input type="hidden" name="action" value="update">
                                Créer la catégorie
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            </form> 
        </div>
        <!--Tableau qui contient les ingrédients triés-->
        <table class="table table-striped table-hover w-auto mx-auto">
            <thead class = "table-dark">
            <tr>
                <th scope="col">Nom de la catégorie</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>';
    foreach ($categorie as $cat)
    {
        $NomCatFiche= $cat->getNomCatFiche();
        $NumeroCatFiche = $cat->getNumeroCatFiche();
         echo '<tr>
                    <td>' .$NomCatFiche. '</td>
                     <!--Boutons modifier et supprimer-->
                    <td>
                        <button class="btn btn-danger" type="button">
                                <a href="index.php?controller=Categorie_Fiche&action=delete&NumeroCatFiche=' . $NumeroCatFiche . ' ">
                                <i class="bi bi-trash" style="font-size: 1rem; color:white;" ></i>
                                </a>  
                        </button>
                    </td>
                </tr>';
    }

    echo '            
            </tbody>
        </table>
        </div> 
    </div>';

?>