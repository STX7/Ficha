<?php
require("conexao.php");
session_start();
/**
/**
 * 
 * Copyright © 2017 Seção Técnica de Informática - STI / ICMC <sti@icmc.usp.br>
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
 * Você deve ter recebido uma cópia da Licença Pública Geral GNU junto
 * com este programa. Se não, veja <http://www.gnu.org/licenses/>.
 * 
 */

/** 
 * <p> 
 * Ficha Catalográfica para Teses e Dissertações - ICMC
 * </p> 
 * 
 * Universidade de São Paulo
 * Instituto de Ciências Matemáticas e de Computação (ICMC).
 * 
 * Contato: 
 * - Seção Técnica de Informática - sti@icmc.usp.br 
 * - Biblioteca Prof. Achille Bassi - biblio@icmc.usp.br
 * 
 * Este aplicativo utiliza o pacote PHP Pdf, que pode ser baixado a partir de 
 * http://sourceforge.net/projects/pdf-php/
 * 
 * Este aplicativo utiliza a biblioteca de estilos do bootstrap v3 que pode ser obtido em
 * http://getbootstrap.com/
 * 
 * Os arquivos associados ao quadro de ajuda estão disponíveis em
 * http://www.icmc.usp.br/institucional/estrutura-administrativa/biblioteca/servicos/ficha
 *  
 * @author Maria Alice Soares de Castro - STI-ICMC
 * @copyright Seção Técnica de Informática - STI/ICMC
 * 
 */

##########################################################################################
// Verifica se foi entrado um nome no formulário
// Se não houver valor para nome, apresenta o formulário para ser preenchido
if (!isset($_POST["Enviar"])) { 

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

    <!-- Menu  --------------------------------- -->

    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
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
</nav></div>

<!-- Formulário  --------------------------------- -->
    <br>
    <form role="form" method="post">
        <label style="font-weight: bold;"> autor 1</label>
        <div class="row border border-dark" style="background-color:#ECF4FE;">
            <div class="form-group col-md-8">

                <label for="exampleInput">
                    nome*
                </label>
                <input type="text" placeholder="Ex: Fulano dos Santos" class="form-control" name="nome_autor1"/>
            </div>
            <div class="form-group col-md-4">

                <label for="exampleInput">
                    sobrenome*
                </label>
                <input type="text" placeholder="Ex: Silva"class="form-control" name="sobrenome_autor1" />
            </div>

        </div>
        <br>
        <label style="font-weight: bold;"> autor 2</label>
        <div class="row border border-dark" style="background-color:#ECF4FE;">
            <div class="form-group col-md-8">

                <label for="exampleInput">
                    nome
                </label>
                <input type="text" placeholder="Ex: Fulano dos Santos" class="form-control" name="nome_autor2" />
            </div>
            <div class="form-group col-md-4">

                <label for="exampleInput">
                    sobrenome
                </label>
                <input type="text" placeholder="Ex: Silva" class="form-control" name="sobrenome_autor2" />
            </div>

        </div>
        <br>
        <label style="font-weight: bold;"> autor 3</label>
        <div class="row border border-dark" style="background-color:#ECF4FE;">
            <div class="form-group col-md-8">

                <label for="exampleInput">
                    nome
                </label>
                <input type="text" placeholder="Ex: fulano dos Santos" class="form-control" name="nome_autor3" />
            </div>
            <div class="form-group col-md-4">

                <label for="exampleInput">
                    sobrenome
                </label>
                <input type="text" placeholder="Ex: Silva" class="form-control" name="sobrenome_autor3" />
            </div>

        </div>
        <br>
        <div class="row border border-dark border-bottom-0" style="background-color:#ECF4FE;">
            <div class="form-group col-md-4">

                <label for="exampleInput">
                    Titulo do trabalho*
                </label>
                <input type="text" placeholder="Ex: Loucuras discretas" class="form-control" name="titulo" />
            </div>
            <div class="form-group col-md-4">

                <label for="exampleInput">
                    Subtitulo do trabalho
                </label>
                <input type="text" placeholder="Ex: seminário sobre as psicoses ordinárias" class="form-control" name="subtitulo" />
            </div>
            <div class="form-group col-md-4">

                <label for="exampleInput">
                    Tipo do trabalho*
                </label>
                <select class="custom-select" name="trabalho">
                    <option value="Tese">Tese</option>
                    <option value="Dissertação">Dissertação</option>
                    <option value="TCC(Especialização)">TCC(Especialização)</option>
                    <option value="TCC(Graduação)" selected>TCC(Graduação)</option>
                    <option value="TCC(Stricto Sensu)">TCC(Stricto Sensu)</option>
                </select>
            </div>

        </div>
        <div class="row border border-dark border-top-0" style="background-color:#ECF4FE;">
            <div class="form-group col-md-4">

                <label for="exampleInput">
                    Ano*
                </label>
                <input type="text" placeholder="Ex: 2022" class="form-control" name="ano" />
            </div>
            <div class="form-group col-md-4">

                <label for="exampleInput">
                    Código Cutter* <a href="http://www.icmc.usp.br/institucional/estrutura-administrativa/biblioteca/servicos/cutter">ver tabela</a>
                </label>
                <input type="text" placeholder="Ex: 111" class="form-control" name="cutter" />
            </div>
            <div class="form-group col-md-4">

                <label for="exampleInput">
                    Curso*
                </label>
                <select class="custom-select" name="programa">
                    <option selected>Escolha o curso</option>
                    <option value="em Bacharelado em Engenharia Cívil">Engenharia Cívil</option>
                    <option value="em Licenciatura em Química">Licenciatura em Química</option>
                    <option value="em Ánalise e Desenvolvimento de sistemas">Análise e Desenvolvimento de Sistemas</option>
                </select>
            </div>

        </div>
        <br><br>
        <label style="font-weight: bold;"> Orientador</label>
        <div class="row border border-dark" style="background-color:#ECF4FE;">
            <div class="form-group col-md-4">

                <label for="exampleInput">
                    nome*
                </label>
                <input type="text" placeholder="Ex: Fulano dos Santos" class="form-control" name="nome_ori" />
            </div>
            <div class="form-group col-md-4">

                <label for="exampleInput">
                    sobrenome*
                </label>
                <input type="text" placeholder="Ex: Silva"class="form-control" name="sobrenome_ori"/>
            </div>
            <div class="form-group col-md-4" align="left" style="left: 20px;">
                <br>
                <input class="form-check-input" type="checkbox" value="Dr. " id="defaultCheck1" name="doutorado">
                <label class="form-check-label" for="defaultCheck1" >Doutor
                </label>
                <br>
                <input class="form-check-input" type="checkbox" value="" name="orientadora">

                <label class="form-check-label" for="defaultCheck1" >
                    Orientadora
                </label>
            </div>

        </div>
        <br><br>
        <label style="font-weight: bold;"> Coorientador 1</label>
        <div class="row border border-dark" style="background-color:#ECF4FE;">
            <div class="form-group col-md-4">

                <label for="exampleInput">
                    nome
                </label>
                <input type="text" placeholder="Ex: Fulano dos Santos" class="form-control" name="nome_coori1" />
            </div>
            <div class="form-group col-md-4">

                <label for="exampleInput">
                    sobrenome
                </label>
                <input type="text" placeholder="Ex: Silva" class="form-control" name="sobrenome_coori1" />
            </div>
            <div class="form-group col-md-4"  align="left" style="left: 20px;">
                <br>
                <input class="form-check-input" type="checkbox" value="Dr. " id="defaultCheck1" name="doutorado1">
                <label class="form-check-label" for="defaultCheck1">
                    Doutor
                </label><br>
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" name="coorientadora1">

                <label class="form-check-label" for="defaultCheck1">
                    Orientadora
                </label>
            </div>
        </div>
        <br><br>
        <label style="font-weight: bold;"> Coorientador 2</label>
        <div class="row border border-dark" style="background-color:#ECF4FE;">
            <div class="form-group col-md-4">

                <label for="exampleInput">
                    nome
                </label>
                <input type="text" placeholder="Ex: fulano dos Santos" class="form-control" name="nome_coori2"  />
            </div>
            <div class="form-group col-md-4">

                <label for="exampleInput">
                    sobrenome
                </label>
                <input type="text" placeholder="Ex: Silva" class="form-control" name="sobrenome_coori2"  />
            </div>
            <div class="form-group col-md-4" align="left" style="left: 20px;">
                <br>
                <input class="form-check-input" type="checkbox" value="Dr. " name="doutorado2">
                <label class="form-check-label" for="defaultCheck1">
                    Doutor
                </label><br>
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" name="coorientadora2">

                <label class="form-check-label" for="defaultCheck1">
                    Orientadora
                </label>
            </div>
        </div>
        <br> 
<label style="font-weight: bold;">Notas</label>
<br>
<div class="row form-group border border-dark " style="background-color:#ECF4FE;">
    
    <div class="form-group col-md-4">
        <br>
            <div class="form-check">

              <input class="form-check-input" name="siglas" type="checkbox" value="1" id="defaultCheck1">
              <label class="form-check-label" for="defaultCheck1">Siglas</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" name="mapas" type="checkbox" value="1" id="defaultCheck1">
          <label class="form-check-label" for="defaultCheck1">Mapas</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" name="fotografias" type="checkbox" value="1" id="defaultCheck1">
            <label class="form-check-label" for="defaultCheck1">Fotografias</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" name="abreviaturas" type="checkbox" value="1" id="defaultCheck1">
            <label class="form-check-label" for="defaultCheck1">Abreviaturas</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" name="simbolos" type="checkbox" value="1" id="defaultCheck1">
            <label class="form-check-label" for="defaultCheck1">Símbolos</label>
        </div>

        <div>
            <div>
            <div class="form-check">
            <input class="form-check-input" name="graficos" type="checkbox" value="1" id="defaultCheck1">
            <label class="form-check-label" for="defaultCheck1">Gráfico</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" name="tabelas" type="checkbox" value="1" id="defaultCheck1">
            <label class="form-check-label" for="defaultCheck1">Tabelas</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" name="algoritmos" type="checkbox" value="1" id="defaultCheck1">
            <label class="form-check-label" for="defaultCheck1">Algoritmos</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" name="figuras" type="checkbox" value="1" id="defaultCheck1">
            <label class="form-check-label" for="defaultCheck1">Lista de Figuras</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" name="lista_tabelas" type="checkbox" value="1" id="defaultCheck1">
            <label class="form-check-label" for="defaultCheck1">Lista de Tabelas</label>
        </div>
        </div>
        </div>

    </div>
    <div class="form-group col-md-4" align="left">
        <br>
        <label class="form-check-label" for="exampleRadios1">Ilustrações: </label><br>
        <div class="form-check form-check-inline">
            
            <input class="form-check-input" type="radio" name="ilustracao" value="1">
            <label class="form-check-label" for="exampleRadios1">Sim</label>
            <input class="form-check-input" type="radio">
            <label class="form-check-label" for="exampleRadios1">Não</label>
            
    </div>
    <br><br>
    <label class="form-check-label" for="exampleRadios1">Bibliografia: </label><br>
    <div class="form-check form-check-inline">
            
            <input class="form-check-input" type="radio" name="bibliografia" value="1">
            <label class="form-check-label" for="exampleRadios1">Sim</label>
            <input class="form-check-input" type="radio"  >
            <label class="form-check-label" for="exampleRadios1">Não</label>
            
    </div>
        <br><br>
        <label class="form-check-label" for="exampleRadios1">Anexos: </label> <br>  
        <div class="form-check form-check-inline">
            
            <input class="form-check-input" type="radio" name="anexo"  value="1">
            <label class="form-check-label" for="exampleRadios1">Sim</label>
            <input class="form-check-input" type="radio">
            <label class="form-check-label" for="exampleRadios1">Não</label>
            
    </div>
     <br><br>
     <label class="form-check-label" for="exampleRadios1">Apêndice: </label><br>
    <div class="form-check form-check-inline">
            
            <input class="form-check-input" type="radio" name="apendice" value="1" >
            <label class="form-check-label" for="exampleRadios1">Sim</label>
            <input class="form-check-input" type="radio">
            <label class="form-check-label" for="exampleRadios1">Não</label>
            
    </div>

    
     </div>

    <div class="form-group col-md-4">
        <br><br>
    <div class="form-group">
            <label for="formGroupExampleInput2">Nº de folhas em romano</label>
            <input type="text" name="pags_roma" class="form-control" id="formGroupExampleInput2" placeholder="Ex: XVI">
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Nº de folhas em arábico</label>
            <input type="text" name="pags" class="form-control" id="formGroupExampleInput" placeholder="Ex: 123">
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">CDD</label>
            <input type="text" name="CDD"  class="form-control" id="formGroupExampleInput" placeholder="Ex: 123">
        </div>
    </div>
        


</div>
 
   <br>
   <label style="font-weight: bold;"> Assunto/Palavra-chave</label>
        <div class="row border border-dark" style="background-color:#ECF4FE;">
            <div class="form-group col-md-12">
                <label for="exampleInput">
                     (min. 1, max. 5)
                </label>
                <input type="text" name="assunto1" placeholder="Ex: Programação procedural" class="form-control" id="exampleInputEmail1" />
            </div>
            <div class="form-group col-md-12">
                <input type="text" name="assunto2" placeholder="Ex: Engenharia de alimentos" class="form-control" id="exampleInputEmail1" />
            </div>
            <div class="form-group col-md-12">
                <input type="text" name="assunto3" placeholder="Ex: Química industrial" class="form-control" id="exampleInputEmail1" />
            </div>
            
            <div class="form-group col-md-12">
                <input type="text" name="assunto4" placeholder="Ex: Desenvolvimento regional" class="form-control" id="exampleInputEmail1" />
            </div>

            <div class="form-group col-md-12">
                <input type="text" name="assunto5" placeholder="Ex: Adaptação social" class="form-control" id="exampleInputEmail1" />
            </div>

        </div>
        <br>

    <input class="btn btn-success btn-lg" type="submit" name="Enviar" value="Enviar" placeholder="Enviar">
    <input class="btn btn-secondary btn-lg" type="reset" value="Resetar" placeholder="Resetar">   <br><br>  
</form>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>
</html>
<?php
} else {
// há alguma informação no formulário de entrada
// carrega o pacote de geração de PDF

    date_default_timezone_set('America/Sao_Paulo');

    require('pdf-php/src/Cezpdf.php');


    $nome_autor1 = filter_input(INPUT_POST, 'nome_autor1', FILTER_SANITIZE_SPECIAL_CHARS);
    $sobrenome_autor1 = filter_input(INPUT_POST, 'sobrenome_autor1', FILTER_SANITIZE_SPECIAL_CHARS);
    $nome_autor2 = filter_input(INPUT_POST, 'nome_autor2', FILTER_SANITIZE_SPECIAL_CHARS);
    $sobrenome_autor2 = filter_input(INPUT_POST, 'sobrenome_autor2', FILTER_SANITIZE_SPECIAL_CHARS);
    $nome_autor3 = filter_input(INPUT_POST, 'nome_autor3', FILTER_SANITIZE_SPECIAL_CHARS);
    $sobrenome_autor3 = filter_input(INPUT_POST, 'sobrenome_autor3', FILTER_SANITIZE_SPECIAL_CHARS);

    $titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_SPECIAL_CHARS);
    $subtitulo = filter_input(INPUT_POST, 'subtitulo', FILTER_SANITIZE_SPECIAL_CHARS);
    if (!empty($subtitulo)) {
        $titulo .= ": $subtitulo";
    }
    $cutter = filter_input(INPUT_POST, 'cutter', FILTER_SANITIZE_SPECIAL_CHARS);
    


    $trabalho = ($_POST["trabalho"]);  // tese / dissertação
    $programa = ($_POST["programa"]);  // cursos ...
    $nome_ori = filter_input(INPUT_POST, 'nome_ori', FILTER_SANITIZE_SPECIAL_CHARS);
    $sobrenome_ori = filter_input(INPUT_POST, 'sobrenome_ori', FILTER_SANITIZE_SPECIAL_CHARS);

    $orientadora = isset($_POST["orientadora"]) ? "Orientadora" : "Orientador";

    $nome_coori1 = filter_input(INPUT_POST, 'nome_coori1', FILTER_SANITIZE_SPECIAL_CHARS);
    $sobrenome_coori1 = filter_input(INPUT_POST, 'sobrenome_coori1', FILTER_SANITIZE_SPECIAL_CHARS);
    
    if (!empty($doutorado1)) {
        $doutorado1 = ($_POST["doutorado1"]);
    }

    $coorientadora1 = isset($_POST["coorientadora1"]) ? "Coorientadora" : "Coorientador";
    
    $nome_coori2 = filter_input(INPUT_POST, 'nome_coori2', FILTER_SANITIZE_SPECIAL_CHARS);
    $sobrenome_coori2 = filter_input(INPUT_POST, 'sobrenome_coori2', FILTER_SANITIZE_SPECIAL_CHARS);

    if (!empty($doutorado2)) {
        $doutorado2 = ($_POST["doutorado1"]);
    }
    $coorientadora2 = isset($_POST["coorientadora2"]) ? "Coorientadora" : "Coorientador";

    $ano = filter_input(INPUT_POST, 'ano', FILTER_SANITIZE_NUMBER_INT);
    $pags = filter_input(INPUT_POST, 'pags', FILTER_SANITIZE_NUMBER_INT);
    $pags_roma = filter_input(INPUT_POST, 'pags_roma', FILTER_SANITIZE_SPECIAL_CHARS);
    
    $assunto1 = filter_input(INPUT_POST, 'assunto1', FILTER_SANITIZE_SPECIAL_CHARS);
    $assunto2 = filter_input(INPUT_POST, 'assunto2', FILTER_SANITIZE_SPECIAL_CHARS);
    $assunto3 = filter_input(INPUT_POST, 'assunto3', FILTER_SANITIZE_SPECIAL_CHARS);
    $assunto4 = filter_input(INPUT_POST, 'assunto4', FILTER_SANITIZE_SPECIAL_CHARS);
    $assunto5 = filter_input(INPUT_POST, 'assunto5', FILTER_SANITIZE_SPECIAL_CHARS);

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
    if  (empty($nome_autor3))// caso tenha 3º autor 
        if(empty($nome_autor2))// caso tenha 2º autor
            $texto = $sobrenome_autor1 . ", " . $nome_autor1 . "\n   " . $titulo . " / " . $nome_autor1 . " " . $sobrenome_autor1;
        else
            $texto = $sobrenome_autor1 . ", " . $nome_autor1 . "\n   " . $titulo . " / " . $nome_autor1 . " " . $sobrenome_autor1 . ", " . $nome_autor2 . " " . $sobrenome_autor2;
    else
    $texto = $sobrenome_autor1 . ", " . $nome_autor1 . "\n   " . $titulo . " / " . $nome_autor1 . " " . $sobrenome_autor1 . ", " . $nome_autor2 . " " . $sobrenome_autor2 . ", "  . $nome_autor3 . " " . $sobrenome_autor3;
    
    
    if (!empty($pags_roma)) //numeros romanos
        $texto .= (". - Uruaçu, " . $ano . ".\n   $pags p.\n   $pags_roma p.\n\n   ");
    else
        $texto .= (". - Uruaçu, " . $ano . ".\n   $pags p.\n\n   ");  
    

    if (empty($_POST["doutorado"]))//caso orientador tenha doutorado
        $texto .= ("  $orientadora: Prof. ". $nome_ori . " " . $sobrenome_ori . "\n" );
    else
        $texto .= ("  $orientadora: Prof. Dr. ". $nome_ori . " " . $sobrenome_ori . "\n" );


    if (!empty($nome_coori1)){ //caso tenha coorientador 1
        if (!empty($nome_coori2)) { //caso tenha coorientador 2

            if (!empty($doutorado2)) { // caso coorientador 2 tenha doutorado
                $texto .= "     $coorientadora2: Prof. Dr. " . $nome_coori2 . " " . $sobrenome_coori2 . "\n\n"; 
            }else{
                $texto .= "     $coorientadora2: Prof. " . $nome_coori2 . " " . $sobrenome_coori2 . "\n\n";
            }
            
            
        }
        if (!empty($doutorado1)) {//caso coorientador 1 tenha doutorado
                $texto .= "     $coorientadora1: Prof. Dr. " . $nome_coori1 . " " . $sobrenome_coori1 . "\n\n"; 
            }else{
                $texto .= "     $coorientadora1: Prof" . $nome_coori1 . " " . $sobrenome_coori1 . "\n\n";
            }

        
        }



    //aplica código CDD
    
    $xyz = filter_input(INPUT_POST, 'CDD', FILTER_SANITIZE_SPECIAL_CHARS);

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

    $texto .= (") - Instituto Federal de Educação Ciência e tecnologia de Goiás, Câmpus Uruaçu, $ano.\n");


    if (!empty($_POST["ilustracao"]))
        $notas2[] = "Ilustração";

    if (!empty($_POST["bibliografia"]))
        $notas2[] = " Bibliografia";

    if (!empty($_POST["anexo"]))
        $notas2[] = "Anexo";

    if (!empty($_POST["apendice"]))
        $notas2[] = "Apêndice";

    if (isset($notas2)) {
      $texto .= "   ". implode(". ", $notas2). ".\n";
    }
   


    if (!empty($_POST["siglas"]))
        $notas[] = "siglas";

    if (!empty($_POST["mapas"]))
        $notas[] = "mapas";

    if (!empty( $_POST["fotografias"]))
        $notas[] = "fotografias";

    if (!empty($_POST["abreviaturas"]))
        $notas[] = "abreviaturas";

    if (!empty($_POST["simbolos"]))
        $notas[] = "simbolos";

    if (!empty($_POST["graficos"]))
        $notas[] = "gráficos";

    if (!empty($_POST["tabelas"]))
        $notas[] = "tabelas";

    if (!empty($_POST["algoritmos"]))
        $notas[] = "algoritmos";

    if (!empty($_POST["figuras"]))
        $notas[] = "figuras";

    if (!empty($_POST["lista_tabelas"]))
        $notas[] = "lista de tabelas";


    if (isset($notas)) {
      $texto .= "   Inclui ". implode(", ", $notas). ".";
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

    if  (empty($nome_coori2)){ //caso tenha coorientador2
        if (empty($nome_coori1)){
            $texto .= "I. $sobrenome_ori, $nome_ori, orient. II. Instituto Federal de Educação Ciência e tecnologia de Goiás, Câmpus Uruaçu, $ano. III.";}
        else{
            $texto .= "I. $sobrenome_ori, $nome_ori, orient. II. $sobrenome_coori1, $nome_coori1, coorient. III. Instituto Federal de Educação Ciência e tecnologia de Goiás, Câmpus Uruaçu, $ano. IV.";}
        }
    else{
        $texto .= "I. $sobrenome_ori, $nome_ori, orient. II. $sobrenome_coori1, $nome_coori1, coorient. III. $sobrenome_coori2, $nome_coori2, coorient. IV. Instituto Federal de Educação Ciência e tecnologia de Goiás, Câmpus Uruaçu, $ano. V.";
    $texto .= ("Título. ");}

    
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
    //header("location: menu_servidor.php");
    /*$pdfcode = $pdf->ezOutput();
    $fp = fopen("./fichas/$nome_autor1-ficha.pdf",'wb');
    fwrite($fp,$pdfcode);
    fclose($fp);

    */

    }