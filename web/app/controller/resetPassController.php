<?php
/*  
+------NÃO ALTERAR OU REMOVER AVISOS DE COPYRIGHT OU ESTE CABEçALHO.----+
+-----------------------------------------------------------------------+
| WebRapidFiles - Catalogo de Arquivos Online				|
| Versão 1.1                                                            |
| Copyright (C) <2012>  Mcezzare - Brasil                               |	
| Blog: http://mcezzare.blogspot.com.br					|
|									|
| Este programa é software livre; você pode redistribuí-lo e/ou		|
| modificá-lo sob os termos da Licença Pública Geral GNU, conforme	|
| publicada pela Free Software Foundation; tanto a versão 2 da		|	
| Licença como (a seu critério) qualquer versão mais nova.		|	
| Este programa é distribuído na expectativa de ser útil, mas SEM	|
| QUALQUER GARANTIA; sem mesmo a garantia implícita de			|
| COMERCIALIZAÇÃO ou de ADEQUAÇÃO A QUALQUER PROPÓSITO EM		|
| PARTICULAR. Consulte a Licença Pública Geral GNU para obter mais	|
| detalhes.								|
|									|
| Você deve ter recebido uma cópia da Licença Pública Geral GNU		|	
| junto com este programa; se não, escreva para a Free Software		|	
| Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA		|
| 02111-1307, USA.							|							|
+-----------------------------------------------------------------------+
| Author : <Mario Cezzare Angelicola Chiodi> <mcezzare@gmail.com>	|
+-----------------------------------------------------------------------+

*/
@session_start();
class ResetPassController{
    
}
require_once($_SERVER['DOCUMENT_ROOT'] . "/lib/config.php");
//debug
require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/Utils.class.php');
$util = new Utils();
$debug = false;
if ($debug) {
    $util->mostraObjeto($_POST);
}
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/model/Usuario.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/controller/UsuarioController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/model/Logger.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/controller/LoggerController.php');

//LOGGER    
$log = new Logger();
$logC = new LoggerController();
$log->setIdUsuario($_SESSION['idusuario']);
$allFine=false;

if (isset($_POST['data']['UsuarioRemember']['update']) && ($_POST['data']['UsuarioRemember']['update'] == true)) {

//    $util->mostraObjeto($_POST);
//    $util->mostraObjeto($_SESSION);

    $userC = new UsuarioController();
    $usuario = new Usuario();
    $usuario->setId($_SESSION['idusuario']);
    $usuario->setSenha($_POST['data']['UsuarioRemember']['senha']);
    $usuario->setLembrete($_POST['data']['UsuarioRemember']['lembrete']);
    $usuario->setTmpLink(null);


    $userC->trocaSenha($usuario);
    $idAcao = 10; //troca senha
    $log->setIdAcao($idAcao);
    $info="usuario:".$usuario->getLogin()." IP:".$_SERVER['REMOTE_ADDR']." browser:".$_SERVER['HTTP_USER_AGENT'];
    $log->setObjectStored($info);
    $logC->loga($log);
    $allFine=true;
    
    
//    $urlFinal = sprintf('Location:%s','/app/controller/LoginController?action=logout');
//
//    header($urlFinal);
}
?>
<? if ($allFine){?>
 <!DOCTYPE html>
<html>
    <head>
        <title><? echo TITULO; ?> Atualização de Senha</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="<? echo BASE_STYLES; ?>custom.css" rel="stylesheet" type="text/css" />
        <script language="javascript" src="<? echo BASE_SCRIPTS; ?>libs/jquery/jquery-1.7.2.js"></script>
    </head>
    <body>
       
        
        <div id="aviso" class="msg" style="display: none">
            Senha atualizada com sucesso
            redirecionando em 4s....
        </div>
        
        
    </body>
</html>
<script language="javascript">
      $(document).ready(function(){ 
          $('#aviso').slideDown();
          $('#aviso').fadeTo("slow", 4).animate({opacity: 1.0}, 700).fadeTo("slow", 0);
          setInterval(window.location.href='/app/controller/LoginController?action=logout', 4);
          
      })
</script>            
<? } ?>
    



