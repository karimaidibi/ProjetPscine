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
    	if(!is_null(myGet('FK_NumeroFiche')) && !is_null(myGet('FK_NumeroSousFiche')) && !is_null(myGet('Ordre'))){
	    	$FK_NumeroFiche = myGet('FK_NumeroFiche');
	    	$FK_NumeroSousFiche = myGet('FK_NumeroSousFiche');
	    	$Ordre = myGet('Ordre');
	    	$u = ModelInclure::selectV3($FK_NumeroFiche,$FK_NumeroSousFiche,$Ordre);
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

	public static function deleteV3(){
		if(!is_null(myGet('FK_NumeroFiche')) && !is_null(myGet('FK_NumeroSousFiche')) && !is_null(myGet('Ordre'))){
        	$view='error';
        	$pagetitle='Page 404';
	    	require_once File::build_path(array("view", "view.php"));
		}
		else{
			$FK_NumeroFiche = myGet('FK_NumeroFiche');
	    	$FK_NumeroSousFiche = myGet('FK_NumeroSousFiche');
	    	$Ordre = myGet('Ordre');
			ModelInclure::delete($NumeroFiche);
			$tab_u = ModelInclure::selectAll();
	        $view='deleted';
	        $pagetitle='Inclusion supprimée';
		    require_once File::build_path(array("view", "view.php"));
		}
	}

	public static function create($NumeroSousFiche){
        $v1 = new ModelInclure($FK_NumeroFiche,$FK_NumeroSousFiche,$Ordre);
		$v1->save();
	}
}
?>