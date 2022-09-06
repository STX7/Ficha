<?php 
if (isset($_POST['login'])) {

	$user = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
	$senha = $_POST['senha'];

	if (!$user || !$senha) {

		header("Location: login_aluno.php?erro=nada");
	}else{
		try {
			$lista = $conexao->prepare("select * from aluno where nome = :user LIMIT 1");
			$lista->bindValue(':user', $user);
			$lista->execute();

			if($lista->rowCount() > 0){

				$usuario = $lista->fetch(PDO::FETCH_OBJ);

				echo $user ."<br>". $usuario->senha;

				if (password_verify($senha, $usuario->senha)) {
					
					setcookie("nome", $user, time() + (86400 * 30));
					$_SESSION['user'] = $usuario->ID;
					header("Location:menu.php");
					
				}else{

					header("Location: login_aluno.php?erro=senhaerrado");
				}

			}else{
				header("Location: login_aluno.php?erro=usererrado");
			}
		} catch (Exception $e) {

		}


	}
}

?>