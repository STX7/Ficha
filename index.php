	<?php
/**
 * 
 * Copyright © 2017 Seção Técnica de Informática - STI / ICMC <sti@icmc.usp.br>
 * 
 * Copyright © 2022 Estágio - ADS / IFG - Uruaçu
 *
 * Este programa é um software livre; você pode redistribuí-lo e/ou 
 * modificá-lo sob os termos da Licença Pública Geral GNU como 
 * publicada pela Fundação do Software Livre (FSF); na versão 3 da 
 * Licença, ou (a seu critério) qualquer versão posterior.
 * 
 * Este programa é distribuído na esperança de que possa ser útil, 
 * mas SEM NENHUMA GARANTIA; sem uma garantia implícita de ADEQUAÇÃO
 * a qualquer MERCADO ou APLICAÇÃO EM PARTICULAR. Veja a
 * Licença Pública Geral GNU para mais detalhes.
 * 
 *
 * Você deve ter recebido uma cópia da Licença Pública Geral GNU junto
 * com este programa. Se não, veja <http://www.gnu.org/licenses/>.
 * 
 */

/** 
 * <p> 
 * Ficha Catalográfica para Teses e Dissertações - IFG
 * </p> 
 * 
 * 
 * Contato: 
 * 
 * Este aplicativo utiliza o pacote PHP Pdf, que pode ser baixado a partir de 
 * https://github.com/rospdf/pdf-php
 *
 * Este aplicativo utiliza o pacote PHP Mailer, que pode ser baixado a partir de 
 * https://github.com/PHPMailer/PHPMailer
 * 
 * Este aplicativo utiliza a biblioteca de estilos do bootstrap v3 que pode ser obtido em
 * http://getbootstrap.com/
 * 
 * Os arquivos associados ao quadro de ajuda estão disponíveis em
 * http://www.icmc.usp.br/institucional/estrutura-administrativa/biblioteca/servicos/ficha
 *  
 * @author Maria Alice Soares de Castro - STI-ICMC (2017)
 * @copyright Seção Técnica de Informática - STI/ICMC (2017)
 * 
 * Universidade de São Paulo
 * Instituto de Ciências Matemáticas e de Computação (ICMC).
 *
 * @author Samuel da Silva dos Santos (2022)
 * 
 * Instituto Federal de Goiás - Campus Uruaçu
 * Análise e Desenvolvimento de Sistemas.
 */

########################################################################################## 
session_start();
require("cadastro_usuario.php");

if (isset($_GET['erro'])) { 
	if ($_GET['erro'] == "usererrado") { 
		echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
		<strong>Usuário ou senha incorreta</strong> insira os dados novamente
		</div>"; 
	}
	if ($_GET['erro'] == "nada") { 
		echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
		<strong>Campos em branco</strong> insira os dados novamente de forma correta!
		</div>"; 
	}
	if ($_GET['erro'] == "banco") { 
		echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
		<strong>Problemas no banco</strong> aguarde um instante e insira os dados novamente
		</div>"; 
	}

}

if (isset($_POST['login'])) {

	$user = filter_input(INPUT_POST, 'nome', FILTER_UNSAFE_RAW);
	$senha = $_POST['senha'];

	if (!$user || !$senha) {

		header("Location: index.php?erro=nada");
	}else{
		//acessa o dominio institucional
		$ldapserver = "dc01.ifg.edu.br";
		$dominio = "@ifg.br";
		$ldaprdn = "$user".$dominio;
		//$ldap_porta = "389"; caso necessario
		$ldappass   = "$senha";
		$ldapconn = ldap_connect($ldapserver) or die(header("Location: index.php?erro=usererrado"));

		$filter = '(objectClass=*)';

		if ($ldapconn) {
			//busca as informações
			$ldapbind = ldap_bind($ldapconn, $ldaprdn, $ldappass);

			if ($ldapbind) {
				$Result = ldap_search($ldapconn, "OU=IFG,DC=ifg,DC=br", "(sAMAccountName=$user)");
				$data = ldap_get_entries($ldapconn, $Result);
				//verifica o tipo de usuario
				
				$conexao = conectar();
				$atualiza = $conexao->prepare("select id from usuarios where usuarios.matricula = :matricula");
				$atualiza->bindValue(":matricula",$data[0]["cn"][0]);
				$atualiza->execute();
				if ($atualiza->rowCount()>0) {
					$id = $atualiza->fetch(PDO::FETCH_OBJ)->id;
					$receba = atualiza($data, $id);
					
				}else{
					$receba = busca($data);					
				}
				

				if ($receba['tipo'] == "servidor") {
					$_SESSION['servidor'] = $receba['id'];
					header("location:menu_servidor.php");
				}else{
					$_SESSION['user'] = $receba['id'];
					header("location:menu.php");
				}

			} else {
				ldap_close($ldapconn);
				header("Location: index.php?erro=usererrado");
			}
		}else{
			//ldap_close($ldapconn);
		}
	}
	ldap_close($ldapconn);
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
		<section class="vh-100">
			<div class="mask d-flex align-items-center h-100 gradient-custom-3">
				<div class="container h-100">
					<div class="row d-flex justify-content-center align-items-center h-100">
						<div class="col-12 col-md-9 col-lg-7 col-xl-6">
							<div class="card" style="border-radius: 15px;">
								<div class="card-body p-5">
									<div class="form-outline mb-4" align="center">
										<h3 class="text-center">Sistema de Fichas Catalográficas</h3>
										<img alt="carregando" src="./img/novo_logo.png" width="110" height="110">
										
									</div> 
									<div class="row">
										<div class="col-12">
											
											<h3 class="text-center">
												Realizar Login
											</h3>
										</div>
										<div class="row">
											<div class="col-12">
											</div>
											<div class="col-12">
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
												<label><a href="https://suap.ifg.edu.br/comum/solicitar_trocar_senha/">Esqueceu a senha</a></label>
											</div>
										</div> 
									</div>
									<br>

								</div>

							</div>


						</div>
					</div>
				</div>
			</section> 


		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>

</body>
</html>
