<?php
require_once File::build_path(array("model", "ModelUtiliser.php"));
class ControllerUtiliser{

	protected static $object='Utiliser';

	public static function readAll() {
        $tab_u = ModelUtiliser::selectAll();     //appel au modèle pour gerer la BD  //"redirige" vers la vue
        $view='list';
        $pagetitle='Liste des coefficients pour chaque fiche';
        require_once File::build_path(array("view", "view.php"));
    }

    public static function read(){
    	if(!is_null(myGet('FK_NumeroFiche')) && !is_null(myGet('FK_CodeCoeff'))){
	    	$FK_NumeroFiche = myGet('FK_NumeroFiche');
			$FK_CodeCoeff = myGet('FK_CodeCoeff');
	    	$u = ModelUtiliser::selectV2($FK_CodeCoeff,$FK_NumeroFiche);
	    	if($u==false){
        		$view='error';
        		$pagetitle='Page 404';
	    		require_once File::build_path(array("view", "view.php"));
	    	}
	    	else{
        		$view='detail';
        		$pagetitle='Utiliser ' . $FK_NumeroFiche;
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
		if(!is_null(myGet('FK_NumeroFiche')) && !is_null(myGet('FK_CodeCoeff'))){
        	$view='error';
        	$pagetitle='Page 404';
	    	require_once File::build_path(array("view", "view.php"));
		}
		else{
			$FK_NumeroFiche = myGet('FK_NumeroFiche');
			$FK_CodeCoeff = myGet('FK_CodeCoeff');
			ModelUtiliser::deleteV2($FK_CodeCoeff  ,$FK_NumeroFiche);
			$tab_u = ModelUtiliser::selectAll();
	        $view='deleted';
	        $pagetitle='les coeeficients de cette fiche sont supprimés';
		    require_once File::build_path(array("view", "view.php"));
		}
	}

	public static function create($FK_CodeCoeff,$FK_NumeroFiche){
        $v1 = new ModelUtiliser($FK_CodeCoeff,$FK_NumeroFiche);
		$v1->save();
		return $v1->getNumeroFiche();
	}
}
?>