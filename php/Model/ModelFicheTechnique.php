<?php
require_once File::build_path(array("model", "Model.php"));
class ModelFicheTechnique extends Model{

	protected static $object = 'FicheTechnique';
	protected static $primary='NumeroFiche';

	private $NumeroFiche;
	private $NomFiche;
    private $NbreCouverts;
    private $NomAuteur;
    private $CoutFluide;
    private $FK_NumeroCatFiche;

	public function getNumeroFiche(){
		return $this->NumeroFiche;
	}

	public function getNomFiche(){
		return $this->NomFiche;
	}

    public function getNbreCouverts(){
        return $this->NbreCouverts;
    }

    public function getNomAuteur(){
        return $this->NomAuteur;
    }

    public function getCoutFluide(){
        return $this->CoutFluide;
    }

    public function getFK_NumeroCatFiche(){
        return $this->FK_NumeroCatFiche;
    }

	public function setNumeroFiche($NumeroFiche2){
		$this->NumeroFiche = $NumeroFiche2;
	}

	public function setNomFiche($NomFiche2){
		$this->NomFiche = $NomFiche2;
	}

    public function setNbreCouverts($NbreCouverts2){
        $this->NbreCouverts = $NbreCouverts2;
    }

    public function setNomAuteur($NomAuteur2){
        $this->NomAuteur = $NomAuteur2;
    }

    public function setCoutFluide($CoutFluide2){
        $this->CoutFluide = $CoutFluide2;
    }

    public function setFK_NumeroCatFiche($NumeroCatFiche2){
        $this->$FK_NumeroCatFiche = $NumeroCatFiche2;
    }

	public function __construct($NumeroFiche = NULL, $NomFiche = NULL, $NbreCouverts = NULL, $NomAuteur = NULL, $CoutFluide = NULL, $FK_NumeroCatFiche = NULL) {
  	if (!is_null($NumeroFiche)) {
	    $this->NumeroFiche = $NumeroFiche;
        $this->NomFiche = $NomFiche;
        $this->NbreCouverts = $NbreCouverts;
        $this->NomAuteur = $NomAuteur;
        $this->CoutFluide = $CoutFluide;
        $this->FK_NumeroCatFiche = $FK_NumeroCatFiche;
        }
  	}

  	public function NumeroFicheTechniqueExiste($NumA) {
      $sql = "SELECT COUNT(*) FROM FicheTechnique WHERE NumeroFiche = $NumA";
      $rep = Model::$pdo->query($sql);  
      $rep->setFetchMode(PDO::FETCH_CLASS, 'FicheTechnique');
     
      $resultat = $rep->fetchAll();
      if($resultat[0][0]==1){
      	return true;
      }
      else{
      	return false;
      }
    }

    public function configNumeroFicheTechnique() {
      $sql = "SELECT MAX(NumeroFiche) FROM FicheTechnique";
      $rep = Model::$pdo->query($sql);  
      $rep->setFetchMode(PDO::FETCH_CLASS, 'FicheTechnique');
     
      $resultat = $rep->fetchAll();
      return $resultat[0][0];
    }

    public function save() {
        try {
            $sql = "INSERT INTO FicheTechnique VALUES (:NumeroFiche, :NomFiche, :NbreCouverts, :NomAuteur, :CoutFluide, :FK_NumeroCatFiche)";
            // Préparation de la requête
            $req_prep = Model::$pdo->prepare($sql);

            $values = array(
                "NumeroFiche" => self::configNumeroFiche()+1,
                "NomFiche" => $this->NomFiche,
                "NbreCouverts" => $this->NbreCouverts,
                "NomAuteur" => $this->NomAuteur,
                "CoutFluide" => $this->CoutFluide,
                "FK_NumeroCatFiche" => $this->FK_NumeroCatFiche,
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