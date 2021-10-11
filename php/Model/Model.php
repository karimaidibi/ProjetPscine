<?php
ini_set('display_errors', 'on'); 
require_once "lib/File.php";
require_once File::build_path(array("config", "conf.php"));
class Model{
	public static $pdo;
	public static function Init(){
		$hostname = Conf::getHostname();
		$database_name = Conf::getDatabase();
		$login = Conf::getLogin();
		$password = Conf::getPassword();
		try{
  			self::$pdo = new PDO("mysql:host=$hostname;dbname=$database_name", $login, $password,
                     array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")); 
  			self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e) {
  			echo $e->getMessage();
  			die();
		}
		
	}

	public static function selectAll() {
		$table_name = static::$object;
		$class_name = 'Model' . ucfirst($table_name);
	    $pdo = Model::$pdo;
	    $sql = "SELECT * from " . $table_name;
	    $rep = $pdo->query($sql);
	    $rep->setFetchMode(PDO::FETCH_CLASS, $class_name);
	    return $rep->fetchAll();
  	}

  	public static function select($primary_value) {
  		$table_name = static::$object;
  		$class_name = 'Model' . ucfirst($table_name);
  		$primary_key = static::$primary;
	    $sql = "SELECT * from " . $table_name . " WHERE " . $primary_key . "=:nom_tag";
	    $req_prep = Model::$pdo->prepare($sql);

	    $values = array(
	        "nom_tag" => $primary_value,
	    );	 
	    $req_prep->execute($values);
	    $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
	    $tab_voit = $req_prep->fetchAll();
	    // Attention, si il n'y a pas de résultats, on renvoie false
    	if (empty($tab_voit)){
        	return false;
    	}
    	return $tab_voit[0]; // renvoie la case d'index 0 du resultat, ce qui notre clé primaire
    	print_r($tab_voit[0]);
	}

	// pouvoir recuperer un objet (une ligne de resultat complète d'une table)
	public static function selectLigne($primary_value) {
		$table_name = static::$object;
		$class_name = 'Model' . ucfirst($table_name);
		$primary_key = static::$primary;
		$sql = "SELECT * from " . $table_name . " WHERE " . $primary_key . "=:nom_tag";
		$req_prep = Model::$pdo->prepare($sql);

		$values = array(
			"nom_tag" => $primary_value,
		);	 
		$req_prep->execute($values);
		$req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
		$tab_voit = $req_prep->fetchAll();
		// Attention, si il n'y a pas de résultats, on renvoie false
		if (empty($tab_voit)){
			return false;
		}
		return $tab_voit; //la ligne de la table correspondante à la clé primaire
	}

	public static function update($data){
        $table_name = ucfirst(static::$object);
        $primary_key = static::$primary;
        $sql = "UPDATE " . $table_name ." SET";
        foreach ($data as $cle => $valeur){
            if ($cle != "primary"){
                $sql = $sql." $cle =:$cle,";
            }
        }
        try{
            $sql = rtrim($sql, ",");
            $sql = $sql
                    . " WHERE $primary_key=:primary";
            
            $req_prep = Model::$pdo->prepare($sql);
            $req_prep->execute($data);
            
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

	public static function selectV2($primary_value1, $primary_value2) {
  		$table_name = static::$object;
  		$class_name = 'Model' . ucfirst($table_name);
  		$primary_key = static::$primary;
  		$primary_key2 = static::$primary2;
	    $sql = "SELECT * from " . $table_name . " WHERE " . $primary_key . "=:nom_tag AND " . $primary_key2 . "=:nom_tag2";
	    $req_prep = Model::$pdo->prepare($sql);

	    $values = array(
	        "nom_tag" => $primary_value,
	        "nom_tag2" => $primary_value2,
	    );	 
	    $req_prep->execute($values);
	    $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
	    $tab_voit = $req_prep->fetchAll();
	    // Attention, si il n'y a pas de résultats, on renvoie false
    	if (empty($tab_voit)){
        	return false;
    	}
    	return $tab_voit[0];
	}

	public static function selectV3($primary_value1, $primary_value2, $primary_value3) {
  		$table_name = static::$object;
  		$class_name = 'Model' . ucfirst($table_name);
  		$primary_key = static::$primary;
  		$primary_key2 = static::$primary2;
  		$primary_key3 = static::$primary3;
	    $sql = "SELECT * from " . $table_name . " WHERE " . $primary_key . "=:nom_tag AND " . $primary_key2 . "=:nom_tag2 AND " . $primary_key3 . "=:nom_tag3";
	    $req_prep = Model::$pdo->prepare($sql);

	    $values = array(
	        "nom_tag" => $primary_value,
	        "nom_tag2" => $primary_value2,
	        "nom_tag3" => $primary_value3,
	    );	 
	    $req_prep->execute($values);
	    $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
	    $tab_voit = $req_prep->fetchAll();
	    // Attention, si il n'y a pas de résultats, on renvoie false
    	if (empty($tab_voit)){
        	return false;
    	}
    	return $tab_voit[0];
	}

	public static function nombreTotal(){
		$table_name = static::$object;
		$class_name = 'Model' . ucfirst($table_name);
		$primary_key = static::$primary;
		$pdo = Model::$pdo;
		$sql = "SELECT COUNT(*) FROM " . $table_name;
	    $rep = $pdo->query($sql);
	    $rep->setFetchMode(PDO::FETCH_CLASS, $class_name);
	    print_r($rep);
	    return $rep->fetchAll();
	}

	public static function delete($primary){
		$table_name = static::$object;
		$primary_key = static::$primary;
		$sql = "DELETE FROM " . $table_name . " WHERE " . $primary_key . "=:nom_tag";
    	$req_prep = Model::$pdo->prepare($sql);
    	$values = array(
    	   "nom_tag" => $primary,
    	);
    	$req_prep->execute($values);
	}

	public static function deleteV2($primary, $primary2){
		$table_name = static::$object;
		$primary_key = static::$primary;
		$primary_key2 = static::$primary2;
		$sql = "DELETE FROM " . $table_name . " WHERE " . $primary_key . "=:nom_tag AND " . $primary_key2 . "=:nom_tag2";
    	$req_prep = Model::$pdo->prepare($sql);
    	$values = array(
    	   "nom_tag" => $primary,
    	   "nom_tag2" => $primary2,
    	);
    	$req_prep->execute($values);
	}

	public static function deleteV3($primary, $primary2, $primary3){
		$table_name = static::$object;
		$primary_key = static::$primary;
		$primary_key2 = static::$primary2;
		$primary_key3 = static::$primary3;
		$sql = "DELETE FROM " . $table_name . " WHERE " . $primary_key . "=:nom_tag AND " . $primary_key2 . "=:nom_tag2 AND " . $primary_key3 . "=:nom_tag3";
    	$req_prep = Model::$pdo->prepare($sql);
    	$values = array(
    	   "nom_tag" => $primary,
    	   "nom_tag2" => $primary2,
    	   "nom_tag3" => $primary3,
    	);
    	$req_prep->execute($values);
	}
}
Model::Init();

?>