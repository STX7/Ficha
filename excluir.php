<?php
	session_start();
	require("conexao.php");
	$id = $_GET['id'];
	$lista = $conexao->prepare("select * from ficha where id = '$id'");
	$lista = $conexao->prepare("delete from ficha where ficha.id = $id")
	$lista->execute();
	$itens = $lista->fetchAll(PDO::FETCH_OBJ);
	header("Location:menu.php");
?>