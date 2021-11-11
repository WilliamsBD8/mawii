<?php
	include_once './php_page/conec.php';
	function obtener_tabla($table, $order = false, $asc_desc = false){
		$conect = new db();
		$conect = $conect->conection();
		$query = "SELECT * FROM $table";
		if($order != false)
			$query .= " ORDER BY $order $asc_desc";
		$dat = $conect->query($query);
		$data = $dat->fetchAll(PDO::FETCH_OBJ);
		return $data;
	}