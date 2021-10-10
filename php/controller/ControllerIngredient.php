<?php
ini_set('display_errors', 'on'); 
require_once File::build_path(array("model", "ModelIngredient.php"));
require_once File::build_path(array("controller", "ControllerFicheTechnique.php"));
class ControllerIngredient{

	protected static $object='ingredient';

	public static function readAll() {
        $tab_u = ModelIngredient::selectAll();     //appel au modèle pour gerer la BD  //"redirige" vers la vue
        $view='list';
        $pagetitle='Liste des catégories';
        require_once File::build_path(array("view", "view.php"));
    }

    public static function read(){
    	if(!is_null(myGet('idI'))){
	    	$idI = myGet('idI');
	    	$u = ModelIngredient::select($idIngredient);
	    	if($u==false){
        		$view='error';
        		$pagetitle='Page 404';
	    		require_once File::build_path(array("view", "view.php"));
	    	}
	    	else{
        		$view='detail';
        		$pagetitle='Catégorie ' . $idI;
	    		require_once File::build_path(array("view", "view.php"));
	    	}
    	}
    	else{
        	$view='error';
        	$pagetitle='Page 404';
	    	require_once File::build_path(array("view", "view.php"));
    	}
	}

	public static function delete(){
		if(!is_null(myGet('idI'))){
        	$view='error';
        	$pagetitle='Page 404';
	    	require_once File::build_path(array("view", "view.php"));
		}
		else{
			$idI = myGet('idI');
			ModelIngredient::delete($idIngredient);
			$tab_u = ModelIngredient::selectAll();
	        $view='deleted';
	        $pagetitle='Catégorie supprimé';
		    require_once File::build_path(array("view", "view.php"));
		}
	}

	public static function create($nomI,$prixI){
        $v1 = new ModelIngredient($nomI,$prixI);
		$v1->save();
		return $v1->getIdIngredient();
	}
}
?>