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
class PostController{
    
}
include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/block.php');

//debug
require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/Utils.class.php');
$util = new Utils();
$debug = true;
if ($debug) {
    $util->mostraObjeto($_POST);
}

//die('debugging');
//log actions 
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/model/Logger.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/controller/LoggerController.php');

//LOGGER    
$log = new Logger();
$logC = new LoggerController();
$log->setIdUsuario($_SESSION['usuario']['id']);
//    $log->setObjectStored($listaOk);
//    $logC->loga($log);
//END LOGGER   
//################remove arquivos 
if (isset($_POST['arquivo']['exclusao']) && ($_POST['arquivo']['exclusao'] == true)) {
    require_once($_SERVER['DOCUMENT_ROOT'] . '/app/model/Arquivo.class.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/app/controller/ArquivoController.php');
//    $util->mostraObjeto($_POST);

    $arquivos = $_POST['arquivos'];
    $arqC = new ArquivoController();
    $removeArquivosExistentes = $arqC->removeArquivosExistentes($arquivos);
    $idAcao = 2; //apaga arquivo
    $log->setIdAcao($idAcao);

    $arquivo = new Arquivo();
    foreach ($removeArquivosExistentes as $arquivo) {

        $log->setObjectStored($arquivo->getStatus());
        $logC->loga($log);
    }



    $urlFinal = sprintf('Location:%s', $_SESSION['usuario']['view'] . '?section=arquivos&action=index');

    header($urlFinal);
}


//################atualiza usuarios
if (isset($_POST['usuario']['update']) && ($_POST['usuario']['update'] == true)) {
    require_once($_SERVER['DOCUMENT_ROOT'] . '/app/model/Usuario.class.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/app/controller/UsuarioController.php');
    $usuarioC = new UsuarioController();
    $usuario = new Usuario();
    $usuario->setId($_POST['usuario']['id']);
    $usuario->setLogin($_POST['usuario']['login']);
    $usuario->setEmail($_POST['usuario']['email']);
    $usuario->setNivel($_POST['usuario']['nivel']);
    $usuario->setIdGrupo($_POST['usuario']['id_grupo']);
    $usuario->setLembrete($_POST['usuario']['lembrete']);
//    $usuario->setAtivo($_POST['usuario']['ativo']);

    ($_POST['usuario']['ativo'] == '') ? $usuario->setAtivo(0) : $usuario->setAtivo($_POST['usuario']['ativo']);
    ($_POST['usuario']['senha'] == '') ? $usuario->setSenha(null) : $usuario->setSenha($_POST['usuario']['senha']);
//    $util->mostraObjeto($usuario);
    if ($usuarioC->atualizaDadosUsuario($usuario)) {

        //log    
        $idAcao = 4; //atualiza usuario
        $log->setIdAcao($idAcao);
        $log->setObjectStored('usuario:' . $usuario->getLogin());
        $logC->loga($log);
        //end log    

        $urlFinal = sprintf('Location:%s', $_SESSION['usuario']['view'] . '?section=usuarios&action=index');
        header($urlFinal);
    }
}

//################adiciona usuarios
if (isset($_POST['usuario']['novo']) && ($_POST['usuario']['novo'] == true)) {
    require_once($_SERVER['DOCUMENT_ROOT'] . '/app/model/Usuario.class.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/app/controller/UsuarioController.php');
    $usuarioC = new UsuarioController();
    $usuario = new Usuario();
    $usuario->setLogin($_POST['usuario']['login']);
    $usuario->setEmail($_POST['usuario']['email']);
    $usuario->setNivel($_POST['usuario']['nivel']);
    $usuario->setIdGrupo($_POST['usuario']['id_grupo']);
    $usuario->setLembrete($_POST['usuario']['lembrete']);
//    $usuario->setAtivo($_POST['usuario']['ativo']);
    $usuario->setSenha($_POST['usuario']['senha']);
    ($_POST['usuario']['ativo'] == '') ? $usuario->setAtivo(0) : $usuario->setAtivo($_POST['usuario']['ativo']);
//    $util->mostraObjeto($usuario);
    if ($usuarioC->salvaNovoUsuario($usuario)) {


        //log    
        $idAcao = 5; //cria usuario
        $log->setIdAcao($idAcao);
        $log->setObjectStored('usuario:' . $usuario->getLogin());
        $logC->loga($log);
        //end log    




        $urlFinal = sprintf('Location:%s', $_SESSION['usuario']['view'] . '?section=usuarios&action=index');
        header($urlFinal);
    }
}

//################remove usuarios
if (isset($_POST['usuario']['remove']) && ($_POST['usuario']['remove'] == true)) {
//$util->mostraObjeto($_POST);    
    require_once($_SERVER['DOCUMENT_ROOT'] . '/app/model/Usuario.class.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/app/controller/UsuarioController.php');
    $usuarioC = new UsuarioController();
    $usuario = new Usuario();
    $usuario->setId($_POST['usuario']['id']);
    $usuarioTmp = $usuarioC->load($usuario);
//        $util->mostraObjeto($usuario);
    if ($usuarioC->removeUsuario($usuario)) {

        $idAcao = 6; //remove usuario
        $log->setIdAcao($idAcao);
        $log->setObjectStored($usuarioTmp->getStatus());
        $logC->loga($log);
        //end log         
//    $util->mostraObjeto($usuarioTmp);    
//    $util->mostraObjeto($log);    
//    $urlFinal=sprintf('Location:%s',$_SESSION['usuario']['view'].'?section=usuarios&action=index');
//    header($urlFinal);
    }
}




if (isset($_POST['log']['exclusao']) && ($_POST['log']['exclusao'] == true)) {


    $logs = $_POST['logs'];
    $logC = new LoggerController();

    if ($logC->removeLogs($logs)) {
        $idAcao = 9; //apaga LOGS
        $log->setIdAcao($idAcao);
        $log->setObjectStored($logs);
        $logC->loga($log);

        $urlFinal = sprintf('Location:%s', $_SESSION['usuario']['view'] . '?section=monitoracao&action=index');

        header($urlFinal);
    }
}



//LOGGER    
$log = new Logger();
$logC = new LoggerController();
$log->setIdUsuario($_SESSION['usuario']['id']);
//    $log->setObjectStored($listaOk);
//    $logC->loga($log);
//END LOGGER   
//################remove arquivos 
if (isset($_POST['arquivosFS']['exclusao']) && ($_POST['arquivosFS']['exclusao'] == true)) {
    require_once($_SERVER['DOCUMENT_ROOT'] . '/app/model/Arquivo.class.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/app/controller/ArquivoController.php');
//    $util->mostraObjeto($_POST);

    $arquivos = $_POST['arquivos'];
    $arqC = new ArquivoController();
    $remove= $arqC->removeArquivosFs($arquivos);
    $idAcao = 2; //apaga arquivo
    $log->setIdAcao($idAcao);

//    $arquivo = new Arquivo();
    for ($i=0; $i<count($remove) ;$i++) {

        $log->setObjectStored($remove[$i]);
        $logC->loga($log);
    }



    $urlFinal = sprintf('Location:%s', $_SESSION['usuario']['view'] . '?section=arquivos&action=arquivosOutCatalog');

    header($urlFinal);
}

if (isset($_POST['usuario']['removeMsg']) && ($_POST['usuario']['removeMsg'] == true)) {
    require_once($_SERVER['DOCUMENT_ROOT'] . '/app/model/Usuario.class.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/app/controller/UsuarioController.php');

    $userC = new UsuarioController();
    $usuario = new Usuario();
    $usuario->setId($_SESSION['usuario']['id']);
    $usuario->setTmpLink(null);
    $action = $_POST['usuario']['action'];
    $section= $_POST['usuario']['section'];
    if ($userC->cleanMsgs($usuario)){
        $urlFinal = sprintf('Location:%s', $_SESSION['usuario']['view'] . '?section='.$section.'&action='.$action);
    unset($_SESSION['usuario']['tmpLink']);    
    header($urlFinal);
    }
    
    
    
}


?>
