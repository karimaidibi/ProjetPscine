<?php

echo '<div class=" container mt-5 bg-dark bg-gradient" align=center style="color:whitesmoke;">
        <p class="fs-5"> Chercher par catégorie, par fiche ou par ingrédient ! </p>
      </div>

      <!---La barre de recherche, trier les fiches et bouton ajouter une fiches-->
      <div class="container-fluid pt-4">
        <div class="row rows-cols-3">
            <!--premiére colonne-->
            <div class="col-5">
                <!---- Barre de recherche des fiches techniques 
                    - soit par nom de la fiche
                    - soit par catégorie 
                    - soit par nom de l auteur-->
                <div class="container d-inline-flex bd-highlight">
                    <div class="flex-shrink-0 mt-1">
                            <i class="bi bi-search"></i>
                    </div>
                    <div class="flex-grow-1 ms-3 ">
                        <input class="form-control" list="datalistOptions" id="chercherFiche" onkeyup="recherche()" placeholder="Chercher..." type="text">
                        <datalist id="datalistOptions">';
                        foreach ($tab_u as $element){
                            $NomFiche = $element->getNomFiche();
                             echo '<option value=' .$NomFiche. '>';
                        }
                  echo '</datalist> 
                    </div>                   
                </div>
            </div>
            <!--deuxieme colonne-->
            <div class="col-3">
                <!--- Bouton pour trier les fiches techniques-->
                <div class="dropdown">
                    <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-sort-alpha-down"></i>
                      Trier par
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                      <li><button class="dropdown-item" type="button">Catégorie</button></li>

                      <li><button class="dropdown-item" type="button" onClick="TrierNomAZ()" >a--z</button></li>
                      <li><button class="dropdown-item" type="button" onClick="TrierNomZA()" >z--a</button></li>
                    </ul>
                </div>
            </div>
            <!--3eme colonne colonne-->
            <div class="col-4">
                <button type="button" class="btn btn-dark">
                    <a class="" href="index.php?controller=ficheTechnique&action=update" style="color:white; text-decoration:none">
                    <i class="bi bi-plus-square"></i>
                    Créer une ficher technique</a>
                </button>
            </div>
        </div>
      </div>



      <div class="container-fluid pt-5 ps-5 pe-5">
        <!------LA TABLE QUI CONTIENT LES FICHES TECHNIQUES--------->
        <table class="table table-striped table-hover align-middle" id="TableFiche">
            <thead class = "table-dark">
            <tr>
                <th scope="col">NomFiche</th>
                <th scope="col">NbreCouverts</th>
                <th scope="col">NomAuteur</th>
                <th scope="col">Catégorie</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>';


foreach ($tab_u as $u)
{
    $NumeroFiche = $u->getNumeroFiche();
    $NomFiche = $u->getNomFiche();
    $NbreCouverts = $u->getNbreCouverts();
    $NomAuteur = $u->getNomAuteur();
    $CoutFluide = $u->getCoutFluide();
    $NumCategorieFiche = $u->getFK_NumeroCatFiche();

    $NomCategorieFiche = ModelCategorie_Fiche::select($NumCategorieFiche) -> getNomCatFiche(); //une ligne = objet

  
        echo '<tr>
                <td>'.$NomFiche.'</td>
                <td>'.$NbreCouverts.'</td>
                <td>'. $NomAuteur.'</td>
                <td>'. $NomCategorieFiche.'</td>
                <td>
                    <div class="d-grid gap-2 d-md-block">
                        <button class="btn btn-success" type="button">
                            <a href="index.php?controller=ficheTechnique&action=update&NumeroFiche=' . $NumeroFiche . '">
                            <i class="bi bi-pencil" style="font-size: 1rem; color:black;" ></i>
                            </a>
                        </button>
                        <button class="btn btn-danger" type="button">
                            <a href="index.php?controller=ficheTechnique&action=delete&NumeroFiche=' . $NumeroFiche . ' ">
                            <i class="bi bi-trash" style="font-size: 1rem; color:black;" ></i>
                            </a>                    
                        </button>
                        <button class="btn btn-primary" type="button">
                        <a href="index.php?controller=ficheTechnique&action=test&controller=ingredient&action=test">
                            <i class="bi bi-eye" style="font-size: 1rem; color:black;" ></i>    
                        </a>                
                        </button>
                    </div>
                </td>
            </tr>';
}
    echo "</tbody>
        </table>
        </div>";
?>

<script>
    // chercher les fiches par nom de la fiche
    function recherche() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("chercherFiche");
        filter = input.value.toUpperCase();
        table = document.getElementById("TableFiche");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
            }
        }
    }

    // trier les fiches par ordre alphabétique
    function TrierNomAZ() {
        var table, rows, switching, i, x, y, shouldSwitch;
        table = document.getElementById("TableFiche");
        switching = true;
        /* Make a loop that will continue until
        no switching has been done: */
        while (switching) {
            // Start by saying: no switching is done:
            switching = false;
            rows = table.rows;
            /* Loop through all table rows (except the
            first, which contains table headers): */
            for (i = 1; i < (rows.length - 1); i++) {
                // Start by saying there should be no switching:
                shouldSwitch = false;
                /* Get the two elements you want to compare,
                one from current row and one from the next: */
                x = rows[i].getElementsByTagName("td")[0];
                y = rows[i + 1].getElementsByTagName("td")[0];
                // Check if the two rows should switch place:
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    // If so, mark as a switch and break the loop:
                    shouldSwitch = true;
                    break;
                }
            }
            if (shouldSwitch) {
            /* If a switch has been marked, make the switch
            and mark that a switch has been done: */
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            }
        }
    }

    // trier les fiches par ordre alphabétique
    function TrierNomZA() {
        var table, rows, switching, i, x, y, shouldSwitch;
        table = document.getElementById("TableFiche");
        switching = true;
        /* Make a loop that will continue until
        no switching has been done: */
        while (switching) {
            // Start by saying: no switching is done:
            switching = false;
            rows = table.rows;
            /* Loop through all table rows (except the
            first, which contains table headers): */
            for (i = 1; i < (rows.length - 1); i++) {
                // Start by saying there should be no switching:
                shouldSwitch = false;
                /* Get the two elements you want to compare,
                one from current row and one from the next: */
                x = rows[i].getElementsByTagName("td")[0];
                y = rows[i + 1].getElementsByTagName("td")[0];
                // Check if the two rows should switch place:
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                    // If so, mark as a switch and break the loop:
                    shouldSwitch = true;
                    break;
                }
            }
            if (shouldSwitch) {
            /* If a switch has been marked, make the switch
            and mark that a switch has been done: */
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            }
        }
    }
</script>