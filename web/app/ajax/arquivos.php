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
class AjaxArquivos{
    
}
require_once ($_SERVER['DOCUMENT_ROOT'] . '/lib/block.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/lib/Utils.class.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/app/model/Arquivo.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/controller/ArquivoController.php');
$util = new Utils();
$arqC = new ArquivoController();
//$arrArquivos = $arqC->getArquivos();
//$totalArquivos = count($arrArquivos);
// define registros por pagina
if (isset($_REQUEST['pagesize'])) {
    $numPorPagina = $_REQUEST['pagesize'];
} else {
    $numPorPagina = 20;
}
//base p/ gerar os links
$basePage = $_SESSION['usuario']['view'] . "?section=arquivos&action=index";

// acrescenta o parametro pagina no link, o valor sera gerado ao carregar
$basePage .="&pagina=";

if (isset($_REQUEST['pagina'])) {
    $pagina = $_REQUEST['pagina'];
} else {
    $pagina = 1;
}
//trava palhaçadas, como tentar passar numeros negativos na url
if ($pagina <= 0) {
//    header("Location:" . $basePage . "1");
    $pagina = 1;
}

// 1º registro do Bloco
$primeiroRegistro = ($pagina * $numPorPagina) - $numPorPagina;
$arquivoFiltro = new Arquivo();
//filter
//isset($d)?true:false;
//if (isset($d)){
//    
//}else {
//    
//}
isset($_REQUEST['arqNome']) && ($_REQUEST['arqNome'] != '') ? $arquivoFiltro->setNome($_REQUEST['arqNome']) : $arquivoFiltro->setNome(null);
isset($_REQUEST['arqTipo']) && ($_REQUEST['arqTipo'] != '0') ? $arquivoFiltro->setTipo($_REQUEST['arqTipo']) : $arquivoFiltro->setTipo(null);
isset($_REQUEST['arqData']) && ($_REQUEST['arqData'] != '0') ? $arquivoFiltro->setData($_REQUEST['arqData']) : $arquivoFiltro->setData(null);
isset($_REQUEST['arqUser']) && ($_REQUEST['arqUser'] != '0') ? $arquivoFiltro->setIdusuario($_REQUEST['arqUser']) : $arquivoFiltro->setIdusuario(null);



//end filter
//die(print_r($arquivoFiltro));
$arrArquivos = $arqC->getArquivosPaginados($primeiroRegistro, $numPorPagina, $arquivoFiltro);
$totalLogs = $arqC->getTotalArquivos($arquivoFiltro);
$totalPaginas = ceil($totalLogs / $numPorPagina); // ceil arredonda p/ maior , exemplo 1.65 sao 2 paginas

$anterior = $pagina - 1;
$proximo = $pagina + 1;

//trava palhaçadas , tipo colocar um nº maior do que o total de paginas
if ($pagina > $totalPaginas) {
//    header("Location:" . $basePage . $totalPaginas);
    $pagina = 1;
    echo 'Sem ocorrencias com essa pesquisa:';
    $util->mostraObjetoUser($arquivoFiltro);

//    $util->mostraObjetoUser($_GET);
}
$testPermissao=false;
sleep(1);
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
<th>Tipo</th>
<th>Tamanho</th>
<th>Data</th>
<th>Usuário</th>
<th>#</th>
<th>+info</th>
<th>ações</th>
</tr>
</thead>

<tbody id="tbArquivos">
    <?
    if ($totalLogs > 0) {
        for ($i = 0; $i < count($arrArquivos); $i++) {
//                                $arquivo = clone($arrArquivos[$i]);
            if ($arrArquivos[$i] instanceof Arquivo) {
                $filename = $arrArquivos[$i]->getNome();
                $idLog = $arrArquivos[$i]->getIdarquivos();
                ?>
                <tr <?
            if ($i % 2 == 0) {
                echo "class=\"alt\"";
            }
                ?>>
                    <td  style="font-size: 100%;" id="indice"><?
            echo ($i + 1 + ($numPorPagina * $pagina) - $numPorPagina);
//                    echo ( ($i +$pagina)); 
//                    echo $arrArquivos[$i]->getIndex();
                ?></td>
                    <td><input type="checkbox" name="arquivos[]" id="arquivo" value="<? echo $idLog; ?>"></td>
                    <td><a href="/files/<? echo $filename; ?>"  target="_blank" title="<? echo $filename; ?>"><? echo utf8_decode($filename); ?></a></td>
                    <td><?
//                                echo $arrArquivos[$i]->getTipo(); 
            echo $util->mimeToPicture($filename, $arrArquivos[$i]->getTipo())
                ?></td>
                    <td><?
//                                echo $arrArquivos[$i]->getTamanho();
            echo $util->getHumanReadableSize($arrArquivos[$i]->getTamanho());
                ?></td>
                    <td><? echo $arrArquivos[$i]->getData(); ?></td>
                    <td><? echo $arrArquivos[$i]->getUsuarioNome(); ?></td>
                    <td><?
            $util->verificaArquivoExiste($filename);
                ?></td>
                    <td><a href="#" title="<? echo $arrArquivos[$i]->getIp() . "-" . $arrArquivos[$i]->getBrowser(); ?>">#</a></td>
                    <td class="actions">
                        <?
//                                                $nivelArquivos = $_SESSION['modulo']['Arquivos'];
//                        $nivelArquivos = 'full control';
                        $nivelArquivos = $_SESSION['usuario']['nivel'];

                        $formFile = "form$idLog";
                        $testPermissao=($nivelArquivos > 1 || $_SESSION['usuario']['id_grupo'] == 2)?true:false;
//                        if ($nivelArquivos == 'exclusão' || $nivelArquivos == 'full control') {
                        if ($testPermissao) {//habilita grupo 2 também
                            ?>

                            <a href="#" id="linkRemoveForm" onclick="jQuery.fn.removeArquivo(<? echo $i . "," . $idLog . ",'" . $filename . "'"; ?>);">
                                <img src="<? echo BASE_IMAGES; ?>b_drop.png" alt="Excluir" title="Excluir Arquivo" width="16" height="16" border="0" />
                            </a>

                        <? } ?>   
                    </td>
                </tr>
                <?
            }//end if 
        }//end for 
    }
    ?>
<input type="hidden" name="paginaAtual" value="<? echo $pagina; ?>">

<tfoot>
    <tr>
        <td colspan="10">
            <div style="padding: 6px 6px 6px 6px;">
                <a>Total de itens:<? echo $totalLogs; ?></a>
                <? if ($testPermissao) { ?>
                    <button id="removerSelecionados" class="botaoMenor" type="button" style="alignment-baseline: middle;width: 200px;padding: 0px 0px 0px 0px;">
                        <img src="<? echo BASE_IMAGES; ?>b_drop.png" alt="Excluir Selecionados" title="Excluir Arquivos Selecionados" width="16" height="16" border="0" />
                        Remover Selecionados</button>
                    <input type="hidden" name="arquivo[exclusao]" value="true">
                <? } ?>
            </div>

        </td>
    </tr>
    <tr>
        <td colspan="10">
            <div id="paging">

                <ul>
                    <? if ($pagina > 1) { ?>
                        <li>
                            <a href="#" onclick="jQuery.fn.atualizaTabela(<? echo ($anterior) . "," . $numPorPagina; ?>);" ><span>&lt;&lt;</span></a>
                        </li>
                    <? } ?>
                    <? for ($i = 1; $i <= $totalPaginas; $i++) { ?>
                        <? /* <li><a href="#" <? $i==$pagina ?'class="active"': ''; ?> ><span><? echo $i;?></span></a></li> */ ?>
                        <? if ($i == $pagina) { ?>
                            <li  class="active"><span><? echo $i; ?></span></li>

                        <? } else { ?>
                            <li><a href="#" onclick=" jQuery.fn.atualizaTabela(<? echo $i . "," . $numPorPagina; ?>);"><span><? echo $i; ?></span></a></li>  
                        <?
                        }
                    }
                    ?>
                    <? if (($pagina != $totalPaginas) && ($pagina < $totalPaginas)) { ?>
                        <li>
                            <a href="#" onclick="jQuery.fn.atualizaTabela(<? echo ($proximo) . "," . $numPorPagina; ?>);"><span>&gt;&gt;</span></a>
                        </li>
                    <? } ?>
                </ul>
            </div>
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
                    $('#formFiles').submit();
                }
            }})
        

    })
</script>