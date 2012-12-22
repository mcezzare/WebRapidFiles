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
@session_start(); 
//if (isset($_SESSION['captcha'])){
//    unset($_SESSION['captcha']);
//}
//header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");  
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");  
header("Cache-Control: no-store, no-cache, must-revalidate");  
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache");  

function _generateRandom($length=6) 
{ 
    $_rand_src = array( 
        array(48,57) //digits 
        , array(97,122) //lowercase chars 
//        , array(65,90) //uppercase chars 
    ); 
    srand ((double) microtime() * 1000000); 
    $random_string = ""; 
    for($i=0;$i<$length;$i++){ 
        $i1=rand(0,sizeof($_rand_src)-1); 
        $random_string .= chr(rand($_rand_src[$i1][0],$_rand_src[$i1][1])); 
    } 
    return $random_string; 
} 

//$im = imagecreatefromjpeg($_SERVER['DOCUMENT_ROOT']."/html/images/captcha.jpg");  
$im = imagecreatefromjpeg($_SERVER["DOCUMENT_ROOT"].BASE_IMAGES."captcha.jpg");  
$rand = _generateRandom(3); 
$_SESSION['captcha'] = $rand; 
ImageString($im, 5, 2, 2, $rand[0]." ".$rand[1]." ".$rand[2]." ", ImageColorAllocate ($im, 0, 0, 0)); 
$rand = _generateRandom(3); 
ImageString($im, 5, 2, 2, " ".$rand[0]." ".$rand[1]." ".$rand[2], ImageColorAllocate ($im, 255, 0, 0)); 
Header ('Content-type: image/jpeg'); 
imagejpeg($im,NULL,100); 
ImageDestroy($im); 
?>