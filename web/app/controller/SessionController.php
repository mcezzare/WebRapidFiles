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
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/model/Usuario.class.php');

class SessionController {

    public function __construct() {
        
    }

    public function iniciaSessaoUsuario(Usuario $usuario) {
        $_SESSION['usuario']['logado'] = true;
        $_SESSION['usuario']['login'] = $usuario->getLogin();
        $_SESSION['usuario']['id'] = $usuario->getId();
        // por enquanto
        $_SESSION['usuario']['cod_user'] = $usuario->getId();

        $_SESSION['usuario']['grupo'] = $usuario->getGrupo();
        $_SESSION['usuario']['id_grupo'] = $usuario->getIdGrupo();

        $_SESSION['usuario']['nivel_nome'] = $usuario->getNivel();
        $usuario->getNivel() == 'Admin' ? $nivel = 2 : $nivel = 1;
        $_SESSION['usuario']['nivel'] = $nivel;

        $_SESSION['usuario']['view'] = "/pages/privado.php";
        $_SESSION['usuario']['tmpLink'] = $usuario->getTmpLink();
    }

}

?>
