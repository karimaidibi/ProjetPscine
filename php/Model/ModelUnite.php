<?php
require_once File::build_path(array("model", "Model.php"));
class ModelUnite extends Model{

	protected static $object = 'Unite';
	protected static $primary='NumUnite';

	private $NumUnite;
	private $NomUnite;

	public function getNumUnite(){
		return $this->NumUnite;
	}

	public function getNomUnite(){
		return $this->NomUnite;
	}

	public function setNumUnite($NumUnite2){
		$this->NumUnite = $NumUnite2;
	}

	public function setNomUnite($NomUnite2){
		$this->NomUnite = $NomUnite2;
	}

	public function __construct($nom = NULL) {
  	if (!is_null($nom)) {
	    $this->NomUnite = $nom;
    	}
  	}

  	public function NumUniteExiste($idU) {
      $sql = "SELECT COUNT(*) FROM Unite WHERE NumUnite = $idU";
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

    public function configNumUnite() {
      $sql = "SELECT MAX(NumUnite) FROM Unite";
      $rep = Model::$pdo->query($sql);  
      $rep->setFetchMode(PDO::FETCH_CLASS, 'Unite');
     
      $resultat = $rep->fetchAll();
      return $resultat[0][0];
    }

    public function save() {
        try {
            $sql = "INSERT INTO Unite VALUES (:NumUnite, :NomUnite)";
            // Préparation de la requête
            $req_prep = Model::$pdo->prepare($sql);

            $values = array(
                "NumUnite" => self::configNumUnite()+1,
                "NomUnite" => $this->NomUnite,
            );
            self::setNumUnite(self::configNumUnite() + 1);
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