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
//$grupos=array(1,2, 3);
class IndexArquivos{
    
}

include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/block.php');

$util = new Utils();
//$util->mostraObjeto($arquivos);
$arqC = new ArquivoController();
$arquivo = new Arquivo();
$totalArquivos = $arqC->getTotalArquivos($arquivo);
$totalArquivosFS = count($arqC->getArquivosFs());
?>

<script language="javascript">
    $(document).ready(function(){ 
        
        //funcoes  
        jQuery.fn.removeArquivo = function(index,chave,nomeArquivo){
            if (confirm('Deseja remover o arquivo: '+index + ' '+ nomeArquivo+ '?')){
                var dataString="arquivo[exclusao][exclusao]=true"
                    + '&arquivo[exclusao][chave]='+chave;
                $.post('/app/controller/PostController',dataString,
                function (data){
                    $('#tabela').empty();
                    //                    $('#tbArquivos').html(data);
                    $('#carregandoArquivos').slideDown();
                    $('#carregandoArquivos').fadeTo("slow", 1).animate({opacity: 1.0}, 1000).fadeTo("slow", 0);
                    $('#tabela').load('/app/ajax/arquivos.php');
                    $('#carregandoArquivos').slideUp();
                    
                }
            );
            }
        }
        
        jQuery.fn.atualizaTabela = function(pagina,pagesize){
            //            var itensN = $('#pagesize').val();
            
            $('#carregandoArquivos').slideDown();
            $('#carregandoArquivos').fadeTo("slow", 1).animate({opacity: 1.0}, 700).fadeTo("slow", 0);
            //simple
            //            $('#tbArquivos').load('/app/ajax/arquivos.php?pagina=<? //echo $pagina;   ?>');
            //            var pagina = $('#paginaAtual').val();
            //            var dataString="pagina=<? // echo $pagina;   ?>";
            var dataString="pagina="+pagina
                +"&pagesize="+pagesize
                +"&arqNome="+$('#fltNome').val()
                +"&arqTipo="+$('#fltTipo').val()
                +"&arqData="+$('#fltData').val()
                +"&arqUser="+$('#fltUsuario').val();
                
                $('#tabela').load('/app/ajax/arquivos.php?'+dataString);  
//            $.post('/app/ajax/arquivos.php',dataString,
//               function (data){
//                    //                alert(data);
//                    $('#tabela').empty();
//                    $('#tabela').html(data);  
//                }
//            );
    
            $('#carregandoArquivos').slideUp();
        }
        
        
        // so p/ iniciar         
        $('#btNULL').click(function(){
//            jQuery.fn.atualizaTabela(1,20);
            $('#tabela').load('/app/ajax/arquivos.php');
        });
        //
        //                
        //dicas
        $('#fltNome').focus(
        function(){
            $('div#dicaNome').slideDown();
        }  
    );
        
        $('#fltNome').blur(
        function(){
            $('div#dicaNome').slideUp();
        }  
    );
        
        $('#fltTipo').focus(
        function(){
            $('div#dicaTipo').slideDown();
        }  
    );
        
        $('#fltTipo').blur(
        function(){
            $('div#dicaTipo').slideUp();
        }  
    );
        
        $('#fltData').focus(
        function(){
            $('div#dicaData').slideDown();
        }  
    );
        
        $('#fltData').blur(
        function(){
            $('div#dicaData').slideUp();
        }  
    );
        
        $('#fltUsuario').focus(
        function(){
            $('div#dicaUsuario').slideDown();
        }  
    );
        
        $('#fltUsuario').blur(
        function(){
            $('div#dicaUsuario').slideUp();
        }  
    );
        //paineis 
        $('a#linkArq').toggle(
        function (){
            $('div#divArquivos').slideDown();    
        },
        function (){
            $('div#divArquivos').slideUp();    
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
            });
//        $('a#linkNaoCatalogados').toggle(
//        function (){
//            $('div#divArquivosNG').slideDown();    
//        },
//        function (){
//            $('div#divArquivosNG').slideUp();    
//        })    
        $('a#linkGeral').toggle(
        function (){
            $('div#divGeral').slideDown();    
        },
        function (){
            $('div#divGeral').slideUp();    
        })    

        
    });
</script>


<fieldset id="flgeral">
      <legend class="tituloTab">
        <a href="#" id="linkGeral" class="tituloTab"><img src="<? echo BASE_IMAGES; ?>folder_page.png" >Arquivos</a>
    </legend>
    <div id="divGeral">
     <fieldset class="borda" id="info">
         Total de Arquivos no catálogo :<b><? echo $totalArquivos ;?></b> <div id="infoText">(Uploads registrados)</div> <br>
         Total de Arquivos no repositório :<b> <? echo $totalArquivosFS ;?></b><div id="infoText">(lista total)</div><br>
         Total de Arquivos não catalogados :<b> <? echo $totalArquivosFS - $totalArquivos;?></b><div id="infoText">(Uploads não registrados)</div> 
         &nbsp;&nbsp;<a id="mostrarDiff" href="<? echo $_SESSION['usuario']['view']?>?section=arquivos&action=arquivosOutCatalog">Mostrar Arquivos</a>
        
    </fieldset>
    
<!--<fieldset id="flNaoCatalogados">

    <legend class="tituloTab">
        <a href="#" id="linkNaoCatalogados" class="tituloTab"><img src="<? echo BASE_IMAGES; ?>folder_page.png" >Não Catalogados</a>
    </legend>
    
        <div id="divArquivosNG" style="visibility: visible">
        <div class="datagrid">
            <form id="formFilesNG" method="POST" action="/app/controller/PostController.php">
                <table id="tabelaNG">
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
    
    
</fieldset>  -->


<fieldset id="flPesquisa">

    <legend class="tituloTab">
        <a href="#" id="linkArq" class="tituloTab"><img src="<? echo BASE_IMAGES; ?>folder_page.png" >Catalogados</a>
    </legend>
    <div>
        <form class="formStyle3">
            <a>Itens por p&aacute;gina:</a> <select id="pagesize" onchange=" jQuery.fn.atualizaTabela(1,this.value);">
                <? for ($x = 10; $x <= 100; $x++) { ?>
                    <option value="<? echo $x; ?>" <? echo $x==20?"selected=\"SELECTED\"":''; ?>><? echo $x; ?></option>
                    <?
                    $x = $x + 9;
                }
                ?>
            </select>
           
        </form>
    </div>

    <div align="center" id="carregandoArquivos" style="display:none;position: fixed ; width: 60%;" class="msg">
        <img src="<? echo BASE_IMAGES; ?>ajax-loader.gif">Aguarde.. atualizando arquivos
    </div> 
    <fieldset id="fldPesquisa">
        <legend class="tituloTab">
            <a href="#" id="btMostraFiltro" class="tituloTab"><img src="<? echo BASE_IMAGES; ?>filter-1.png" >Filtro</a>
        </legend>
        <div id="pesquisa" style="display: none;" class="datagrid">


            <center>
                <form class="formBusca" id="formFiltro">
                    <table class="borda" width="95%">
                        <thead>
                            <tr>
                                <th colspan="8">Filtrar lista</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th colspan="2"><div id="dicaNome" style="display:none">Parte de nome de arquivo</div></th>
                        <th colspan="2"><div id="dicaTipo" style="display:none">Xls,Doc,Ppt,Pdf,Jpg,outros</div></th>
                        <th colspan="2"><div id="dicaData" style="display:none">Data do Upload</div></th>
                        <th colspan="2"><div id="dicaUsuario" style="display:none">Apenas usu&aacute;rios que fizeram upload</div></th>
                        </tr>
        <!--                <tr>
                            <td colspan="9">&nbsp;</td>
                        </tr>-->

                        <tr>
                            <th>Nome</th>
                            <td><input type="text" id="fltNome" name="" size="15" ></td>

                            <th>Tipo</th>
                            <td>
                                <select id="fltTipo" name="">
                                    <option value="0">...</option>
                                    <?
                                    $arrT = $arqC->getTipoArquivosExistentes();
                                    $tipo = new Arquivo();
                                    foreach ($arrT as $tipo) {
                                        ?>
                                        <option value="<? echo $tipo->getTipo(); ?>"><? echo $tipo->getTipo(); ?></option>  
                                    <? }
                                    ?>
                                </select>

                            </td>
                            <th>Data</th>
                            <td>
                                <select id="fltData" name="">
                                    <option value="0">...</option>
                                    <?
                                    $arrD = $arqC->getDatasArquivosExistentes();
                                    $data = new Arquivo();
                                    foreach ($arrD as $data) {
                                        ?>
                                        <option value="<? echo $data->getData(); ?>"><? echo $data->getData(); ?></option>  
                                    <? }
                                    ?>
                                </select>

                            </td>
                            <th>Usuario</th>
                            <td>
                                <select  id="fltUsuario" name="">
                                    <option value="0">...</option>
                                    <?
                                    $arrU = $arqC->getUsuariosArquivosExistentes();
                                    $usuario = new Arquivo();
                                    foreach ($arrU as $usuario) {
                                        ?>
                                        <option value="<? echo $usuario->getIdusuario(); ?>"><? echo $usuario->getUsuarioNome(); ?></option>  
                                    <? }
                                    ?>   
                                </select></td>
                        </tr>
                        <tr>
                            <th colspan="8" align="center">
                                <button type="button" class="botaoMenor" name="btFiltra" id="btFiltra" > <img  src="<? echo BASE_IMAGES; ?>filter-add.png" alt="" width="8" height="8" />Filtrar </button>
                                <button type="reset" class="botaoMenor" name="btResetFiltros" id="btResetFiltros" > <img  src="<? echo BASE_IMAGES; ?>filter-delete.png" alt="" width="8" height="8" />Limpar </button>
                            </th>
                        </tr>

                        </tbody>
                    </table>

                </form>
            </center>
    </fieldset>

<div>        
    <div id="divArquivos" style="visibility: visible">
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
</fieldset>
        </div>
</fieldset>

  
    
    
<script lang="javascript">
    $(function () {
        //        $('#paginaAtual').val(1);
        $('#btNULL').click();
        //    jquery.fn.atualizaTabela();
    });
</script>

