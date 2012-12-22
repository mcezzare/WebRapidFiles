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
class AjaxGrupos{
    
}
require_once ($_SERVER['DOCUMENT_ROOT'] . '/lib/block.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/lib/Utils.class.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/app/model/Grupo.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/controller/GrupoController.php');

$grupoC = new GrupoController();
$arrGrupos = $grupoC->getGrupos();
?>
<table border="1">
    <thead>
    <th id="indice">#</th>
    <th>Id</th>
    <th >Grupo</th>
    <th >Descri&ccedil;&atilde;o</th>
    <th >Total Usu&aacute;rios</th>
</thead>
<tbody>
    <? for ($i = 0; $i < count($arrGrupos); $i++) { ?>
        <tr <?
        if ($i % 2 == 0) {
            echo "class=\"alt\"";
        }
        ?>>
            <td id="indice"><? echo $i + 1; ?></td>
            <td><? echo $arrGrupos[$i]->getId(); ?></td>
            <td><? echo $arrGrupos[$i]->getNome(); ?></td>
            <td><? echo $arrGrupos[$i]->getDescricao(); ?></td>
            <td><? echo $arrGrupos[$i]->getTotalUsers(); ?></td>


        </tr>
    <? } ?>
</tbody>

</table>