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
//error_reporting('E_ALL');

if (!$_SESSION['usuario']["logado"]) {
    header("Location: /login.php");
}
if (isset($_GET['section'])) {
    $section = $_GET['section'];
    switch ($section) {

        case 'arquivos':
            $model = 'Arquivo';
            $controller = "ArquivoController";

            break;
        case 'usuarios':
                $model='Usuario';
                $controller='UsuarioController';
        break;
        case 'grupos':
                $model='Grupo';
                $controller='GrupoController';
        break;
        case 'admin':
            $model = 'Admin';
            $controller = 'AdminController';
        break;
        case 'uploads':
            $model = 'Uploads';
            $controller = 'UploadController';
        break;
        case 'monitoracao':
            $model = 'Logger';
            $controller = 'LoggerController';
        break;

        default:
            $model = 'Empty';
            $controller = 'empty';
            break;
    }
    
require_once($_SERVER['DOCUMENT_ROOT']."/app/controller/".$controller.".php");
require_once($_SERVER['DOCUMENT_ROOT']."/app/model/".$model.".class.php");

$pageAction = ''; // pagina de acao
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {

        default:
            $pageAction = $action . '.php';
            break;
    }
}
    
}
?>
