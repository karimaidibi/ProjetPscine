<?php
require_once File::build_path(array("model","ModelCoeffCoutPersonnel.php"));
class ControllerCoeffCoutPersonnel{

	protected static $object='CoeffCoutPersonnel';

	public static function readAll() {
        $CoeffCoutPersonnel= ModelCoeffCoutPersonnel::selectAll();     
        $view='list';
        $pagetitle='Liste des coefficients';
        require_once File::build_path(array("view", "view.php"));
    }

    public static function read(){
    	if(!is_null(myGet('CodeCoeffCoutPersonnel'))){
	    	$CodeCoeffCoutPersonnel = myGet('CodeCoeffCoutPersonnel');
	    	$u = ModelCoeffCoutPersonnel::select($CodeCoeffCoutPersonnel);
	    	if($u==false){
        		$view='error';
        		$pagetitle='Page 404';
	    		require_once File::build_path(array("view", "view.php"));
	    	}
	    	else{
        		$view='detail';
        		$pagetitle='CoeffCoutPersonnel ' . $CodeCoeffCoutPersonnel;
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
		if(is_null(myGet('CodeCoeffCoutPersonnel'))){
        	$view='error';
        	$pagetitle='Page 404';
	    	require_once File::build_path(array("view", "view.php"));
		}
		else{
			$CodeCoeffCoutPersonnel = myGet('CodeCoeffCoutPersonnel');
			ModelCoeffCoutPersonnel::delete($CodeCoeffCoutPersonnel);
			$CoeffCoutPersonnel = ModelCoeffCoutPersonnel::selectAll();
	        $view='list';
	        $pagetitle='CoeffCoutPersonnel supprimé';
		    require_once File::build_path(array("view", "view.php"));
		}
	}

	
	public static function update(){
		if(!is_null(myGet('valeurCoeffCoutPersonnel'))){
			$valeurCoeffCoutPersonnel=myGet('valeurCoeffCoutPersonnel');
		}
		self::create($valeurCoeffCoutPersonnel);
		$CoeffCoutPersonnel = ModelCoeffCoutPersonnel::selectAll();
		$view='list';
		require_once File::build_path(array("view", "view.php"));
	}

	public static function create($valeurCoeffCoutPersonnel){
        $v1 = new ModelCoeffCoutPersonnel($valeurCoeffCoutPersonnel);
		$v1->save();
		return $v1->getCodeCoeffCoutPersonnel();
	}
}
?>