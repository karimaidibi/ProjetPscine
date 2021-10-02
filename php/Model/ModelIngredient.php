<?php
require_once File::build_path(array("model", "Model.php"));
class ModelIngredient extends Model{

	protected static $object = 'Ingredient';
	protected static $primary='idIngredient';

	private $idIngredient;
	private $nomIngredient;
    private $prixUnitaire;
    private $quantiteStock;

	public function getIdIngredient(){
		return $this->idIngredient;
	}

	public function setIdIngredient($idIngredient2){
		$this->idIngredient = $idIngredient2;
	}

	public function getNomIngredient(){
		return $this->nomIngredient;
	}

	public function setNomIngredient($nomIngredient2){
		$this->nomIngredient = $nomIngredient2;
	}

    public function getPrixUnitaire(){
        return $this->prixUnitaire;
    }

    public function setPrixUnitaire($prixUnitaire2){
        $this->prixUnitaire = $prixUnitaire2;
    }

    public getquantiteStock(){
        return $this->quantiteStock;
    }

    public setquantiteStock($quantiteStock2){
        $this->quantiteStock = $quantiteStock2;
    }

	public function __construct($nom = NULL, $idIngredient = NULL, $prixU = NULL, $qteStock = NULL) {
  	if (!is_null($nom)) {
	    $this->nomIngredient = $nom;
        $this->idIngredient = $idIngredient;
        $this->prixUnitaire = $prixU;
        $this->quantiteStock = $qteStock;
    	}
  	}

  	public function idIngredientExiste($idI) {
      $sql = "SELECT COUNT(*) FROM Ingredient WHERE idIngredient = $idI";
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

    public function configIdIngredient() {
      $sql = "SELECT MAX(idIngredient) FROM Ingredient";
      $rep = Model::$pdo->query($sql);  
      $rep->setFetchMode(PDO::FETCH_CLASS, 'Ingredient');
     
      $resultat = $rep->fetchAll();
      return $resultat[0][0];
    }

    public function save() {
        try {
            $sql = "INSERT INTO Ingredient VALUES (:nomIngredient, :idIngredient, :prixUnitaire, :quantiteStock)";
            // Préparation de la requête
            $req_prep = Model::$pdo->prepare($sql);

            $values = array(
                "idIngredient" => self::configIdIngredient()+1,
                "nomIngredient" => $this->nomIngredient,
                "prixUnitaire" => $this->prixUnitaire,
                "quantiteStock" => $this->quantiteStock,
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