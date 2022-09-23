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
require("conexao.php");
$conexao = conectar();
$id = $_SESSION['servidor'];
//verificar se o usuário tem permissão pra acessar a página
if (empty($_SESSION['servidor'])) {
  header("location:index.php");
}

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" rel="stylesheet">
</head>

<body style="background-color:#BEC8E3;">



  <div class="container class=" col-12">

    <!-- Menu  --------------------------------- -->

    <nav class="navbar navbar-expand-lg navbar-light bg-light table">
      <a class="navbar-brand" href="menu_servidor.php">Menu</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">

          <li class="nav-item">
            <a class="nav-link" href="Tutorial_fichacat_2011.pdf">Informações</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://suap.ifg.edu.br/">Suap</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="ficha_usuario.php">Gerar ficha</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="historico.php">Histórico</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Sair</a>
          </li>
        </ul>

      </div>
    </nav>


    <div style="background-color:#ffffff">

      <?php

      $lista = $conexao->prepare("select * from ficha");
      $lista->execute();
      $itens = $lista->fetchAll(PDO::FETCH_OBJ);
      echo "<table class='table align-middle  mb-0 bg-white'>
      <thead class='bg-light '>
        <tr>
          <th>Obra</th>
          <th>Curso</th>
          <th>Status</th>
          <th></th>
        </tr>
      </thead>
      <tbody>";
      if (empty($itens)) {
        echo "<tr><th scope='row'></th><th scope='row'>Você não possui fichas cadastradas</th></tr>";
      } else {
        $contador = 0;
        foreach ($itens as $item) {
          $contador = $contador + 1;
          if ($item->curso == "em Bacharelado em Engenharia Cívil") {
            $curso = "ENG";
          }
          if ($item->curso == "em Licenciatura em Química") {
            $curso = "QUI";
          }
          if ($item->curso == "em Ánalise e Desenvolvimento de sistemas") {
            $curso = "ADS";
          }
          if ($item->status == 0) {

            echo "
              <tr>
          <td>
            <div class='d-flex align-items-center'>
            $contador
              <div class='ms-3'>
                <p class='fw-bold mb-1'>$item->n_autor1</p>
                <p class='text-muted mb-0'>$item->titulo</p>
              </div>
            </div>
          </td>
          <td>
            <p class='fw-normal mb-1'>$curso</p>
            
          </td>
          <td>
            <span class='badge text-bg-danger rounded-pill d-inline'>Aguardando</span>
          </td>
          
          <td align='right'>
            <a href='info.php?id=$item->id_usuario&idficha=$item->id'><img width='25' height='25' src='.\\img\\search.svg'></a>
            <a href='alterar_servidor.php?id=$item->id'><img width='25' height='25' src='.\\img\\edit.svg'></a>
            <a href='excluir_servidor.php?id=$item->id'><img width='25' height='25' src='.\\img\\x.svg'></a>
            <a href='mail.php?id=$item->id'><img width='25' height='25' src='.\\img\\send.svg'></a></div>
          </td>
        </tr>";
          }
          if ($item->status == 1) {
            echo "<tr>
          <td>
            <div class='d-flex align-items-center'>
            $contador
              <div class='ms-3'>
                <p class='fw-bold mb-1'>$item->n_autor1</p>
                <p class='text-muted mb-0'>$item->titulo</p>
              </div>
            </div>
          </td>
          <td>
            <p class='fw-normal mb-1'>$curso</p>
            
          </td>
          <td>
            <span class='badge text-bg-success rounded-pill d-inline'
                  >verificado</span
              >
          </td>
          
          <td align='right'>
            <a href='info.php?id=$item->id_usuario&idficha=$item->id'><img width='25' height='25' src='.\\img\\search.svg'></a>
            <a href='alterar_servidor.php?id=$item->id'><img width='25' height='25' src='.\\img\\edit.svg'></a>
            <a href='excluir_servidor.php?id=$item->id'><img width='25' height='25' src='.\\img\\x.svg'></a>
            <a href='mail.php?id=$item->id'><img width='25' height='25' src='.\\img\\send.svg'></a></div>
          </td>
        </tr>";
          }
          if ($item->status == 2) {
            echo "<tr>
          <td>
            <div class='d-flex align-items-center'>
            $contador
              <div class='ms-3'>
                <p class='fw-bold mb-1'>$item->n_autor1</p>
                <p class='text-muted mb-0'>$item->titulo</p>
              </div>
            </div>
          </td>
          <td>
            <p class='fw-normal mb-1'>$curso</p>
            
          </td>
          <td>
            <span class='badge text-bg-warning rounded-pill d-inline'>correção</span>
          </td>
          
          <td align='right'>
            <a href='info.php?id=$item->id_usuario&idficha=$item->id'><img width='25' height='25' src='.\\img\\search.svg'></a>
            <a href='alterar_servidor.php?id=$item->id'><img width='25' height='25' src='.\\img\\edit.svg'></a>
            <a href='excluir_servidor.php?id=$item->id'><img width='25' height='25' src='.\\img\\x.svg'></a>
            <a href='mail.php?id=$item->id'><img width='25' height='25' src='.\\img\\send.svg'></a></div>
          </td>
        </tr>";
          }
        }
      }
      echo "</tbody></table>";
      ?>




    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>

</html>