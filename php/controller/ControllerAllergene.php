<?php
require_once File::build_path(array("model", "ModelAllergene.php"));
class ControllerAllergene{

	protected static $object='allergene';

	public static function readAll() {
        $tab_u = ModelAllergene::selectAll();     //appel au modèle pour gerer la BD  //"redirige" vers la vue
        $view='list';
        $pagetitle='Liste des allergènes';
        require_once File::build_path(array("view", "view.php"));
    }

    public static function read(){
    	if(!is_null(myGet('NumAllergene'))){
	    	$NumAllergene = myGet('NumAllergene');
	    	$u = ModelAllergene::select($idAllergene);
	    	if($u==false){
        		$view='error';
        		$pagetitle='Page 404';
	    		require_once File::build_path(array("view", "view.php"));
	    	}
	    	else{
        		$view='detail';
        		$pagetitle='Catégorie ' . $NumAllergene;
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
		if(!is_null(myGet('NumAllergene'))){
        	$view='error';
        	$pagetitle='Page 404';
	    	require_once File::build_path(array("view", "view.php"));
		}
		else{
			$NumAllergene = myGet('NumAllergene');
			ModelAllergene::delete($idAllergene);
			$tab_u = ModelAllergene::selectAll();
	        $view='deleted';
	        $pagetitle='Catégorie supprimé';
		    require_once File::build_path(array("view", "view.php"));
		}
	}

	public static function create($nomA){
        $v1 = new ModelAllergene($nomA);
		$v1->save();
		return $v1->getNumAllergene();
	}
}
?>