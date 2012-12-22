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
//namespace lib;
require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/model/Usuario.class.php');

final class Utils {

    public function Utils() {
        
    }
    public function __construct() {
        
    }
    
    public static function init() {
        
    }
    
    
    public static function mostraObjetoStatic($object) {
//        var_dump($object); 
        echo "<pre style=\"border:solid 1px #EA9C5C; padding:3px; color:#000000; background-color:#ededed \">";
        print_r($object);
        echo "</pre>";
        echo "<hr size=\"1\" width=\"100%\">";
    }
    public function mostraObjeto($object) {
//        var_dump($object); 
        echo "<pre   style=\"border:solid 1px #EA9C5C;  padding:3px; color:#000000; background-color:#ededed \">";
        print_r($object);
        echo "</pre>";
        echo "<hr size=\"1\" width=\"100%\">";
    }

    public function mostraObjetoUser($object) {
        /* @var $object type */
    
        
        echo "<pre class=\"botao\" style=\"border:solid 1px #EA9C5C; padding:3px; color:#000000; background-color:#ededed \">";
//            print_r($object);
//            echo preg_match_all('/=>.*[a-z].?/',$object,$ret);
          if ($object instanceof Arquivo ){
//              print_r($object);
              echo $object->getStatus();
          }
          if ($object instanceof Usuario ){
//              print_r($object);
              $pattern = '/(\d):(\d)/';
              $patternR = '<b><font-color=red></font></b>';
              $subject = $object->getStatus();
//              echo $subject;
//              echo preg_replace($pattern,"<b><font-color=red>$pattern</font></b>", $subject);
              echo preg_replace($pattern,$patternR, $subject);
              
          }
              
//        print_r($ret);
        echo "</pre>";
        echo "<hr size=\"1\" width=\"100%\">";
    }
    public function mostraObjetoArr($object) {
//        var_dump($object); 
        echo "<pre style=\"border:solid 1px #EA9C5C; padding:3px; color:#000000; background-color:#ededed \">";


        if (is_array($object)) {
            foreach ($object as $key => $value) {
//                if (strlen($value) > 0) {
                echo "$key:<b>$value</b> &nbsp;|&nbsp;";
                if (is_array($value)) {
                    foreach ($value as $val) {
                        echo "$value:<b>$val</b> &nbsp;|&nbsp;";
                    }
                }
//                }
            }
        }

        echo "</pre>";
        echo "<hr size=\"1\" width=\"100%\">";
    }

    function includeFile($file) {
        try {
            $fileX = $_SERVER['DOCUMENT_ROOT'] . $file;
            //die($fileX);
            if (file_exists($fileX)) {
                require_once $fileX;
            } else {
                //throw new Exception("Arquivo '$file' n&atilde;o encontrado");
                throw new Exception("A operação deste modulo '$file' ainda  n&atilde;o foi implementada.");
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
    public static function includeFileStatic($file) {
        try {
            $fileX = $_SERVER['DOCUMENT_ROOT'] . $file;
            //die($fileX);
            if (file_exists($fileX)) {
                require_once $fileX;
            } else {
                //throw new Exception("Arquivo '$file' n&atilde;o encontrado");
                throw new Exception("A operação deste modulo '$file' ainda  n&atilde;o foi implementada.");
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function mostraParamPesquisa($object) {
        if (is_array($object)) {
            foreach ($object as $key => $value) {
                if (strlen($value) > 0) {
                    echo "$key:<b>$value</b> &nbsp;|&nbsp;";
                }
            }
        }
    }

    function destaca($x, $y, $upper = false) {
        if ((strlen($x) > 0) && (strlen($y) > 0)) {
//		$y= strtoupper($y);
            $y = ($upper) ? strtoupper($y) : $y;
            $saida = str_replace($y, "<font color=red>" . $y . "</font>", $x);
        } else {
            $saida = $x;
        }

        return $saida;
    }

//<input name="data[acesso]" type="hidden" id="acesso" value="' . $acesso . '" />
    public function montaFormAutoPost($action, $otherVars = array(), $tipoForm = array('data', 'load'), $debug = false) {
        print_r($otherVars);
        $body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=' . CHARSET . '" />
<title>Registrando Opera&ccedil;&atilde;o</title>
</head>"';

        if ($debug) {
            $body.='<body onload=""><!--document.form1.submit() -->';
        } else {
            $body.='<body onload="document.form1.submit()"><!-- -->';
        }

        $body.='<form id="form1" name="form1" method="post" action="' . $action . '">
   \n';
        if (is_array($otherVars) && count($otherVars) > 0) {
            foreach ($otherVars as $key => $value) {

                $body.='<input name="' . $tipoForm[0] . '[' . $tipoForm[1] . '][' . $key . ']" type="hidden" id="' . $key . '" value="' . $value . '" /> \n';
//                }
//                $body.='<input name="'.$tipoForm.'[\'' . $key . '\']" type="hidden" id="' . $key . '" value="' . $value . '" /> \n';
            }
        }

        $body .='\n
</form>
</body>
</html>';

        echo $body;
    }

    function mostraDinheiro($val) {
        if ($val) {
            $valFormatado = 'R$ ' . number_format($val, 2, ',', '.');
        } else {
            $valFormatado = "";
        }

        return $valFormatado;
    }

    function arrumaStr($str, $ucase = 'lower') {
        $str = trim(str_replace(" ", "", $str));
        for ($i = 0; $i < strlen($str); $i++) {
            $Astr[$i] = $str{$i};
        }

        $sem = array("c", "C", "a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "A", "O", "a", "o", "a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "A", "O");
        $com = array("ç", "Ç", "á", "é", "í", "ó", "ú", "Á", "É", "Í", "Ó", "Ú", "Ã", "Õ", "ã", "õ", "`a", "`e", "`i", "`o", "`u", "`A", "`E", "`I", "`O", "`U", "â", "ô", "Â", "Ô");
        $strFinal = implode("", str_replace($com, $sem, $Astr));
        if ($ucase == 'lower') {
            return strtolower($strFinal);
        } else {
            return strtoupper($strFinal);
        }
    }

    public function mostraSQL($sqlQuery) {
        echo "<pre style=\"border:solid 1px #EA9C5C; padding:3px; color:#000000; background-color:#ededed \">";


        echo $sqlQuery;

        echo "</pre>";
        echo "<hr size=\"1\" width=\"100%\">";
    }

    public function mimeToPicture($filename, $mimeType) {

        $prefixIcon = "ico_mime_";
        $icon = 'unknown';
        $arrDoc = array('doc', 'docx');
        $arrXls = array('xls', 'xlsx');
        $arrPpt = array('ppt', 'pptx');
        $arrPdf = array('pdf');
        $arrDb = array('mdb', 'sql', 'mdbx');
        $arrImage = array('jpg', 'jpeg', 'png', 'gif', 'bmp');
        $arrZip = array('zip', 'rar', 'tar', 'gif', 'bmp');

        $preSufix = strtolower(substr($filename, -5));
        if (substr($preSufix, 0, 1) == '.') {
            $sufix = strtolower(substr($filename, -4));
        } else {
            $sufix = strtolower(substr($filename, -3));
        }
//        if (in_array($sufix, $arrImage)){
//                $icon='picture';
//        }

        in_array($sufix, $arrDoc) ? $icon = 'word' : null;
        in_array($sufix, $arrXls) ? $icon = 'excel' : null;
        in_array($sufix, $arrPpt) ? $icon = 'ppt' : null;
        in_array($sufix, $arrPdf) ? $icon = 'pdf' : null;
        in_array($sufix, $arrDb) ? $icon = 'db' : null;
        in_array($sufix, $arrImage) ? $icon = 'picture' : null;
        in_array($sufix, $arrZip) ? $icon = 'zip' : null;

        $finalIcon = $prefixIcon . $icon . '.png';

//        return "<img border=\"0\"  src=\"/html/images/$finalIcon\" title=\"$mimeType\">";
        return "<img border=\"0\"  src=\"".BASE_IMAGES.$finalIcon."\" title=\"$mimeType\">";
    }

    public function getHumanReadableSize($param) {

        if ($param < 1024) {
            return $param . ' B';
        } elseif ($param < 1048576) {
            return round($param / 1024, 2) . ' KiB';
        } elseif ($param < 1073741824) {
            return round($param / 1048576, 2) . ' MiB';
        } elseif ($param < 1099511627776) {
            return round($param / 1073741824, 2) . ' GiB';
        } elseif ($param < 1125899906842624) {
            return round($param / 1099511627776, 2) . ' TiB';
        } elseif ($param < 1152921504606846976) {
            return round($param / 1125899906842624, 2) . ' PiB';
        } elseif ($param < 1180591620717411303424) {
            return round($param / 1152921504606846976, 2) . ' EiB';
        } elseif ($param < 1208925819614629174706176) {
            return round($param / 1180591620717411303424, 2) . ' ZiB';
        } else {
            return round($param / 1208925819614629174706176, 2) . ' YiB';
        }
    }

    public function verificaArquivoExiste($filename,$printImages=true) {
        // echo REPOSITORIO.$filename;
        if (file_exists(REPOSITORIO . $filename)) {
//		echo "valido";
            
            echo $printImages==true ? '<img src="/html/images/ico_ok.png"  alt="OK"  title="OK"/>':'';
            return true;
        } else {
            //	echo "invalido";
            echo $printImages==true ? '<img src="/html/images/ico_attention.png"  alt="Arquivo não existe"  title="Arquivo não existe"/>':'';
            return false;
        }
    }
    
    public function removeArquivoFs($filename){ //remove do FileSystem
        $file = REPOSITORIO . $filename; 
        if (file_exists($file)) {
             
             unlink($file);
         }else{
             
//             echo 'Arquivo nao existe';
         }
            
    }
    
    public function convertObjectToString($object){
//    return ' '.print_r($object).' '; 
        if ($object instanceof Usuario){
            
            return $object->getLogin();
            
            
        }
    
    }

    public function buildResetPassLink() {
        $length=512;

    $_rand_src = array( 
        array(48,57) //digits 
        , array(97,122) //lowercase chars 
        , array(65,90) //uppercase chars 
    ); 
    srand ((double) microtime() * 1000000); 
    $random_string = ""; 
    for($i=0;$i<$length;$i++){ 
        $i1=rand(0,sizeof($_rand_src)-1); 
        $random_string .= chr(rand($_rand_src[$i1][0],$_rand_src[$i1][1])); 
    } 
    return $random_string; 
    } 
        
        
        
        
    

}

?>
