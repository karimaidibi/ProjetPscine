<?php
foreach ($tab_v as $v)
{
    $NumeroFiche = $v->getNumeroFiche();
    $NomFiche = $v->getNomFiche();
    $NbreCouverts = $v->getNbreCouverts();
    $NomAuteur = $v->getNomAuteur();
    $CoutFluide = $v->getCoutFluide();
    echo '<div class="produitThe">';
    echo '<div><a href="index.php?action=read&NumeroFiche='. htmlspecialchars($NumeroFiche) .'">'.htmlspecialchars($NomFiche).'</a></div>';
    //echo '<form method="get" action="index.php?controller=panier&action=ajouterArticle">';
    
    echo '<form>';
    echo '<p><label for="ticketNum">Quantité à ajouter :</label>';
    echo '<input type="hidden" name="controller" value="panier">
            <input type="hidden" name="action" value="ajouterArticle">';
    //echo '<input id="id_qte" type="number" name="qte" min="1" max="'.$stockmax.'" value="1"></p>';
    if($stockmax<1){
        echo '<input id="id_qte" type="number" name="qte" min="1" max="'.$stock.'" value="1"></p>';
    }
    else{
        echo '<input id="id_qte" type="number" name="qte" min="1" max="'.$stockmax.'" value="1"></p>';
    }
    echo '<div>
            <input type="hidden" name="idP" value="'.$idP.'">
            <input type=submit value="Ajouter au Panier"/>
        </div>';
    echo '</form>';
    echo '</div>';
}
?>