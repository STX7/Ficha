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
//verificar se o usuário tem permissão pra acessar a página
if (empty($_SESSION['servidor'])) {
  header("location:index.php");
}
require 'vendor/autoload.php';
require("conexao.php");
$conexao = conectar();
$id = $_SESSION['servidor'];
$id_usuario = $_GET['id'];
$id_ficha = $_GET['idficha'];

  $lista2 = $conexao->prepare("select * from usuarios where :id = usuarios.id");
  $lista2->bindValue(':id', $id_usuario);
  $lista2->execute();
  $itens2 = $lista2->fetch(PDO::FETCH_OBJ);
if (isset($_POST["gerar"])) {

  $lista = $conexao->prepare("select * from ficha where :id2 = ficha.id");
  $lista->bindValue(':id2', $id_ficha);
  $lista->execute();
  $itens = $lista->fetch(PDO::FETCH_OBJ);
  
  try
  {
      
  
      $nome_autor1 = $itens->n_autor1;
      $sobrenome_autor1 = $itens->s_autor1;
      $nome_autor2 =  $itens->n_autor2;
      $sobrenome_autor2 = $itens->s_autor2;
      $nome_autor3 = $itens->n_autor3;
      $sobrenome_autor3 = $itens->s_autor3;
      $titulo = $itens->titulo;
      $subtitulo = $itens->sub_titulo;
      $cutter = $itens->codigo;
      $xyz = $itens->cdd;
      $trabalho = $itens->trabalho;
      $programa = $itens->curso;
      $nome_ori = $itens->n_orientador;
      $sobrenome_ori = $itens->s_orientador;
      $nome_coori1 = $itens->n_coorientador1;
      $sobrenome_coori1 = $itens->s_coorientador1;
      $nome_coori2 = $itens->n_coorientador2;
      $sobrenome_coori2 = $itens->s_coorientador2;
      $orientadora =  !empty($itens->g_orientador) ? "Orientadora" : "Orientador";
      $coorientadora1 = !empty($itens->g_coorientador1) ? "Coorientadora" : "Coorientador";
      $coorientadora1 = !empty($itens->g_coorientador2) ? "Coorientadora" : "Coorientador";
      $ano = $itens->ano;
      $pags = $itens->n_pags;
      $pags_roma = $itens->n_pags_rom;
      $assunto1 = $itens->assunto1;
      $assunto2 = $itens->assunto2;
      $assunto3 = $itens->assunto3;
      $assunto4 = $itens->assunto4;
      $assunto5 = $itens->assunto5;
    
  
  
      if (($itens->d_coorientador1) == "dr") {
          $doutorado1 = "dr";
      } elseif (($itens->d_coorientador1) == "mer") {
          $doutorado1 = "mer";
      } else {
          $doutorado1 = null;
      }
  
      if (($itens->d_coorientador2) == "dr") {
          $doutorado2 = "dr";
      } elseif (($itens->d_coorientador2) == "mer") {
          $doutorado2 = "mer";
      } else {
          $doutorado2 = null;
      }
  
      if (($itens->d_orientador) == "dr") {
        $doutorado = "dr";
    } elseif (($itens->d_orientador) == "mer") {
        $doutorado = "mer";
    } else {
        $doutorado = null;
    }
  
    
      $codigo1 = substr($sobrenome_autor1, 0, 1);
  
      // separa o título por espaços em branco e verifica a primeira palavra
      // se a primeira palavra for uma stopword, o $codigo2 será a primeira letra da segunda palavra do título
  
      $vetitulo = explode(" ", $titulo);
  
      $stopwords = array("o", "a", "os", "as", "um", "uns", "uma", "umas", "de", "do", "da", "dos", "das", "no", "na", "nos", "nas", "ao", "aos", "à", "às", "pelo", "pela", "pelos", "pelas", "duma", "dumas", "dum", "duns", "num", "numa", "nuns", "numas", "com", "por", "em");
  
      if (in_array(strtolower($vetitulo[0]), $stopwords))
          $codigo2 = strtolower(substr($vetitulo[1], 0, 1));
      else
          $codigo2 = strtolower(substr($vetitulo[0], 0, 1));
  
      // monta o Código Cutter
  
      $codigo = $codigo1 . $cutter . $codigo2;
  
      // monta informações da ficha catalográfica
      if (empty($nome_autor3)) // caso tenha 3º autor 
          if (empty($nome_autor2)) // caso tenha 2º autor
              $texto = $sobrenome_autor1 . ", " . $nome_autor1 . "\n   " . $titulo . " / " . $nome_autor1 . " " . $sobrenome_autor1;
          else
              $texto = $sobrenome_autor1 . ", " . $nome_autor1 . "\n   " . $titulo . " / " . $nome_autor1 . " " . $sobrenome_autor1 . ", " . $nome_autor2 . " " . $sobrenome_autor2;
      else
          $texto = $sobrenome_autor1 . ", " . $nome_autor1 . "\n   " . $titulo . " / " . $nome_autor1 . " " . $sobrenome_autor1 . ", " . $nome_autor2 . " " . $sobrenome_autor2 . ", "  . $nome_autor3 . " " . $sobrenome_autor3;
  
  
      if (!empty($pags_roma)) //numeros romanos
          $texto .= (". - Uruaçu, " . $ano . ".\n   $pags p.\n   $pags_roma p.\n\n   ");
      else
          $texto .= (". - Uruaçu, " . $ano . ".\n   $pags p.\n\n   ");
  
  
      if (($doutorado) == "dr") { //caso orientador tenha doutorado
          $texto .= ("  $orientadora: Prof. Dr. " . $nome_ori . " " . $sobrenome_ori . "\n\n");
      } elseif (($doutorado) == "mer") {
          $texto .= ("  $orientadora: Prof. Mer. " . $nome_ori . " " . $sobrenome_ori . "\n\n");
      } else {
          $texto .= ("  $orientadora: Prof. " . $nome_ori . " " . $sobrenome_ori . "\n\n");
      }
  
      if (!empty($nome_coori1)) { //caso tenha coorientador 1
          if (!empty($nome_coori2)) { //caso tenha coorientador 2
  
              if (($doutorado2) == "dr") { // caso coorientador 2 tenha doutorado
                  $texto .= "     $coorientadora2: Prof. Dr. " . $nome_coori2 . " " . $sobrenome_coori2 . "\n\n";
              } elseif (($doutorado2) == "mer") {
                  $texto .= "     $coorientadora2: Prof. Mer. " . $nome_coori2 . " " . $sobrenome_coori2 . "\n\n";
              } else {
                  $texto .= "     $coorientadora2: Prof. " . $nome_coori2 . " " . $sobrenome_coori2 . "\n\n";
              }
          }
          if (!empty($doutorado1)) { //caso coorientador 1 tenha doutorado
              $texto .= "     $coorientadora1: Prof. Dr. " . $nome_coori1 . " " . $sobrenome_coori1 . "\n\n";
          } elseif (($doutorado1) == "mer") {
              $texto .= "     $coorientadora1: Prof. Mer. " . $nome_coori1 . " " . $sobrenome_coori1 . "\n\n";
          } else {
              $texto .= "     $coorientadora1: Prof" . $nome_coori1 . " " . $sobrenome_coori1 . "\n\n";
          }
      }
  
  
  
  
      if ($trabalho == "Tese")
          $texto .= " (Doutorado";
      if ($trabalho == "Dissertação")
          $texto .= " (Mestrado";
      if ($trabalho == "TCC1")
          $texto .= " (Trabalho de Conclusão de curso - graduação";
      if ($trabalho == "TCC2")
          $texto .= " (Trabalho de Conclusão de curso - pós-graduação";
      if ($trabalho == "TCC3")
          $texto .= " (Trabalho de Conclusão de curso";
  
      $texto .= $trabalho;
  
      if ($programa == "Interinstitucional")
          $texto .= (" - Programa Interinstitucional de graduação");
      else
          $texto .= (" - Curso de Graduação ") . $programa;
  
      $texto .= (") - Instituto Federal de Educação Ciência e Tecnologia de Goiás, Câmpus Uruaçu, $ano.\n\n");
  
  
      if (!empty($itens->ilustracao))
          $notas2[] = "Ilustração";
  
      if (!empty($itens->bibliografia))
          $notas2[] = " Bibliografia";
  
      if (!empty($itens->anexo))
          $notas2[] = "Anexo";
  
      if (!empty($itens->apendice))
          $notas2[] = "Apêndice";
  
      if (isset($notas2)) {
          $texto .= "   " . implode(". ", $notas2) . ".\n";
      }
  
  
  
      if (!empty($itens->siglas))
          $notas[] = "siglas";
  
      if (!empty($itens->mapas))
          $notas[] = "mapas";
  
      if (!empty($itens->fotografias))
          $notas[] = "fotografias";
  
      if (!empty($itens->abreviaturas))
          $notas[] = "abreviaturas";
  
      if (!empty($itens->simbolos))
          $notas[] = "simbolos";
  
      if (!empty($itens->graficos))
          $notas[] = "gráficos";
  
      if (!empty($itens->tabelas))
          $notas[] = "tabelas";
  
      if (!empty($itens->algoritmos))
          $notas[] = "algoritmos";
  
      if (!empty($itens->figuras))
          $notas[] = "figuras";
  
      if (!empty($itens->lista_tabelas))
          $notas[] = "lista de tabelas";
  
  
      if (isset($notas)) {
          $texto .= "   Inclui " . implode(", ", $notas) . ".";
      }
  
  
      $texto .= "\n\n";
  
      $texto .= "   1. " . $assunto1 . ". ";
      if (!empty($assunto2))
          $texto .= "2. $assunto2. ";
      if (!empty($assunto3))
          $texto .= "3. $assunto3. ";
      if (!empty($assunto4))
          $texto .= "4. $assunto4. ";
      if (!empty($assunto5))
          $texto .= "5. $assunto5. ";
  
      if (empty($nome_coori2)) { //caso tenha coorientador2
          if (empty($nome_coori1)) {
              $texto .= "I. $sobrenome_ori, $nome_ori, orient. II. Instituto Federal de Educação Ciência e Tecnologia de Goiás, Câmpus Uruaçu, $ano. III.";
          } else {
              $texto .= "I. $sobrenome_ori, $nome_ori, orient. II. $sobrenome_coori1, $nome_coori1, coorient. III. Instituto Federal de Educação Ciência e Tecnologia de Goiás, Câmpus Uruaçu, $ano. IV.";
          }
      } else {
          $texto .= "I. $sobrenome_ori, $nome_ori, orient. II. $sobrenome_coori1, $nome_coori1, coorient. III. $sobrenome_coori2, $nome_coori2, coorient. IV. Instituto Federal de Educação Ciência e Tecnologia de Goiás, Câmpus Uruaçu, $ano. V.";
          $texto .= ("Título. ");
      }
  
  
      $pdf = new Cezpdf();
  
  
      $ficha = array(array('cod' => "\n" . $codigo, 'ficha' => $texto));
  
      // Gera a ficha em pdf
  
      $pdf->selectFont('./pdf-php/src/fonts/Times-roman.afm');
      $pdf->ezText("\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n");
      $pdf->rectangle(116, 90, 375, 250); //(x,y,width,heigth)
      $pdf->ezText(("Ficha de identificação da obra elaborada pelo autor, através do\n Programa de Geração de Ficha Automática do IFG/Câmpus Uruaçu\n\n"), 10, array('justification' => 'center'));
      $pdf->selectFont('pdf-php/src/fonts/Times-Roman.afm');
      $pdf->ezTable($ficha, '', '', array('fontSize' => 9, 'showHeadings' => 0, 'showLines' => 0, 'width' => 340, 'cols' => array('cod' => array('width' => 45))));
      $pdf->ezText("\n CDD $xyz", 9, array('left' => 375));
  
  
      $pdf->ezStream();

}catch(Exception $e){
    echo "erro $e";
}

}
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

    <div class="container">

      <section class="vh-100">
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
          <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
              <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                <div class="card" style="border-radius: 15px;">
                  <div class="card-body p-5">

                    <h2>Informações de contato</h2><br>

                    <div class="form-outline mb-4">
                      <label class="form-label" for="form3Example1cg">Nome</label><br>
                      <label class="text-secondary"><?php echo "$itens2->nome"; ?></label>

                    </div>
                    <div class="form-outline mb-4">
                      <label class="form-label" for="form3Example1cg">Matricula</label><br>
                      <label class="text-secondary"><?php echo "$itens2->matricula"; ?></label>

                    </div>

                    <div class="form-outline mb-4">
                      <label class="form-label" for="form3Example3cg">E-mail</label><br>
                      <label class="text-secondary"><?php echo "$itens2->email"; ?></label>

                    </div><form method="post">
                    <div class="form-outline mb-4">
                      <label class="form-label" for="form3Example3cg">PDF gerado</label><br>
                      <button type="submit" name="gerar" class="btn btn-secondary">visualizar</button>

                    </div></form>
                    <div class="form-outline mb-4">
                      <label class="form-label" for="form3Example3cg">Mais informações</label><br>
                      <?php  
                      if(strlen($itens2->matricula)>14){
                        echo " <label class='text-secondary'><a href='https://suap.ifg.edu.br/edu/aluno/$itens2->matricula/'>Clique aqui...</a></label><br>";
                      }else{
                        echo " <label class='text-secondary'><a href='https://suap.ifg.edu.br/rh/servidor/$itens2->matricula/'>Clique aqui...</a></label><br>";
                      }
                      
                      ?>
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