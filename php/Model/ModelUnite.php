<?php
require_once File::build_path(array("model", "Model.php"));
class ModelUnite extends Model{

	protected static $object = 'Unite';
	protected static $primary='idUnite';

	private $idUnite;
	private $nomUnite;

	public function getIdUnite(){
		return $this->idUnite;
	}

	public function getNomUnite(){
		return $this->nomUnite;
	}

	public function setIdUnite($idUnite2){
		$this->idUnite = $idUnite2;
	}

	public function setNomUnite($nomUnite2){
		$this->nomUnite = $nomUnite2;
	}

	public function __construct($nom = NULL, $idUnite = NULL) {
  	if (!is_null($nom)) {
	    $this->nomUnite = $nom;
        $this->idUnite = $idUnite;
    	}
  	}

  	public function idUniteExiste($idU) {
      $sql = "SELECT COUNT(*) FROM Unite WHERE idUnite = $idU";
      $rep = Model::$pdo->query($sql);  
      $rep->setFetchMode(PDO::FETCH_CLASS, 'Unite');
     
      $resultat = $rep->fetchAll();
      if($resultat[0][0]==1){
      	return true;
      }
      else{
      	return false;
      }
    }

    public function configIdUnite() {
      $sql = "SELECT MAX(idUnite) FROM Unite";
      $rep = Model::$pdo->query($sql);  
      $rep->setFetchMode(PDO::FETCH_CLASS, 'Unite');
     
      $resultat = $rep->fetchAll();
      return $resultat[0][0];
    }

    public function save() {
        try {
            $sql = "INSERT INTO Unite VALUES (:nomUnite, :idUnite)";
            // Préparation de la requête
            $req_prep = Model::$pdo->prepare($sql);

            $values = array(
                "idUnite" => self::configIdUnite()+1,
                "nomUnite" => $this->nomUnite,
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