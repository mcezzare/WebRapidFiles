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
require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/Conexao.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/Utils.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/model/Logger.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/model/Usuario.class.php');

class LoggerDAO {

    private $sqlBase;
    private $util;

    public function LoggerDAO() {
        $this->sqlBase = "SELECT
                `log`.`id`,
                `log`.`idusuario`,
                `log`.`idacao`,
                DATE_FORMAT(`log`.`data_acao`,'%d/%m/%y %h:%i:%s') as `data_acao`,
                `log`.`data_acao` as `data`,
                `log`.`objeto`,
                `ac`.`acao`,
                `u`.`login`,
                `g`.`grupo`
                FROM `site_log` `log`
                inner join `usuario` `u` on (`log`.`idusuario`=`u`.`idusuario`)
                inner join `acao` `ac` on (`ac`.`idacao`=`log`.`idacao`)
                inner join `grupo_usuario` `g` on (`g`.`idgrupo_usuario`=`u`.`idgrupo_usuario`)
                WHERE `log`.`id` is not null";
        $this->util = new Utils();
    }

    public function registraLog(Logger $log) {
        if ($log->getObjectStored() == null) {
            $object = 'NULL';
        } else {
            $object = "'" . $log->getObjectStored() . "'";
        }

        $sqlQuery = sprintf("INSERT INTO `" . DB_NAME . "`.`site_log`
                    (
                    `idusuario`,
                    `idacao`,
                    `data_acao`,
                    `objeto`)
                    VALUES(%s,%s,NOW(),%s)", $log->getIdUsuario(), $log->getIdAcao(), $object);


//        $this->util->mostraSQL($sqlQuery);
//        die('x');
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

    public function getAllLogs(Logger $logFiltro = null) {
        $sqlQuery = $this->sqlBase;
        $sqlQuery.=$this->montaFiltro($logFiltro);
        $sqlQuery.="  order by `data` DESC";
//        die($sqlQuery);
        $conexao = new Conexao();
        $conexao->conecta();
        $rs = $conexao->executeQuery($sqlQuery);
        $arrLogs = array();
        $conta = 1;
//        if (count($rs) > 0) {
        while ($row = mysql_fetch_array($rs)) {
            $log = new Logger();
            $log->setNumRow($conta);
            $log->setUsuarioNome($row['login']);
            $log->setData($row['data_acao']);
            $log->setAcaoNome($row['acao']);
            $log->setObjectStored($row['objeto']);
            array_push($arrLogs, $log);
            $conta++;
        }


        $conexao->desconecta();
//            var_dump($arrLogs);
        return $arrLogs;
    }

    public function getLogsPaginadosDAO($primeiro, $numPorPagina, Logger $logFiltro, $order, $orderMode, $debug = false) {

        $sqlQuery = $this->sqlBase;
        $sqlQuery.=$this->montaFiltro($logFiltro);
        $sqlQuery.="  order by `data` DESC";
        $sqlQuery.= " LIMIT " . $primeiro . "," . $numPorPagina;


        if ($debug) {
            echo($sqlQuery);
        }

        $conexao = new Conexao();
        $rs = $conexao->executeQuery($sqlQuery);
        $arrLogs = array();
        $conta = 1;
        try {
            while ($row = mysql_fetch_array($rs)) {
                $log = new Logger();
                $log->setNumRow($conta);
                $log->setId($row['id']);

                $log->setUsuarioNome($row['login']);
                $log->setData($row['data_acao']);
                $log->setAcaoNome($row['acao']);
                $log->setObjectStored($row['objeto']);
                $log->setGrupoNome($row['grupo']);
                array_push($arrLogs, $log);
                $conta++;
            }

            $conexao->desconecta();
//            var_dump($arrLogs);
            return $arrLogs;
        } catch (Exception $e) {
            die(print_r($e));
        }
    }

    public function getTotalLogs(Logger $logFiltro) {

        $conexao = new Conexao();
        $sqlQuery = "SELECT COUNT(*) as total
                    FROM `" . DB_NAME . "`.`site_log` `log` where `log`.`id` is not null ";
        
        //need join to filter by group
        if ($logFiltro->getIdGrupo() != null){
           $sqlQuery = "SELECT COUNT(*) as total
                    FROM `" . DB_NAME . "`.`site_log` `log` 
                        inner join `usuario` `g` on (`log`.`idusuario`=`g`.`idusuario`)
                        where `log`.`id` is not null ";
         
        }

        $sqlQuery .= $this->montaFiltro($logFiltro);
//        $this->util->mostraSQL($sqlQuery);
//        die($sqlQuery);

        $rs = $conexao->executeQuery($sqlQuery);
        $total = 0;
        while ($row = mysql_fetch_array($rs)) {
            $total = $row['total'];
        }

        $conexao->desconecta();
        return $total;
    }

    private function montaFiltro(Logger $logFiltro) {
        $sqlQuery = "";
        if ($logFiltro->getIdUsuario() != null) {
            $sqlQuery.=" AND `log`.`idusuario` =" . $logFiltro->getIdUsuario();
        }
      


        if ($logFiltro->getData() != null) {
            $sqlQuery.=" AND DATE_FORMAT(`log`.`data_acao`,'%d/%m/%y')='". $logFiltro->getData()."' ";
        }

        
        if (($logFiltro->getDataStart() != null)&&($logFiltro->getDataEnd() != null)) {
            $sqlQuery.=" AND DATE_FORMAT(`log`.`data_acao`,'%d/%m/%y')>='". $logFiltro->getDataStart()."' ";
            $sqlQuery.=" AND DATE_FORMAT(`log`.`data_acao`,'%d/%m/%y')<='". $logFiltro->getDataEnd()."' ";
        }

       if ($logFiltro->getIdGrupo() != null) {
            $sqlQuery.=" AND `g`.`idgrupo_usuario`=" . $logFiltro->getIdGrupo();
        }
        
        
       if ($logFiltro->getIdAcao() != null) {
            $sqlQuery.=" AND  `log`.`idacao`=" . $logFiltro->getIdAcao();
        }
        
        
        
        
        return $sqlQuery;
    }

    public function removerLogs($logs) {
        if (is_array($logs)) {

            $sqlValues = "";
            try {
                for ($i = 0; $i <= count($logs); $i++) {

                    $sqlValues.=$logs[$i] . ",";
                    //sql    
                }
            } catch (Exception $eIgnore) {
                // log php notice undefined offset 
            }

            $cleanVars = substr($sqlValues, 0, strlen($sqlValues) - 2);
        } else {
            $cleanVars = $logs;
        }
        $conexao = new Conexao();

        $sqlQueryRemove = sprintf("DELETE FROM `site_log` WHERE id in(%s) ", $cleanVars);
        echo $sqlQueryRemove;
        try {
            $rsR = $conexao->executeUpdate($sqlQueryRemove);
            $conexao->desconecta();
            return true;
        } catch (Exception $err) {
            print_r($err);
            return false;
        }
    }

    public function getUsersLogs() {
        $sqlQuery ="SELECT DISTINCT `SL`.`idusuario`,`U`.`login`  from `site_log` `SL` inner join `usuario` `U`
on (`SL`.`idusuario`=`U`.`idusuario`)";
        $sqlQuery.="  order by `login` ";
//        die($sqlQuery);
        $conexao = new Conexao();
        $rs = $conexao->executeQuery($sqlQuery);
        $arrLogs = array();
       
       if (count($rs) > 0) {
           while ($row = mysql_fetch_array($rs)) {
            $log = new Logger();
            $log->setIdUsuario($row['idusuario']);
            $log->setUsuarioNome($row['login']);
            array_push($arrLogs, $log);
        
        }
        $conexao->desconecta();

        
       }
        
        return $arrLogs;
        
    }

    public function getLogsExistentesDatas() {
        $sqlQuery ="SELECT DISTINCT DATE_FORMAT(`data_acao`,'%d/%m/%y') as `data` from `site_log` order by `data` DESC ";
//        $sqlQuery.="  order by  `login` ";
//        die($sqlQuery);
        $conexao = new Conexao();
        $rs = $conexao->executeQuery($sqlQuery);
        $arrLogs = array();
       
       if (count($rs) > 0) {
           while ($row = mysql_fetch_array($rs)) {
            $log = new Logger();
            $log->setData($row['data']);
            array_push($arrLogs, $log);
        
        }
        $conexao->desconecta();
       }
        return $arrLogs;
    }

    public function getAcoesLogadas() {
       $sqlQuery ="SELECT DISTINCT `SL`.`idacao`,`A`.`acao`  from `site_log` `SL` inner join `acao` `A`
on (`SL`.`idacao`=`A`.`idacao`) ";
//        $sqlQuery.="  order by  `login` ";
//        die($sqlQuery);
        $conexao = new Conexao();
        $rs = $conexao->executeQuery($sqlQuery);
        $arrLogs = array();
       
       if (count($rs) > 0) {
           while ($row = mysql_fetch_array($rs)) {
            $log = new Logger();
            $log->setIdAcao($row['idacao']);
            $log->setAcaoNome($row['acao']);
            array_push($arrLogs, $log);
        
        }
        $conexao->desconecta();
       }
        return $arrLogs; 
        
    }

    public function getGruposLogados() {
        $sqlQuery ="SELECT DISTINCT `U`.`idgrupo_usuario` as `idgrupo`, `GU`.`grupo` 
from `site_log` `SL` 
inner join `usuario` `U` on (`SL`.`idusuario`=`U`.`idusuario`)
inner join `grupo_usuario` `GU` on (`GU`.`idgrupo_usuario`=`U`.`idgrupo_usuario`) ";
//        $sqlQuery.="  order by  `login` ";
//        die($sqlQuery);
        $conexao = new Conexao();
        $rs = $conexao->executeQuery($sqlQuery);
        $arrLogs = array();
       
       if (count($rs) > 0) {
           while ($row = mysql_fetch_array($rs)) {
            $log = new Logger();
            $log->setIdGrupo($row['idgrupo']);
            $log->setGrupoNome($row['grupo']);
            array_push($arrLogs, $log);
        
        }
        $conexao->desconecta();
       }
        return $arrLogs; 
    }
    public function getResetPassLogs(Usuario $usuario) {
        $sqlQuery="SELECT
`SL`.`id`,
`SL`.`idusuario`,
`SL`.`idacao`,
DATE_FORMAT(`SL`.`data_acao`,'%d/%m/%y %h:%i:%s') as `data_acao`,
`SL`.`objeto`,
`A`.`acao`
FROM `site_log` `SL` inner join `acao` `A`
on (`SL`.`idacao`=`A`.`idacao`)
WHERE `SL`.`idusuario` = ".$usuario->getId()."
AND `SL`.`idacao`= 10
order by `id` desc";
        
//        die($sqlQuery);
        $conexao = new Conexao();
        $rs = $conexao->executeQuery($sqlQuery);
        $arrLogs = array();
       
       if (count($rs) > 0) {
           while ($row = mysql_fetch_array($rs)) {
            $log = new Logger();
            $log->setIdUsuario($row['idusuario']);
            $log->setData($row['data_acao']);
            $log->setObjectStored($row['objeto']);
            $log->setAcaoNome($row['acao']);
            array_push($arrLogs, $log);
        
        }
        $conexao->desconecta();

        
       }
        
        return $arrLogs;
        
    }
    
}

?>
