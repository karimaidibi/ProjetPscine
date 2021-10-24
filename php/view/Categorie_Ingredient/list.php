<?php
ini_set('display_errors', 'on'); 

    echo '<!--Label pour laffichage des ingrédients-->
    <div class="container bg-light bg-gradient border border-dark mt-5 ">
        <div class=" container-fluid bg-dark bg-gradient" align=center style="color:whitesmoke;">
            <p class="fs-5"> Liste des catégories d\'ingrédient </p>
        </div>

        <div class="container pt-5 ps-5 pe-5">
        <!--3eme colonne-->
        <div class="mb-4">
            <button type="button" class="btn btn-dark ">
                <a href="index.php?controller=categorie_Ingredient&action=update" style="color:white; text-decoration:none;">
                <i class="bi bi-plus-square"></i>
                Créer une nouvelle catégorie d\'ingrédient
                </a>
            </button>
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
    foreach ($Categorie as $cat)
    {
        $NomCategorie = $cat->getNomCategorie();
        $NumCategorie = $cat->getNumCategorie();
         echo '<tr>
                    <td>' .$NomCategorie. '</td>
                     <!--Boutons modifier et supprimer-->
                    <td>
                        <div class="d-grid gap-2 d-md-block">
                            <button class="btn btn-success" type="button">
                                <a href="index.php?controller=categorie_Ingredient&action=update&NumCategorie=' . $NumCategorie . '">
                                <i class="bi bi-pencil" style="font-size: 1rem; color:white;" ></i>
                                </a>
                            </button>
                            <button class="btn btn-danger" type="button">
                                    <a href="index.php?controller=categorie_Ingredient&action=delete&NumCategorie=' . $NumCategorie . ' ">
                                    <i class="bi bi-trash" style="font-size: 1rem; color:white;" ></i>
                                    </a>  
                            </button>
                        </div>
                    </td>
                </tr>';
    }

    echo '            
            </tbody>
        </table>
        </div> 
    </div>';

?>