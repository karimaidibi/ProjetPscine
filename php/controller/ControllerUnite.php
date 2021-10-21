<?php
require_once File::build_path(array("model", "ModelUnite.php"));
class ControllerUnite{

	protected static $object='unite';

	public static function readAll() {
        $tab_u = ModelUnite::selectAll();     //appel au modèle pour gerer la BD  //"redirige" vers la vue
        $view='list';
        $pagetitle='Liste des unités';
        require_once File::build_path(array("view", "view.php"));
    }

    public static function read(){
    	if(!is_null(myGet('NumUnite'))){
	    	$NumUnite = myGet('NumUnite');
	    	$u = ModelUnite::select($NumUnite);
	    	if($u==false){
        		$view='error';
        		$pagetitle='Page 404';
	    		require_once File::build_path(array("view", "view.php"));
	    	}
	    	else{
        		$view='detail';
        		$pagetitle='Catégorie ' . $NumUnite;
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
		if(!is_null(myGet('NumUnite'))){
        	$view='error';
        	$pagetitle='Page 404';
	    	require_once File::build_path(array("view", "view.php"));
		}
		else{
			$NumUnite = myGet('NumUnite');
			ModelUnite::delete($NumUnite);
			$tab_u = ModelUnite::selectAll();
	        $view='deleted';
	        $pagetitle='Catégorie supprimé';
		    require_once File::build_path(array("view", "view.php"));
		}
	}

	public static function create($nomU){
        $v1 = new ModelUnite($nomU);
		$v1->save();
		return $v1->getIdUnite();
	}
}
?>