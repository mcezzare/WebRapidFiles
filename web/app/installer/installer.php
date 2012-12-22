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
@session_start();

require_once($_SERVER['DOCUMENT_ROOT'] . "/app/installer/check.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/lib/config.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/lib/Utils.class.php");
$util = new Utils();


if (isset($_POST['config']['login']) && isset($_POST['config']['senha'])) {
    $login = $_POST['config']['login'];
    $senha = $_POST['config']['senha'];



    if (($login == $config->getConfigAdminLogin()) && ($senha == $config->getConfigAdminSenha())) {
        $_SESSION['config']['autenticado'] = true;
    }
}

class Setup {

    private $erros;

    public function __construct() {
        $this->erros = array('Nº' => 'Motivo');
    }

    public function getErros() {
        return $this->erros;
    }

    public function setErros($erros) {
        $this->erros = $erros;
    }

    public function addErro($erroN, $erroMotivo) {
        array_push($this->erros, array($erroN => $erroMotivo));
    }

    public function test($var, $erroN, $erroMotivo) {
        if ($var) {
            return $this->ok();
        }
        return $this->notOk($erroN, $erroMotivo);
    }

    public function ok() {
        return "<span style='color:green'>ok</span>";
    }

    public function notOk($erroN, $erroMotivo) {

        $this->addErro($erroN, $erroMotivo);
        return "<span style='color:red'>não</span>";
    }

}

$s = new Setup();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=<? echo CHARSET; ?>" />
        <title><? echo TITULO; ?></title>
        <link href="<? echo BASE_STYLES; ?>custom.css.php" rel="stylesheet" type="text/css" />
        <link href="<? echo BASE_STYLES; ?>validation.css" rel="stylesheet" type="text/css" />
        <script language="javascript" src="<? echo BASE_SCRIPTS; ?>libs/jquery/jquery-1.7.2.js"></script>
        <script language="javascript" src="<? echo BASE_SCRIPTS; ?>libs/jquery/jquery.validate.js"></script>
        <script language="javascript">
            $(document).ready(function(){ 
                $('#formLogin').validate();
            
                
                
                $('a#linkConfig').toggle(
                function (){
                    $('#divConfig').slideDown();    
                },
                function (){
                    $('#divConfig').slideUp();    
                })
            
            
            })     
        </script>
           <style type="text/css">
            body{
                font-size: 90%;
            }
        </style>
    </head>
    <body>

        <fieldset class="borda">
            <legend class="tituloTab"> <a><img width="32" height="32" src="<? echo BASE_IMAGES; ?>ico_lock.png"></img>Instalador Rapid Files </a> </legend>

            <? if (isset($_SESSION['config']['autenticado'])) { ?>

                <div id="separator" style="height: 20px"></div>         

                <fieldset id="fldConfig" class="borda">
                    <legend class="tituloTab"> <img width="32" height="32" src="<? echo BASE_IMAGES; ?>config.png"></img><a href="#" id="linkConfig">Configuração e Tests</a> </legend>
                    <div id="divConfig">

                        <fieldset id="fldConfiguracao" class="borda">
                            <legend class="tituloTab"> <a>Configuração</a> </legend>
                            Essa configuração está  no arquivo /lib/config.php. Ajuste-o para o seu ambiente, e <a href="<? echo $_SERVER['SCRIPT_NAME'];?>">atualize essa página</a>.
                            <? $util->mostraObjeto($config); ?>
                        </fieldset>
                   
                    </div>
                </fieldset>
                     <div id="separator"> </div>
                        <fieldset id="fldTests1" class="borda">
                            <legend class="tituloTab"> <a>Tests 1</a> </legend>
                            <div id="divTests1"> 
                                <?
//    $arrErros = array();
//    $erro = 0;
//    $ok = $s->ok();
//    $notOk = notOk();
                                $suportMysql = function_exists('mysql_connect');
                                ?>
                                <legend><a>Básico:</a></legend>
                                <b>Versão:</b><?
                            echo PHP_VERSION_ID . "&nbsp";
//                            echo PHP_VERSION_ID > 5 ? $ok : $notOk;
                            echo $s->test(PHP_VERSION_ID > 5, '1', 'Versão');
                                ?><br />

                                <b>Suporte ao Mysql:</b><? echo $s->test($suportMysql, '2', 'Mysql Support'); ?><br />
                                <b>Repositorio</b>:<? echo REPOSITORIO; ?>&nbsp<? echo $s->test(file_exists(REPOSITORIO), '3', 'Repositorio'); ?><br />  
                                <b>Repositorio permite escrita:</b>:
                                <?
                                echo substr(sprintf('%o', fileperms(REPOSITORIO)), -4) . "&nbsp";
                                echo $s->test(substr(sprintf('%o', fileperms(REPOSITORIO)), -4) == '0777', '3', 'Permissões');
                                ?>
                                <legend><a>Database:</a></legend>
                                <b>Conexao ao DB:</b>
                                <?
                                $conRoot = mysql_connect(DB_HOST, DB_USER, DB_PASS);
                                echo $s->test(mysql_select_db(DB_NAME, $conRoot), '4', 'DB access');
                                ?><br />
                                <b>Tabelas DB:</b><br />
                                <?
                                $sql = "SHOW TABLES";
                                $rs = mysql_query($sql);
                                $tables = array('acao', 'arquivos', 'grupo_usuario', 'site_log', 'usuario');
                                while ($row = mysql_fetch_array($rs)) {

                                    echo $row[0] . "&nbsp;";
                                    echo $s->test(in_array($row[0], $tables), '5', 'TabelaDB:' . $row[0]) . "<br>";
                                }
                                ?>
                            </div>
                        </fieldset>
                <div id="separator"> </div>
                <fieldset id="fldTests2" class="borda">
                    <legend class="tituloTab"> <a>Tests 2</a> </legend>
                    <div id="divTests2">
                        <legend><a>Usuários:</a></legend>
                        <?
                        require_once($_SERVER['DOCUMENT_ROOT'] . '/app/model/Usuario.class.php');
                        require_once($_SERVER['DOCUMENT_ROOT'] . '/app/controller/UsuarioController.php');
                        $usuarioC = new UsuarioController();
//          $usuario = new Usuario();
                        require_once($_SERVER['DOCUMENT_ROOT'] . '/app/controller/GrupoController.php');
                        $grupoC = new GrupoController();
//          $usuario = new Usuario();
//          $usuarioC->getTotalUsuarios();
                        ?>                 <b>Usuarios do sistema:</b><? echo $usuarioC->getTotalUsuarios(); ?> <br />      
                        <b>Usuario admin:</b><?
                    $findLogin = $usuarioC->findLogin('admin', true);
                    echo $s->test($findLogin->getId() != 0, '6', 'Admin nao cadastrado');
                        ?> <br />      
                        <b>Grupos do sistema:</b><? echo count($grupoC->getGrupos()); ?> 
                        <? echo $s->test(count($grupoC->getGrupos()) > 0, '7', 'Grupos nao cadastrado'); ?> <br />      
                        <br />      



                    </div> 
                </fieldset>



                <div id="separator"> </div>
                <fieldset id="fldErros" class="borda">
                    <legend class="tituloTab"> <a>Erros</a> </legend>
                    <div id="divErros">
                        <? echo count($s->getErros()) > 1 ? $util->mostraObjeto($s->getErros()) : 'Sem erros'; ?>
                    </div> 
                </fieldset>

            <? } //se nao tiver logado 
            else { ?>
                <fieldset id="fldLogin" class="borda">
                    <legend class="tituloTab"> <a>Login do Admin</a> </legend>
                    <div id="divTests" class="datagrid">

                        <form id="formLogin" class="formStyle3" method="post" action="<? echo $_SERVER['SCRIPT_NAME']; ?>">
                            <div style="display: inline-block"><label for="login" >Login:</label><input type="text" name="config[login]" id="login"  class="required"  /></div>
                            <div style="display: inline-block"><label for="senha">Senha:</label><input type="password" name="config[senha]" id="senha" class="required" /></div>
                            <div><button id="loga" class="botaoMenor" type="submit">Iniciar </button></div>
                        </form>
                     </div> 
                </fieldset>        
                <!--//end config-->
            <? } ?>



        </fieldset>

    </body>
</html>
