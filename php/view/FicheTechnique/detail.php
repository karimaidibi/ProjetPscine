<?php

    
    $NomFiche = $u->getNomFiche();
    $NbreCouverts = $u->getNbreCouverts();
    $NomAuteur = $u->getNomAuteur();
    $CoufFluide = $u->getCoutFluide();
    $FK_NumeroCatFiche = $u->getFK_NumeroCatFiche();

    echo $NomFiche .' '. $NbreCouverts;

?>