<?php
require_once File::build_path(array("model", "Model.php"));
class ModelComposer extends Model{

	protected static $object = 'Composer';
    protected static $primary='FK_NumeroFiche';
	protected static $primary2='FK_NumIngredient';

    private $FK_NumeroFiche;
	private $FK_NumIngredient;
    private $QuantiteIngredient;

	public function getFK_NumIngredient(){
		return $this->FK_NumIngredient;
	}

	public function getFK_NumeroFiche(){
		return $this->NumeroFiche;
	}

	public function setFK_NumIngredient($NumIngredient2){
		$this->FK_NumIngredient = $NumIngredient2;
	}

	public function setFK_NumeroFiche($NumeroFiche2){
		$this->FK_NumeroFiche = $NumeroFiche2;
	}

    public function setQuantiteIngredient($QuantiteIngredient2){
        $this->QuantiteIngredient = $QuantiteIngredient2;
    }

    public function getQuantiteIngredient(){
        return $this->QuantiteIngredient;
    }

	public function __construct($FK_NumeroFiche = NULL, $FK_NumIngredient = NULL, $QuantiteIngredient = NULL) {
  	if (!is_null($FK_NumIngredient) && !is_null($FK_NumeroFiche)) {
        $this->FK_NumeroFiche = $FK_NumeroFiche;
	    $this->FK_NumIngredient = $FK_NumIngredient;
        $this->QuantiteIngredient = $QuantiteIngredient;
    	}
  	}

  	public function NumComposerExiste($NumI, $NumFiche) {
      $sql = "SELECT COUNT(*) FROM Composer WHERE FK_NumIngredient = $NumI AND FK_NumeroFiche = $NumFiche";
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
            $sql = "INSERT INTO Composer VALUES (:FK_NumeroFiche, :FK_NumIngredient, :QuantiteIngredient)";
            // Préparation de la requête
            $req_prep = Model::$pdo->prepare($sql);

            $values = array(
                "FK_NumeroFiche" => $this->FK_NumeroFiche,
                "FK_NumIngredient" => $this->FK_NumIngredient,
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