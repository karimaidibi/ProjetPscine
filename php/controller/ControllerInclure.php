<?php
class ControllerInclure{

	protected static $object='Inclure';

	public static function readAll() {
        $tab_u = ModelInclure::selectAll();     //appel au modèle pour gerer la BD  //"redirige" vers la vue
        $view='list';
        $pagetitle='Liste des inclusions';
        require_once File::build_path(array("view", "view.php"));
    }

    public static function read(){
    	if(!is_null(myGet('NumeroFiche'))){
	    	$NumeroFiche = myGet('NumeroFiche');
	    	$u = ModelInclure::select($NumeroFiche);
	    	if($u==false){
        		$view='error';
        		$pagetitle='Page 404';
	    		require_once File::build_path(array("view", "view.php"));
	    	}
	    	else{
        		$view='detail';
        		$pagetitle='Inclure ' . $NumeroFiche;
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
		if(!is_null(myGet('NumeroFiche'))){
        	$view='error';
        	$pagetitle='Page 404';
	    	require_once File::build_path(array("view", "view.php"));
		}
		else{
			$NumeroFiche = myGet('NumeroFiche');
			ModelInclure::delete($NumeroFiche);
			$tab_u = ModelInclure::selectAll();
	        $view='deleted';
	        $pagetitle='Inclusion supprimée';
		    require_once File::build_path(array("view", "view.php"));
		}
	}

	public static function create($NumeroSousFiche){
        $v1 = new ModelInclure($NumeroSousFiche);
		$v1->save();
		return $v1->getNumeroFiche();
	}
}
?>