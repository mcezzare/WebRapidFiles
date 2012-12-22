<?
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
if (!$_SESSION['usuario']["logado"]) {
    header('Location:/index.php?err=4');
}

function checkNivel($min, $val) {

    if ($min > $val) {
        echo "<h2>Sem permissão para esta opção</h2><br>";
        echo "<a href=\"javascript:history.go(-1)\">voltar</a>";
        die();
    }
}

function checkGroup($arrPermitidos, $groupUser) {
    $valid = false;
    if ($groupUser == 3) {
        $valid = true;
        return true;
    }

    if (in_array($arrPermitidos, $groupUser)) {
        $valid = true;
        return true;
    }

    if ($valid) {
        return true;
    } else {
        echo "<h2>Você não pertence à este grupo</h2><br>";
        echo "<a href=\"javascript:history.go(-1)\">voltar</a>";

        return false;
    }
}

?>