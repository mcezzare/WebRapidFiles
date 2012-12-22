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
require_once('config.php');
/*
  @arquivo = /lib/Conexao.php
  MVC :  controller
  objeto : Conexao
  obs : arquivo em uso na versão corrente
 */
 
Class Conexao {
 
    var $host;
    var $user;
    var $pass;
    var $dbname;
    var $data;
    var $db;
    var $saida;
    var $status;
    var $entrada;
 
    public function __construct() {
        $this->conecta();
    }
    
    public function __destruct() {
         if ($this->status == 1) {
             $this->desconecta();
         }
        
    }
//    function Conexao() {
//        
//         
//    }
 
    public function conecta() {
        $this->status = 0;
//        $this->host = "localhost";
//        $this->user = "delageuploads";
//        $this->pass = "T9CwntJQ9DzZaGSG";
//        $this->dbname = "delageuploads";
        $this->host = DB_HOST;
        $this->user = DB_USER;
        $this->pass = DB_PASS;
        $this->dbname = DB_NAME;
        $this->db = mysql_connect($this->host, $this->user, $this->pass);
 
        if (!$this->db) {
//  echo "Erro ao conectar no banco".trigger_error(mysql_error(),E_USER_ERROR);
            echo "Erro ao conectar no banco" . mysql_error();
        } else {
            //echo "Conectado no banco";
            $this->status = 1;
        }
        mysql_select_db($this->dbname, $this->db);
        mysql_set_charset('utf8');
    }
 
    public function executeQuery($query) {
        if ($this->status == 1) {
            //echo "lista...";
            if ($this->saida = mysql_query($query)) {
                // echo 'Rs loaded';
                return $this->saida;
            } else {
                echo "<pre class=\"error\">";
                echo "SQL ERROR: " . mysql_error();
                echo "SQL : " . $query;
                echo "</pre>";
//                desconecta();
            }
        }
    }
 
    public function executeUpdate($query) {
        if ($this->status == 1) {
            if ($this->entrada = mysql_query($query)) {
                return true;
            } else {
                echo "<pre class=\"error\">";
                echo "SQL ERROR: " . mysql_error();
                echo "</pre>";
                desconecta();
                return false;
            }
        }
    }
 
    function desconecta() {
        if ($this->status == 1){
        $this->status=0;
        return mysql_close($this->db);
        }
        
    }
 
}
 
?>