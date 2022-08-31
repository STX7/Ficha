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
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
//require('pdf-php/src/Cezpdf.php');

require 'conexao.php';

session_start();
date_default_timezone_set('America/Sao_Paulo');
$id = $_GET['id'];
$mail = new PHPMailer();

$lista = $conexao->prepare("select * from ficha where ficha.id = :id");
$lista->bindValue(':id', $id);
$lista->execute();
$itens = $lista->fetch(PDO::FETCH_OBJ);

$lista2 = $conexao->prepare("select * from aluno where aluno.id = :id");
$lista2->bindValue(':id',$itens->id_usuario);
$lista2->execute();
$usuario = $lista2->fetch(PDO::FETCH_OBJ);

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


    $codigo1 = substr($sobrenome_autor1, 0, 1);

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
    

    /*if (empty($_POST["doutorado"]))//caso orientador tenha doutorado
        $texto .= ("  $orientadora: Prof. ". $nome_ori . " " . $sobrenome_ori . "\n" );
    else
        $texto .= ("  $orientadora: Prof. Dr. ". $nome_ori . " " . $sobrenome_ori . "\n" );*/


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


    
    
    $pdfcode = $pdf->ezOutput();
    $fp = fopen("./fichas/ficha.pdf",'wb');
    fwrite($fp,$pdfcode);
    fclose($fp);



    //$mail-> SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username   = 'sistemadefichas@gmail.com';
    $mail->Password   = 'dedculzohbqxgbni';//senha acesso total a conta google
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    
    $mail->setFrom('sistemadefichas@gmail.com');
    $mail->addAddress("$usuario->email");
    $mail->isHTML(true);  // Seta o formato do e-mail para aceitar conteúdo HTML
    $mail->Subject = "Ficha Catalografica";
    $texto    = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" style="width:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0"> 
 <head> 
  <meta charset="UTF-8"> 
  <meta content="width=device-width, initial-scale=1" name="viewport"> 
  <meta name="x-apple-disable-message-reformatting"> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
  <meta content="telephone=no" name="format-detection"> 
  <title>Novo modelo de e-mail 2022-08-22</title><!--[if (mso 16)]>
    <style type="text/css">
    a {text-decoration: none;}
    </style>
    <![endif]--><!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]--><!--[if gte mso 9]>
<xml>
    <o:OfficeDocumentSettings>
    <o:AllowPNG></o:AllowPNG>
    <o:PixelsPerInch>96</o:PixelsPerInch>
    </o:OfficeDocumentSettings>
</xml>
<![endif]--> 
  <style type="text/css">
#outlook a {
    padding:0;
}
.ExternalClass {
    width:100%;
}
.ExternalClass,
.ExternalClass p,
.ExternalClass span,
.ExternalClass font,
.ExternalClass td,
.ExternalClass div {
    line-height:100%;
}
.es-button {
    mso-style-priority:100!important;
    text-decoration:none!important;
}
a[x-apple-data-detectors] {
    color:inherit!important;
    text-decoration:none!important;
    font-size:inherit!important;
    font-family:inherit!important;
    font-weight:inherit!important;
    line-height:inherit!important;
}
.es-desk-hidden {
    display:none;
    float:left;
    overflow:hidden;
    width:0;
    max-height:0;
    line-height:0;
    mso-hide:all;
}
.es-button-border:hover a.es-button, .es-button-border:hover button.es-button {
    background:#ffffff!important;
    border-color:#ffffff!important;
}
.es-button-border:hover {
    background:#ffffff!important;
    border-style:solid solid solid solid!important;
    border-color:#3d5ca3 #3d5ca3 #3d5ca3 #3d5ca3!important;
}
[data-ogsb] .es-button {
    border-width:0!important;
    padding:15px 20px 15px 20px!important;
}
@media only screen and (max-width:600px) {p, ul li, ol li, a { line-height:150%!important } h1, h2, h3, h1 a, h2 a, h3 a { line-height:120%!important } h1 { font-size:20px!important; text-align:center } h2 { font-size:16px!important; text-align:left } h3 { font-size:20px!important; text-align:center } .es-header-body h1 a, .es-content-body h1 a, .es-footer-body h1 a { font-size:20px!important } h2 a { text-align:left } .es-header-body h2 a, .es-content-body h2 a, .es-footer-body h2 a { font-size:16px!important } .es-header-body h3 a, .es-content-body h3 a, .es-footer-body h3 a { font-size:20px!important } .es-menu td a { font-size:14px!important } .es-header-body p, .es-header-body ul li, .es-header-body ol li, .es-header-body a { font-size:10px!important } .es-content-body p, .es-content-body ul li, .es-content-body ol li, .es-content-body a { font-size:16px!important } .es-footer-body p, .es-footer-body ul li, .es-footer-body ol li, .es-footer-body a { font-size:12px!important } .es-infoblock p, .es-infoblock ul li, .es-infoblock ol li, .es-infoblock a { font-size:12px!important } *[class="gmail-fix"] { display:none!important } .es-m-txt-c, .es-m-txt-c h1, .es-m-txt-c h2, .es-m-txt-c h3 { text-align:center!important } .es-m-txt-r, .es-m-txt-r h1, .es-m-txt-r h2, .es-m-txt-r h3 { text-align:right!important } .es-m-txt-l, .es-m-txt-l h1, .es-m-txt-l h2, .es-m-txt-l h3 { text-align:left!important } .es-m-txt-r img, .es-m-txt-c img, .es-m-txt-l img { display:inline!important } .es-button-border { display:block!important } a.es-button, button.es-button { font-size:14px!important; display:block!important; border-left-width:0px!important; border-right-width:0px!important } .es-btn-fw { border-width:10px 0px!important; text-align:center!important } .es-adaptive table, .es-btn-fw, .es-btn-fw-brdr, .es-left, .es-right { width:100%!important } .es-content table, .es-header table, .es-footer table, .es-content, .es-footer, .es-header { width:100%!important; max-width:600px!important } .es-adapt-td { display:block!important; width:100%!important } .adapt-img { width:100%!important; height:auto!important } .es-m-p0 { padding:0px!important } .es-m-p0r { padding-right:0px!important } .es-m-p0l { padding-left:0px!important } .es-m-p0t { padding-top:0px!important } .es-m-p0b { padding-bottom:0!important } .es-m-p20b { padding-bottom:20px!important } .es-mobile-hidden, .es-hidden { display:none!important } tr.es-desk-hidden, td.es-desk-hidden, table.es-desk-hidden { width:auto!important; overflow:visible!important; float:none!important; max-height:inherit!important; line-height:inherit!important } tr.es-desk-hidden { display:table-row!important } table.es-desk-hidden { display:table!important } td.es-desk-menu-hidden { display:table-cell!important } .es-menu td { width:1%!important } table.es-table-not-adapt, .esd-block-html table { width:auto!important } table.es-social { display:inline-block!important } table.es-social td { display:inline-block!important } .es-desk-hidden { display:table-row!important; width:auto!important; overflow:visible!important; max-height:inherit!important } }
</style> 
 </head> 
 <body style="width:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;font-family:helvetica, "helvetica neue", arial, verdana, sans-serif;padding:0;Margin:0"> 
  <div class="es-wrapper-color" style="background-color:#FAFAFA"><!--[if gte mso 9]>
            <v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
                <v:fill type="tile" color="#fafafa"></v:fill>
            </v:background>
        <![endif]--> 
   <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top"> 
     <tr style="border-collapse:collapse"> 
      <td valign="top" style="padding:0;Margin:0"> 
       <table cellpadding="0" cellspacing="0" class="es-content" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%"> 
         <tr style="border-collapse:collapse"> 
          <td class="es-adaptive" align="center" style="padding:0;Margin:0"> 
           <table class="es-content-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center"> 
             <tr style="border-collapse:collapse"> 
              <td align="left" style="padding:10px;Margin:0"> 
               <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                 <tr style="border-collapse:collapse"> 
                  <td valign="top" align="center" style="padding:0;Margin:0;width:580px"> 
                   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                     <tr style="border-collapse:collapse"> 
                      <td align="center" style="padding:0;Margin:0;display:none"></td> 
                     </tr> 
                   </table></td> 
                 </tr> 
               </table></td> 
             </tr> 
           </table></td> 
         </tr> 
       </table> 
       <table cellpadding="0" cellspacing="0" class="es-header" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top"> 
         <tr style="border-collapse:collapse"> 
          <td class="es-adaptive" align="center" style="padding:0;Margin:0"> 
           <table class="es-header-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#3d5ca3;width:600px" cellspacing="0" cellpadding="0" bgcolor="#3d5ca3" align="center"> 
             <tr style="border-collapse:collapse"> 
              <td style="Margin:0;padding-top:20px;padding-bottom:20px;padding-left:20px;padding-right:20px;background-color:#bec8e3" bgcolor="#BEC8E3" align="left"><!--[if mso]><table style="width:560px" cellpadding="0" 
                        cellspacing="0"><tr><td style="width:270px" valign="top"><![endif]--> 
               <table class="es-left" cellspacing="0" cellpadding="0" align="left" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:left"> 
                 <tr style="border-collapse:collapse"> 
                  <td class="es-m-p20b" align="left" style="padding:0;Margin:0;width:270px"> 
                   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                     <tr style="border-collapse:collapse"> 
                      <td align="center" style="padding:0;Margin:0;display:none"></td> 
                     </tr> 
                   </table></td> 
                 </tr> 
               </table><!--[if mso]></td><td style="width:20px"></td><td style="width:270px" valign="top"><![endif]--> 
               <table class="es-right" cellspacing="0" cellpadding="0" align="right" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;float:right"> 
                 <tr style="border-collapse:collapse"> 
                  <td align="left" style="padding:0;Margin:0;width:270px"> 
                   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                     <tr style="border-collapse:collapse"> 
                      <td align="center" style="padding:0;Margin:0;display:none"></td> 
                     </tr> 
                   </table></td> 
                 </tr> 
               </table><!--[if mso]></td></tr></table><![endif]--></td> 
             </tr> 
           </table></td> 
         </tr> 
       </table> 
       <table class="es-content" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%"> 
         <tr style="border-collapse:collapse"> 
          <td style="padding:0;Margin:0;background-color:#fafafa" bgcolor="#fafafa" align="center"> 
           <table class="es-content-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#ffffff;width:600px" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center"> 
             <tr style="border-collapse:collapse"> 
              <td style="padding:0;Margin:0;padding-left:20px;padding-right:20px;padding-top:40px;background-color:transparent;background-position:left top" bgcolor="transparent" align="left"> 
               <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                 <tr style="border-collapse:collapse"> 
                  <td valign="top" align="center" style="padding:0;Margin:0;width:560px"> 
                   <table style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-position:left top" width="100%" cellspacing="0" cellpadding="0" role="presentation"> 
                     <tr style="border-collapse:collapse"> 
                      <td align="center" style="padding:0;Margin:0;padding-left:40px;padding-right:40px"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica, "helvetica neue", arial, verdana, sans-serif;line-height:24px;color:#666666;font-size:16px">Ficha Catalográfica&nbsp;<br><br></p></td> 
                     </tr> 
                     <tr style="border-collapse:collapse"> 
                      <td align="center" style="padding:0;Margin:0;padding-right:35px;padding-left:40px"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica, "helvetica neue", arial, verdana, sans-serif;line-height:24px;color:#666666;font-size:16px">Prezado usuário(a),</p></td> 
                     </tr> 
                     <tr style="border-collapse:collapse"> 
                      <td style="padding:0;Margin:0;padding-top:25px;padding-left:40px;padding-right:40px"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica, "helvetica neue", arial, verdana, sans-serif;line-height:19px;color:#666666;font-size:16px;text-align:justify">Segue anexo conforme solicitado a ficha catalográfica que deverá ser incluída no seu trabalho após a folha de rosto. (Favor manter em pdf. para não haver alterações na formatação da mesma).</p></td> 
                     </tr> 
                   </table></td> 
                 </tr> 
               </table></td> 
             </tr> 
             <tr style="border-collapse:collapse"> 
              <td style="Margin:0;padding-top:5px;padding-bottom:20px;padding-left:20px;padding-right:20px;background-position:left top" align="left"> 
               <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                 <tr style="border-collapse:collapse"> 
                  <td valign="top" align="center" style="padding:0;Margin:0;width:560px"> 
                   <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                     <tr style="border-collapse:collapse"> 
                      <td align="center" style="padding:0;Margin:0"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica, "helvetica neue", arial, verdana, sans-serif;line-height:21px;color:#666666;font-size:14px"><br><b><i>Coordenação de Biblioteca -&nbsp;</i></b>Biblioteca Marisa dos Santos Pereira Araújo<br>Instituto Federal de Educação, Ciência e Tecnologia de Goiás - Campus Uruaçu<br>Qualquer dúvida estamos à disposição.<br><br>Telefone: 62 3357-8166<br>e-mail: sistemadefichas@gmail.com<br>e-mail:&nbsp;bib.uruacu@ifg.edu.br</p></td> 
                     </tr> 
                   </table></td> 
                 </tr> 
               </table></td> 
             </tr> 
           </table></td> 
         </tr> 
       </table> 
       <table class="es-footer" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top"> 
         <tr style="border-collapse:collapse"> 
          <td style="padding:0;Margin:0;background-color:#fafafa" bgcolor="#fafafa" align="center"> 
           <table class="es-footer-body" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px"> 
             <tr style="border-collapse:collapse"> 
              <td style="Margin:0;padding-top:10px;padding-left:20px;padding-right:20px;padding-bottom:30px;background-color:#bec8e3" bgcolor="#BEC8E3" align="left"> 
               <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                 <tr style="border-collapse:collapse"> 
                  <td valign="top" align="center" style="padding:0;Margin:0;width:560px"> 
                   <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                     <tr style="border-collapse:collapse"> 
                      <td align="left" style="padding:0;Margin:0;padding-top:5px;padding-bottom:5px"><h2 style="Margin:0;line-height:17px;mso-line-height-rule:exactly;font-family:arial, "helvetica neue", helvetica, sans-serif;font-size:14px;font-style:normal;font-weight:normal;color:#333333"><br></h2></td> 
                     </tr> 
                     <tr style="border-collapse:collapse"> 
                      <td align="left" style="padding:0;Margin:0;padding-bottom:5px"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica, "helvetica neue", arial, verdana, sans-serif;line-height:21px;color:#ffffff;font-size:14px"><br></p></td> 
                     </tr> 
                   </table></td> 
                 </tr> 
               </table></td> 
             </tr> 
           </table></td> 
         </tr> 
       </table> 
       <table class="es-footer" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top"> 
         <tr style="border-collapse:collapse"> 
          <td style="padding:0;Margin:0;background-color:#fafafa" bgcolor="#fafafa" align="center"> 
           <table class="es-footer-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px" cellspacing="0" cellpadding="0" bgcolor="transparent" align="center"> 
             <tr style="border-collapse:collapse"> 
              <td align="left" style="Margin:0;padding-bottom:5px;padding-top:15px;padding-left:20px;padding-right:20px"> 
               <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                 <tr style="border-collapse:collapse"> 
                  <td valign="top" align="center" style="padding:0;Margin:0;width:560px"> 
                   <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                     <tr style="border-collapse:collapse"> 
                      <td align="center" style="padding:0;Margin:0"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:helvetica, "helvetica neue", arial, verdana, sans-serif;line-height:18px;color:#666666;font-size:12px">Este e-mail foi gerado automaticamente, por favor não responder este e-mail.<br>agradecemos a coompreensão.</p></td> 
                     </tr> 
                   </table></td> 
                 </tr> 
               </table></td> 
             </tr> 
           </table></td> 
         </tr> 
       </table> 
       <table class="es-content" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%"> 
         <tr style="border-collapse:collapse"> 
          <td align="center" style="padding:0;Margin:0"> 
           <table class="es-content-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:transparent;width:600px" cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center"> 
             <tr style="border-collapse:collapse"> 
              <td align="left" style="Margin:0;padding-left:20px;padding-right:20px;padding-top:30px;padding-bottom:30px"> 
               <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                 <tr style="border-collapse:collapse"> 
                  <td valign="top" align="center" style="padding:0;Margin:0;width:560px"> 
                   <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                     <tr style="border-collapse:collapse"> 
                      <td align="center" style="padding:0;Margin:0;display:none"></td> 
                     </tr> 
                   </table></td> 
                 </tr> 
               </table></td> 
             </tr> 
           </table></td> 
         </tr> 
       </table></td> 
     </tr> 
   </table> 
  </div>  
 </body>
</html>';

    $mail->Body = utf8_decode($texto);
    $mail->AltBody = 'Esta mensagem é um envio automatizado, não responda devolta, segue em anexo a ficha catalográfica.';
    $mail->addAttachment('./fichas/ficha.pdf'); 
    // Enviar

    if ($mail->send()) {
        unlink('./fichas/ficha.pdf');  
    }
    header("Location:menu_servidor.php?msg='sucesso'");
    
}
catch (Exception $e)
{
    header("Location:menu_servidor.php?msg='erro'");

}
?>