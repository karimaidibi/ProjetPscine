<?php
require_once File::build_path(array("model", "Model.php"));
class ModelComposer extends Model{

	protected static $object = 'Composer';
	protected static $primary='FK_NumIngredient';
    protected static $primary2='FK_NumeroFiche';

	private $FK_NumIngredient;
	private $FK_NumeroFiche;
    private $QuantiteIngredient;

	public function getNumIngredient(){
		return $this->NumIngredient;
	}

	public function getNumeroFiche(){
		return $this->NumeroFiche;
	}

    public function getQuantiteIngredient(){
        return $this->QuantiteIngredient;
    }

	public function setNumComposer($NumIngredient2){
		$this->NumIngredient = $NumIngredient2;
	}

	public function setNumeroFiche($NumeroFiche2){
		$this->NumeroFiche = $NumeroFiche2;
	}

    public function setQuantiteIngredient($QuantiteIngredient2){
        $this->QuantiteIngredient = $QuantiteIngredient2;
    }

	public function __construct($NumIngredient = NULL, $NumeroFiche = NULL, $QuantiteIngredient = NULL) {
  	if (!is_null($NumIngredient) && !is_null($NumeroFiche)) {
	    $this->NumIngredient = $NumIngredient;
        $this->NumeroFiche = $NumeroFiche;
        $this->QuantiteIngredient = $QuantiteIngredient;
    	}
  	}

  	public function NumComposerExiste($NumI, $NumFiche) {
      $sql = "SELECT COUNT(*) FROM Composer WHERE NumIngredient = $NumI AND NumeroFiche = $NumFiche";
      $rep = Model::$pdo->query($sql);  
      $rep->setFetchMode(PDO::FETCH_CLASS, 'Composer');
     
      $resultat = $rep->fetchAll();
      if($resultat[0][0]==1){
      	return true;
      }
      else{
      	return false;
      }
    }

    public function save() {
        try {
            $sql = "INSERT INTO Composer VALUES (:NumeroFiche, :NumIngredient, :QuantiteIngredient)";
            // Préparation de la requête
            $req_prep = Model::$pdo->prepare($sql);

            $values = array(
                "NumeroFiche" => $this->FK_NumeroFiche,
                "NumIngredient" => $this->FK_NumIngredient,
                "QuantiteIngredient" => $this->QuantiteIngredient,
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