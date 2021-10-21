<?php
require_once File::build_path(array("model","ModelContenir.php"));
class ControllerContenir{

	protected static $object='Contenir';

	public static function readAll() {
        $tab_u = ModelContenir::selectAll();     //appel au modèle pour gerer la BD  //"redirige" vers la vue
        $view='list';
        $pagetitle='Liste des contenus';
        require_once File::build_path(array("view", "view.php"));
    }

    public static function read(){
    	if(!is_null(!is_null(myGet('FK_NumeroFiche')) && myGet('FK_NumEtape')) && !is_null(myGet('Ordre')) ){
	    	$FK_NumEtape = myGet('FK_NumEtape');
	    	$FK_NumeroFiche = myGet('FK_NumeroFiche');
			$Ordre = myGet('Ordre');
	    	$u = ModelContenir::selectV3($FK_NumEtape, $FK_NumeroFiche,$Ordre);
	    	if($u==false){
        		$view='error';
        		$pagetitle='Page 404';
	    		require_once File::build_path(array("view", "view.php"));
	    	}
	    	else{
        		$view='detail';
        		$pagetitle='Contenir ' . $FK_NumeroFiche;
	    		require_once File::build_path(array("view", "view.php"));
	    	}
    	}
    	else{
        	$view='error';
        	$pagetitle='Page 404';
	    	require_once File::build_path(array("view", "view.php"));
    	}
	}


	public static function delete3(){
		if(is_null(myGet('FK_NumeroFiche')) || is_null(myGet('FK_NumEtape')) || is_null(myGet('Ordre')) ){
        	$view='error';
        	$pagetitle='Page 404';
	    	require_once File::build_path(array("view", "view.php"));
		}
		else{
			$FK_NumeroFiche = myGet('FK_NumeroFiche');
			$FK_NumEtape = myGet('FK_NumEtape');
			$Ordre = myGet('Ordre');
			ModelContenir::deleteV3($FK_NumeroFiche, $FK_NumEtape, $Ordre);
			$tab_u = ModelContenir::selectAll();
	        $view='deleted';
	        $pagetitle='Contenu supprimé';
		    require_once File::build_path(array("view", "view.php"));
		}
	}

	public static function create($FK_NumeroFiche, $FK_NumEtape, $ordre){
        $v1 = new ModelContenir($FK_NumeroFiche, $FK_NumEtape, $ordre);
		$v1->save();
	}
}
?>