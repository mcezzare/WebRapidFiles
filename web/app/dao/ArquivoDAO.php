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
//use lib\Utils;
require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/Conexao.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/model/Arquivo.class.php');
//debug
require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/Utils.class.php');

class ArquivoDAO {

    public function getListaArquivos() {
        $conexao = new Conexao();
//        $conexao->conecta();
        $sqlQuery = "SELECT
                    `A`.`idarquivos`,
                    `A`.`nome`,
                    `A`.`tipo`,
                    `A`.`tamanho`,
                    `A`.`idusuario`,
                    date_format(`A`.`data`,'%d/%m/%y %H:%i:%s') as `data`,
                    `A`.`data` as `dataOrder`,
                    `A`.`ip`,
                    `A`.`browser`,
                    `U`.`login`
                    FROM `" . DB_NAME . "`.`arquivos` `A` inner join `" . DB_NAME . "`.`usuario` `U`
                    on (`U`.`idusuario`=`A`.`idusuario`) order by `dataOrder` DESC ";
        $rs = $conexao->executeQuery($sqlQuery);
        $arrArquivos = array();

        while ($row = mysql_fetch_array($rs)) {
            $arquivo = new Arquivo();
            $arquivo->setIdarquivos($row['idarquivos']);
            $arquivo->setNome($row['nome']);
            $arquivo->setTipo($row['tipo']);
            $arquivo->setTamanho($row['tamanho']);
            $arquivo->setIdusuario($row['idusuario']);
            $arquivo->setData($row['data']);
            $arquivo->setIp($row['ip']);
            $arquivo->setBrowser($row['browser']);
            $arquivo->setUsuarioNome($row['login']);
            array_push($arrArquivos, $arquivo);
        }

        $conexao->desconecta();
        return $arrArquivos;
    }

    public function getTotalArquivos(Arquivo $arquivoFiltro) {
        $conexao = new Conexao();
//        $conexao->conecta();
        $sqlQuery = "SELECT COUNT(*) as total
                    FROM `" . DB_NAME . "`.`arquivos` `A` where `A`.`idarquivos` is not null ";
        $sqlQuery .= $this->montaFiltroPaginacao($arquivoFiltro);

        $rs = $conexao->executeQuery($sqlQuery);
        $total = 0;
        while ($row = mysql_fetch_array($rs)) {
            $total = $row['total'];
        }

        $conexao->desconecta();
        return $total;
    }

    public function getListaArquivosPaginados($primeiroRegistro, $numPorPagina, Arquivo $arquivoFiltro, $order = 1) {
        $conexao = new Conexao();
//        $conexao->conecta();
        $sqlQuery = "
                    SELECT 
                    `A`.`idarquivos`,
                    `A`.`nome`,
                    `A`.`tipo`,
                    `A`.`tamanho`,
                    `A`.`idusuario`,
                    date_format(`A`.`data`,'%d/%m/%y %H:%i:%s') as `data`,
                    `A`.`data` as `dataOrder`,
                    `A`.`ip`,
                    `A`.`browser`,
                    `U`.`login`
                    FROM `" . DB_NAME . "`.`arquivos` `A` inner join `" . DB_NAME . "`.`usuario` `U`
                    on (`U`.`idusuario`=`A`.`idusuario`) 
                    where `A`.`idarquivos` is not null "; //
        $sqlQuery .= $this->montaFiltroPaginacao($arquivoFiltro);

        $sqlQuery .= " order by `dataOrder` DESC";

        $sqlQuery.= " LIMIT " . $primeiroRegistro . "," . $numPorPagina;
//        echo($sqlQuery);
        $rs = $conexao->executeQuery($sqlQuery);
        $arrArquivos = array();
        try {
            $cnt = 1;
            while ($row = mysql_fetch_array($rs)) {
                $arquivo = new Arquivo();
//            $arquivo->setIndex($cnt);
                $arquivo->setIndex($cnt);
                $arquivo->setIdarquivos($row['idarquivos']);
                $arquivo->setNome($row['nome']);
                $arquivo->setTipo($row['tipo']);
                $arquivo->setTamanho($row['tamanho']);
                $arquivo->setIdusuario($row['idusuario']);
                $arquivo->setData($row['data']);
                $arquivo->setIp($row['ip']);
                $arquivo->setBrowser($row['browser']);
                $arquivo->setUsuarioNome($row['login']);
                array_push($arrArquivos, $arquivo);
                $cnt++;
            }
        } catch (Exception $e) {
            die(print_r($e));
        }

        $conexao->desconecta();
        return $arrArquivos;
    }

    //funcao utilizada para aplicar o filtro na pesquisa
    public function montaFiltroPaginacao(Arquivo $arquivoFiltro) {
        $sqlQuery = "";

        if ($arquivoFiltro->getNome() != null) {
            $sqlQuery.=" AND `A`.`nome` LIKE '%" . $arquivoFiltro->getNome() . "%' ";
        }
        if ($arquivoFiltro->getIdusuario() != null) {
            $sqlQuery.=" AND `A`.`idusuario` = " . $arquivoFiltro->getIdusuario() . " ";
        }
        if ($arquivoFiltro->getTipo() != null) {
            $sqlQuery.=" AND `A`.`tipo` = '" . $arquivoFiltro->getTipo() . "' ";
        }

        if ($arquivoFiltro->getData() != null) {
            $sqlQuery.=" AND date_format(`A`.`data`,'%d/%m/%y') = '" . $arquivoFiltro->getData() . "' ";
        }




        return $sqlQuery;
    }

    public function getListaTipoArquivosExistentes() {
        $conexao = new Conexao();
        $sqlQuery = "SELECT DISTINCT `tipo`
                    FROM `" . DB_NAME . "`.`arquivos`";
        $rs = $conexao->executeQuery($sqlQuery);
        $arrArquivos = array();

        while ($row = mysql_fetch_array($rs)) {
            $arquivo = new Arquivo();
            $arquivo->setTipo($row['tipo']);
            array_push($arrArquivos, $arquivo);
        }

        $conexao->desconecta();
        return $arrArquivos;
    }

    public function getListaDatasArquivosExistentes() {
        $conexao = new Conexao();
        $sqlQuery = "SELECT DISTINCT DATE_FORMAT(`data`,'%d/%m/%y') as `data`
                    FROM `" . DB_NAME . "`.`arquivos`";
        $rs = $conexao->executeQuery($sqlQuery);
        $arrArquivos = array();

        while ($row = mysql_fetch_array($rs)) {
            $arquivo = new Arquivo();
            $arquivo->setData($row['data']);
            array_push($arrArquivos, $arquivo);
        }

        $conexao->desconecta();
        return $arrArquivos;
    }

    public function getListaUsuariosArquivosExistentes() {
        $conexao = new Conexao();
        $sqlQuery = "SELECT DISTINCT `A`.`idusuario`,`U`.`login`  from `arquivos` `A` inner join `usuario` `U`
on (`A`.`idusuario`=`U`.`idusuario`)";
        $rs = $conexao->executeQuery($sqlQuery);
        $arrArquivos = array();

        while ($row = mysql_fetch_array($rs)) {
            $arquivo = new Arquivo();
            $arquivo->setIdusuario($row['idusuario']);
            $arquivo->setUsuarioNome($row['login']);
            array_push($arrArquivos, $arquivo);
        }

        $conexao->desconecta();
        return $arrArquivos;
    }

    public function removeArquivos($arquivos) {
        $util = new Utils();
        if (is_array($arquivos)) {

//            print_r($arquivos)."<br>";
            $sqlValues = "";
            try{
            for ($i = 0; $i <= count($arquivos); $i++) {
            
                $sqlValues.=$arquivos[$i] . ",";
                //sql    
            }
            }  catch (Exception $eIgnore){
                // log php notice undefined offset 
            }

            $cleanVars = substr($sqlValues, 0, strlen($sqlValues) - 2);
            $conexao = new Conexao();
            $sqlQuery = sprintf("SELECT
                    `A`.`idarquivos`,
                    `A`.`nome`,
                    `A`.`tipo`,
                    `A`.`tamanho`,
                    `A`.`idusuario` 
            FROM `arquivos` `A` WHERE `A`.idarquivos in(%s) ", $cleanVars);

            $rs = $conexao->executeQuery($sqlQuery);
            $arrArquivos = array();
            $arrErrors = array();

            while ($row = mysql_fetch_array($rs)) {
                $arquivo = new Arquivo();
                $arquivo->setIdusuario($row['idarquivos']);
                $arquivo->setNome($row['nome']);
                $arquivo->setTipo($row['tipo']);
                $arquivo->setTamanho($row['tamanho']);

                $filename = $arquivo->getNome();
                if ($util->verificaArquivoExiste($filename, true)) {
//            if ($util->verificaArquivoExiste($filename, false)){
                    array_push($arrArquivos, $arquivo);
                    $util->removeArquivoFs($filename);
                } else {
                    array_push($arrErrors, $arquivo);
                }
            }

//        to debug  
//        echo "existentes:<br>";    
//        $util->mostraObjeto($arrArquivos);
//        echo "nao existentes:<br>";
//        $util->mostraObjeto($arrErrors);

            $sqlQueryRemove = sprintf("DELETE FROM `arquivos` WHERE idarquivos in(%s) ", $cleanVars);
            try {
                $rsR = $conexao->executeUpdate($sqlQueryRemove);
                $conexao->desconecta();
//                return true;
                return $arrArquivos; // to log
            } catch (Exception $err) {
                print_r($err);
                return false;
            }
        }
    }

    public function addArquivo(Arquivo $arquivo) {

//        print_r($arquivo);
        $conexao = new Conexao();
        $sqlQuery = sprintf("INSERT INTO `arquivos`
                (`nome`,`tipo`,`tamanho`,`idusuario`,`data`,`ip`,`browser`)
                VALUES ('%s','%s',%s,%s,NOW(),'%s','%s')", $arquivo->getNome(), $arquivo->getTipo(), $arquivo->getTamanho(), $arquivo->getIdusuario(), $arquivo->getIp(), $arquivo->getBrowser()
        );

        try {
            $rs = $conexao->executeQuery($sqlQuery);
            $conexao->desconecta();
            return true;
        } catch (Exception $err) {
            print_r($err);
            return false;
        }

    }

}

?>
