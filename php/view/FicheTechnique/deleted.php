<?php
	echo '<p>La recette ' . $NomFiche . ' a bien été supprimé !</p>';
	require_once File::build_path(array("view","ficheTechnique","list.php"));
?>