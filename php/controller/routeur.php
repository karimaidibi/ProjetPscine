<?php
	//ini_set('display_errors', 'on'); 
	require_once File::build_path(array("lib","File.php"));	
	require_once File::build_path(array("controller", "ControllerProduit.php"));
	require_once File::build_path(array("controller", "ControllerUtilisateur.php"));
	require_once File::build_path(array("controller", "ControllerPanier.php"));

	if(!isset($_GET['controller'])){
		$controller = "produit";
	}
	else{
		$controller = $_GET['controller'];
	}
	$controller_class = "Controller" . ucfirst($controller);
	if(!class_exists($controller_class)){
		ControllerProduit::error();
	}
	else
	{
		Session::timeoutUtilisateur();
		Session::timeoutPanier();
		if(!isset($_GET['action'])){
			ControllerProduit::readAll();
		}
		else{
			$action = $_GET['action'];
			if(!method_exists($controller_class, "$action")){
				ControllerProduit::error();
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