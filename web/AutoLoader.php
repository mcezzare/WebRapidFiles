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
class Autoloader {
    static public function loader($classe) {
        // como chega o nome ao instanciar
        echo ".receiving <b>$classe</b><br>";
        // quero so o qtem apos a utima barra -- ex app\model\Foo
        $nameClassOnly = strpos(strrev($classe), "\\");
        $classeAux = substr($classe, -$nameClassOnly);
        // return only foo
        echo "..would be <b>$classeAux</b>??<br>";
        // acerta as barras p/ funcionar com namespaces
        $finalClass = str_replace('\\', '/', $classe);

        //verifica se o arquivo existe antes de tentar incluir
        if (file_exists($finalClass . '.php')) {
            echo "...including <b>$finalClass.php</b><br>";
            require_once $finalClass . '.php';
//            //registra as classes passando o método statico init
            spl_autoload_register(array($classe, 'init'));
        } else {
            try {
                if (file_exists($finalClass . '.class.php')) {
                    echo "...including <b>$finalClass.class.php</b><br>";
                    require_once $finalClass . '.class.php';
//            //registra as classes passando o método statico init
                    spl_autoload_register(array($classe, 'init'));
                }
            } 
            catch (Exception $E) {
                echo 'no files';
                echo $E->getMessage();
                
//        }
            }
        }
    }
}
spl_autoload_register('Autoloader::loader');
// nao precisa fazer isso pois a chamada acima já cria uma instância dessa classe
//$autoloader = new Autoloader();
   
?>