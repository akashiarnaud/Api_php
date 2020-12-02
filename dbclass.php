<?php

class Database {
	var $conn;
	function getConnection() {
		$dsn = "mysql:host=localhost;dbname=efficom";
		$dbh = new PDO($dsn, "root", "root", array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
		return $dbh;
	}
}
?>