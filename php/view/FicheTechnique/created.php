<?php
    if($type=="created"){
        echo '<div class="alert alert-success mt-5" role="alert">
		<p align="center">La fiche ' . $NomFiche  . ' a bien été crée !</p>	
		</div>';
    }elseif($type=="modified"){
        echo '<div class="alert alert-success mt-5" role="alert">
		<p align="center">La fiche ' . $NomFiche  . ' a bien été modifié !</p>	
		</div>';
    }else{
        echo '<div class="alert alert-success mt-5" role="alert">
		<p align="center">La fiche ' . $NomFiche . ' a bien été utilisée !</p>	
		</div>';
    }

	require_once File::build_path(array("view","FicheTechnique","list.php"));
?>