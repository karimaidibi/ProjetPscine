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
                        <label for="NomTVA" class="col-form-label">
                            ajouter le nom puis le Coef TVA :   
                        </label>
                    </div>
                    <!-- Deuxième sous colonne -->
                    <div class="col-auto">
                        <div class="input-group">
                            <input type="text" id="NomTVA" name="NomTVA" class="form-control" placeholder="Ajoutez un nom TVA" required/>
                            <input type="number" step="any" id="NomTVA" name="CoefTVA" class="form-control" placeholder="Ajoutez un CoefTVA" required/>
                            <input type="hidden" name="controller" value="tva" >
                            <button class="btn btn-dark" type="submit">
                                <input type="hidden" name="action" value="update">
                                Créer le TVA
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
                <th scope="col">Nom du TVA</th>
                <th scope="col">Coef du TVA</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>';
    foreach ($TVA as $tva)
    {
        $NomTVA= $tva->getNomTVA();
        $CoefTVA= $tva->getCoefTVA();
        $CodeTVA = $tva->getCodeTVA();
         echo '<tr>
                    <td>' .$NomTVA. '</td>
                    <td>' .$CoefTVA. '</td>
                     <!--Boutons modifier et supprimer-->
                    <td>
                        <button class="btn btn-danger" type="button">
                                <a href="index.php?controller=tva&action=delete&CodeTVA=' . $CodeTVA . ' ">
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