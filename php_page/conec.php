<?php
	class db{
		private $dbhost 		= 'localhost';
		// private $dbuser 		= 'amclabor_usr_ges';
		// private $dbpassword 	= 'A49bx3kk!!';
		// private $dbname 		= 'amclabor_gestionv1';
		private $dbuser 		= 'root';
		private $dbpassword 	= 'root';
		private $dbname 		= 'mawiicom__mawii';
		public function conection(){
			$mysql = "mysql:host=$this->dbhost;dbname=$this->dbname";
			$conection = new PDO($mysql, $this->dbuser, $this->dbpassword, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
			$conection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $conection;
		}
	}