<?php
	try {
		$conexao = new PDO('mysql:host=localhost:3306; dbname=ficha', 'root', '');
	} catch (Exception $e) {
		echo $e->getMessage();
		echo "<br>";
		echo $e->getCode();
	}
?>