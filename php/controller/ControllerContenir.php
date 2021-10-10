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
    	if(!is_null(myGet('NumEtape')) && !is_null(myGet('NumeroFiche'))){
	    	$NumEtape = myGet('NumEtape');
	    	$NumeroFiche = myGet('NumeroFiche');
	    	$u = ModelContenir::selectV2($NumEtape, $NumeroFiche);
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
		if(!is_null(myGet('NumEtape')) && !is_null(myGet('NumeroFiche'))){
        	$view='error';
        	$pagetitle='Page 404';
	    	require_once File::build_path(array("view", "view.php"));
		}
		else{
			$NumEtape = myGet('NumEtape');
			$NumeroFiche = myGet('NumeroFiche');
			ModelContenir::delete($NumEtape, $NumeroFiche, $Ordre);
			$tab_u = ModelContenir::selectAll();
	        $view='deleted';
	        $pagetitle='Contenu supprimé';
		    require_once File::build_path(array("view", "view.php"));
		}
	}

	public static function create($NumEtape, $NumeroFiche){
        $v1 = new ModelContenir($NumEtape, $NumeroFiche);
		$v1->save();
	}
}
?>