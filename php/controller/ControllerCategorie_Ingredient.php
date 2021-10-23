<?php
require_once File::build_path(array("model", "ModelCategorie_Ingredient.php"));
class ControllerCategorie_Ingredient{

	protected static $object='categorie_Ingredient';

	public static function readAll() {
        $Categorie = ModelCategorie_Ingredient::selectAll();     //appel au modèle pour gerer la BD  //"redirige" vers la vue
        $view='list';
        $pagetitle='Liste des catégories';
        require_once File::build_path(array("view", "view.php"));
    }

    public static function read(){
    	if(!is_null(myGet('NumCategorie'))){
	    	$NumCategorie = myGet('NumCategorie');
	    	$u = ModelCategorie::select($idCategorie);
	    	if($u==false){
        		$view='error';
        		$pagetitle='Page 404';
	    		require_once File::build_path(array("view", "view.php"));
	    	}
	    	else{
        		$view='detail';
        		$pagetitle='Catégorie ' . $NumCategorie;
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
		$NumCategorie = myGet('NumCategorie');
		if(is_null($NumCategorie)){
			$view='update';
			$type="";
			$pagetitle='Création d\'une catégorie d\'ingrédients';
			$action='updated';
			require_once File::build_path(array("view", "view.php"));
		}
		else{
			$Categorie = ModelCategorie_Ingredient::select($NumCategorie);
			$view='update';
	        $pagetitle='Modification d\'une catégorie d\'ingrédients';
	        $type = 'readonly';
	        $action = 'updated';
	    	require_once File::build_path(array("view", "view.php"));
		}
	}

	public static function created(){
		$NumCategorie = myGet('NumCategorie');
		$NomCategorie = myGet('NomCategorie');
		$Categorie = new ModelCategorie_Ingredient($NomCategorie);
		$Categorie->save();
		self::readAll();
	}

	public static function updated(){
		if(!is_null(myGet('NumCategorie'))){
			$NumCategorie=myGet('NumCategorie');
		}
		if(!is_null(myGet('NomCategorie'))){
			$NomCategorie=myGet('NomCategorie');
		}
		$data = array(
			"primary" => $NumCategorie,
			"NomCategorie" => $NomCategorie,
		);
		ModelCategorie_Ingredient::update($data);
		self::readAll();
	}

	public static function delete(){
		if(is_null(myGet('NumCategorie'))){
        	$view='error';
        	$pagetitle='Page 404';
	    	require_once File::build_path(array("view", "view.php"));
		}
		else{
			$NumCategorie = myGet('NumCategorie');
			ModelCategorie_Ingredient::delete($NumCategorie);
			self::readAll();
		}
	}

	public static function create($nomC){
        $v1 = new ModelCategorie_Ingredient($nomC);
		$v1->save();
		return $v1->getNumCategorie();
	}
}
?>