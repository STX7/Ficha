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
        require("conexao.php");
        if (isset($_GET['erro'])) { 
            if ($_GET['erro'] == "dadoserrado") { 
                echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
          <strong>Dados Incorretos</strong> insira os dados novamente de forma correta!
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
          </button>
        </div>"; 
            }
        }
        if (isset($_POST['cadastrar'])) {
            $senha1 = filter_input(INPUT_POST, 'senha1', FILTER_SANITIZE_SPECIAL_CHARS);
            $senha2 = filter_input(INPUT_POST, 'senha2', FILTER_SANITIZE_SPECIAL_CHARS);
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
            $matricula = filter_input(INPUT_POST, 'matricula', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_SPECIAL_CHARS);
            $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_SPECIAL_CHARS);
            $hashsenha = password_hash($senha1, PASSWORD_DEFAULT);
        if ($senha1 == $senha2) {
          

         $cadastro = $conexao->prepare("insert into `professor` (`nome`, `senha`, `email`, `matricula`, `telefone`) values (:n, :s, :a, :b, :c)");
          $cadastro->bindValue(":n", $nome);
          $cadastro->bindValue(":s", $hashsenha);
          $cadastro->bindValue(":a", $email);
          $cadastro->bindValue(":b", $matricula);
          $cadastro->bindValue(":c", $telefone);
          $cadastro->execute();

          header("location:index.html");
        }else{
            header("Location: cadastro_aluno.php?erro=dadoserrado");
        } 
        }

        ?><!DOCTYPE html>
        <html>
        <head>
           <meta charset="utf-8">
           <meta name="viewport" content="width=device-width, initial-scale=1">
           <title></title>
           <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        </head>
        <body style="background-color:#BEC8E3;">        



        <div class="container">

            <section class="vh-100">
          <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
              <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                  <div class="card" style="border-radius: 15px;">
                    <div class="card-body p-5">
                      <h2 class="text-uppercase text-center mb-5">Criar conta</h2>

                      <form method="POST">

                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example1cg">Nome</label>
                          <input type="text" name="nome" id="form3Example1cg" class="form-control form-control-lg" />
                          
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example1cg">Matricula</label>
                          <input type="text" name="matricula" id="form3Example1cg" class="form-control form-control-lg" />
                          
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example3cg">E-mail</label>
                          <input type="email" name="email" id="form3Example3cg" class="form-control form-control-lg" />
                          
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example3cg">Telefone</label>
                          <input type="text" name="telefone" id="form3Example3cg" class="form-control form-control-lg" />
                          
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example4cg">Senha</label>
                          <input type="password" name="senha1" id="form3Example4cg" class="form-control form-control-lg" />
                          
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example4cdg">Repetir senha</label>
                          <input type="password" name="senha2" id="form3Example4cdg" class="form-control form-control-lg" />
                          
                        </div>


                        <div class="d-flex justify-content-center">
                            
                          <input type="submit"
                            class="btn btn-success btn-block btn-lg gradient-custom-4 text-body" name="cadastrar" value="cadastrar">
                        </div>

                        <p class="text-center text-muted mt-5 mb-0">Já possuid uma conta? <a href="index.html" class="fw-bold text-body"><u>Login</u></a></p>

                      </form>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
            
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

        </body>
        </html>
