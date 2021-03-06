<?php

	//LE CONTROLLER EST INCLUS SELON LACTION DE LUTILISATEUR
	ini_set('display_errors', 'on'); 
	require_once File::build_path(array("lib","File.php"));	
	require_once File::build_path(array("controller","ControllerFicheTechnique.php"));
	require_once File::build_path(array("controller","ControllerIngredient.php"));	
	require_once File::build_path(array("controller","ControllerAcceuil.php"));
	require_once File::build_path(array("controller","ControllerCategorie_Ingredient.php"));
	require_once File::build_path(array("controller","ControllerCategorie_Fiche.php"));
	require_once File::build_path(array("controller","ControllerAllergene.php"));
	require_once File::build_path(array("controller","ControllerTVA.php"));
	require_once File::build_path(array("controller","ControllerUnite.php"));
	require_once File::build_path(array("controller","ControllerCoeffAss.php"));
	require_once File::build_path(array("controller","ControllerCoeffCoutPersonnel.php"));

	/*SI ON NE TROUVE PAS CONTROLLR SPECIFIQUE =>
		- on affiche la page d'acceuil
		- sinon on récupère le controller trouvé (demandé par l'utilisateur)*/

	if(!isset($_GET['controller'])){
		$controller = "Acceuil";
	}
	else{
		$controller = $_GET['controller'];
	}
	$controller_class = "Controller" . ucfirst($controller); //ucfirst = UpperCaseFirst
	/* SI LE CONTROLLER DEMANDE NEXISTE PAS => */
	if(!class_exists($controller_class)){
		ControllerFicheTechnique::error();
	}
	else
	{
		if(!isset($_GET['action'])){
			ControllerAcceuil::readAll();
		}
		else{
			$action = $_GET['action'];
			if(!method_exists($controller_class, "$action")){
				ControllerFicheTechnique::error();
			}
			else{
				$controller_class::$action();
			}
		}
	}

	function myGet($nomVar){
		if(isset($_GET[$nomVar])){
			return $_GET[$nomVar];
		}
		if(isset($_POST[$nomVar])){
			return $_POST[$nomVar];
		}
		else{
			return NULL;
		}	
	}

?>