<?php

	ini_set('display_errors', 'on'); 
	class File{
		/*build_path(dossier,fichier) :
			- return le chemin à partir de la raçine arrivant au fichier 
			- la fonction join sert à coller des éléments de la liste par un varactère
			- la variable $path_array va contenir une array de deux élements (dossier,fiche)
			- regarder le fichier index.php pour comprendre le fonctionnement de build_path
			- Exemple :
				c:/piscine/dossier/fichier*/
		public static function build_path($path_array) {
			$DS = DIRECTORY_SEPARATOR;
			$ROOT_FOLDER = __DIR__ . $DS . "..";
			return $ROOT_FOLDER. $DS . join($DS, $path_array); //php/model/model
		}
	}

?>