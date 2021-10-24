<?php
require_once File::build_path(array("model","ModelCoeffAss.php"));
class ControllerCoeffAss{

	protected static $object='CoeffAss';

	public static function readAll() {
        $CoeffAss= ModelCoeffAss::selectAll();     
        $view='list';
        $pagetitle='Liste des coefficients';
        require_once File::build_path(array("view", "view.php"));
    }

    public static function read(){
    	if(!is_null(myGet('CodeCoeffAss'))){
	    	$CodeCoeffAss = myGet('CodeCoeffAss');
	    	$u = ModelCoeffAss::select($CodeCoeffAss);
	    	if($u==false){
        		$view='error';
        		$pagetitle='Page 404';
	    		require_once File::build_path(array("view", "view.php"));
	    	}
	    	else{
        		$view='detail';
        		$pagetitle='CoeffAss ' . $CodeCoeffAss;
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
		if(is_null(myGet('CodeCoeffAss'))){
        	$view='error';
        	$pagetitle='Page 404';
	    	require_once File::build_path(array("view", "view.php"));
		}
		else{
			$CodeCoeffAss = myGet('CodeCoeffAss');
			ModelCoeffAss::delete($CodeCoeffAss);
			$CoeffAss = ModelCoeffAss::selectAll();
	        $view='list';
	        $pagetitle='CoeffAss supprimé';
		    require_once File::build_path(array("view", "view.php"));
		}
	}

	public static function update(){
		if(!is_null(myGet('valeurCoeffAss'))){
			$valeurCoeffAss=myGet('valeurCoeffAss');
		}
		self::create($valeurCoeffAss);
		$CoeffAss = ModelCoeffAss::selectAll();
		$view='list';
		require_once File::build_path(array("view", "view.php"));
	}

	public static function create($valeurCoeffAss){
        $v1 = new ModelCoeffAss($valeurCoeffAss);
		$v1->save();
		return $v1->getCodeCoeffAss();
	}
}
?>