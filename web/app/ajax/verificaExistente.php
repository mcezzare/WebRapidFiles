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
class AjaxVerificaArquivos{
    
}
@session_start();
require_once ($_SERVER['DOCUMENT_ROOT'] . '/lib/block.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/lib/Utils.class.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/app/model/Usuario.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/controller/UsuarioController.php');

if (isset($_POST['email']) && $_POST['email'] != '') {
    $email = $_POST['email'];

    $userC = new UsuarioController();
    $test = $userC->findEmail($email);

}

if (isset($_POST['login']) && $_POST['login'] != '') {
    $login = $_POST['login'];

    $userC = new UsuarioController();
    $test = $userC->findLogin($login);

}




?>
