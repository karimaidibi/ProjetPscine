<?php
class ControllerContenir{

	protected static $object='Contenir';

	public static function readAll() {
        $tab_u = ModelContenir::selectAll();     //appel au modèle pour gerer la BD  //"redirige" vers la vue
        $view='list';
        $pagetitle='Liste des contenus';
        require_once File::build_path(array("view", "view.php"));
    }

    public static function read(){
    	if(!is_null(myGet('NumEtape'))){
	    	$NumEtape = myGet('NumEtape');
	    	$u = ModelContenir::select($NumEtape);
	    	if($u==false){
        		$view='error';
        		$pagetitle='Page 404';
	    		require_once File::build_path(array("view", "view.php"));
	    	}
	    	else{
        		$view='detail';
        		$pagetitle='Contenir ' . $NumEtape;
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
			ModelContenir::delete($NumEtape);
			$tab_u = ModelContenir::selectAll();
	        $view='deleted';
	        $pagetitle='Contenu supprimé';
		    require_once File::build_path(array("view", "view.php"));
		}
	}

	public static function create($NumeroFiche){
        $v1 = new ModelContenir($NumeroFiche);
		$v1->save();
		return $v1->getNumEtape();
	}
}
?>