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
require_once("conexao.php");
$nome = '';
$email = '';
$matricula = '';
$tipo = '';

function busca($data)
{
    if(strpos($data[0]["distinguishedname"][0], "URU-CB")){
        $nome = $data[0]["displayname"][0];
        $email = isset($data[0]["mail"][0])?$data[0]["mail"][0]:$data[0]["extensionattribute4"][0];
        $matricula = $data[0]["cn"][0];
        $tipo = "servidor";
        
    }else{
        $nome = $data[0]["displayname"][0];
        $email = isset($data[0]["mail"][0])?$data[0]["mail"][0]:$data[0]["extensionattribute4"][0];
        $matricula = $data[0]["cn"][0];
        $tipo = "usuario";
        
    }

    try {
      $conexao = conectar();
      $cadastro = $conexao->prepare("insert into usuarios (nome, email, matricula) values (:nome, :a, :b)");

      $cadastro->bindValue(":nome", $nome);
      $cadastro->bindValue(":a", $email);
      $cadastro->bindValue(":b", $matricula);
      $cadastro->execute();

      $id = $conexao->lastInsertId();
       
  } catch (Exception $e) {
    die($e->getMessage());
  }
  return [
    "tipo"=> $tipo,
    "id" => $id
  ]; 
}          
function atualiza($data, $id){
try {
    if(strpos($data[0]["distinguishedname"][0], "URU-CB")){
        $nome = $data[0]["displayname"][0];
        $email = $data[0]["mail"][0];
        $matricula = $data[0]["cn"][0];
        $tipo = "servidor";
        
    }else{
        $nome = $data[0]["displayname"][0];
        $email = isset($data[0]["mail"][0])?$data[0]["mail"][0]:$data[0]["extensionattribute4"][0];
        $matricula = $data[0]["cn"][0];
        $tipo = "usuario";
        
    }

    $conexao = conectar();
    $atualiza = $conexao->prepare("update usuarios set nome=:nome,email=:email where usuarios.matricula = :matricula");
    $atualiza->bindValue(":nome", $nome);
    $atualiza->bindValue(":email", $email);
    $atualiza->bindValue(":matricula", $matricula);
    $atualiza->execute();

    return [
    "tipo"=> $tipo,
    "id" => $id
  ];
} catch (Exception $e) {
  echo " $e";
}

}

?>
