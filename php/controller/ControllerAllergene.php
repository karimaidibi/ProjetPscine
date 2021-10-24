<?php
require_once File::build_path(array("model","ModelAllergene.php"));
class ControllerAllergene{

	protected static $object='Allergene';

	public static function readAll() {
        $allergene = ModelAllergene::selectAll();     //appel au modèle pour gerer la BD  //"redirige" vers la vue
        $view='list';
        $pagetitle='Liste des allergènes';
        require_once File::build_path(array("view", "view.php"));
    }

    public static function read(){
    	if(!is_null(myGet('NumAllergene'))){
	    	$NumAllergene = myGet('NumAllergene');
	    	$u = ModelAllergene::select($NumAllergene);
	    	if($u==false){
        		$view='error';
        		$pagetitle='Page 404';
	    		require_once File::build_path(array("view", "view.php"));
	    	}
	    	else{
        		$view='detail';
        		$pagetitle='Catégorie ' . $NumAllergene;
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
		if(is_null(myGet('NumAllergene'))){
        	$view='error';
        	$pagetitle='Page 404';
	    	require_once File::build_path(array("view", "view.php"));
		}
		else{
			$NumAllergene = myGet('NumAllergene');
			ModelAllergene::delete($NumAllergene);
			$allergene = ModelAllergene::selectAll();
	        $view='list';
	        $pagetitle='Catégorie supprimé';
		    require_once File::build_path(array("view", "view.php"));
		}
	}

	public static function update(){
		if(!is_null(myGet('NomAllergene'))){
			$NomAllergene=myGet('NomAllergene');
		}
		self::create($NomAllergene);
		$allergene = ModelAllergene::selectAll();
		$view='list';
		require_once File::build_path(array("view", "view.php"));
	}

	public static function create($nomA){
        $v1 = new ModelAllergene($nomA);
		$v1->save();
		//return $v1->getNumAllergene();
	}
}
?>