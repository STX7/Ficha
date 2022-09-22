<?php


$ldapserver = "dc01.ifg.edu.br";
$dominio = "@ifg.br";
$ldaprdn = "20201050100033".$dominio;
//$ldap_porta = "389"; caso necessario
$ldappass   = "SSS#20171050080274";
$ldaptree    = "CN=20201050100033,OU=ALUNOS,OU=CP-URUACU,OU=IFG,DC=ifg,DC=br";
$ldapconn = ldap_connect($ldapserver) or die("Could not connect to LDAP server.");

$filter = '(objectClass=*)';

if ($ldapconn) {
    $ldappass = 'SSS#20171050080274';
    $ldapbind = ldap_bind($ldapconn, $ldaprdn, $ldappass);
    
    if ($ldapbind) {
       $Result = ldap_search($ldapconn, "OU=IFG,DC=ifg,DC=br", "(sAMAccountName=20201050080130)");
       $data = ldap_get_entries($ldapconn, $Result);
       $v = implode(",", $data[0]['memberof']);
       if(strpos($v, "G_URU-BIBLIOTECA")){
         echo "BIBLIOTECA";
       }else{
        echo "USUARIO";
       }
       

    } else {
        echo "LDAP bind failed...";
    }
}

var_dump($data);

ldap_close($ldapconn);    
?>