<?php
require_once File::build_path(array("model","ModelFicheTechnique.php"));
require_once File::build_path(array("model","ModelCategorie_Fiche.php"));
require_once File::build_path(array("model","ModelComposer.php"));
class ControllerFicheTechnique{

	protected static $object='FicheTechnique';

	public static function readAll() {
        $tab_u = ModelFicheTechnique::selectAll();     //appel au modèle pour gerer la BD  //"redirige" vers la vue
        $view='list';
        $pagetitle='Liste des fiches techniques';
        require_once File::build_path(array("view", "view.php"));
    }

    public static function triCroissant(){
    	$tab_u = ModelFicheTechnique::selectAll();
    	asort($tab_u);
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

	public static function updated(){
		if(!is_null(myGet('NumeroFiche'))){
			$NumeroFiche=myGet('NumeroFiche');
		}
		if(!is_null(myGet('NomFiche'))){
			$NomFiche=myGet('NomFiche');
		}
		if(!is_null(myGet('NbreCouverts'))){
			$NbreCouverts=myGet('NbreCouverts');
		}
		if(!is_null(myGet('NomAuteur'))){
			$NomAuteur=myGet('NomAuteur');
		}
		if(!is_null(myGet('FK_NumeroCatFiche'))){
			$FK_NumeroCatFiche=myGet('FK_NumeroCatFiche');
		}
		if(!is_null(myGet('CoutFluide'))){
			$CoutFluide=myGet('CoutFluide');
		}
		$data = array(
			"primary" => $NumeroFiche,
			"NomFiche" => $NomFiche,
			"NbreCouverts" => $NbreCouverts,
			"NomAuteur" => $NomAuteur,
			"CoutFluide" => $CoutFluide,
			"FK_NumeroCatFiche" => $FK_NumeroCatFiche
		);
		ModelFicheTechnique::update($data);
	    $view='list';
	    $pagetitle='Mise à jour de la recette';
	    $tab_u = ModelFicheTechnique::selectAll();
		require_once File::build_path(array("view", "view.php"));
	}

	public static function created(){
		$NomFiche=myGet('NomFiche');
		$NbreCouverts=myGet('NbreCouverts');
		$NomAuteur=myGet('NomAuteur');
		$CoutFluide=myGet('CoutFluide');
		$FK_NumeroCatFiche=myGet('FK_NumeroCatFiche');
		$Fiche = new ModelFicheTechnique($NomFiche,$NbreCouverts,$NomAuteur,$CoutFluide,$FK_NumeroCatFiche);
		$Fiche->save();
		self::readAll();
	}

	public static function delete(){
		if(is_null(myGet('NumeroFiche'))){
        	$view='error';
        	$pagetitle='Page 404';
	    	require_once File::build_path(array("view", "view.php"));
		}
		else{
			$NumeroFiche = myGet('NumeroFiche');
			$Fiche = ModelFicheTechnique::select($NumeroFiche);
			$NomFiche = $Fiche->GetNomFiche();
			ModelFicheTechnique::delete($NumeroFiche);
			$tab_u = ModelFicheTechnique::selectAll();
	        $view='deleted';
	        $pagetitle='FicheTechnique supprimée';
		    require_once File::build_path(array("view", "view.php"));
		}
	}

	public static function update(){
		$tab_u = ModelFicheTechnique::selectAll();
		if(is_null(myGet('NumeroFiche'))){
        	$view='update';
        	$pagetitle='Création d\'une Recette';
        	$type = '';
        	$action='created';
	    	require_once File::build_path(array("view", "view.php"));
		}
		else{
			$NumeroFiche = myGet('NumeroFiche');
	    	$fiche = ModelFicheTechnique::select($NumeroFiche); //Fiche à update
	    	$compositions = ModelComposer::select2($NumeroFiche);  //lignes de la table Composer pour le Numéro de fiche concerné
	    	$ingredients = array();
	    	print_r($compositions);
	    	foreach ($compositions as $key) {
	    		echo('qsdsdqqdqd');
	    		echo($key);
	    		array_push($ingredients, ModelIngredient::select($key));
	    	}
	        $view='update';
	        $pagetitle='Modification de la recette';
	        $type = 'readonly';
	        $action = 'updated';
	    	require_once File::build_path(array("view", "view.php"));
		}
	}

	public static function create($NomFiche,$FK_NumeroCatFiche){
        $v1 = new ModelFicheTechnique($nomFicheTechnique,$FK_NumeroCatFiche);
		$v1->save();
		return $v1->getNumeroFiche();
	}

	//apercu de la fiche (page pour imprimer la fiche avec les prix)
	public static function apercu(){
		$NumeroFiche = myGet('NumeroFiche'); //recuperer le num de la fiche actuelle
		$Progressions = ModelFicheTechnique::selectProgressionsOf($NumeroFiche);
		$Coefficients = ModelFicheTechnique::selectCoefficientsOf($NumeroFiche);
		$Ingredients = ModelFicheTechnique::selectIngredientsOf($NumeroFiche);
		$SousFiches = ModelFicheTechnique::selectSousFichesOf($NumeroFiche);
		$view ='apercu';
		$cetteFiche = ModelFicheTechnique::select($NumeroFiche); // recuperer lobjet fiche ayant ce numero 
		require_once File::build_path(array("view", "view.php"));
	}

	//apercu de letiquette
	public static function apercuEtiquette(){
		$NumeroFiche = myGet('NumeroFiche'); //recuperer le num de la fiche actuelle
		$Ingredients = ModelFicheTechnique::selectIngredientsOf($NumeroFiche);
		$view ='apercuEtiquette';
		require_once File::build_path(array("view", "view.php"));
	}


}
?>