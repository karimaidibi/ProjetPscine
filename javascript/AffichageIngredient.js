    // chercher les fiches par nom de la fiche
    function recherche() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("chercherIngredient");
        filter = input.value.toUpperCase();
        table = document.getElementById("TableIngredient");
        tr = table.getElementsByTagName("tr");
        var ChercherPar = document.getElementById("chercherpar").value;
        console.log(ChercherPar);
        var colonne = 0;
        switch(ChercherPar){
            case "Nom Ingredient":
                colonne = 0;
                console.log("je suis passé par NomIngredient");
            break;

            case "Categorie":
                colonne = 1;
                console.log("je suis passé par Categorie");
            break;
            
            case "Unite":
                colonne = 2;
                console.log("je suis passé par Unite");
            break;

            case "Type allergene":
                colonne = 3;
                console.log("je suis passé par allergene");
            break;

            case "PrixUnitaire":
                colonne = 4;
                console.log("je suis passé par prixU");
            break;
            
            case "TVA":
                colonne = 5;
                console.log("je suis passé par TVA");
            break;
        }

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[colonne];
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
        table = document.getElementById("TableIngredient");
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
        table = document.getElementById("TableIngredient");
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