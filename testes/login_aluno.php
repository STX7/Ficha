		<?php
		/**
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
			require("conexao.php");

	        if (isset($_GET['erro'])) { 
	            if ($_GET['erro'] == "senhaerrado") { 
	                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
	          <strong>Senha Incorreta</strong> insira os dados novamente de forma correta!
	        </div>"; 
	            }
	            if ($_GET['erro'] == "usererrado") { 
	                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
	          <strong>Usuário não encontrado ou incorreto</strong> insira os dados novamente de forma correta!
	        </div>"; 
	            }
	            if ($_GET['erro'] == "nada") { 
	                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
	          <strong>Campos em branco</strong> insira os dados novamente de forma correta!
	        </div>"; 
	            }

	}
	            if (isset($_POST['login'])) {

			$user = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
			$senha = $_POST['senha'];

			if (!$user || !$senha) {

				header("Location: login_aluno.php?erro=nada");
			}else{

				$ldapserver = "dc01.ifg.edu.br";
				$dominio = "@ifg.br";
				$ldaprdn = "20201050100033".$dominio;
				//$ldap_porta = "389"; caso necessario
				$ldappass   = "SSS#20171050080274";
				$ldaptree    = "CN=20201050100033,OU=ALUNOS,OU=CP-URUACU,OU=IFG,DC=ifg,DC=br";
				$ldapconn = ldap_connect($ldapserver) or die("Could not connect to LDAP server.");
				$filter = '(objectClass=*)';

				if ($ldapconn) {
	    			$ldappass = 'SSS#20171050080274';
	    			$ldapbind = ldap_bind($ldapconn, $ldaprdn, $ldappass);
	    
	    			if ($ldapbind) {
	      				$lista = $conexao->prepare("select * from aluno where nome = :user LIMIT 1");
						$lista->bindValue(':user', $user);
						$lista->execute();
						if ($lista) {
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
						}else{
							$Result = ldap_search($ldapconn, "OU=IFG,DC=ifg,DC=br", "(sAMAccountName=3068240)");
        					$data = ldap_get_entries($ldapconn, $Result);
       						$v = implode(",", $data[0]['memberof']);
						}
						

	    			} else {
	        			header("Location: login_aluno.php?erro=usererrado");
	    					}
				}

	var_dump($data);
	ldap_close($ldapconn);

	}
				

				
					
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
