<?php
require_once File::build_path(array("model", "ModelCategorie.php"));
require_once File::build_path(array("model", "ModelProduit.php"));
class ControllerCategorie{

	protected static $object='categorie';

	public static function readAll() {
        $tab_u = ModelCategorie::selectAll();     //appel au modèle pour gerer la BD  //"redirige" vers la vue
        $view='list';
        $pagetitle='Liste des produits';
        require_once File::build_path(array("view", "view.php"));
    }

    public static function read(){
    	if(!is_null(myGet('idC'))){
	    	$idC = myGet('idC');
	    	$u = ModelCategorie::select($idCactegorie);
	    	if($u==false){
        		$view='error';
        		$pagetitle='Page 404';
	    		require_once File::build_path(array("view", "view.php"));
	    	}
	    	else{
        		$view='detail';
        		$pagetitle='Catégorie ' . $idC;
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
		if(!is_null(myGet('idC'))){
        	$view='error';
        	$pagetitle='Page 404';
	    	require_once File::build_path(array("view", "view.php"));
		}
		else{
			$idC = myGet('idC');
			ModelCategorie::delete($idCactegorie);
			$tab_u = ModelCategorie::selectAll();
	        $view='deleted';
	        $pagetitle='Catégorie supprimé';
		    require_once File::build_path(array("view", "view.php"));
		}
	}

	public static function create($nomC){
        $v1 = new ModelCategorie($nomC);
		$v1->save();
		return $v1->getIdCategorie();
	}
}
?>