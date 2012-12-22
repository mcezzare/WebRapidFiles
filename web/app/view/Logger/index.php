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

class IndexLogger{
    
}
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/model/Arquivo.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/controller/ArquivoController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/FormUtils.php');
//$util = new Utils();
//$arqC = new ArquivoController();
$logC = new LoggerController();
$log = new Logger();
$FU = new FormUtils();
//$arrLogs = $logC->getLogs($log);
//print_r($arrLogs);
?>
<!-- date picker -->
<?
include_once($_SERVER['DOCUMENT_ROOT'] . '/pages/javascriptDatePicker.php');
?>    
<script>
    $(function() {
        $("#dataStart").datepicker({ dateFormat: "dd/mm/yy" });
        $("#dataEnd").datepicker({ dateFormat: "dd/mm/yy" });
        
    });
</script>
<!-- end date picker -->
<script language="javascript">
    $(document).ready(function(){ 
        // so p/ iniciar         
        $('#btNULL').click(function(){
            //            jQuery.fn.atualizaTabela(1,20);
            $('#tabela').load('/app/ajax/logs.php');
        });
        //paineis 
        $('a#linkArq').toggle(
        function (){
            $('div#divLogs').slideDown();    
        },
        function (){
            $('div#divLogs').slideUp();    
        })
        $('a#btMostraFiltro').toggle(
        function (){
            $('div#pesquisa').slideDown();    
        },
        function (){
            $('div#pesquisa').slideUp();    
        })
        //form busca
        $('#btResetFiltros').click(
        function(){
            $('#formFiltro').jQuery.fn.reset();
        });

        $('#btFiltra').click(
        function(){
            jQuery.fn.atualizaTabela(1,$('#pagesize').val());  
        });
        
        $('#formFiles').keyup(function(e) {
            //alert(e.keyCode);
            if(e.keyCode == 13) {
                //		alert('Enter key was pressed.');
                event.preventDefault();
                jQuery.fn.atualizaTabela(1,$('#pagesize').val());  
            }
        })
        
        
        jQuery.fn.atualizaTabela = function(pagina,pagesize){
            //            var itensN = $('#pagesize').val();
            
            $('#carregandoLogs').slideDown();
            $('#carregandoLogs').fadeTo("slow", 1).animate({opacity: 1.0}, 700).fadeTo("slow", 0);
            //simple
            //            $('#tbLogs').load('/app/ajax/arquivos.php?pagina=<? //echo $pagina;       ?>');
            //            var pagina = $('#paginaAtual').val();
            //            var dataString="pagina=<? // echo $pagina;       ?>";
            var dataString="pagina="+pagina
                +"&pagesize="+pagesize
                +"&logData="+ $('#fltData').val()
                +"&logData1="+ $('#dataStart').val()
                +"&logData2="+ $('#dataEnd').val()
                +"&logGrupo="+ $('#fltGrupo').val()
                +"&logAcao="+ $('#fltAcao').val()
                +"&logUsuario="+ $('#fltUsuario').val();
                
            //            $('#tabela').load('/app/ajax/logs.php?'+dataString);  
            $.post('/app/ajax/logs.php',dataString,
            function (data){
                //                alert(data);
                $('#tabela').empty();
                $('#tabela').html(data);  
            }
        );
    
            $('#carregandoLogs').slideUp();
        }
        
        jQuery.fn.removeLog = function(index,chave){
            if (confirm('Deseja remover o log: '+index + '?')){
                var dataString="log[exclusao][exclusao]=true"
                    + '&log[exclusao][chave]='+chave
                    +'&logs='+ $('#log').val();
                $.post('/app/controller/PostController',dataString,
                function (data){
                    $('#tabela').empty();
                    
                    $('div#resultado').html(data);
                    $('#carregandoArquivos').slideDown();
                    $('#carregandoArquivos').fadeTo("slow", 1).animate({opacity: 1.0}, 1000).fadeTo("slow", 0);
                    $('#tabela').load('/app/ajax/logs.php');
                    $('#carregandoArquivos').slideUp();
                    
                }
            );
            }
        }
        //dicas   
        $('#fltUsuario').focus(
        function(){
            $('div#dicaUsuario').slideDown();
        });
        
        $('#fltUsuario').blur(
        function(){
            $('div#dicaUsuario').slideUp();
        });
        $('#fltGrupo').focus(
        function(){
            $('div#dicaGrupo').slideDown();
        });
      
        $('#fltGrupo').blur(
        function(){
            $('div#dicaGrupo').slideUp();
        });


        $('#fltData').focus(
        function(){
            $('div#dicaData').slideDown();
        });
      
        $('#fltData').blur(
        function(){
            $('div#dicaData').slideUp();
        });
        
        $('#fltAcao').focus(
        function(){
            $('div#dicaAcao').slideDown();
        });
      
        $('#fltAcao').blur(
        function(){
            $('div#dicaAcao').slideUp();
        });
        $('#dataStart').focus(
        function(){
            $('div#dicaDatas').slideDown();
        });
      
        $('#dataStart').blur(
        function(){
            $('div#dicaDatas').slideUp();
        });
        $('#dataEnd').focus(
        function(){
            $('div#dicaDatas').slideDown();
        });
      
        $('#dataEnd').blur(
        function(){
            $('div#dicaDatas').slideUp();
        });
        
        
        
        
        
    })
</script>

<fieldset id="flLogger">

    <legend class="tituloTab">
        <a href="#" id="linkArq" class="tituloTab"><img src="<? echo BASE_IMAGES; ?>database_table.png" >Logs </a>
    </legend>
    <div>
        <form class="formStyle3">
            <a>Itens por p&aacute;gina:</a> <select id="pagesize" onchange=" jQuery.fn.atualizaTabela(1,this.value);">
                <? for ($x = 10; $x <= 100; $x++) { ?>
                    <option value="<? echo $x; ?>" <? echo $x == 20 ? "selected=\"SELECTED\"" : ''; ?>><? echo $x; ?></option>
                    <?
                    $x = $x + 9;
                }
                ?>
            </select>

        </form>
    </div>

    <div align="center" id="carregandoLogs" style="display:none;position: fixed ; width: 60%;" class="msg">
        <img src="<? echo BASE_IMAGES; ?>ajax-loader.gif">Aguarde.. atualizando logs
    </div>
    <div> 
        <fieldset id="fldLogger">
            <legend class="tituloTab">
                <a href="#" id="btMostraFiltro" class="tituloTab"><img src="<? echo BASE_IMAGES; ?>filter-1.png" >Filtro</a>
            </legend>
            <div id="pesquisa" style="display: none;" class="datagrid">


                <center>
                    <form class="formBusca" id="formFiltro">
                        <table class="borda" width="95%">
                            <thead>
                                <tr>
                                    <th colspan="4">Filtrar lista</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th colspan="4" style="height: 30px;">
                            <div id="dicaData" style="display:none">Data do Log</div>
                            <div id="dicaDatas" style="display:none">informe data inicial e final para filtrar os resultados</div>
                            <div id="dicaAcao" style="display:none">Apenas a&ccedil;&otilde;es que est&atilde;o nos Logs</div>


                            <div id="dicaUsuario" style="display:none">Apenas usu&aacute;rios que est&atilde;o nos Logs</div>
                            <div id="dicaGrupo" style="display:none">Apenas grupos que est&atilde;o nos Logs</div>
                            </th>
                            </tr>
                            <tr>
                                <th>Data</th>
                                <td>
                                    <?
                                    $arrD = $logC->getDatasLogsExistentes();
                                    $FU->buildSelect($arrD, 'logs', 0, 'fltData');
                                    ?>
                                </td>
                                <th>Usuario</th>
                                <td>
                                    <?
                                    $arrU = $logC->getUsuariosLogsExistentes();
                                    $FU->buildSelect($arrU, 'users_logs', 0, 'fltUsuario');
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Ação</th>
                                <td>
                                    <?
                                    $arrA = $logC->getAcoesExistentes();
                                    $FU->buildSelect($arrA, 'acoes_logs', 0, 'fltAcao');
                                    ?>

                                </td>
                                <th>Grupo</th>
                                <td>
                                    <?
                                    $arrG = $logC->getGruposExistentes();
                                    $FU->buildSelect($arrG, 'grupos_logs', 0, 'fltGrupo');
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th colspan="4"><hr size="1" width="100%" color="#CC6600"></th>
                            </tr>
                            <tr>

                                <th>Data Inicial</th>
                                <td><input type="text" id="dataStart" /></td>

                                <th>Data Final</th>
                                <td><input type="text" id="dataEnd" /></td>   
                            </tr>
                            <tr>
                                <th colspan="5" align="center">
                                    <button type="button" class="botaoMenor" name="btFiltra" id="btFiltra" > <img  src="<? echo BASE_IMAGES; ?>filter-add.png" alt="" width="8" height="8" />Filtrar </button>
                                    <button type="reset" class="botaoMenor" name="btResetFiltros" id="btResetFiltros" > <img  src="<? echo BASE_IMAGES; ?>filter-delete.png" alt="" width="8" height="8" />Limpar </button>
                                </th>
                            </tr>

                            </tbody>
                        </table>

                    </form>
                </center>
        </fieldset>
    </div>
    <div>        
        <div id="divLogs" style="visibility: visible">
            <div class="datagrid">
                <form id="formFiles" method="POST" action="/app/controller/PostController.php">
                    <table id="tabela">
                        <thead>
                            <tr></tr>
                        </thead>
                        <tbody>
                            <tr></tr>
                        </tbody>

                    </table>

                </form> 
            </div>    
        </div>
        <button id="btNULL" style="display: none;" ></button>
    </div>
    <div id="resultado" style="display: none">

    </div>        
</fieldset>
<script lang="javascript">
    $(function () {
        //        $('#paginaAtual').val(1);
        $('#btNULL').click();
        //    jquery.fn.atualizaTabela();
    });
</script>
