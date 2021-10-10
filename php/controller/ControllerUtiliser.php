<?php
require_once File::build_path(array("model", "ModelUtiliser.php"));
class ControllerComposer{

	protected static $object='Utiliser';

	public static function readAll() {
        $tab_u = ModelUtiliser::selectAll();     //appel au modèle pour gerer la BD  //"redirige" vers la vue
        $view='list';
        $pagetitle='Liste des coefficients pour chaque fiche';
        require_once File::build_path(array("view", "view.php"));
    }

    public static function read(){
    	if(!is_null(myGet('NumeroFiche'))){
	    	$NumeroFiche = myGet('NumeroFiche');
	    	$u = ModelUtiliser::select($NumeroFiche);
	    	if($u==false){
        		$view='error';
        		$pagetitle='Page 404';
	    		require_once File::build_path(array("view", "view.php"));
	    	}
	    	else{
        		$view='detail';
        		$pagetitle='Utiliser ' . $NumeroFiche;
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
			ModelUtiliser::delete($NumeroFiche);
			$tab_u = ModelUtiliser::selectAll();
	        $view='deleted';
	        $pagetitle='les coeeficients de cette fiche sont supprimés';
		    require_once File::build_path(array("view", "view.php"));
		}
	}

	public static function create($CodeCoeff,$NumeroFiche){
        $v1 = new ModelUtiliser($CodeCoeff,$NumeroFiche);
		$v1->save();
		return $v1->getNumeroFiche();
	}
}
?>