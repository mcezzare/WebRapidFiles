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
require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/Utils.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/Conexao.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/model/Arquivo.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/dao/ArquivoDAO.php');

class ArquivoController {

    public function __construct() {
        
    }

//    public function getArquivos() {
    public static function getArquivos() {
        $arqDAO = new ArquivoDAO();
        $arrArquivos = $arqDAO->getListaArquivos();
        return $arrArquivos;
    }

    public function getArquivosPaginados($primeiroRegistro, $numPorPagina, Arquivo $arquivoFiltro, $order = 1) {
        $arqDAO = new ArquivoDAO();
        $arrArquivos = $arqDAO->getListaArquivosPaginados($primeiroRegistro, $numPorPagina, $arquivoFiltro, $order);
        return $arrArquivos;
    }

    public function getTotalArquivos(Arquivo $arquivoFiltro) {
        $arqDAO = new ArquivoDAO();
        $total = $arqDAO->getTotalArquivos($arquivoFiltro);
        return $total;
    }

    public function getTipoArquivosExistentes() {
        $arqDAO = new ArquivoDAO();
        $arrTipos = $arqDAO->getListaTipoArquivosExistentes();
        return $arrTipos;
    }

    public function getDatasArquivosExistentes() {
        $arqDAO = new ArquivoDAO();
        $arrDatas = $arqDAO->getListaDatasArquivosExistentes();
        return $arrDatas;
    }

    public function getUsuariosArquivosExistentes() {
        $arqDAO = new ArquivoDAO();
        $arrUsers = $arqDAO->getListaUsuariosArquivosExistentes();
        return $arrUsers;
    }

    public function removeArquivosExistentes($arquivos) { //array arquivos
        $arqDAO = new ArquivoDAO();
        $arrArquivosRemovidos = $arqDAO->removeArquivos($arquivos);
        return $arrArquivosRemovidos;
    }

    public function adicionaArquivo(Arquivo $arquivo) {
        $arqDAO = new ArquivoDAO();
        return $arqDAO->addArquivo($arquivo);
    }

    public function getArquivosFs() {
        $dir = opendir(REPOSITORIO);
        $arr_files = array();
        if ($dir) {
            $oculto = array(".", "..", "listall.php", ".htaccess", ".index.php.swp");


            while ($conteudo = readdir($dir)) {
                if (!in_array($conteudo, $oculto))
                    array_push($arr_files, $conteudo);
            }
        }
        closedir($dir);
        return $arr_files;
    }

    public function getArquivosNaoCatalogados() {
        $arrArquivosFs = $this->getArquivosFs();
//        $totalArquivosFs = count($arrArquivosFs);
        $arrArquivos = $this->getArquivos();
//        $totalArquivos = count($arrArquivos);

        $arrArquivosNames = array();
        $tmp = new Arquivo();
        foreach ($arrArquivos as $tmp) {
            array_push($arrArquivosNames, utf8_encode($tmp->getNome()));
        }
        ksort($arrArquivosFs);
        ksort($arrArquivosNames);
        $arrDiff = array();
        foreach ($arrArquivosFs as $tmp2) {
            //echo $tmp2."<br>";
            if (in_array($tmp2, $arrArquivosNames)) {
//        echo "existe";
            } else {
                array_push($arrDiff, $tmp2);
            }
        }
        asort($arrDiff);
        return $arrDiff;
        
    }
    
    public function removeArquivosFs($arquivos) { //array arquivos
        $util = new Utils();
        if (is_array($arquivos)){
            for ($i=0;$i<count($arquivos);$i++){
                $filename=$arquivos[$i];
                $util->removeArquivoFs($filename);
                
            }
  
        }
        return $arquivos;
        
    }

    
}

?>
