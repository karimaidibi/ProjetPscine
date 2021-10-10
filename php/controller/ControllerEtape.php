<?php
class ControllerEtape{

	protected static $object='Etape';

	public static function readAll() {
        $tab_u = ModelEtape::selectAll();     //appel au modèle pour gerer la BD  //"redirige" vers la vue
        $view='list';
        $pagetitle='Liste des étapes';
        require_once File::build_path(array("view", "view.php"));
    }

    public static function read(){
    	if(!is_null(myGet('NumEtape'))){
	    	$NumEtape = myGet('NumEtape');
	    	$u = ModelEtape::select($NumEtape);
	    	if($u==false){
        		$view='error';
        		$pagetitle='Page 404';
	    		require_once File::build_path(array("view", "view.php"));
	    	}
	    	else{
        		$view='detail';
        		$pagetitle='Etape ' . $NumEtape;
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
		if(!is_null(myGet('NumEtape'))){
        	$view='error';
        	$pagetitle='Page 404';
	    	require_once File::build_path(array("view", "view.php"));
		}
		else{
			$NumEtape = myGet('NumEtape');
			ModelEtape::delete($NumEtape);
			$tab_u = ModelEtape::selectAll();
	        $view='deleted';
	        $pagetitle='Etape supprimée';
		    require_once File::build_path(array("view", "view.php"));
		}
	}

	public static function create($DescriptionEtape){
        $v1 = new ModelEtape($DescriptionEtape);
		$v1->save();
		return $v1->getNumEtape();
	}
}
?>