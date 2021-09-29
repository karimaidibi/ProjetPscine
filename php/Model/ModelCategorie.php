<?php
require_once File::build_path(array("model", "Model.php"));
class ModelCategorie extends Model{

	protected static $object = 'Categorie';
	protected static $primary='idCategorie';

	private $idCategorie;
	private $nomCategorie;

	public function getIdCategorie(){
		return $this->idCategorie;
	}

	public function getNomCategorie(){
		return $this->nomCategorie;
	}

	public function setIdCategorie($idCategorie2){
		$this->idCategorie = $idCategorie2;
	}

	public function setNomCategorie($nomCategorie2){
		$this->nomCategorie = $nomCategorie2;
	}

	public function __construct($nom = NULL, $idCategorie = NULL) {
  	if (!is_null($nom)) {
	    $this->nomCategorie = $nom;
        $this->idCategorie = $idCategorie;
    	}
  	}

  	public function idCategorieExiste($idC) {
      $sql = "SELECT COUNT(*) FROM Categorie WHERE idCategorie = $idC";
      $rep = Model::$pdo->query($sql);  
      $rep->setFetchMode(PDO::FETCH_CLASS, 'Categorie');
     
      $resultat = $rep->fetchAll();
      if($resultat[0][0]==1){
      	return true;
      }
      else{
      	return false;
      }
    }

    public function configIdCategorie() {
      $sql = "SELECT MAX(idCategorie) FROM Categorie";
      $rep = Model::$pdo->query($sql);  
      $rep->setFetchMode(PDO::FETCH_CLASS, 'Categorie');
     
      $resultat = $rep->fetchAll();
      return $resultat[0][0];
    }

    public function save() {
        try {
            $sql = "INSERT INTO Categorie VALUES (:nomCategorie, :idCategorie)";
            // Préparation de la requête
            $req_prep = Model::$pdo->prepare($sql);

            $values = array(
                "idCategorie" => self::configIdCategorie()+1,
                "nomCategorie" => $this->nomCategorie,
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