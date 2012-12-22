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
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/model/Usuario.class.php');
//debug
require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/Utils.class.php');

class UsuarioDAO {

    private $sqlBase;
    private $sqlBaseT;

    public function __construct() {
        $this->sqlBase = "SELECT
            `U`.`idusuario`,
            `U`.`login`,
            `U`.`senha`,
            `U`.`email`,
            `U`.`lembrete`,
            `U`.`idgrupo_usuario`,
            `U`.`ativo`,
            `U`.`nivel`,
            `U`.`link_reset_senha`,
            `GU`.`grupo`
            FROM `" . DB_NAME . "`.`usuario` `U` inner join `" . DB_NAME . "`.`grupo_usuario` `GU`
            on (`GU`.`idgrupo_usuario`=`U`.`idgrupo_usuario`) ";
        $this->sqlBaseT = "SELECT
            `U`.`idusuario`,
            `U`.`login`,
            `U`.`senha`,
            `U`.`email`,
            `U`.`lembrete`,
            `U`.`idgrupo_usuario`,
            `U`.`ativo`,
            `U`.`nivel`,
            `GU`.`grupo`,
            (SELECT COUNT(*) from `arquivos` `ARQ` where `ARQ`.`idusuario` = `U`.`idusuario`) as `total_arquivos`
            FROM `usuario` `U` inner join `grupo_usuario` `GU`
            on (`U`.`idgrupo_usuario` = `GU`.`idgrupo_usuario`) ";
    }

    public function load(Usuario $usuario) {

        $conexao = new Conexao();
//        $conexao->conecta();
        $sqlQuery = $this->sqlBase;
        $sqlQuery .= sprintf(" 
            where `U`.`idusuario`=%s ", $usuario->getId());
        //debug
//        $util = new Utils();
//        $util->mostraSQL($sqlQuery);

        $rs = $conexao->executeQuery($sqlQuery);


        while ($row = mysql_fetch_array($rs)) {
            $usuario->setId($row['idusuario']);
            $usuario->setLogin(htmlspecialchars($row['login'], ENT_NOQUOTES, 'ISO8859-1'));
            $usuario->setAtivo($row['ativo']);
            $usuario->setIdGrupo($row['idgrupo_usuario']);
            $usuario->setGrupo($row['grupo']);
            $usuario->setEmail($row['email']);
            $usuario->setNivel($row['nivel']);
            $usuario->setLembrete($row['lembrete']);
        }

        $conexao->desconecta();
//        $util->mostraObjeto($Usuario);
        return $usuario;
    }

    public function validar($login, $senha) {
        $Usuario = new Usuario();
        $conexao = new Conexao();
//        $conexao->conecta();
        $sqlQuery = $this->sqlBase;
        $sqlQuery .= sprintf(" 
            where `U`.`login`='%s' 
            and `U`.`senha`=md5('%s')", $login, $senha);
        //debug
//        $util = new Utils();
//        $util->mostraSQL($sqlQuery);

        $rs = $conexao->executeQuery($sqlQuery);


        while ($row = mysql_fetch_array($rs)) {
            $Usuario->setId($row['idusuario']);
            $Usuario->setLogin(htmlspecialchars($row['login'], ENT_NOQUOTES, 'ISO8859-1'));
            $Usuario->setAtivo($row['ativo']);
            $Usuario->setIdGrupo($row['idgrupo_usuario']);
            $Usuario->setGrupo($row['grupo']);
            $Usuario->setEmail($row['email']);
            $Usuario->setNivel($row['nivel']);
            $Usuario->setTmpLink($row['link_reset_senha']);
        }

        $conexao->desconecta();
//        $util->mostraObjeto($Usuario);
        return $Usuario;
    }

    public function getUsuarios() {
        $sqlQuery = $this->sqlBaseT;
        $sqlQuery.=" ORDER BY GRUPO ";
        $arrUsuarios = array();
        $conexao = new Conexao();
        $rs = $conexao->executeQuery($sqlQuery);

        while ($row = mysql_fetch_array($rs)) {

            $Usuario = new Usuario();
            $Usuario->setId($row['idusuario']);
            $Usuario->setLogin(htmlspecialchars($row['login'], ENT_NOQUOTES, 'ISO8859-1'));
            $Usuario->setAtivo($row['ativo']);
            $Usuario->setIdGrupo($row['idgrupo_usuario']);
            $Usuario->setGrupo($row['grupo']);
            $Usuario->setEmail($row['email']);
            $Usuario->setNivel($row['nivel']);
            $Usuario->setTotalArquivos($row['total_arquivos']);
            array_push($arrUsuarios, $Usuario);
        }

        $conexao->desconecta();

        return $arrUsuarios;
    }

    public function getUsuario($idUser) {
        $Usuario = new Usuario();
        $conexao = new Conexao();
//        $conexao->conecta();
        $sqlQuery = $this->sqlBaseT;
        $sqlQuery .= sprintf(" 
            where `U`.`idusuario`=%s ", $idUser);
        //debug
//        $util = new Utils();
//        $util->mostraSQL($sqlQuery);

        $rs = $conexao->executeQuery($sqlQuery);


        while ($row = mysql_fetch_array($rs)) {
            $Usuario->setId($row['idusuario']);
            $Usuario->setLogin(htmlspecialchars($row['login'], ENT_NOQUOTES, 'ISO8859-1'));
            $Usuario->setAtivo($row['ativo']);
            $Usuario->setIdGrupo($row['idgrupo_usuario']);
            $Usuario->setGrupo($row['grupo']);
            $Usuario->setEmail($row['email']);
            $Usuario->setNivel($row['nivel']);
            $Usuario->setTotalArquivos($row['total_arquivos']);
        }

        $conexao->desconecta();
//        $util->mostraObjeto($Usuario);
        return $Usuario;
    }

    public function atualizaDados(Usuario $u) {

        $conexao = new Conexao();
        if ($u->getSenha() != null) {
            $sqlQuery = sprintf("UPDATE `usuario`
SET
`login` = '%s',
`senha` = md5('%s'),
`email` = '%s',
`lembrete` = '%s',
`idgrupo_usuario` = %s,
`ativo` = %s,
`nivel` = '%s'
WHERE `idusuario` = %s", $u->getLogin(), $u->getSenha(), $u->getEmail(), $u->getLembrete(), $u->getIdGrupo(), $u->isAtivo(), $u->getNivel(), $u->getId()
            );
        } else {
            $sqlQuery = sprintf("UPDATE `usuario`
SET
`login` = '%s',
`email` = '%s',
`lembrete` = '%s',
`idgrupo_usuario` = %s,
`ativo` = %s,
`nivel` = '%s'
WHERE `idusuario` = %s", $u->getLogin(), $u->getEmail(), $u->getLembrete(), $u->getIdGrupo(), $u->isAtivo(), $u->getNivel(), $u->getId()
            );
        }
//        $util = new Utils();
//        $util->mostraSQL($sqlQuery);

        try {
            $rs = $conexao->executeUpdate($sqlQuery);
            $conexao->desconecta();
            return true;
        } catch (Exception $err) {
            print_r($err);
            return false;
        }
    }

    public function adicionaUsuario(Usuario $usuario) {
        $sqlQuery = sprintf("INSERT INTO `usuario`
                    (
                    `login`,
                    `senha`,
                    `email`,
                    `lembrete`,
                    `idgrupo_usuario`,
                    `ativo`,
                    `nivel`)
                    VALUES
                    (
                    '%s',
                    md5('%s'),
                    '%s',
                    '%s',
                    %s,
                    %s,
                    '%s'
                    )", $usuario->getLogin(), $usuario->getSenha(), $usuario->getEmail(), $usuario->getLembrete(), $usuario->getIdGrupo(), $usuario->isAtivo(), $usuario->getNivel()
        );

//        echo $sqlQuery."<br>";
//        $util = new Utils();
//        $util->mostraSQL($sqlQuery);
        $conexao = new Conexao();
        try {

            $rs = $conexao->executeUpdate($sqlQuery);
            $conexao->desconecta();
            return true;
        } catch (Exception $err) {
            print_r($err);
            return false;
        }
    }

    public function deleteUsuario(Usuario $usuario) {
        if ($usuario instanceof Usuario) {
            $sqlQuery = sprintf("DELETE FROM `" . DB_NAME . "`.`usuario` WHERE idusuario=%s", $usuario->getId());
            $conexao = new Conexao();
//            echo $sqlQuery;
            try {

                $rs = $conexao->executeUpdate($sqlQuery);
                $conexao->desconecta();
                return true;
            } catch (Exception $err) {
                print_r($err);
                return false;
            }
        }
    }

    public function findByMail($email) {
        $sqlQuery = sprintf("SELECT `usuario`.`idusuario`,`usuario`.`login`,`usuario`.`ativo` FROM `" . DB_NAME . "`.`usuario` WHERE `usuario`.`email`='%s'", $email);
        $conexao = new Conexao();


        $rs = $conexao->executeQuery($sqlQuery);
        if (count($rs) > 0) {
            $Usuario = new Usuario();
            while ($row = mysql_fetch_array($rs)) {

                $Usuario->setId($row['idusuario']);
                $Usuario->setLogin(htmlspecialchars($row['login'], ENT_NOQUOTES, 'ISO8859-1'));
                $Usuario->setAtivo($row['ativo']);
            }

            $conexao->desconecta();

//                return $Usuario;
            echo $Usuario->getStatus();
            return true;
        } else {
            return false;
        }
    }

    public function findByLogin($login, $returnUser = false) {
        $sqlQuery = sprintf("SELECT `usuario`.`idusuario`,`usuario`.`login`,`usuario`.`ativo`,`usuario`.`email` 
             FROM `" . DB_NAME . "`.`usuario` WHERE `usuario`.`login`='%s'", $login);
        $conexao = new Conexao();


        $rs = $conexao->executeQuery($sqlQuery);
        if (count($rs) > 0) {
            $Usuario = new Usuario();
            while ($row = mysql_fetch_array($rs)) {

                $Usuario->setId($row['idusuario']);
                $Usuario->setLogin(htmlspecialchars($row['login'], ENT_NOQUOTES, 'ISO8859-1'));
                $Usuario->setAtivo($row['ativo']);
                $Usuario->setEmail($row['email']);
            }

            $conexao->desconecta();

//                return $Usuario;
            if ($returnUser) {
                return $Usuario;
            } else {
                echo $Usuario->getStatus();

                return true;
            }
        } else {
            return false;
        }
    }

    public function getTotalUsuarios() {
        $sqlQuery = "SELECT COUNT(*) as total from `" . DB_NAME . "`.`usuario`";
        $conexao = new Conexao();
        $total = 0;
        $rs = $conexao->executeQuery($sqlQuery);
        while ($row = mysql_fetch_array($rs)) {
            $total = $row['total'];
        }
        $conexao->desconecta();
        return $total;
    }

    public function getTotalUsuariosAtivos() {
        $sqlQuery = "SELECT COUNT(*) as total from `" . DB_NAME . "`.`usuario`  where `ativo`=1";
        $conexao = new Conexao();
        $total = 0;
        $rs = $conexao->executeQuery($sqlQuery);
        while ($row = mysql_fetch_array($rs)) {
            $total = $row['total'];
        }
        $conexao->desconecta();
        return $total;
    }

    public function armazenaLinkSenha(Usuario $usuario, $resetPassLink) {

        $sqlQuery = sprintf("UPDATE `usuario`
SET
`link_reset_senha` = '%s'
WHERE `idusuario` = %s", $resetPassLink, $usuario->getId());
        $conexao = new Conexao();
        try {

            $rs = $conexao->executeUpdate($sqlQuery);
            $conexao->desconecta();
            return true;
        } catch (Exception $err) {
            print_r($err);
            return false;
        }
    }

    public function procuraLinkSenha($link) {
        $usuario = new Usuario();
        $sqlQuery = sprintf("SELECT `usuario`.`idusuario`,`usuario`.`login`,`usuario`.`ativo`,`usuario`.`email` 
             FROM `" . DB_NAME . "`.`usuario` WHERE `usuario`.`link_reset_senha`='%s'", $link);
        $conexao = new Conexao();


        $rs = $conexao->executeQuery($sqlQuery);
        if (count($rs) > 0) {
            while ($row = mysql_fetch_array($rs)) {

                $usuario->setId($row['idusuario']);
                $usuario->setLogin(htmlspecialchars($row['login'], ENT_NOQUOTES, 'ISO8859-1'));
                $usuario->setAtivo($row['ativo']);
                $usuario->setEmail($row['email']);
            }

            $conexao->desconecta();
        }
        return $usuario;
    }

    public function trocaSenha(Usuario $u) {
        $conexao = new Conexao();
        $sqlQuery = sprintf("UPDATE `usuario`
SET
`senha` = md5('%s'),
`lembrete` = '%s',
`link_reset_senha`=null
WHERE `idusuario` = %s", $u->getSenha(), $u->getLembrete(), $u->getId());

        try {
            $rs = $conexao->executeUpdate($sqlQuery);
            $conexao->desconecta();
            return true;
        } catch (Exception $err) {
            print_r($err);
            return false;
        }
    }

    public function limpaLinkSenha(Usuario $u) {
            $conexao = new Conexao();
        $sqlQuery = sprintf("UPDATE `usuario`
SET
`link_reset_senha`=null
WHERE `idusuario` = %s", $u->getId());
            echo $sqlQuery;
        try {
            $rs = $conexao->executeUpdate($sqlQuery);
            $conexao->desconecta();
            return true;
        } catch (Exception $err) {
            print_r($err);
            return false;
        }
    }

}

?>
