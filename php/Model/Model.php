<?php
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
}
Model::Init();

?>