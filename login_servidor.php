	<?php 
		session_start();
		require("conexao.php");

		if (isset($_POST['login'])) {

		$user = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
		$senha = $_POST['senha'];

		if (!$user || !$senha) {

			echo "digite sua senha e login";
		}else{

			$lista = $conexao->prepare("select * from servidor where nome = :user LIMIT 1");
			$lista->bindValue(':user', $user);
			$lista->execute();

			if($lista->rowCount() > 0){

				$usuario = $lista->fetch(PDO::FETCH_OBJ);

				echo $user ."<br>". $usuario->senha;

				if (password_verify($senha, $usuario->senha)) {
					
						setcookie("nome", $user, time() + (86400 * 30));
						$_SESSION['user'] = $usuario->ID;
						header("Location:menu_servidor.php");
					
				}else{

						echo "erro no nome ou senha";
					}

			}else{
				echo "Usuário não encontrado";
			}
			
		}
	}
	?>
	<!DOCTYPE html>
	<html lang="pt-BR">
	  <head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">

	    <title>Login Aluno</title>
	    <link rel="icon" type="image/x-icon" href="img/logo.ico">

	    <meta name="description" content="Source code generated using layoutit.com">
	    <meta name="author" content="LayoutIt!">

	    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
	    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" rel="stylesheet">

	  </head>
	  <body style="background-color:#BEC8E3;">

	    <div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<br>
				<br>
				<br>
				<h3 class="text-center">
					Realizar Login
				</h3>
			</div>
			<br>
		</div>
		<div class="row">
			<div class="col-md-4">
			</div>
			<div class="col-md-4">
				<form role="form" method="POST">
					<div class="form-group">
						 
						<label for="exampleInputEmail1">
							Login
						</label>
						<input type="text" class="form-control" id="exampleInputEmail1" name="nome">
					</div>
					<br>
					<br>
					<div class="form-group">
						 
						<label for="exampleInputPassword1">
							Senha
						</label>
						<input type="password" class="form-control" id="exampleInputPassword1" name="senha">
					</div>
					<br>
					<br>
					<div class="checkbox">
						 
					</div> 
					<button type="submit" class="btn btn-primary" value="login" name="login">
						Entrar
					</button>
				</form>

				<br>
				<br>
			</div>
			<div class="col-md-4">
			</div>
		</div>
	</div>

	    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>

	  </body>
	</html>
