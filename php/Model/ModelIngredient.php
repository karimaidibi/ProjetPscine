<?php
require_once File::build_path(array("model", "Model.php"));
class ModelIngredient extends Model{

	protected static $object = 'Ingredient';
	protected static $primary='NumIngredient';

	private $NumIngredient;
	private $NomIng;
    private $prixUnitaireIng;
    private $QteStockIngredient;
    private $FK_NumUnite;
    private $FK_NumAllergene;
    private $FK_CodeTVA;
    private $FK_NumCategorie;

	public function getNumIngredient(){
		return $this->NumIngredient;
	}

	public function setNumIngredient($NumIngredient2){
		$this->NumIngredient = $NumIngredient2;
	}

	public function getNomIng(){
		return $this->NomIng;
	}

	public function setNomIng($NomIng2){
		$this->NomIng = $NomIng2;
	}

    public function getPrixUnitaireIng(){
        return $this->prixUnitaireIng;
    }

    public function setPrixUnitaireIng($prixUnitaireIng2){
        $this->prixUnitaireIng = $prixUnitaireIng2;
    }

    public function getQteStockIngredient(){
        return $this->QteStockIngredient;
    }

    public function setQteStockIngredient($QteStockIngredient2){
        $this->QteStockIngredient = $QteStockIngredient2;
    }

    public function getFK_NumUnite(){
        return $this->FK_NumUnite;
    }

    public function setFK_NumUnite($NumUnite2){
        $this->FK_NumUnite = $NumUnite2;
    }

    public function getFK_NumAllergene(){
        return $this->FK_NumAllergene;
    }

    public function setFK_NumAllergene($NumAllergene2){
        $this->FK_NumAllergene = $NumAllergene2;
    }

    public function getFK_CodeTVA(){
        return $this->FK_CodeTVA;
    }

    public function setFK_CodeTVA($CodeTVA2){
        $this->FK_CodeTVA = $CodeTVA2;
    }

    public function getFK_NumCategorie(){
        return $this->FK_NumCategorie;
    }

    public function setFK_NumCategorie($NumCategorie2){
        $this->FK_NumCategorie = $NumCategorie2;
    }

	public function __construct($nom = NULL, $NumIngredient = NULL, $prixU = NULL, $qteStock = NULL, $NumUnite = NULL, $NumAllergene = NULL, $CodeTVA = NULL, $NumCategorie = NULL) {
  	if (!is_null($nom)) {
	    $this->NomIng = $nom;
        $this->NumIngredient = $NumIngredient;
        $this->prixUnitaireIng = $prixU;
        $this->QteStockIngredient = $qteStock;
        $this->$FK_NumUnite = $NumUnite;
        $this->$FK_NumAllergene = $NumAllergene;
        $this->$FK_CodeTVA = $CodeTVA;
        $this->$FK_NumCategorie = $NumCategorie;
    	}
  	}

  	public function NumIngredientExiste($idI) {
      $sql = "SELECT COUNT(*) FROM Ingredient WHERE NumIngredient = $idI";
      $rep = Model::$pdo->query($sql);  
      $rep->setFetchMode(PDO::FETCH_CLASS, 'Ingredient');
     
      $resultat = $rep->fetchAll();
      if($resultat[0][0]==1){
      	return true;
      }
      else{
      	return false;
      }
    }

    public function configNumIngredient() {
      $sql = "SELECT MAX(NumIngredient) FROM Ingredient";
      $rep = Model::$pdo->query($sql);  
      $rep->setFetchMode(PDO::FETCH_CLASS, 'Ingredient');
     
      $resultat = $rep->fetchAll();
      return $resultat[0][0];
    }

    public function save() {
        try {
            $sql = "INSERT INTO Ingredient VALUES (:NomIng, :NumIngredient, :prixUnitaireIng, :QteStockIngredient)";
            // Préparation de la requête
            $req_prep = Model::$pdo->prepare($sql);

            $values = array(
                "NomIng" => $this->NomIng,
                "prixUnitaireIng" => $this->prixUnitaireIng,
                "QteStockIngredient" => $this->QteStockIngredient,
                "FK_NumUnite" => $this->$FK_NumUnite,
                "FK_NumAllergene" => $this->$FK_NumAllergene,
                "FK_CodeTVA" => $this->$FK_CodeTVA,
                "FK_NumCategorie" => $this->$FK_NumCategorie,
            );
            // On donne les valeurs et on exécute la requête     
            $req_prep->execute($values);
            // echo $sql;
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }
}
?>