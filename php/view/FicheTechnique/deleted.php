<?php
	echo '<div class="alert alert-danger mt-5" role="alert">
		<p align="center">La recette ' . $NomFiche . ' a bien été supprimé !</p>	
		</div>';
	require_once File::build_path(array("view","ficheTechnique","list.php"));
?>

