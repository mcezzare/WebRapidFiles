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
require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/Conexao.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/model/Grupo.class.php');
//debug
require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/Utils.class.php');

class GrupoDAO {

    public function getAllGroups() {
        $conexao = new Conexao();
        $sqlQuery = "SELECT
`GU`.`idgrupo_usuario` as `id`,
`GU`.`grupo` as `nome`,
`GU`.`descricao` as `descricao`,
(Select count(*) from `" . DB_NAME . "`.`usuario` `U` where `GU`.`idgrupo_usuario`=`U`.`idgrupo_usuario`) as `total`
FROM `" . DB_NAME . "`.`grupo_usuario` `GU`";
        $arrGrupos = array();
        $rs = $conexao->executeQuery($sqlQuery);

        while ($row = mysql_fetch_array($rs)) {
            $grupo = new Grupo();
            $grupo->setId($row['id']);
            $grupo->setNome($row['nome']);
            $grupo->setDescricao($row['descricao']);
            $grupo->setTotalUsers($row['total']);
            
            array_push($arrGrupos, $grupo);
        }


        $conexao->desconecta();
        return $arrGrupos;
    }

}

?>
