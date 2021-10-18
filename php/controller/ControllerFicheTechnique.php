<?php
require_once File::build_path(array("model","ModelFicheTechnique.php"));
require_once File::build_path(array("model","ModelCategorie_Fiche.php"));
require_once File::build_path(array("model","ModelComposer.php"));
require_once File::build_path(array("model","ModelIngredient.php"));
require_once File::build_path(array("model","ModelEtape.php"));
require_once File::build_path(array("model","ModelCoefficient.php"));
require_once File::build_path(array("model","ModelUtiliser.php"));
require_once File::build_path(array("controller","ControllerInclure.php"));
require_once File::build_path(array("model","ModelInclure.php"));
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

	public static function saveIngredients($Fiche){
		$NumeroFiche = $Fiche ->getNumeroFiche();
		$tabFiches = JSON_decode($_COOKIE['TabFiches']);  // récupère les sous-fiches liées à la fiche
		print_r($tabFiches);
		foreach ($tabFiches as $numFiche) {
			ControllerInclure::create(1,$numFiche); //crée les relations inclure en BDD
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
		//les coefficients
		if(!is_null(myGet('CodeCoeffAss'))){
			$CodeCoeffAss=myGet('CodeCoeffAss');
		}
		if(!is_null(myGet('CodeCoeffCoutPersonnel'))){
			$CodeCoeffCoutPersonnel=myGet('CodeCoeffCoutPersonnel');
		}
		$Ass = array(
			"primary" => $NumeroFiche,
			"FK_CodeCoeff" => $CodeCoeffAss
		);
		$CoutPersonnel = array(
			"primary" => $NumeroFiche,
			"FK_CodeCoeff" => $CodeCoeffCoutPersonnel
		);
		ModelUtiliser::update($Ass);
		ModelUtiliser::update($CoutPersonnel);		
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
		//les coefficients
		self::saveIngredients($Fiche);
		$CodeCoeffAss = myGet('CodeCoeffAss');
		$CodeCoeffCoutPersonnel= myGet('CodeCoeffCoutPersonnel');
		$utiliser = new ModelUtiliser($CodeCoeffAss,$NumeroFiche);
		$utiliser2 = new ModelUtiliser($CodeCoeffCoutPersonnel,$NumeroFiche);
		$utiliser->save();
		$utiliser2->save();
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
		$LesFiches = ModelFicheTechnique::selectAll(); // toutes les fiches dans la BD 
		$categories = ModelCategorie_Fiche::selectAll(); // toutes les categories dans la BD
		$ingredients = ModelIngredient::selectAll(); //touts les ingredients dans la BD
		$progressions = ModelEtape::selectAll(); // toutes les etapes dans la BD
		$coefficients = ModelCoefficient::selectAll(); // touts les coefficients dans la BD 
		if(is_null(myGet('NumeroFiche'))){ // si c'est pour créer
        	$view='update';
        	$pagetitle='Création d\'une Recette';
        	$type = '';
        	$action='created'; // fonction created quand on click sur le submit
	    	require_once File::build_path(array("view", "view.php"));
		}
		else{ // si c'est pour update
			$NumeroFiche = myGet('NumeroFiche');
	    	$fiche = ModelFicheTechnique::select($NumeroFiche); //Fiche à update
			$coefficientASS = ModelFicheTechnique::selectCoefficientAssOf($NumeroFiche);
			$coefficientCoutPersonnel = ModelFicheTechnique::selectCoefficientCoutPersonnelOf($NumeroFiche);
	    	//$compositions = ModelComposer::select2($NumeroFiche);  //lignes de la table Composer pour le Numéro de fiche concerné, chaque ligne étant un objet composer
	    	//$ingredients = array();
			/*echo '<pre>';
	    	print_r($compositions);
			echo '</pre>';
	    	foreach ($compositions as $comp) {
				$NumIngredient = $comp -> getFK_NumIngredient();
	    		array_push($ingredients, ModelIngredient::select($NumIngredient));
	    	}
			echo '<pre>';
			print_r($ingredients);
			echo '</pre>'; */
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
		$cetteFiche = ModelFicheTechnique::select($NumeroFiche); // recuperer lobjet fiche ayant ce numero 
		$Ingredients = ModelFicheTechnique::selectIngredientsOf($NumeroFiche);
		$view ='apercuEtiquette';
		require_once File::build_path(array("view", "view.php"));
	}


}
?>