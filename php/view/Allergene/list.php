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
                        <label for="NomAllergene" class="col-form-label">
                            Nom de l \'allergene :   
                        </label>
                    </div>
                    <!-- Deuxième sous colonne -->
                    <div class="col-auto">
                        <div class="input-group">
                            <input type="text" id="NomAllergene" name="NomAllergene" class="form-control" placeholder="Ajoutez un allergene" required/>
                            <input type="hidden" name="controller" value="Allergene" >
                            <button class="btn btn-dark" type="submit">
                                <input type="hidden" name="action" value="update">
                                Créer l\'allergene
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
                <th scope="col">Nom de l\allergène</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>';
    foreach ($allergene as $all)
    {
        $NomAllergene= $all->getNomAllergene();
        $NumAllergene = $all->getNumAllergene();
         echo '<tr>
                    <td>' .$NomAllergene. '</td>
                     <!--Boutons modifier et supprimer-->
                    <td>
                        <button class="btn btn-danger" type="button">
                                <a href="index.php?controller=allergene&action=delete&NumAllergene=' . $NumAllergene . ' ">
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