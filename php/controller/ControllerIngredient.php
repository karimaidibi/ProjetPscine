<?php
ini_set('display_errors', 'on'); 
require_once File::build_path(array("model", "ModelIngredient.php"));
require_once File::build_path(array("controller", "ControllerFicheTechnique.php"));
require_once File::build_path(array("model","ModelUnite.php"));
require_once File::build_path(array("model","ModelTVA.php"));
require_once File::build_path(array("model","ModelAllergene.php"));
require_once File::build_path(array("model","ModelCategorie_Ingredient.php"));
class ControllerIngredient{

	protected static $object='ingredient';

	public static function readAll() {
        $tab_u = ModelIngredient::selectAll();     //appel au modèle pour gerer la BD  //"redirige" vers la vue
        $view='list';
        $pagetitle='Liste des catégories';
        require_once File::build_path(array("view", "view.php"));
    }

    public static function read(){
    	if(!is_null(myGet('NumIngredient'))){
	    	$NumIngredient = myGet('NumIngredient');
	    	$u = ModelIngredient::select($NumIngredient);
	    	if($u==false){
        		$view='error';
        		$pagetitle='Page 404';
	    		require_once File::build_path(array("view", "view.php"));
	    	}
	    	else{
        		$view='detail';
        		$pagetitle='Catégorie ' . $NumIngredient;
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
		if(is_null(myGet('NumIngredient'))){
        	$view='error';
        	$pagetitle='Page 404';
	    	require_once File::build_path(array("view", "view.php"));
		}
		else{
			$NumIngredient = myGet('NumIngredient');
			$Ingredient = ModelIngredient::select($NumIngredient);
			$NomIng = $Ingredient->getNomIng();
			ModelIngredient::delete($NumIngredient);
			$tab_u = ModelIngredient::selectAll();
	        $view='deleted';
	        $pagetitle='Ingredient supprimé';
		    require_once File::build_path(array("view", "view.php"));
		}
	}

	public static function create($nomI,$prixI){
        $v1 = new ModelIngredient($nomI,$prixI);
		$v1->save();
		return $v1->getNumIngredient();
	}

	public static function created(){
		$NomIng=myGet('NomIng');
		$prixUnitaireIng=myGet('prixUnitaireIng');
		$QteStockIngredient=myGet('QteStockIngredient');
		$FK_NumAllergene=myGet('FK_NumAllergene');
		$FK_NumUnite=myGet('FK_NumUnite');
		if(empty($FK_NumAllergene)){
			$FK_NumAllergene = NULL;
		}
		$FK_CodeTVA=myGet('FK_CodeTVA');
		$FK_NumCategorie=myGet('FK_NumCategorie');
		if(empty($FK_NumCategorie)){
		$FK_NumCategorie = NULL;
		}
		$Ingredient = new ModelIngredient($NomIng,$prixUnitaireIng,$QteStockIngredient,$FK_NumUnite,$FK_NumAllergene,$FK_CodeTVA,$FK_NumCategorie);
		$Ingredient->save();
		self::readAll();
	}

	public static function updated(){
		if(!is_null(myGet('NumIngredient'))){
			$NumIngredient=myGet('NumIngredient');
		}
		if(!is_null(myGet('NomIng'))){
			$NomIng=myGet('NomIng');
		}
		if(!is_null(myGet('prixUnitaireIng'))){
			$prixUnitaireIng=myGet('prixUnitaireIng');
		}
		if(!is_null(myGet('QteStockIngredient'))){
			$QteStockIngredient=myGet('QteStockIngredient');
		}
		if(!is_null(myGet('FK_NumUnite'))){
			$FK_NumUnite=myGet('FK_NumUnite');
		}
		if(!is_null(myGet('FK_NumAllergene'))){
			$FK_NumAllergene=myGet('FK_NumAllergene');
		}
		if(empty($FK_NumAllergene)){
			$FK_NumAllergene = NULL;
		}
		if(!is_null(myGet('FK_CodeTVA'))){
			$FK_CodeTVA=myGet('FK_CodeTVA');
		}
		if(!is_null(myGet('FK_NumCategorie'))){
			$FK_NumCategorie=myGet('FK_NumCategorie');
		}
		if(empty($FK_NumCategorie)){
			$FK_NumCategorie = NULL;
			}
		$data = array(
			"primary" => $NumIngredient,
			"NomIng" => $NomIng,
			"prixUnitaireIng" => $prixUnitaireIng,
			"QteStockIngredient" => $QteStockIngredient,
			"FK_NumUnite" => $FK_NumUnite,
			"FK_NumAllergene" => $FK_NumAllergene,
			"FK_CodeTVA" => $FK_CodeTVA,
			"FK_NumCategorie" => $FK_NumCategorie
		);
		ModelIngredient::update($data);
	    $view='list';
	    $pagetitle='Mise à jour de la recette';
	    $tab_u = ModelIngredient::selectAll();
		require_once File::build_path(array("view", "view.php"));
	}

	/*private $NumIngredient;
	private $NomIng;
    private $prixUnitaireIng;
    private $QteStockIngredient;
    private $FK_NumUnite;
    private $FK_NumAllergene;
    private $FK_CodeTVA;
    private $FK_NumCategorie;*/

	//fonction pour modifier et créer des ingrédients
	public static function update(){
		$tab_u = ModelIngredient::selectAll();
		$NumIngredient = myGet('NumIngredient');
		$liste_unite = ModelUnite::selectAll();
		$liste_categorie = ModelCategorie_Ingredient::selectAll();
		$liste_allergene = ModelAllergene::selectAll();
		$liste_TVA = ModelTVA::selectAll();
		if(is_null($NumIngredient)){
        	$view='update';
        	$pagetitle='Création d\'un ingredient';
        	$type = '';
        	$action='created';
	    	require_once File::build_path(array("view", "view.php"));
		} else {
	    	$ingredient = ModelIngredient::select($NumIngredient); //Ingredient à update
	    	$view = 'update';
	        $pagetitle='Modification de l\'ingredient';
	        $type = 'readonly';
	        $action = 'updated';

	    	require_once File::build_path(array("view", "view.php"));
		}
	}
}
?>