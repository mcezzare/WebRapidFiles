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
error_reporting('E_ALL');
class RecuperaSenha{
    
}
@session_start();

//require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/config.php');
//require_once ($_SERVER['DOCUMENT_ROOT'] . '/lib/block.php');
//print_r($_POST);
require_once ($_SERVER['DOCUMENT_ROOT'] . '/lib/Utils.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/model/Logger.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/controller/LoggerController.php');
    
$util = new Utils();
$resetPassLink = $util->buildResetPassLink();


if (isset($_POST['data']['Usuario']['captcha'])) {
    if ($_SESSION["captcha"] == $_POST['data']['Usuario']['captcha']) {
        //CAPTHCA is valid; proceed the message: save to database, send by e-mail ...
        //echo 'CAPTCHA is valid; proceed the message';
        $aproved = true;
        $msg = "Captcha confere<br>";
    } else {
        //echo 'CAPTCHA is not valid; ignore submission';
        $aproved = false;
        $msg = "Captcha não confere<br>";
    }
}
echo $msg;

require_once ($_SERVER['DOCUMENT_ROOT'] . '/lib/MailUtils.class.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/app/model/Usuario.class.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/app/controller/UsuarioController.php');

if ($aproved) {
   
    
    
    
    $login = $_POST['data']['Usuario']['login'];
    
    
 
    
    
    $userC = new UsuarioController();
    $usuario = $userC->findLogin($login, true);

        //logger
    $log = new Logger();
    $logC = new LoggerController();
    $log->setIdUsuario($usuario->getId());
    $idAcao = 10; //troca senha
    $log->setIdAcao($idAcao);
    $info="usuario:".$login." IP:".$_SERVER['REMOTE_ADDR']." browser:".$_SERVER['HTTP_USER_AGENT'];
    $log->setObjectStored($info);
    $logC->loga($log);
    //end logger
    
    
    
    
    
    if (($usuario instanceof Usuario) && ($usuario->getId() != 0) && ($usuario->isAtivo())) {
         echo 'Enviando nova senha por e-mail...';
        //todo
        $MU= new MailUtils();
        $MU->EnviaSenha($usuario,$resetPassLink);
        $userC->armazenaLink($usuario,$resetPassLink);
        //
//        print_r($usuario) ;
        // 
    } else {

        echo 'Email não enviado';
    }
}
?>
<!--<script language="javascript">
            $(document).ready(function(){
    
                window.location.href=window.location.href;
            })
</script>-->
    