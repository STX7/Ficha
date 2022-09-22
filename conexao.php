<?php
function conectar(){
	try {
		return new PDO('mysql:host=localhost:3306; dbname=ficha', 'root', '');

	} catch (Exception $e) {
		echo $e->getMessage();
		echo "<br>";
		echo $e->getCode();
	}
}

function excluir(){
	session_start();
	require("conexao.php");
	$conexao = conectar();
	$id = $_GET['id'];
	$lista = $conexao->prepare("delete from ficha where ficha.id = '$id'");
	$lista->execute();
	$itens = $lista->fetchAll(PDO::FETCH_OBJ);
	header("Location:menu.php");

}
function excluir_servidor(){
	session_start();
	require("conexao.php");
	$conexao = conectar();
	$id = $_GET['id'];
	$lista = $conexao->prepare("delete from ficha where ficha.id = '$id'");
	$lista->execute();
	$itens = $lista->fetchAll(PDO::FETCH_OBJ);
	header("Location:menu_servidor.php");

}

function logout(){
	session_start();
	session_destroy();
	header("location: index.php"); 
}
?>