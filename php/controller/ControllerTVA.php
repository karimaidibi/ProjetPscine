<?php
require_once File::build_path(array("model", "ModelTVA.php"));
class ControllerTVA{

	protected static $object='tva';

	public static function readAll() {
        $tab_u = ModelTVA::selectAll();     //appel au modèle pour gerer la BD  //"redirige" vers la vue
        $view='list';
        $pagetitle='Liste des TVA';
        require_once File::build_path(array("view", "view.php"));
    }

    public static function read(){
    	if(!is_null(myGet('idTVA'))){
	    	$idTVA = myGet('idTVA');
	    	$u = ModelTVA::select($idTVA);
	    	if($u==false){
        		$view='error';
        		$pagetitle='Page 404';
	    		require_once File::build_path(array("view", "view.php"));
	    	}
	    	else{
        		$view='detail';
        		$pagetitle='TVA' . $idTVA;
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
		if(!is_null(myGet('idTVA'))){
        	$view='error';
        	$pagetitle='Page 404';
	    	require_once File::build_path(array("view", "view.php"));
		}
		else{
			$idTVA = myGet('idTVA');
			ModelTVA::delete($idTVA);
			$tab_u = ModelTVA::selectAll();
	        $view='deleted';
	        $pagetitle='TVA supprimée';
		    require_once File::build_path(array("view", "view.php"));
		}
	}

	public static function create($NomTVA, $CoefTVA){
        $v1 = new ModelTVA($NomTVA, $CoefTVA);
		$v1->save();
		return $v1->getIdTVA();
	}
}
?>