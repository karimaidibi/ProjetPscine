<?php
require_once File::build_path(array("model", "Model.php"));
class ModelContenir extends Model{

	protected static $object = 'Contenir';
    protected static $primary='FK_NumeroFiche';
	protected static $primary2='FK_NumEtape';
    protected static $primary3='ordre';

	private $FK_NumeroFiche;
	private $FK_NumEtape;
    private $ordre;

    public function getNumEtape(){
        return $this->FK_NumEtape;
    }

	public function getNumeroFiche(){
		return $this->FK_NumeroFiche;
	}

	public function setNumEtape($FK_NumEtape2){
		$this->FK_NumEtape = $FK_NumEtape2;
	}

	public function setNumeroFiche($FK_NumeroFiche2){
		$this->FK_NumeroFiche = $FK_NumeroFiche2;
	}

    public function getordre(){
        return $this->ordre;
    }

    public function setordre($ordre2){
        $this->ordre = $ordre2;
    }

	public function __construct( $FK_NumeroFiche = NULL, $FK_NumEtape = NULL, $ordre = NULL) {
  	if (!is_null($FK_NumEtape) && !is_null($FK_NumeroFiche) && !is_null($ordre)) {
        $this->FK_NumeroFiche = $FK_NumeroFiche;
	    $this->FK_NumEtape = $FK_NumEtape;
        $this->ordre = $ordre;
        }
  	}

  	public function NumEtapeExiste($NumA) {
      $sql = "SELECT COUNT(*) FROM Contenir WHERE FK_NumEtape = $NumA";
      $rep = Model::$pdo->query($sql);  
      $rep->setFetchMode(PDO::FETCH_CLASS, 'Contenir');
     
      $resultat = $rep->fetchAll();
      if($resultat[0][0]==1){
      	return true;
      }
      else{
      	return false;
      }
    }

    public function configordre() {
        $sql = "SELECT MAX(ordre) FROM contenir";
        $rep = Model::$pdo->query($sql);  
        $rep->setFetchMode(PDO::FETCH_CLASS, 'contenir');
       
        $resultat = $rep->fetchAll();
        return $resultat[0][0];
      }

    public function save() {
        try {
            $sql = "INSERT INTO Contenir VALUES (:FK_NumeroFiche, :FK_NumEtape, :ordre)";
            // Préparation de la requête
            $req_prep = Model::$pdo->prepare($sql);
            //$ordre = self::configordre()+1;

            $values = array(
                "FK_NumeroFiche" => $this->FK_NumeroFiche,
                "FK_NumEtape" => $this->FK_NumEtape,
                "ordre" => $this->ordre
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