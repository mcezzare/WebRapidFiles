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
class LoginController{
    
}
//use lib\Utils;
error_reporting('E_ALL');

require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/Utils.class.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/app/model/Usuario.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/controller/UsuarioController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/controller/SessionController.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/app/model/Logger.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/controller/LoggerController.php');
$util = new Utils();

//print_r($_POST);
//$util->mostraObjeto($_POST);

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'logout') {
        if ($_SESSION['usuario']['id'] != '') {
//LOGGER    
            $log = new Logger();
            $logC = new LoggerController();
            $log->setIdAcao(8); //logout
            $log->setIdUsuario($_SESSION['usuario']['id']);
            $log->setObjectStored(null);

            $logC->loga($log);
        }
//END LOGGER            
        session_destroy();
        header('Location:/index.php');
    }
}


$userC = new UsuarioController();

if (isset($_POST['data']['Usuario']['login'])) {
    $login = ($_POST['data']['Usuario']['login']);
    $_SESSION['tryLogin']=$login;
}

if (isset($_POST['data']['Usuario']['senha'])) {
    $senha = ($_POST['data']['Usuario']['senha']);
}
//$usuario = new Usuario();
//$util->mostraObjeto($usuario);
$_SESSION['erro'] = $_SESSION['erro'] + 1;
$usuario = $userC->autenticar($login, $senha);

//$util->mostraObjeto($usuario);
//die('debig');
if ($usuario->getId() == 0) {
    header('Location: /index.php?err='. $_SESSION['erro']);
} else {
    if ($usuario->isAtivo()) {

        $sessionC = new SessionController();
        $sessionC->iniciaSessaoUsuario($usuario);
//LOGGER    
        $log = new Logger();
        $logC = new LoggerController();
        $log->setIdAcao(7); //login
        $log->setIdUsuario($usuario->getId());
        $log->setObjectStored(null);

        $logC->loga($log);
//END LOGGER    
//      $util->mostraObjeto($load);  
//      die();
//      $util->mostraObjeto($_SESSION);
//      die();
        $usuario->getGrupo() == 'Admin' ? $sectionRun = "section=admin&action=index" : $sectionRun = "section=uploads&action=upload";

//    $urlToGo = $_SESSION['usuario']['view'] . "?section=arquivos&action=index";
        $urlToGo = $_SESSION['usuario']['view'] . "?" . $sectionRun;

        header(sprintf("Location: %s", $urlToGo));
    } else {
        header('Location:/index.php?err=81');
    }
}
?>
