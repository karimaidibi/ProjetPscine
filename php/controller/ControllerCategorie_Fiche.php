<?php
require_once File::build_path(array("model","ModelCategorie_Fiche.php"));
class ControllerCoefficient{

	protected static $object='Categorie_Fiche';

	public static function readAll() {
        $tab_u = ModelCategorie_Fiche::selectAll();     
        $view='list';
        $pagetitle='Liste des categories fiches';
        require_once File::build_path(array("view", "view.php"));
    }

    public static function read(){
    	if(!is_null(myGet('NumeroCatFiche'))){
	    	$NumeroCatFiche = myGet('NumeroCatFiche');
	    	$u = ModelCategorie_Fiche::select($NumeroCatFiche);
	    	if($u==false){
        		$view='error';
        		$pagetitle='Page 404';
	    		require_once File::build_path(array("view", "view.php"));
	    	}
	    	else{
        		$view='detail';
        		$pagetitle='Categorie_Fiche ' . $NumeroCatFiche;
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
		if(!is_null(myGet('NumeroCatFiche'))){
        	$view='error';
        	$pagetitle='Page 404';
	    	require_once File::build_path(array("view", "view.php"));
		}
		else{
			$NumeroCatFiche = myGet('NumeroCatFiche');
			ModelCategorie_Fiche::delete($NumeroCatFiche);
			$tab_u = ModelCategorie_Fiche::selectAll();
	        $view='deleted';
	        $pagetitle='Categorie_Fiche supprimé';
		    require_once File::build_path(array("view", "view.php"));
		}
	}

	public static function create($NomCatFiche){
        $v1 = new ModelCategorie_Fiche($NomCatFiche);
		$v1->save();
		return $v1->getNomCatFiche();
	}
}
?>