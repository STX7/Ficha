<?php
require("conexao.php");
session_start();
$id_aluno = $_SESSION['user'];
    $id = $_GET['id'];
    $lista2 = $conexao->prepare("delete from ficha where ficha.id = '$id'");
    $lista2->execute();
    $itens = $lista2->fetchAll(PDO::FETCH_OBJ);

    $nome_autor1 = $itens->n_autor1;
    $sobrenome_autor1 = $itens->s_autor1;
    $nome_autor2 =  $itens->n_autor2;
    $sobrenome_autor2 = $itens->s_autor2;
    $nome_autor3 = $itens->n_autor3;
    $sobrenome_autor3 = $itens->s_autor3;
    $titulo = $itens->titulo;
    $subtitulo = $itens->sub_titulo;
    $cutter = $itens->codigo;
    $trabalho = $itens->trabalho;
    $programa = $itens->curso;
    $nome_ori = $itens->n_orientador;
    $sobrenome_ori = $itens->s_orientador;
    $nome_coori1 = $itens->n_coorientado1;
    $sobrenome_coori1 = $itens->s_coorientador1;
    $nome_coori2 = $itens->n_coorientador2;
    $sobrenome_coori2 = $itens->s_coorientador2;
    //$orientadora = $itens->;
    //$coorientadora1 = $itens->
    //$coorientadora1 = $itens->
    $ano = $itens->ano;
    $pags = $itens->n_pags;
    $pags_roma = $itens->n_pags_rom;
    $assunto1 = $itens->assunto1;
    $assunto2 = $itens->assunto2;
    $assunto3 = $itens->assunto3;
    $assunto4 = $itens->assunto4;
    $assunto5 = $itens->assunto5;
    $sigla = $itens->siglas;
    $mapa = $itens->mapas;
    $fotografias = $itens->fotografias;
    $abreviaturas = $itens->abreviaturas;
    $simbolos = $itens->simbolos;
    $graficos = !$itens->graficos;
    $tabelas = $itens->tabelas;
    $algoritmos = $itens->algoritmos;
    $figuras = $itens->lista_figuras;
    $lista_tabela = $itens->lista_tabelas;
    $ilustracao = $itens->ilustracoes;
    $bibliografia = $itens->bibliografia;
    $anexo = $itens->anexos;
    $apendice = $itens->apendice;

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
          <a class="navbar-brand" href="menu.php">Menu</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
              
            <li class="nav-item">
                <a class="nav-link" href="#">Informações</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Alterar dados</a>
            </li>                
            <li class="nav-item">
                <a class="nav-link" href="ficha_usuario.php">Enviar nova ficha</a>
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
                <input type="text" placeholder="Ex: Fulano dos Santos" class="form-control" name="nome_autor1" value=<?php echo="$nome_autor1"; ?> />
            </div>
            <div class="form-group col-md-4">

                <label for="exampleInput">
                    sobrenome*
                </label>
                <input type="text" placeholder="Ex: Silva"class="form-control" name="sobrenome_autor1" value=<?php echo="$sobrenome_autor1"; ?> />
            </div>

        </div>
        <br>
        <label style="font-weight: bold;"> autor 2</label>
        <div class="row border border-dark" style="background-color:#ECF4FE;">
            <div class="form-group col-md-8">

                <label for="exampleInput">
                    nome
                </label>
                <input type="text" placeholder="Ex: Fulano dos Santos" class="form-control" name="nome_autor2" value=<?php echo="$nome_autor2"; ?> />
            </div>
            <div class="form-group col-md-4">

                <label for="exampleInput">
                    sobrenome
                </label>
                <input type="text" placeholder="Ex: Silva" class="form-control" name="sobrenome_autor2" value=<?php echo="$sobrenome_autor2"; ?>/>
            </div>

        </div>
        <br>
        <label style="font-weight: bold;"> autor 3</label>
        <div class="row border border-dark" style="background-color:#ECF4FE;">
            <div class="form-group col-md-8">

                <label for="exampleInput">
                    nome
                </label>
                <input type="text" placeholder="Ex: fulano dos Santos" class="form-control" name="nome_autor3" value=<?php echo="$nome_autor3"; ?>/>
            </div>
            <div class="form-group col-md-4">

                <label for="exampleInput">
                    sobrenome
                </label>
                <input type="text" placeholder="Ex: Silva" class="form-control" name="sobrenome_autor3" value=<?php echo="sobrenome_autor3"; ?>/>
            </div>

        </div>
        <br>
        <div class="row border border-dark border-bottom-0" style="background-color:#ECF4FE;">
            <div class="form-group col-md-4">

                <label for="exampleInput">
                    Titulo do trabalho*
                </label>
                <input type="text" placeholder="Ex: Loucuras discretas" class="form-control" name="titulo" value=<?php echo="$titulo"; ?>/>
            </div>
            <div class="form-group col-md-4">

                <label for="exampleInput">
                    Subtitulo do trabalho
                </label>
                <input type="text" placeholder="Ex: seminário sobre as psicoses ordinárias" class="form-control" name="subtitulo" value=<?php echo="$subtitulo"; ?>/>
            </div>
            <div class="form-group col-md-4">

                <label for="exampleInput">
                    Tipo do trabalho*
                </label>
                <select class="custom-select" name="trabalho" value=<?php echo="$trabalho"; ?>>
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
                <input type="text" placeholder="Ex: 2022" class="form-control" name="ano" value=<?php echo="$ano"; ?>/>
            </div>
            <div class="form-group col-md-4">

                <label for="exampleInput">
                    Código Cutter* <a href="http://www.icmc.usp.br/institucional/estrutura-administrativa/biblioteca/servicos/cutter">ver tabela</a>
                </label>
                <input type="text" placeholder="Ex: 111" class="form-control" name="cutter" value=<?php echo="$cutter"; ?>/>
            </div>
            <div class="form-group col-md-4">

                <label for="exampleInput">
                    Curso*
                </label>
                <select class="custom-select" name="programa" value=<?php echo="$programa"; ?>>
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
                <input type="text" placeholder="Ex: Fulano dos Santos" class="form-control" name="nome_ori" value=<?php echo="$nome_ori"; ?>/>
            </div>
            <div class="form-group col-md-4">

                <label for="exampleInput">
                    sobrenome*
                </label>
                <input type="text" placeholder="Ex: Silva"class="form-control" name="sobrenome_ori" value=<?php echo="$sobrenome_ori"; ?>/>
            </div>
            <div class="form-group col-md-4" align="left" style="left: 20px;">
                <br>
                <input class="form-check-input" type="checkbox" value=<?php echo=""; ?> id="defaultCheck1" name="doutorado">
                <label class="form-check-label" for="defaultCheck1" >Doutor
                </label>
                <br>
                <input class="form-check-input" type="checkbox" value=<?php echo=""; ?> name="orientadora">

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
                <input type="text" placeholder="Ex: Fulano dos Santos" class="form-control" name="nome_coori1" value=<?php echo="$nome_coori1"; ?>/>
            </div>
            <div class="form-group col-md-4">

                <label for="exampleInput">
                    sobrenome
                </label>
                <input type="text" placeholder="Ex: Silva" class="form-control" name="sobrenome_coori1" value=<?php echo="sobrenome_coori1"; ?>/>
            </div>
            <div class="form-group col-md-4"  align="left" style="left: 20px;">
                <br>
                <input class="form-check-input" type="checkbox" vvalue=<?php echo=""; ?> id="defaultCheck1" name="doutorado1">
                <label class="form-check-label" for="defaultCheck1">
                    Doutor
                </label><br>
                <input class="form-check-input" type="checkbox" value=<?php echo=""; ?> id="defaultCheck1" name="coorientadora1">

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
                <input type="text" placeholder="Ex: fulano dos Santos" class="form-control" name="nome_coori2" value=<?php echo="$nome_coori2";?> />
            </div>
            <div class="form-group col-md-4">

                <label for="exampleInput">
                    sobrenome
                </label>
                <input type="text" placeholder="Ex: Silva" class="form-control" name="sobrenome_coori2"  value=<?php echo="$sobrenome_coori2"; ?>/>
            </div>
            <div class="form-group col-md-4" align="left" style="left: 20px;">
                <br>
                <input class="form-check-input" type="checkbox" value=<?php echo="";?> name="doutorado2">
                <label class="form-check-label" for="defaultCheck1">
                    Doutor
                </label><br>
                <input class="form-check-input" type="checkbox" value=<?php echo=""; ?> id="defaultCheck1" name="coorientadora2">

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

              <input class="form-check-input" name="siglas" type="checkbox" value=<?php echo=""; ?> id="defaultCheck1">
              <label class="form-check-label" for="defaultCheck1">Siglas</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" name="mapas" type="checkbox" value=<?php echo="" ;?> id="defaultCheck1">
          <label class="form-check-label" for="defaultCheck1">Mapas</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" name="fotografias" type="checkbox" value=<?php echo="" ;?> id="defaultCheck1">
            <label class="form-check-label" for="defaultCheck1">Fotografias</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" name="abreviaturas" type="checkbox" value=<?php echo=""; ?> id="defaultCheck1">
            <label class="form-check-label" for="defaultCheck1">Abreviaturas</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" name="simbolos" type="checkbox" value=<?php echo=""; ?> id="defaultCheck1">
            <label class="form-check-label" for="defaultCheck1">Símbolos</label>
        </div>

        <div>
            <div>
            <div class="form-check">
            <input class="form-check-input" name="graficos" type="checkbox" value=<?php echo=""; ?> id="defaultCheck1">
            <label class="form-check-label" for="defaultCheck1">Gráfico</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" name="tabelas" type="checkbox" value=<?php echo=""; ?> id="defaultCheck1">
            <label class="form-check-label" for="defaultCheck1">Tabelas</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" name="algoritmos" type="checkbox" value=<?php echo=""; ?> id="defaultCheck1">
            <label class="form-check-label" for="defaultCheck1">Algoritmos</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" name="figuras" type="checkbox" value=<?php echo=""; ?> id="defaultCheck1">
            <label class="form-check-label" for="defaultCheck1">Lista de Figuras</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" name="lista_tabelas" type="checkbox" value=<?php echo=""; ?> id="defaultCheck1">
            <label class="form-check-label" for="defaultCheck1">Lista de Tabelas</label>
        </div>
        </div>
        </div>

    </div>
    <div class="form-group col-md-4" align="left">
        <br>
        <label class="form-check-label" for="exampleRadios1">Ilustrações: </label><br>
        <div class="form-check form-check-inline">
            
            <input class="form-check-input" type="radio" name="ilustracao" value=<?php echo=""; ?>>
            <label class="form-check-label" for="exampleRadios1">Sim</label>
            <input class="form-check-input" type="radio" value=<?php echo=""; ?>>
            <label class="form-check-label" for="exampleRadios1">Não</label>
            
    </div>
    <br><br>
    <label class="form-check-label" for="exampleRadios1">Bibliografia: </label><br>
    <div class="form-check form-check-inline">
            
            <input class="form-check-input" type="radio" name="bibliografia" value="1" <?php echo=""; ?>>
            <label class="form-check-label" for="exampleRadios1">Sim</label>
            <input class="form-check-input" type="radio"  <?php echo=""; ?>>
            <label class="form-check-label" for="exampleRadios1">Não</label>
            
    </div>
        <br><br>
        <label class="form-check-label" for="exampleRadios1">Anexos: </label> <br>  
        <div class="form-check form-check-inline">
            
            <input class="form-check-input" type="radio" name="anexo"  value=<?php echo=""; ?>>
            <label class="form-check-label" for="exampleRadios1">Sim</label>
            <input class="form-check-input" type="radio" value=<?php echo=""; ?>>
            <label class="form-check-label" for="exampleRadios1">Não</label>
            
    </div>
     <br><br>
     <label class="form-check-label" for="exampleRadios1">Apêndice: </label><br>
    <div class="form-check form-check-inline">
            
            <input class="form-check-input" type="radio" name="apendice" value="1" value=<?php echo=""; ?>>
            <label class="form-check-label" for="exampleRadios1">Sim</label>
            <input class="form-check-input" type="radio" value=<?php echo=""; ?>>
            <label class="form-check-label" for="exampleRadios1">Não</label>
            
    </div>

    
     </div>

    <div class="form-group col-md-4">
        <br><br>
    <div class="form-group">
            <label for="formGroupExampleInput2">Nº de folhas em romano</label>
            <input type="text" name="pags_roma" class="form-control" id="formGroupExampleInput2" placeholder="Ex: XVI" value=<?php echo="$n_pags_rom"; ?>>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Nº de folhas em arábico</label>
            <input type="text" name="pags" class="form-control" id="formGroupExampleInput" placeholder="Ex: 123" value=<?php echo="$n_pags"; ?>>
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
                <input type="text" name="assunto1" placeholder="Ex: Programação procedural" class="form-control" id="exampleInputEmail1" value=<?php echo="$assunto1"; ?>/>
            </div>
            <div class="form-group col-md-12">
                <input type="text" name="assunto2" placeholder="Ex: Engenharia de alimentos" class="form-control" id="exampleInputEmail1" value=<?php echo="$assunto2"; ?>/>
            </div>
            <div class="form-group col-md-12">
                <input type="text" name="assunto3" placeholder="Ex: Química industrial" class="form-control" id="exampleInputEmail1" value=<?php echo="$assunto3"; ?>/>
            </div>
            
            <div class="form-group col-md-12">
                <input type="text" name="assunto4" placeholder="Ex: Desenvolvimento regional" class="form-control" id="exampleInputEmail1" value=<?php echo="$assunto4"; ?>/>
            </div>

            <div class="form-group col-md-12">
                <input type="text" name="assunto5" placeholder="Ex: Adaptação social" class="form-control" id="exampleInputEmail1" value=<?php echo="$assunto5"; ?>/>
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

    $id_aluno = $_SESSION['user'];
    $nome_autor1 = ($_POST["nome_autor1"]);
    $sobrenome_autor1 = ($_POST["sobrenome_autor1"]);
    $nome_autor2 = ($_POST["nome_autor2"]);
    $sobrenome_autor2 = ($_POST["sobrenome_autor2"]);
    $nome_autor3 = ($_POST["nome_autor3"]);
    $sobrenome_autor3 = ($_POST["sobrenome_autor3"]);

    $titulo = ($_POST["titulo"]);
    $subtitulo = ($_POST["subtitulo"]);
    $cutter = $_POST["cutter"];

    $trabalho = ($_POST["trabalho"]);  // tese / dissertação
    $programa = ($_POST["programa"]);  // cursos ...
    $nome_ori = ($_POST["nome_ori"]); // nome do orientador
    $sobrenome_ori = ($_POST["sobrenome_ori"]); // sobrenome do orientador

    $nome_coori1 = ($_POST["nome_coori1"]); // nome do coorientador
    $sobrenome_coori1 = ($_POST["sobrenome_coori1"]); // sobrenome do coorientador
    
    $nome_coori2 = ($_POST["nome_coori2"]); // nome do coorientador
    $sobrenome_coori2 = ($_POST["sobrenome_coori2"]); // sobrenome do coorientador

    $orientadora = isset($_POST["orientadora"]) ? "orientadora" : "orientador";
    $coorientadora1 = isset($_POST["coorientadora1"]) ? "coorientadora" : "coorientador";
    $coorientadora1 = isset($_POST["coorientadora2"]) ? "coorientadora" : "coorientador";
    //if (!empty($_POST["orientadora"]))
    //   $orientadora = $_POST["orientadora"]; // se sexo feminino, vale "a"
    
    $ano = $_POST["ano"];
    $pags = $_POST["pags"];
    $pags_roma = $_POST["pags_roma"];
    
    $assunto1 = ($_POST["assunto1"]);
    $assunto2 = ($_POST["assunto2"]);
    $assunto3 = ($_POST["assunto3"]);
    $assunto4 = ($_POST["assunto4"]);
    $assunto5 = ($_POST["assunto5"]);

    // monta informações da ficha catalográfica
    if  (empty($nome_autor3))// caso tenha 3º autor 
        if(empty($nome_autor2))// caso tenha 2º autor
            ;
        else
            ;
    else
        ;

    $sigla = !empty($_POST["siglas"]) ? 1 : 0;

    $mapa = !empty($_POST["mapas"]) ? 1 : 0;

    $fotografias = !empty( $_POST["fotografias"]) ? 1 : 0;

    $abreviaturas = !empty($_POST["abreviaturas"]) ? 1 : 0;

    $simbolos = !empty($_POST["simbolos"]) ? 1 : 0;

    $graficos = !empty($_POST["graficos"]) ? 1 : 0;

    $tabelas = !empty($_POST["tabelas"]) ? 1 : 0;

    $algoritmos = !empty($_POST["algoritmos"]) ? 1 : 0;

    $figuras = !empty($_POST["figuras"]) ? 1 : 0;

    $lista_tabela = !empty($_POST["lista_tabelas"]) ? 1 : 0;

    $ilustracao = !empty($_POST["ilustracao"]) ? 1 : 0;

    $bibliografia = !empty($_POST["bibliografia"]) ? 1 : 0;
        
    $anexo = !empty($_POST["anexo"]) ? 1 : 0;

    $apendice = !empty($_POST["apendice"]) ? 1 : 0;
 
try {
    $lista = $conexao->prepare("insert into ficha (`n_autor1`, `s_autor1`, `n_autor2`, `s_autor2`, `n_autor3`, `s_autor3`, `titulo`, `sub_titulo`, `codigo`, `trabalho`, `curso`, `n_orientador`, `s_orientador`, `n_coorientador1`, `s_coorientador1`, `n_coorientador2`, `s_coorientador2`, `ano`, `n_pags`, `n_pags_rom`, `siglas`, `mapas`, `fotografias`, `abreviaturas`, `simbolos`, `graficos`, `tabelas`, `algoritmos`, `lista_figuras`, `lista_tabelas`, `ilustracoes`, `bibliografia`, `anexos`, `apendice`, `assunto1`, `assunto2`, `assunto3`, `assunto4`, `assunto5`, `id_usuario`, `status`) values(:a, :b, :c, :d, :e, :f, :g, :h, :i, :j, :k, :l, :m, :n, :o, :p, :q, :r, :s, :t, :u, :v, :w, :x, :y, :z, :aa, :ab, :ac, :ad, :ae, :af, :ag, :ah, :ai, :aj, :ak, :al, :am, :an, :ao)");
    $lista->bindValue(':a', $nome_autor1);
    $lista->bindValue(':b', $sobrenome_autor1);
    $lista->bindValue(':c', $nome_autor2);
    $lista->bindValue(':d', $sobrenome_autor2);
    $lista->bindValue(':e', $nome_autor3);
    $lista->bindValue(':f', $sobrenome_autor3);
    $lista->bindValue(':g', $titulo);
    $lista->bindValue(':h', $subtitulo);
    $lista->bindValue(':i', $cutter);
    $lista->bindValue(':j', $trabalho);
    $lista->bindValue(':k', $programa);
    $lista->bindValue(':l', $nome_ori);
    $lista->bindValue(':m', $sobrenome_ori);
    $lista->bindValue(':n', $nome_coori1);
    $lista->bindValue(':o', $sobrenome_coori1);
    $lista->bindValue(':p', $nome_coori2);
    $lista->bindValue(':q', $sobrenome_coori2);
    $lista->bindValue(':r', $ano);
    $lista->bindValue(':s', $pags);
    $lista->bindValue(':t', $pags_roma);
    $lista->bindValue(':u', $sigla);
    $lista->bindValue(':v', $mapa);
    $lista->bindValue(':w', $fotografias);
    $lista->bindValue(':x', $abreviaturas);
    $lista->bindValue(':y', $simbolos);
    $lista->bindValue(':z', $graficos);
    $lista->bindValue(':aa', $tabelas);
    $lista->bindValue(':ab', $algoritmos);
    $lista->bindValue(':ac', $figuras);
    $lista->bindValue(':ad', $lista_tabela);
    $lista->bindValue(':ae', $ilustracao);
    $lista->bindValue(':af', $bibliografia);
    $lista->bindValue(':ag', $anexo);
    $lista->bindValue(':ah', $apendice);
    $lista->bindValue(':ai', $assunto1);
    $lista->bindValue(':aj', $assunto2);
    $lista->bindValue(':ak', $assunto3);
    $lista->bindValue(':al', $assunto4);
    $lista->bindValue(':am', $assunto5);
    $lista->bindValue(':an', $id_aluno);
    $status = 0;
    $lista->bindValue(':ao', $status);

    $lista->execute();
    
    header("location:menu.php");

} catch (Exception $e) {
    echo "Erro no sistema, falha $e->getMessage()";
}


}

/**
$cursos = [
0 => ['nome'=> "ADS", "cdd" => 004],
1 => ['nome'=> "Quimica", "cdd" => 005]
];

**/