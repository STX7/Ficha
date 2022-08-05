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
if (!isset($_POST["nome_autor1"])) {
    
?><!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Ficha Catalogr&aacute;fica</title>

        <!-- Bootstrap core CSS -->
        <link href="bootstrap.min.css" rel="stylesheet">

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
                <h3>FICHA CATALOGR&Aacute;FICA</h3>

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

                <form name="ficha" method="post">

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
                        <label>Sobrenome do orientador*:</label> <input type="text" name="sobrenome_ori" size="50"> 
                        <input type="checkbox" name="orientadora" value="a"> orientadora<br /><br />

                        <label>Nome do 1º coorientador:</label> <input type="text" name="nome_coori1" size="50"><br />
                        <label>Sobrenome do 1º coorientador:</label> <input type="text" name="sobrenome_coori1" size="50"> 
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
    
    header("listagem.php");

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