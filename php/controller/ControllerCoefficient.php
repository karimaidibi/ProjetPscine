<?php
require_once File::build_path(array("model","ModelCoefficient.php"));
class ControllerCoefficient{

	protected static $object='Coefficient';

	public static function readAll() {
        $tab_u = ModelCoefficient::selectAll();     
        $view='list';
        $pagetitle='Liste des coefficients';
        require_once File::build_path(array("view", "view.php"));
    }

    public static function read(){
    	if(!is_null(myGet('CodeCoeff'))){
	    	$CodeCoeff = myGet('CodeCoeff');
	    	$u = ModelCoefficient::select($CodeCoeff);
	    	if($u==false){
        		$view='error';
        		$pagetitle='Page 404';
	    		require_once File::build_path(array("view", "view.php"));
	    	}
	    	else{
        		$view='detail';
        		$pagetitle='Coefficient ' . $CodeCoeff;
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
		if(!is_null(myGet('CodeCoeff'))){
        	$view='error';
        	$pagetitle='Page 404';
	    	require_once File::build_path(array("view", "view.php"));
		}
		else{
			$CodeCoeff = myGet('CodeCoeff');
			ModelCoefficient::delete($CodeCoeff);
			$tab_u = ModelCoefficient::selectAll();
	        $view='deleted';
	        $pagetitle='Coefficient supprimé';
		    require_once File::build_path(array("view", "view.php"));
		}
	}

	public static function create($valeurCoefficient){
        $v1 = new ModelCoefficient($valeurCoefficient);
		$v1->save();
		return $v1->getCodeCoeff();
	}
}
?>