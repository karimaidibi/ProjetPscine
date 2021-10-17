<?php
	echo '<div class="alert alert-danger mt-5" role="alert">
		<p align="center">L\'ingredient ' . $NomIng . ' a bien été supprimé !</p>	
		</div>';
	require_once File::build_path(array("view","Ingredient","list.php"));
?>