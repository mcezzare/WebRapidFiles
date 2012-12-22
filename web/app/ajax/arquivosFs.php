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
@session_start();
class AjaxArquivosFs{
    
}
require_once ($_SERVER['DOCUMENT_ROOT'] . '/lib/block.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/lib/Utils.class.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/app/model/Arquivo.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/controller/ArquivoController.php');
$util = new Utils();
$arqC = new ArquivoController();

//fisico
$arrArquivosFs = $arqC->getArquivosNaoCatalogados();
$totalArquivosFs=count($arrArquivosFs);
//$util->mostraObjeto($arrArquivosFs);
//
sleep(1);
$testPermissao=false;

?>
<table>
    <thead>
        <tr>
            <th id="indice">#</th>
            <th>
                <input type="checkbox" id="markAll">
    <div id="divLimparSelecao" style="display: none;">
        <a href="#"><img src="<? echo BASE_IMAGES; ?>cancel.png" id="cleanAll" title="Limpar seleção"></a>
    </div>
</th>
<th>Arquivo</th>
<th>ações</th>

</tr>
</thead>

<tbody id="tbArquivos">
    <?
    if ($totalArquivosFs > 0) {
        for ($i = 0; $i < count($arrArquivosFs); $i++) {
            $filename= utf8_decode($arrArquivosFs[$i]);
//                                $arquivo = clone($arrArquivos[$i]);
//            if ($arrArquivos[$i] instanceof Arquivo) {
//                $filename = $arrArquivos[$i]->getNome();
//                $idLog = $arrArquivos[$i]->getIdarquivos();
                ?>
                <tr <?
            if ($i % 2 == 0) {
                echo "class=\"alt\"";
            }
                ?>>
                    <td  style="font-size: 100%;" id="indice"><?
            echo ($i+1);
//                    echo ( ($i +$pagina)); 
//                    echo $arrArquivos[$i]->getIndex();
                ?></td>
                    <td><input type="checkbox" name="arquivos[]" id="arquivo" value="<? echo $filename; ?>"></td>
                    <td><a href="/files/<? echo $filename; ?>"  target="_blank" title="<? echo $filename; ?>"><? echo utf8_decode($filename); ?></a></td>
                    <td class="actions">
                        <?
//                                                $nivelArquivos = $_SESSION['modulo']['Arquivos'];
//                        $nivelArquivos = 'full control';
                        $nivelArquivos = $_SESSION['usuario']['nivel'];

                        $testPermissao=($nivelArquivos > 1 || $_SESSION['usuario']['id_grupo'] == 2)?true:false;
//                        if ($nivelArquivos == 'exclusão' || $nivelArquivos == 'full control') {
                        if ($testPermissao) {//habilita grupo 2 também
                            ?>

                            <a href="#" id="linkRemoveForm" onclick="jQuery.fn.removeArquivo(<? echo $i . ",'" . $filename . "'"; ?>);">
                                <img src="<? echo BASE_IMAGES; ?>b_drop.png" alt="Excluir" title="Excluir Arquivo" width="16" height="16" border="0" />
                            </a>

                        <? } ?>   
                    </td>
                </tr>
                <?
//            }//end if 
        }//end for 
    }
    ?>


<tfoot>
    <tr>
        <td colspan="10">
            <div style="padding: 6px 6px 6px 6px;">
                <a>Total de itens:<? echo $totalArquivosFs; ?></a>
                <? if ($testPermissao) { ?>
                    <button id="removerSelecionados" class="botaoMenor" type="button" style="alignment-baseline: middle;width: 200px;padding: 0px 0px 0px 0px;">
                        <img src="<? echo BASE_IMAGES; ?>b_drop.png" alt="Excluir Selecionados" title="Excluir Arquivos Selecionados" width="16" height="16" border="0" />
                        Remover Selecionados</button>
                    <input type="hidden" name="arquivosFS[exclusao]" value="true">
                <? } ?>
            </div>

        </td>
    </tr>

</tfoot>            
</tbody>
</table>
<script language="javascript">
    $(document).ready(function(){ 
        $('#markAll').click(function(){
            $('input[type=checkbox]').each(function(){
                $(this).attr('checked', true);
            })
            $('#divLimparSelecao').slideDown();
        })
        $('#cleanAll').click(function(){
            $('input[type=checkbox]').each(function(){
                $(this).attr('checked', false);
            })
            $('#divLimparSelecao').slideUp();
        })
               
 
        
        
        $('#removerSelecionados').click(function(){
            //            alert($('#exclusao:checked').size());
            if($('#arquivo:checked').size() == 0){
                alert('Selecione algum arquivo para excluir');
            }else {
                var valores = "";
                $('#arquivo:checked').each(function(){
                    valores+=$(this).val()+' , ';
                })
                
                if (confirm('Deseja excluir os arquivos :\n' + valores + '?')){
                    $('#formFilesNG').submit();
                }
            }})
        
        
        
        
        //funcoes  
        jQuery.fn.removeArquivo = function(index,nomeArquivo){
            if (confirm('Deseja remover o arquivo: '+index + ' '+ nomeArquivo+ '?')){
                var dataString="arquivoFs[exclusao][exclusao]=true"
                    + '&arquivoFs[exclusao][nome]='+nomeArquivo;
                $.post('/app/controller/PostController',dataString,
                function (data){
                    $('#tabelaNG').empty();
                    //                    $('#tbArquivos').html(data);
                    $('#carregandoArquivos').slideDown();
                    $('#carregandoArquivos').fadeTo("slow", 1).animate({opacity: 1.0}, 1000).fadeTo("slow", 0);
                    $('#tabelaNG').load('/app/ajax/arquivosFs.php');
                    $('#carregandoArquivos').slideUp();
                    
                }
            );
            }
        }
         
        
        
    })
</script>