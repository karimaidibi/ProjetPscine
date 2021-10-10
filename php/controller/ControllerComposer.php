<?php
class ControllerComposer{

	protected static $object='Composer';

	public static function readAll() {
        $tab_u = ModelComposer::selectAll();     //appel au modèle pour gerer la BD  //"redirige" vers la vue
        $view='list';
        $pagetitle='Liste des compositions';
        require_once File::build_path(array("view", "view.php"));
    }

    public static function read(){
    	if(!is_null(myGet('NumIngredient')) && !is_null(myGet('NumeroFiche'))){
	    	$NumIngredient = myGet('NumIngredient');
	    	$NumeroFiche = myGet('NumeroFiche');
	    	$u = ModelComposer::selectV2($NumIngredient,$NumeroFiche);
	    	if($u==false){
        		$view='error';
        		$pagetitle='Page 404';
	    		require_once File::build_path(array("view", "view.php"));
	    	}
	    	else{
        		$view='detail';
        		$pagetitle='Composition ' . $NumIngredient;
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
		if(!is_null(myGet('NumIngredient')) && !is_null(myGet('NumeroFiche'))){
        	$view='error';
        	$pagetitle='Page 404';
	    	require_once File::build_path(array("view", "view.php"));
		}
		else{
			$NumIngredient = myGet('NumIngredient');
			$NumeroFiche = myGet('NumeroFiche');
			ModelComposer::deleteV2($NumIngredient,$NumeroFiche);
			$tab_u = ModelComposer::selectAll();
	        $view='deleted';
	        $pagetitle='Composition supprimée';
		    require_once File::build_path(array("view", "view.php"));
		}
	}

	public static function create($NumIngredient,$NumeroFiche,$QuantiteIngredient){
        $v1 = new ModelComposer($NumIngredient,$NumeroFiche,$QuantiteIngredient);
		$v1->save();
		return $v1->getNumIngredient();
	}
}
?>