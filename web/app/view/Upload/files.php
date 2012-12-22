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
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/config.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/Utils.class.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/Upload.class.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/app/model/Arquivo.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/controller/ArquivoController.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/app/model/Logger.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/controller/LoggerController.php');

$up = new Upload();
//$up->send($field, $dir)
$util = new Utils();
$util->mostraObjeto($_FILES);

$uploaddir=REPOSITORIO; 
$listaOk = $up->sendMultiple('url', $uploaddir,$_SESSION['usuario']['id']);
//print_r($listaOk);

//LOGGER    
    $log = new Logger();
    $logC = new LoggerController();
    $log->setIdAcao(1);//upload
    $log->setIdUsuario($_SESSION['usuario']['id']);
//    $log->setObjectStored($listaOk);
//    $logC->loga($log);
//END LOGGER   
//$util->mostraObjeto($log);


$arqC = new ArquivoController();
$arquivo = new Arquivo();
foreach ($listaOk as $arquivo) {
    $arqC->adicionaArquivo($arquivo);
     $log->setObjectStored($arquivo->getStatus());
    $logC->loga($log);
    
}




//if(isset($_FILES['url']['error'])){ 
//   foreach ($_FILES["url"]["error"] as $key => $error) { 
//      if ($error == UPLOAD_ERR_OK) { 
//         $tmp_name = $_FILES["url"]["tmp_name"][$key]; 
//         $name = $_FILES["url"]["name"][$key]; 
//         move_uploaded_file($tmp_name, $uploaddir. "/" .$name); 
//      } 
//   } 
//} 


?>