<?php
require_once File::build_path(array("model","ModelFicheTechnique.php"));
require_once File::build_path(array("model","ModelCategorie_Fiche.php"));
require_once File::build_path(array("model","ModelComposer.php"));
require_once File::build_path(array("model","ModelIngredient.php"));
require_once File::build_path(array("model","ModelEtape.php"));
require_once File::build_path(array("model","ModelCoeffAss.php"));
require_once File::build_path(array("model","ModelCoeffCoutPersonnel.php"));
require_once File::build_path(array("model","ModelInclure.php"));
require_once File::build_path(array("controller","ControllerInclure.php"));
require_once File::build_path(array("controller","ControllerContenir.php"));
require_once File::build_path(array("controller","ControllerEtape.php"));
require_once File::build_path(array("controller","ControllerComposer.php"));
class ControllerFicheTechnique{

	protected static $object='FicheTechnique';

	public static function readAll() {
        $tab_u = ModelFicheTechnique::selectAll();     //appel au modèle pour gerer la BD  //"redirige" vers la vue
		//$tabFiches = JSON_decode($_COOKIE['TabFiches']);  // debogage
		//$tabProgressions = JSON_decode($_COOKIE['TabProgressions']);  // debogage
		//$TabIng = json_decode(($_COOKIE['TabIng'])); //debogage
		//$TabQteIng = json_decode(($_COOKIE['TabQteIng'])); //debogage
		//$NumProg = ModelEtape::selectNumOf('numopp'); // debogage
		//print_r($NumProg);
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

	public static function saveSousFiches($NumeroFiche){
		$tabFiches = JSON_decode($_COOKIE['TabFiches']);  // récupère les sous-fiches liées à la fiche
		//print_r($tabFiches);
		$ordre = 0;
			foreach ($tabFiches as $numFiche) {
				//print_r($numFiche);
				$ordre = $ordre + 1;
				ControllerInclure::create($NumeroFiche,$numFiche,$ordre); //crée les relations inclure en BDD (inclure c'est la relation entre une fiche et les sousfiches)
			}
		setcookie('TabFiches','',time()-3600);
	}

	public static function saveIngredients($NumeroFiche){
		$TabIng = json_decode(($_COOKIE['TabIng']));
		$TabQteIng = json_decode(($_COOKIE['TabQteIng']));
			for($i=0;$i<count($TabIng);$i++) {
				$obj = ControllerComposer::create($NumeroFiche,$TabIng[$i],$TabQteIng[$i]); //crée les relations composer en BDD 
			}
		setcookie('TabIng','',time()-3600);
		setcookie('TabQteIng','',time()-3600);
	}

	public static function saveProgressions($NumeroFiche){
		//echo $NumeroFiche;
		$tabProgressions = JSON_decode($_COOKIE['TabProgressions']);  // récupère les sous-fiches liées à la fiche
		//echo '<pre>';
		//print_r($tabProgressions);
		//echo '</pre>';
		$ordre = 0;
		//$reg = "abc";
			foreach($tabProgressions as $numProgression){
				if(!is_numeric($numProgression)){
					ControllerEtape::create($numProgression);
				}
			}
			foreach ($tabProgressions as $numProgression){
				$ordre = $ordre + 1;
				if(is_numeric($numProgression)){
					ControllerContenir::create($NumeroFiche,$numProgression,$ordre); //crée les relations inclure en BDD (inclure c'est la relation entre une fiche et les sousfiches)
				}else{
					$obj = ModelEtape::selectNumOf($numProgression);
					$NumProg = $obj[0][0];
					ControllerContenir::create($NumeroFiche,$NumProg,$ordre); //crée les relations inclure en BDD (inclure c'est la relation entre une fiche et les sousfiches)			
				}	
			}			
		setcookie('TabProgressions','null',time()-3600);
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
		if(empty($FK_NumeroCatFiche)){
			$FK_NumeroCatFiche = NULL;
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
		self::deleteProgressionsOf($NumeroFiche);
		self::deleteIngredientsOf($NumeroFiche);
		self::deleteSousFichesOf($NumeroFiche);
		$NumeroFiche=myGet('NumeroFiche');
		self::saveProgressions($NumeroFiche);
		self::saveIngredients($NumeroFiche);	
		self::saveSousFiches($NumeroFiche);
		//phase de confirmation
		$tab_u = ModelFicheTechnique::selectAll();
		$type = "modified";
		$view = 'created';
		$pagetitle='fiche créée';
		require_once File::build_path(array("view", "view.php"));
	}

	public static function created(){
		$NomFiche=myGet('NomFiche');
		$NbreCouverts=myGet('NbreCouverts');
		$NomAuteur=myGet('NomAuteur');
		$CoutFluide=myGet('CoutFluide');
		$FK_NumeroCatFiche=myGet('FK_NumeroCatFiche');
		if(empty($FK_NumeroCatFiche)){
			$FK_NumeroCatFiche = NULL;
		}
		$FK_CodeCoeffAss = myGet('CodeCoeffAss');
		$FK_CodeCoeffCoutPersonnel = myGet('CodeCoeffCoutPersonnel');
		$Fiche = new ModelFicheTechnique($NomFiche,$NbreCouverts,$NomAuteur,$CoutFluide,$FK_NumeroCatFiche,$FK_CodeCoeffAss,$FK_CodeCoeffCoutPersonnel);
		$Fiche->save();
		$NumeroFiche = $Fiche ->getNumeroFiche();
		self::saveSousFiches($NumeroFiche);
		self::saveProgressions($NumeroFiche);
		self::saveIngredients($NumeroFiche);
		self::readAll();
		//phase de confirmation
		$NomFiche = $Fiche->getNomFiche(); //recuperer son nom 
		$tab_u = ModelFicheTechnique::selectAll();
		$type = 'created';
		$view = 'created';
		$pagetitle='fiche créée';
		require_once File::build_path(array("view", "view.php"));
	} 

	//supprimer les progressions de la table CONTENIR
	public static function deleteProgressionsOf($numfiche){
		ModelContenir::delete($numfiche);
	}
	//suprimer les ingredients de la table COMPOSER
	public static function deleteIngredientsOf($numfiche){
		ModelComposer::delete($numfiche);
	}
	//supprimer les sousfiche de la table INCLURE 
	public static function deleteSousFichesOf($numfiche){
		ModelInclure::delete($numfiche);
	}

	public static function delete(){
		if(is_null(myGet('NumeroFiche'))){
        	$view='error';
        	$pagetitle='Page 404';
	    	require_once File::build_path(array("view", "view.php"));
		}
		else{
			$NumeroFiche = myGet('NumeroFiche'); //numero de cette fiche
			$Fiche = ModelFicheTechnique::select($NumeroFiche); //objet fiche
			if(empty($Fiche)){
				$view = "error";
				require_once File::build_path(array("view", "view.php"));
			}else{
				$NomFiche = $Fiche->GetNomFiche(); //le nom de la fiche
				self::deleteProgressionsOf($NumeroFiche);
				self::deleteIngredientsOf($NumeroFiche);
				self::deleteSousFichesOf($NumeroFiche);
				ModelFicheTechnique::delete($NumeroFiche); //supprimer la ligne concernant cette fiche dans la table des fiches BD 
				$tab_u = ModelFicheTechnique::selectAll();
				$view='deleted';
				$pagetitle='FicheTechnique supprimée';
				require_once File::build_path(array("view", "view.php"));
			}
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
			//$ingredientsFiches = ModelComposer::select();
	    	$fiche = ModelFicheTechnique::select($NumeroFiche); //Fiche à update
			$Progressions = ModelFicheTechnique::selectProgressionsOf($NumeroFiche); // les progressions de cette fiche
			$Ingredients = ModelFicheTechnique::selectIngredientsOf($NumeroFiche);  // les ingredients de cette fiche 
			$SousFiches = ModelFicheTechnique::selectSousFichesOf($NumeroFiche);
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

	//apercu de la fiche (page pour imprimer la fiche avec les prix)
	public static function apercuSP(){
		$NumeroFiche = myGet('NumeroFiche'); //recuperer le num de la fiche actuelle
		$Progressions = ModelFicheTechnique::selectProgressionsOf($NumeroFiche);
		$Ingredients = ModelFicheTechnique::selectIngredientsOf($NumeroFiche);
		$SousFiches = ModelFicheTechnique::selectSousFichesOf($NumeroFiche);
		$view ='apercuSP';
		$cetteFiche = ModelFicheTechnique::select($NumeroFiche); // recuperer lobjet fiche ayant ce numero 
		require_once File::build_path(array("view", "view.php"));
	}

	//apercu de letiquette
	public static function apercuEtiquette(){
		$NumeroFiche = myGet('NumeroFiche'); //recuperer le num de la fiche actuelle
		$cetteFiche = ModelFicheTechnique::select($NumeroFiche); // recuperer lobjet fiche ayant ce numero 
		$Ingredients = ModelFicheTechnique::selectIngredientsOf($NumeroFiche);
		$view ='apercuEtiquette';
		$type="";
		require_once File::build_path(array("view", "view.php"));
	}

	//creer une progression a partir de form de fiche technique 
	public static function CreateProg(){
        	$view='update';
        	$pagetitle='Création d\'une progression';
        	$action='CreerProg'; // fonction created quand on click sur le submit

	}

	//creer une progression a partir de form de fiche technique 
	public static function CreerProg(){
		$DescrEtape = myGet('AjouterProgressionDirect');
		ControllerEtape::create($DescrEtape);
		self::update();
	}

	//gestion d'erreur :
	public static function error(){
		$view='error';
        $pagetitle='erreur 404';
        require_once File::build_path(array("view", "view.php"));
	}

	//gestion de stock
	public static function gererStock(){
		if(is_null(myGet('NumeroFiche'))){
        	$view='error';
        	$pagetitle='Page 404';
	    	require_once File::build_path(array("view", "view.php"));
		}
		else{
			$NumeroFiche = myGet('NumeroFiche'); //numero de cette fiche
			$Fiche = ModelFicheTechnique::select($NumeroFiche); //objet fiche
			if(empty($Fiche)){
				$view = "error";
				require_once File::build_path(array("view", "view.php"));
			}else{
				$Ingredients = ModelFicheTechnique::selectIngredientsOf($NumeroFiche);
				if(!empty($Ingredients)){
					foreach($Ingredients as $Ing){
						$StockFinal = $Ing["QteStockIngredient"] - $Ing["QuantiteIngredient"] ; //on calcul le stock final
						$NumIngredient = $Ing["NumIngredient"];
						$data = array(
							"primary" => $NumIngredient,
							"QteStockIngredient" => $StockFinal
						);
						ModelIngredient::update($data);
					}
					$NomFiche = $Fiche ->getNomFiche();
					$tab_u = ModelFicheTechnique::selectAll();
					$type="StockUpdated";
					$view='created';
					$pagetitle='stock updated';
					require_once File::build_path(array("view", "view.php"));
				}
			}
		}
	}

	//gestion stock etiquette
		//gestion de stock
		public static function gererStockEtiquette(){
			if(is_null(myGet('NumeroFiche'))){
				$view='error';
				$pagetitle='Page 404';
				require_once File::build_path(array("view", "view.php"));
			}
			else{
				$NumeroFiche = myGet('NumeroFiche'); //numero de cette fiche
				$Fiche = ModelFicheTechnique::select($NumeroFiche); //objet fiche
				if(empty($Fiche)){ //gestion d'erreur
					$view = "error";
					require_once File::build_path(array("view", "view.php"));
				}else{
					$Ingredients = ModelFicheTechnique::selectIngredientsOf($NumeroFiche);
					if(!empty($Ingredients)){ //si ce ticjet possède des ingredients 
						$NbreTickets = myGet('nbreTickets'); //nombre de tickets à imprimer
						if(!empty($NbreTickets)){
							for($i=0;$i<$NbreTickets;$i++){ //pour chaque ticket
								$Ingredients = ModelFicheTechnique::selectIngredientsOf($NumeroFiche); //on recupere la nouvelle qte de stock
								foreach($Ingredients as $Ing){ //pour chaque ingredient appartenant au ticket
									$StockFinal = $Ing["QteStockIngredient"] - $Ing["QuantiteIngredient"] ; //on calcul le stock final
									$NumIngredient = $Ing["NumIngredient"];
									$data = array(
										"primary" => $NumIngredient,
										"QteStockIngredient" => $StockFinal
									);
									ModelIngredient::update($data);
									sleep(0.1);
								}
								sleep(0.1);
							}
						}
						$type='ticketUsed';
						$NumeroFiche = myGet('NumeroFiche'); //recuperer le num de la fiche actuelle
						$cetteFiche = ModelFicheTechnique::select($NumeroFiche); // recuperer lobjet fiche ayant ce numero 
						$Ingredients = ModelFicheTechnique::selectIngredientsOf($NumeroFiche);
						$view ='apercuEtiquette';
						$pagetitle='etiquette utilisé';
						require_once File::build_path(array("view", "view.php"));
					}
				}
			}
		}
}
?>