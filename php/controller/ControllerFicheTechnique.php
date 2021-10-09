<?php
require_once File::build_path(array("model","ModelFicheTechnique.php"));	
class ControllerFicheTechnique{

	protected static $object='FicheTechnique';

	public static function readAll() {
        $tab_u = ModelFicheTechnique::selectAll();     //appel au modèle pour gerer la BD  //"redirige" vers la vue
        $view='list';
        $pagetitle='Liste des fiches techniques';
        require_once File::build_path(array("view", "view.php"));
    }

    public static function read(){
    	if(!is_null(myGet('NumeroFiche'))){
	    	$NumeroFiche = myGet('NumeroFiche');
	    	$u = ModelFicheTechnique::select($NumeroFiche);
	    	if($u==false){
        		$view='error';
        		$pagetitle='Page 404';
	    		require_once File::build_path(array("view", "view.php"));
	    	}
	    	else{
        		$view='detail';
        		$pagetitle='FicheTechnique ' . $NumeroFiche;
	    		require_once File::build_path(array("view", "view.php"));
	    	}
    	}
    	else{
        	$view='error';
        	$pagetitle='Page 404';
	    	require_once File::build_path(array("view", "view.php"));
    	}
	}

	public static function update(){
        $view='update';
        $pagetitle='Création d\'une fiche technique';
	    require_once File::build_path(array("view", "view.php"));
	}

	public static function updated(){
		echo "c'est bon !!!";
	}

	public static function delete(){
		if(is_null(myGet('NumeroFiche'))){
        	$view='error';
        	$pagetitle='Page 404';
	    	require_once File::build_path(array("view", "view.php"));
		}
		else{
			$NumeroFiche = myGet('NumeroFiche');
			ModelFicheTechnique::delete($NumeroFiche);
			echo "ici";
			$tab_u = ModelFicheTechnique::selectAll();
			$NomFiche = ModelFicheTechnique::select('NomFiche');
	        $view='deleted';
	        $pagetitle='FicheTechnique supprimée';
		    require_once File::build_path(array("view", "view.php"));
		}
	}

	public static function create($NomFiche,$FK_NumeroCatFiche){
        $v1 = new ModelFicheTechnique($nomFicheTechnique,$FK_NumeroCatFiche);
		$v1->save();
		return $v1->getNumeroFiche();
	}
}
?>