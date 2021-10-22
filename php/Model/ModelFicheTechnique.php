<?php
ini_set('display_errors', 'on'); 
require_once "lib/File.php";
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
    private $FK_CodeCoeffAss;
    private $FK_CodeCoeffCoutPersonnel;

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

    public function getFK_CodeCoeffAss(){
        return $this->FK_CodeCoeffAss;
    }

    public function getFK_CodeCoeffCoutPersonnel(){
        return $this->FK_CodeCoeffCoutPersonnel;
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

    public function setFK_CodeCoeffAss($CodeCoeffAss2){
        $this->$FK_CodeCoeffAss = $CodeCoeffAss2;
    }

    public function setFK_CodeCoeffCoutPersonnel($CodeCoeffCoutPersonnel2){
        $this->$FK_CodeCoeffCoutPersonnel = $CodeCoeffCoutPersonnel2;
    }


	public function __construct($NomFiche = NULL, $NbreCouverts = NULL, $NomAuteur = NULL, $CoutFluide = NULL, $FK_NumeroCatFiche = NULL, $FK_CodeCoeffAss = NULL, $FK_CodeCoeffCoutPersonnel = NULL) {
  	if (!is_null($NomFiche)) {
        $this->NomFiche = $NomFiche;
        $this->NbreCouverts = $NbreCouverts;
        $this->NomAuteur = $NomAuteur;
        $this->CoutFluide = $CoutFluide;
        $this->FK_NumeroCatFiche = $FK_NumeroCatFiche;
        $this->FK_CodeCoeffAss = $FK_CodeCoeffAss;
        $this->FK_CodeCoeffCoutPersonnel = $FK_CodeCoeffCoutPersonnel;
        $this->NumeroFiche = self::configNumeroFicheTechnique()+1;
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
            $sql = "INSERT INTO FicheTechnique (NumeroFiche,NomFiche, NbreCouverts, NomAuteur, CoutFluide, FK_NumeroCatFiche, FK_CodeCoeffAss, FK_CodeCoeffCoutPersonnel) VALUES (:NumeroFiche, :NomFiche, :NbreCouverts, :NomAuteur, :CoutFluide, :FK_NumeroCatFiche, :FK_CodeCoeffAss, :FK_CodeCoeffCoutPersonnel)";
            // Préparation de la requête
            $req_prep = Model::$pdo->prepare($sql);
            $values = array(
                "NumeroFiche" => $this->NumeroFiche,
                "NomFiche" => $this->NomFiche,
                "NbreCouverts" => $this->NbreCouverts,
                "NomAuteur" => $this->NomAuteur,
                "CoutFluide" => $this->CoutFluide,
                "FK_NumeroCatFiche" => $this->FK_NumeroCatFiche,
                "FK_CodeCoeffAss" => $this->FK_CodeCoeffAss,
                "FK_CodeCoeffCoutPersonnel" => $this->FK_CodeCoeffCoutPersonnel
            );
            // On donne les valeurs et on exécute la requête 
            $req_prep->execute($values);
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    /*Requette pour recuperer toutes les progressions appartenant à une fiche donnée
        - cette requette n'est pas generique à toute les tables, de ce fait j'ai choisit de la mettre ici */
    public static function selectProgressionsOf($NumeroFiche){
        try{
            //select DescriptionEtape from contenir join Etape on FK_NumEtape = NumEtape where NumeroFiche = $NumeroFiche
            $sql = "SELECT * FROM etape e JOIN contenir c ON e.NumEtape = c.FK_NumEtape WHERE c.FK_NumeroFiche = $NumeroFiche ORDER BY ordre ASC";
            $req_prep = Model::$pdo->prepare($sql);
            $req_prep->execute();
        } catch (PDOException $e){
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
	    return $req_prep->fetchAll();
    }

    /*Requette pour recuperer touts les ingredients appartenant à une fiche donnée
        - cette requette n'est pas generique à toute les tables, de ce fait j'ai choisit de la mettre ici */
        public static function selectIngredientsOf($NumeroFiche){
            try{
                // select touts les coefficients dans la table coefficients ayant comme code un code utilisé par une fiche technique précise
                $sql = "SELECT * FROM ingredient i JOIN composer c ON i.NumIngredient = c.FK_NumIngredient WHERE c.FK_NumeroFiche = $NumeroFiche";
                $req_prep = Model::$pdo->prepare($sql);
                $req_prep->execute();
            } catch (PDOException $e){
                if (Conf::getDebug()) {
                    echo $e->getMessage(); // affiche un message d'erreur
                } else {
                    echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
                }
                die();
            }
            return $req_prep->fetchAll();
        }

    /*Requette pour recuperer toutes les fiches appartenante à une fiche donnée
        - cette requette n'est pas generique à toute les tables, de ce fait j'ai choisit de la mettre ici */
        public static function selectSousFichesOf($NumeroFiche){
            try{

                $sql = "SELECT * FROM inclure i JOIN fichetechnique f ON i.FK_NumeroSousFiche = f.NumeroFiche WHERE i.FK_NumeroFiche = $NumeroFiche ORDER BY ordre ASC";
                $req_prep = Model::$pdo->prepare($sql);
                $req_prep->execute();
            } catch (PDOException $e){
                if (Conf::getDebug()) {
                    echo $e->getMessage(); // affiche un message d'erreur
                } else {
                    echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
                }
                die();
            }
            return $req_prep->fetchAll();
        }

}
?>