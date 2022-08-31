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
	$id = $_SESSION['user'];

?>
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title></title>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body style="background-color:#BEC8E3;">		



<div class="container" class="col-12">

    <!-- Menu  --------------------------------- -->

        <nav class="navbar navbar-expand-lg navbar-light bg-light table" style="width:100%;">
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
                <a class="nav-link" href="#">Alterar dados</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="ficha_servidor.php">Gerar ficha</a>
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

	$lista = $conexao->prepare("select * from ficha where ficha.status = 1 or ficha.status = 0");
	$lista->execute();
	$itens = $lista->fetchAll(PDO::FETCH_OBJ);
    echo "<table class='table  table-sm'>
  <thead >
    <tr>
      <th scope='col'> </th>
      <th scope='col'>Obra</th>
      <th scope='col'>Editar</th>
      <th scope='col'>Excluir</th>
      <th scope='col'>Enviar</th>
      <th scope='col'>Info</th>
    </tr>
  </thead>
  <tbody>";
    if (empty($itens)) {
       echo "<tr><th scope='row'></th><th scope='row'>Você não possui fichas cadastradas</th></tr>";
    }
    else{
        $contador = 0;
    foreach ($itens as $item) {
        $contador = $contador +1;
        if ($item->status == 0) {
          echo "<tr>
      <th scope='row'>$contador</th>
      <td><h6>$item->n_autor1</h6>$item->titulo</td>
      <td>
      <a href='alterar_servidor.php?id=$item->id'><img alt='Editar'  src='.\\img\\edit.svg' height='25' width='25'></a>
      </td>
      <td>
      <a href='excluir_servidor.php?id=$item->id'><img alt='Excluir'  src='.\\img\\x-lg.svg' height='25' width='25'></a>
      </td>
      <td>
      <a href='mail.php?id=$item->id'><img alt='enviar'  src='.\\img\\send.svg' height='25' width='25'></a>
      </td>
      <td>
      <a href='info.php?id=$item->id_usuario'><img alt='enviar'  src='.\\img\\info.svg' height='25' width='25'></a>
      </td>
    </tr>";  
        }
        if ($item->status == 1) {
           echo "<tr class='table-warning'>
      <th scope='row'>$contador</th>
      <td><h6>$item->n_autor1</h6>$item->titulo</td>
      <td>
      <a href='alterar_servidor.php?id=$item->id'><img alt='Editar'  src='.\\img\\edit.svg' height='25' width='25'></a>
      </td>
      <td>
      <a href='excluir_servidor.php?id=$item->id'><img alt='Excluir'  src='.\\img\\x-lg.svg' height='25' width='25'></a>
      </td>
      <td>
      <a href='mail.php?id=$item->id'><img alt='enviar'  src='.\\img\\send.svg' height='25' width='25'></a>
      </td>
      <td>
      <a href='info.php?id=$item->id_usuario'><img alt='enviar'  src='.\\img\\info.svg' height='25' width='25'></a>
      </td>
    </tr>"; 
        }
        if ($item->status == 2) {
           echo "<tr class='table-info'>
      <th scope='row'>$contador</th>
      <td><h6>$item->n_autor1</h6>$item->titulo</td>
      <td>
      <a href='alterar_servidor.php?id=$item->id'><img alt='Editar'  src='.\\img\\edit.svg' height='25' width='25'></a>
      </td>
      <td>
      <a href='excluir_servidor.php?id=$item->id'><img alt='Excluir'  src='.\\img\\x-lg.svg' height='25' width='25'></a>
      </td>
      <td>
      <a href='mail.php?id=$item->id'><img alt='enviar'  src='.\\img\\send.svg' height='25' width='25'></a>
      </td>
      <td>
      <a href='info.php?id=$item->id_usuario'><img alt='enviar'  src='.\\img\\info.svg' height='25' width='25'></a>
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