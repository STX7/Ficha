<?php
require("conexao.php");
session_start();
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
if (!isset($_POST["nome_autor1"])) {
    
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Ficha Catalográfica</title>

        <!-- Bootstrap core CSS -->
        <link href="bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>

        <style type='text/css'>
            .bloco-conteudo {
                min-height: 510px;
            }
        </style>

        <div class='container'>
            <div class='bloco-conteudo'>
                <h3>FICHA CATALOGRÁFICA</h3>

                <style>
                    a { color:#276DD1; }
                    body { font-size: 12px; }
                    fieldset {
                        border: 1px solid #526F9B;
                        width: 650px;
                    }
                    label {
                        float:left;
                        width:25%;
                        margin-right:0.5em;
                        padding-top:0.2em;
                        text-align:right;
                        font-weight:bold;
                        height: 10px;
                    }
                    legend {
                        color: #fff;
                        background: #84A4D4;
                        border: 1px solid #526F9B;
                        padding: 2px 6px;
                        font-size: 16px;
                    } 
                </style>

                <form name="ficha" method="post" action="ficha.php">

                    <!-- quadro com links para tutorial e ajuda -->	
                    <div style="background-color:white; border: 1px solid #526F9B; font-size:11px; width: 125px; float:right; padding: 3px"><div style="background: #84A4D4; padding:3px; color:white;font-weight:bold;">Ajuda</div>- <a href="Tutorial_fichacat_2011.pdf" target="_blank">Tutorial para preenchimento</a> (pdf)<br />- <a href="FichaCat_diretrizes_2011.pdf" target="_blank">Orienta&ccedil;&otilde;es b&aacute;sicas</a> (pdf)
                       

                    </div>
                    <!-- fim do quadro com links para tutorial e ajuda -->
                    <fieldset>
                        <legend>Dados para ficha catalogr&aacute;fica</legend>

                        <label>Autor 1</label><br>
                        <label>Nome*:</label> 
                        <input type="text" name="nome_autor1" placeholder="Samuel" size="70">
                        <br />

                        <label>Sobrenome*:</label> 
                        <input type="text" name="sobrenome_autor1" size="70">
                        <br />
                        <br>

                        <label>Autor 2</label><br>
                        <label>Nome:</label> 
                        <input type="text" name="nome_autor2" size="70">
                        <br />
                        
                        <label>Sobrenome:</label> 
                        <input type="text" name="sobrenome_autor2" size="70">
                        <br />
                        <br>

                        <label>Autor 3</label><br>
                        <label>Nome:</label> 
                        <input type="text" name="nome_autor3" size="70">
                        <br />

                        <label>Sobrenome:</label> 
                        <input type="text" name="sobrenome_autor3" size="70">
                        <br />
                         <br>   
                        <label>T&iacute;tulo do trabalho*:</label> 
                        <input type="text" name="titulo" size="70">
                        <br />

                        <label>Sub-Titulo do trabalho:</label> 
                        <input type="text" name="subtitulo" size="70">
                        <br />

                        <label>C&oacute;digo Cutter*:</label> 
                        <input type="text" name="cutter" size="6"> <a href="http://www.icmc.usp.br/institucional/estrutura-administrativa/biblioteca/servicos/cutter" target="_blank">Ver tabela</a>
                        <br />
                        <br>

                        <label>Trabalho*:</label>
                        <input type="radio" name="trabalho" value="Tese" checked> Tese <br />
                        <label></label>
                        <input type="radio" name="trabalho" value="Dissertação"> Disserta&ccedil;&atilde;o <br>
                        <label></label>
                        <input type="radio" name="trabalho" value="TCC1"> Trabalho de conclusão de curso - graduação<br>
                        <label></label>
                        <input type="radio" name="trabalho" value="TCC2"> Trabalho de conclusão de curso - pós - graduação <br>
                        <label></label>
                        <input type="radio" name="trabalho" value="TCC3"> Trabalho de conclusão de curso<br>
                        <br />
                        <br />

                        <label>Curso*:</label> 
                        <br>

                        <label></label>
                        <input type="radio" name="programa" value="em Bacharelado em Engenharia Cívil"> Bacharelado em Engenharia Cívil<br />
                        <label></label>

                        <input type="radio" name="programa" value="em Licenciatura em Química"> Licenciatura em Química<br />
                        <label></label>

                        <input type="radio" name="programa" value="em Ánalise e Desenvolvimento de sistemas"> Ánalise e Desenvolvimento de sistemas<br /><br />



                        <label>Nome do orientador*:</label><input type="text" name="nome_ori" size="50"><br />
                        <label>Sobrenome do orientador*:</label> <input type="text" name="sobrenome_ori" size="50"> <input type="checkbox" name="doutorado" value="Dr."> doutor
                        <input type="checkbox" name="orientadora" value="a"> orientadora<br />

                        <label>Nome do 1º coorientador:</label> <input type="text" name="nome_coori1" size="50"><br />
                        <label>Sobrenome do 1º coorientador:</label> <input type="text" name="sobrenome_coori1" size="50"> <input type="checkbox" name="doutorado" value="Dr."> doutor 
                        <input type="checkbox" name="coorientadora1" value="a"> coorientadora<br /><br />

                        <label>Nome do 2º coorientador:</label> <input type="text" name="nome_coori2" size="50"><br />
                        <label>Sobrenome do 2º coorientador:</label> <input type="text" name="sobrenome_coori2" size="50"> 
                        <input type="checkbox" name="coorientadora2" value="a"> coorientadora<br /><br />

                        <label>Ano*:</label>  <input type="text" name="ano" size="6"><br />
                        <label>n<sup>o</sup> de p&aacute;ginas em romanos:</label>  <input type="text" name="pags_roma" size="6"><br />
                        <label>n<sup>o</sup> de p&aacute;ginas em arábico*:</label>  <input type="text" name="pags" size="6"><br /><br />


                        <label>Notas:</label><br>
                        <label></label>
                        <input type="checkbox" name="siglas" value="1"> Siglas<br />
                        <label></label>
                        <input type="checkbox" name="mapas" value="1"> Mapas<br />
                        <label></label>
                        <input type="checkbox" name="fotografias" value="1"> Fotografias<br />
                        <label></label>
                        <input type="checkbox" name="abreviaturas" value="1"> Abreviaturas<br />
                        <label></label>
                        <input type="checkbox" name="simbolos" value="1"> Simbolos<br />
                        <label></label>
                        <input type="checkbox" name="graficos" value="1"> Gráficos<br />
                        <label></label>
                        <input type="checkbox" name="tabelas" value="1"> Tabelas<br />
                        <label></label>
                        <input type="checkbox" name="algoritmos" value="1"> Algoritmos<br />
                        <label></label>
                        <input type="checkbox" name="figuras" value="1"> Lista de Figuras<br />
                        <label></label>
                        <input type="checkbox" name="lista_tabelas" value="1"> Lista de Tabelas<br />
                        
                        <br />
                        <br />

                        <label>Ilustrações:</label>
                        <input type="radio" name="ilustracao" value="1"> Sim <input type="radio" name="notas" value="0"> Não<br />

                        <label>Bibliografia:</label>
                        <input type="radio" name="bibliografia" value="1"> Sim <input type="radio" name="notas" value="0"> Não<br />

                        <label>Anexos:</label>
                        <input type="radio" name="anexo" value="1"> Sim <input type="radio" name="notas" value="0"> Não<br />

                        <label>Apêndice:</label>
                        <input type="radio" name="apendice" value="1"> Sim <input type="radio" name="notas" value="0"> Não<br /><br>

                        <label>Assunto/Palavras-chave* (min. 1, max. 5): </label><br />
                        <label>&nbsp;</label> 1. <input type="text" name="assunto1" size="50"> <div style="background-color:#f0f0f0; text-align:center; font-size:11px; width: 100px; float:right; padding: 3px"><a href="http://143.107.154.62/Vocab/" target="_blank">Consulta opcional ao Vocabul&aacute;rio Controlado da USP</a></div><br />
                        <label>&nbsp;</label> 2. <input type="text" name="assunto2" size="50"> <br />
                        <label>&nbsp;</label> 3. <input type="text" name="assunto3" size="50"> <br />
                        <label>&nbsp;</label> 4. <input type="text" name="assunto4" size="50"> <br />
                        <label>&nbsp;</label> 5. <input type="text" name="assunto5" size="50"> <br /><br />
                        <label></label>

                        <input type="submit" name="Enviar" value="Enviar" class="btn btn-sm btn-primary" />
                        <input type="reset" name="Limpar" value="Limpar" class="btn btn-sm btn-default" />
                        <br /><br />
                    </fieldset>
                </form>
            </div>
        </div>
        
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
    $subtitulo = ($_POST["subtitulo"]);
    if (!empty($subtitulo)) {
        $titulo .= ": $subtitulo";
    }
    $cutter = filter_input(INPUT_POST, 'cutter', FILTER_SANITIZE_SPECIAL_CHARS);
    


    $trabalho = ($_POST["trabalho"]);  // tese / dissertação
    $programa = ($_POST["programa"]);  // cursos ...
    $nome_ori = ($_POST["nome_ori"]); // nome do orientador
    $sobrenome_ori = ($_POST["sobrenome_ori"]); // sobrenome do orientador

    $orientadora = isset($_POST["orientadora"]) ? "orientadora" : "orientador";
    
    //if (!empty($_POST["orientadora"]))
    //   $orientadora = $_POST["orientadora"]; // se sexo feminino, vale "a"

    $nome_coori1 = filter_input(INPUT_POST, 'nome_coori1', FILTER_SANITIZE_SPECIAL_CHARS);
    $sobrenome_coori1 = filter_input(INPUT_POST, 'sobrenome_coori1', FILTER_SANITIZE_SPECIAL_CHARS);
    if (!empty($_POST["coorientadora1"]))
        $coorientadora1 = $_POST["coorientadora1"]; // se sexo feminino, vale "a"
    else
        $coorientadora1 = " ";
    
    $nome_coori2 = filter_input(INPUT_POST, 'nome_coori2', FILTER_SANITIZE_SPECIAL_CHARS);
    $sobrenome_coori2 = filter_input(INPUT_POST, 'sobrenome_coori2', FILTER_SANITIZE_SPECIAL_CHARS);
    if (!empty($_POST["coorientadora2"]))
        $coorientadora2 = $_POST["coorientadora2"]; // se sexo feminino, vale "a"	
    else
        $coorientadora2 = " ";
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
            $texto = $sobrenome_autor1 . ", " . $nome_autor1 . "\n   " . $titulo . " / " . $nome_autor1 . " " . $sobrenome_autor1 . "; $orientadora " . $nome_ori . " " . $sobrenome_ori;
        else
            $texto = $sobrenome_autor1 . ", " . $nome_autor1 . "\n   " . $titulo . " / " . $nome_autor1 . " " . $sobrenome_autor1 . ", " . $nome_autor2 . " " . $sobrenome_autor2 . "; $orientadora " . $nome_ori . " " . $sobrenome_ori;
    else
    $texto = $sobrenome_autor1 . ", " . $nome_autor1 . "\n   " . $titulo . " / " . $nome_autor1 . " " . $sobrenome_autor1 . ", " . $nome_autor2 . " " . $sobrenome_autor2 . ", "  . $nome_autor3 . " " . $sobrenome_autor3 .  "; $orientadora " . $nome_ori . " " . $sobrenome_ori;
    if (!empty($nome_coori2)) //caso tenha coorientador
        if (!empty($nome_coori)) {
            $texto .= "; coorientador$coorientadora1 " . $nome_coori1 . " " . $sobrenome_coori2;
        }
        $texto .= "; coorientador$coorientadora1 " . $nome_coori1 . " " . $sobrenome_coori2;
/* perguntar para a bibliotecária a ordem dos coorientadores e arrumar o if de gênero do coorientador*/
    
    if (!empty($pags_roma)) //numeros romanos
        $texto .= (". -- Uruaçu, " . $ano . ".\n   $pags p.\n   $pags_roma p.\n\n   ");
    else
        $texto .= (". -- Uruaçu, " . $ano . ".\n   $pags p.\n\n   ");  
    

    if (!empty($_POST["doutorado"]))
        $texto .= ("    Orientador: Prof. ". $nome_ori . " " . $sobrenome_ori . "\n" );
    else
        $texto .= ("    Orientador: Prof. Dr. ". $nome_ori . " " . $sobrenome_ori . "\n" );



    //aplica código CDD
    if($programa == "em Licenciatura em Química")
        $xyz = "CDD 540";
    if ($programa == "em Bacharelado em Engenharia Cívil")
        $xyz = "CDD 624";
    if ($programa == "em Ánalise e Desenvolvimento de sistemas")
        $xyz = "CDD 004";
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

    $texto .= (") -- Instituto Federal de Educação Ciência e tecnologia de Goiás, Câmpus Uruaçu, $ano.\n");


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

    if  (empty($nome_coori2)){
        if (empty($nome_coori1)){
            $texto .= "I. $sobrenome_ori, $nome_ori, orient. II. ";}
        else{
            $texto .= "I. $sobrenome_ori, $nome_ori, orient. II. $sobrenome_coori1, $nome_coori1, coorient. III. ";}
        }
    else{
        $texto .= "I. $sobrenome_ori, $nome_ori, orient. II. $sobrenome_coori1, $nome_coori1, coorient. III. $sobrenome_coori2, $nome_coori2, coorient. IV. ";
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
    $pdf->ezText("\n$xyz", 9, array('left' => 375));



    $pdf->ezStream();
    
}