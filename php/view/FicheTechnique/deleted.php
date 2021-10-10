<?php
echo '<p>La fiche technique ' . $NomFiche . ' a bien été supprimé !</p>';
require_once File::build_path(array("view","ficheTechnique","list.php"));
?>