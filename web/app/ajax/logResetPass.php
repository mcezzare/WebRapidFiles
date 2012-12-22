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
error_reporting('E_ALL');
@session_start();

require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/config.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/lib/block.php');

require_once ($_SERVER['DOCUMENT_ROOT'] . '/lib/Utils.class.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/app/model/Usuario.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/model/Logger.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/controller/LoggerController.php');

$logC = new LoggerController();
$log = new Logger();
$util = new Utils();

$usuario = new Usuario();
$usuario->setId($_SESSION['usuario']['id']);
?>
<a href="#" id="fechaPainel">Fechar</a>
<script language="javascript">
    $(document).ready(function(){
                
        $('a#fechaPainel').click(function(){
            $('div#logTentativas').empty();
            $('div#logTentativas').slideUp();
        })
    });
</script>
<?
$arrLogs = $logC->getResetPassLogs($usuario);
$totalLogs = count($arrLogs);
//$util->mostraObjeto($arrLogs);
?>
<div id="divLogs" style="visibility: visible">
    <div class="datagrid">
        <table id="tabelaLogsUser">
            <thead>
                <tr>
                    <th colspan="2" style="text-align: center" class="tituloTab">Tentativas de troca de senha</th>

                </tr>
                <tr>
                    <th>Data</th>
                    <th>Info</th>
                </tr>
            </thead>
            <tbody>
                <?
                if ($totalLogs > 0) {
                    for ($i = 0; $i < $totalLogs; $i++) {
                        if ($arrLogs[$i] instanceof Logger) {

//                                $idLog = $arrLogs[$i]->getId();
                            $data = $arrLogs[$i]->getData();
                            $info = $arrLogs[$i]->getObjectStored();
                            ?>
                            <tr>
                                <td>
                                    <? echo $data; ?>
                                </td>
                                <td>
                                    <? echo $info; ?>
                                </td>
                            </tr>

                        <? }
                    }
                } ?>
            </tbody>

        </table>

        </form> 
    </div>    
</div>