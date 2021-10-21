<?php
require_once File::build_path(array("model", "ModelCategorie.php"));
class ControllerCategorie_Ingredient{

	protected static $object='categorie';

	public static function readAll() {
        $tab_u = ModelCategorie::selectAll();     //appel au modèle pour gerer la BD  //"redirige" vers la vue
        $view='list';
        $pagetitle='Liste des catégories';
        require_once File::build_path(array("view", "view.php"));
    }

    public static function read(){
    	if(!is_null(myGet('NumCategorie'))){
	    	$NumCategorie = myGet('NumCategorie');
	    	$u = ModelCategorie::select($idCategorie);
	    	if($u==false){
        		$view='error';
        		$pagetitle='Page 404';
	    		require_once File::build_path(array("view", "view.php"));
	    	}
	    	else{
        		$view='detail';
        		$pagetitle='Catégorie ' . $NumCategorie;
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
		if(!is_null(myGet('NumCategorie'))){
        	$view='error';
        	$pagetitle='Page 404';
	    	require_once File::build_path(array("view", "view.php"));
		}
		else{
			$NumCategorie = myGet('NumCategorie');
			ModelCategorie::delete($idCategorie);
			$tab_u = ModelCategorie::selectAll();
	        $view='deleted';
	        $pagetitle='Catégorie supprimé';
		    require_once File::build_path(array("view", "view.php"));
		}
	}

	public static function create($nomC){
        $v1 = new ModelCategorie_Ingredient($nomC);
		$v1->save();
		return $v1->getNumCategorie();
	}
}
?>