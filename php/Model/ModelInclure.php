<?php
require_once File::build_path(array("model", "Model.php"));
class ModelInclure extends Model{

	protected static $object = 'Inclure';
	protected static $primary='FK_NumeroFiche';

	private $FK_NumeroFiche;
	private $FK_NumeroSousFiche;
    private $ordre;

    public function getFK_NumeroFiche(){
        return $this->FK_NumeroFiche;
    }

	public function getFK_NumeroSousFiche(){
		return $this->FK_NumeroSousFiche;
	}

    public function getordre(){
        return $this->ordre;
    }

	public function setFK_NumeroFiche($FK_NumeroFiche2){
		$this->FK_NumeroFiche = $FK_NumeroFiche2;
	}

	public function setFK_NumeroSousFiche($FK_NumeroSousFiche2){
		$this->FK_NumeroSousFiche = $FK_NumeroSousFiche2;
	}

    public function setordre($ordre2){
        $this->ordre = $ordre2;
    }

	public function __construct($FK_NumeroFiche = NULL, $FK_NumeroSousFiche = NULL) {
  	if (!is_null($FK_NumeroFiche) && !is_null($FK_NumeroSousFiche) && !is_null($ordre)) {
	    $this->FK_NumeroFiche = $FK_NumeroFiche;
        $this->FK_NumeroSousFiche = $FK_NumeroSousFiche;
        }
  	}

  	public function FK_NumeroFicheExiste($NumA) {
      $sql = "SELECT COUNT(*) FROM Inclure WHERE FK_NumeroFiche = $NumA";
      $rep = Model::$pdo->query($sql);  
      $rep->setFetchMode(PDO::FETCH_CLASS, 'Inclure');
     
      $resultat = $rep->fetchAll();
      if($resultat[0][0]==1){
      	return true;
      }
      else{
      	return false;
      }
    }

    public function configordre() {
      $sql = "SELECT MAX(ordre) FROM Inclure";
      $rep = Model::$pdo->query($sql);  
      $rep->setFetchMode(PDO::FETCH_CLASS, 'Inclure');
     
      $resultat = $rep->fetchAll();
      return $resultat[0][0];
    }

    public function save() {  //A revoir pour la sauvegarde de l'ordre !!!
        try {
            $sql = "INSERT INTO Inclure VALUES (:FK_NumeroFiche, :FK_NumeroSousFiche, :ordre)";
            // Préparation de la requête
            $req_prep = Model::$pdo->prepare($sql);
            $ordre = self::configordre()+1;

            $values = array(
                "FK_NumeroFiche" => $this->FK_NumeroFiche,
                "FK_NumeroSousFiche" => $this->FK_NumeroSousFiche,
                "ordre" => $ordre
            );
            self::setordre($ordre);
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