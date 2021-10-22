<?php
    if($type=="created"){
        echo '<div class="alert alert-success mt-5" role="alert">
		<p align="center">L\'ingredient ' . $NomIng . ' a bien été crée !</p>	
		</div>';
    }elseif($type=="modified"){
        echo '<div class="alert alert-success mt-5" role="alert">
		<p align="center">L\'ingredient ' . $NomIng . ' a bien été modifié !</p>	
		</div>';
    }else{
        echo '<div class="alert alert-success mt-5" role="alert">
		<p align="center">Le stock de l\'ingredient ' . $NomIng . ' a bien été modifié !</p>	
		</div>';
    }

	require_once File::build_path(array("view","Ingredient","list.php"));
?>