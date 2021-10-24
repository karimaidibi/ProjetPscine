<?php
require_once File::build_path(array("model", "ModelTVA.php"));
class ControllerTVA{

	protected static $object='tva';

	public static function readAll() {
        $TVA = ModelTVA::selectAll();     //appel au modèle pour gerer la BD  //"redirige" vers la vue
        $view='list';
        $pagetitle='Liste des TVA';
        require_once File::build_path(array("view", "view.php"));
    }

    public static function read(){
    	if(!is_null(myGet('CodeTVA'))){
	    	$CodeTVA = myGet('CodeTVA');
	    	$u = ModelTVA::select($CodeTVA);
	    	if($u==false){
        		$view='error';
        		$pagetitle='Page 404';
	    		require_once File::build_path(array("view", "view.php"));
	    	}
	    	else{
        		$view='detail';
        		$pagetitle='TVA' . $CodeTVA;
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
		if(is_null(myGet('CodeTVA'))){
        	$view='error';
        	$pagetitle='Page 404';
	    	require_once File::build_path(array("view", "view.php"));
		}
		else{
			$CodeTVA = myGet('CodeTVA');
			ModelTVA::delete($CodeTVA);
			$TVA = ModelTVA::selectAll();
	        $view='list';
	        $pagetitle='TVA supprimée';
		    require_once File::build_path(array("view", "view.php"));
		}
	}

	public static function update(){
		if(!is_null(myGet('NomTVA'))){
			$NomTVA=myGet('NomTVA');
		}
		if(!is_null(myGet('CoefTVA'))){
			$CoefTVA=myGet('CoefTVA');
		}
		self::create($NomTVA,$CoefTVA);
		$TVA = ModelTVA::selectAll();
		$view='list';
		require_once File::build_path(array("view", "view.php"));
	}	

	public static function create($NomTVA, $CoefTVA){
        $v1 = new ModelTVA($NomTVA, $CoefTVA);
		$v1->save();
		//return $v1->getIdTVA();
	}
}
?>