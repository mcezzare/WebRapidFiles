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
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/model/Arquivo.class.php');
//error_reporting(E_ALL);
class Upload {

    private $path;
    private $name;
    private $direc;
    private $binaryData;
    private $type;
    private $size;

    public function __construct() {
        
    }

    
    
    public function dumpFile($field) {
        try {
            
            $this->name = $_FILES[$field]['name'];
            $this->type = $_FILES[$field]['type'];
            $this->size = $_FILES[$field]['size'];
            $this->binaryData = file_get_contents($_FILES[$field]['tmp_name']);

            return $this;
        } catch (Exception $E) {
            die($E->getMessage());
        }
    }
    public function send($field, $dir) {
        try {
            $this->direc = $dir;
            $this->name = $_FILES[$field]['name'];
            $this->type = $_FILES[$field]['type'];
            $this->size = $_FILES[$field]['size'];
            $this->binaryData = file_get_contents($_FILES[$field]['tmp_name']);

            return (move_uploaded_file($_FILES[$field]['tmp_name'], $this->getPath())) ? true : false;

        } catch (Exception $E) {
            die($E->getMessage());
        }
    }

    public function sendMultiple($field, $dir,$idUsuario) {
//         $this->direc = $dir;
//          $this->name = $_FILES[$field]['name'];
//          $this->type = $_FILES[$field]['type'];
//          $this->size = $_FILES[$field]['size'];
            $arr = array();
        if (isset($_FILES[$field]['error'])) {
            foreach ($_FILES[$field]["error"] as $key => $error) {
                if ($error == UPLOAD_ERR_OK) {
                    
                    $tmp_name = $_FILES[$field]["tmp_name"][$key];
                    $name = $_FILES[$field]["name"][$key];
                    
                    $arquivo = new Arquivo();
                    $arquivo->setNome($this->arrumaStr($name));
                    $arquivo->setTipo($_FILES[$field]["type"][$key]);
                    $arquivo->setTamanho($_FILES[$field]["size"][$key]);
                    $arquivo->setIdusuario($idUsuario);
                    $arquivo->setIp($_SERVER['REMOTE_ADDR']);
                    $arquivo->setBrowser($_SERVER['HTTP_USER_AGENT']);
                    array_push($arr, $arquivo);
//                    move_uploaded_file($tmp_name, $dir . "/" . $this->arrumaStr($name));
                    move_uploaded_file($tmp_name, $dir . "/" . $this->arrumaStr($name));
                }
            }
        }
                    return $arr;
        
    }


    public function getPath() {

        //count_chars($_SERVER['DOCUMENT_ROOT']
        $this->path = $_SERVER['DOCUMENT_ROOT'] . "/" . $this->direc . "/" . $this->arrumaStr($this->name);
        return $this->path;
    }

    public function arrumaStr($str) {
        $str = trim(str_replace(" ", "", $str));
        for ($i = 0; $i < strlen($str); $i++) {
            $Astr[$i] = $str{$i};
        }

        $sem = array("c", "C", "a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "A", "O", "a", "o", "a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "A", "O");
        $com = array("ç", "Ç", "á", "é", "í", "ó", "ú", "Á", "É", "Í", "Ó", "Ú", "Ã", "Õ", "ã", "õ", "`a", "`e", "`i", "`o", "`u", "`A", "`E", "`I", "`O", "`U", "â", "ô", "Â", "Ô");
        $str = implode("", str_replace($com, $sem, $Astr));
        return strtolower($str);
    }

    public function getName() {
        //return strstr($this->path, $this->direc);
        return $this->arrumaStr($this->name);
    }

//    public function getType() {
//
//        return $this->type;
//    }
//
//    public function getSize() {
//
//        return $this->size;
//    }

    public function getBinaryData() {
        return $this->binaryData;
    }

    public function setBinaryData($binaryData) {
        $this->binaryData = $binaryData;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getSize() {
        return $this->size;
    }

    public function setSize($size) {
        $this->size = $size;
    }

}

//$up = new upload;
?>