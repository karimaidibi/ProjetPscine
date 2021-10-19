<?php
require_once File::build_path(array("model","ModelFicheTechnique.php"));
require_once File::build_path(array("model","ModelCategorie_Fiche.php"));
require_once File::build_path(array("model","ModelComposer.php"));
require_once File::build_path(array("model","ModelIngredient.php"));
require_once File::build_path(array("model","ModelEtape.php"));
require_once File::build_path(array("model","ModelCoeffAss.php"));
require_once File::build_path(array("model","ModelCoeffCoutPersonnel.php"));
require_once File::build_path(array("controller","ControllerInclure.php"));
require_once File::build_path(array("model","ModelInclure.php"));
require_once File::build_path(array("controller","ControllerComposer.php"));
class ControllerFicheTechnique{

	protected static $object='FicheTechnique';

	public static function readAll() {
        $tab_u = ModelFicheTechnique::selectAll();     //appel au modèle pour gerer la BD  //"redirige" vers la vue
		$tabFiches = JSON_decode($_COOKIE['TabFiches']);  // récupère les sous-fiches liées à la fiche
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
		$TabIng = json_decode(($_COOKIE['TabIng']));
		$TabQteIng = json_decode(($_COOKIE['TabQteIng']));
		for($i=0;$i<count($TabIng);$i++) {
			ControllerComposer::create($TabIng[$i],$NumeroFiche,$TabQteIng[$i]); //crée les relations composer en BDD 
		}
		setcookie('TabFiches',time()-3600);
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
		if(!is_null(myGet('CodeCoeffAss'))){
			$FK_CodeCoeffAss=myGet('CodeCoeffAss');
		}
		if(!is_null(myGet('CodeCoeffCoutPersonnel'))){
			$FK_CodeCoeffCoutPersonnel=myGet('CodeCoeffCoutPersonnel');
		}
		$data = array(
			"primary" => $NumeroFiche,
			"NomFiche" => $NomFiche,
			"NbreCouverts" => $NbreCouverts,
			"NomAuteur" => $NomAuteur,
			"CoutFluide" => $CoutFluide,
			"FK_NumeroCatFiche" => $FK_NumeroCatFiche,
			"FK_CodeCoeffAss" => $FK_CodeCoeffAss,
			"FK_CodeCoeffCoutPersonnel" => $FK_CodeCoeffCoutPersonnel
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
		$FK_CodeCoeffAss = myGet('CodeCoeffAss');
		$FK_CodeCoeffCoutPersonnel = myGet('CodeCoeffCoutPersonnel');
		$Fiche = new ModelFicheTechnique($NomFiche,$NbreCouverts,$NomAuteur,$CoutFluide,$FK_NumeroCatFiche,$FK_CodeCoeffAss,$FK_CodeCoeffCoutPersonnel);
		$Fiche->save();
		self::saveIngredients($Fiche);
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
		$coefficientsAss = ModelCoeffAss::selectAll(); // touts les coeff Ass dans la BD
		$coefficientsCoutPersonnel = ModelCoeffCoutPersonnel::selectAll(); // touts les coeff de cout personnel dans la BD 
		if(is_null(myGet('NumeroFiche'))){ // si c'est pour créer
        	$view='update';
        	$pagetitle='Création d\'une Recette';
        	$type = '';
        	$action='created'; // fonction created quand on click sur le submit
	    	require_once File::build_path(array("view", "view.php"));
		}
		else{ // si c'est pour update
			$NumeroFiche = myGet('NumeroFiche');
			$ingredientsFiches = ModelComposer::select()
	    	$fiche = ModelFicheTechnique::select($NumeroFiche); //Fiche à update
			$Progressions = ModelFicheTechnique::selectProgressionsOf($NumeroFiche); // les progressions de cette fiche
			$Ingredients = ModelFicheTechnique::selectIngredientsOf($NumeroFiche);  // les ingredients de cette fiche 
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