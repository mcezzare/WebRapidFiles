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
class AjaxLogs{
    
}

require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/config.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/lib/block.php');

require_once ($_SERVER['DOCUMENT_ROOT'] . '/lib/Utils.class.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/app/model/Logger.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/controller/LoggerController.php');

$logC = new LoggerController();
$log = new Logger();
$util = new Utils();

//$arrLogs=$logC->getLogs($log);
//print_r($arrLogs);

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
$primeiro = ($pagina * $numPorPagina) - $numPorPagina;
$logFiltro = new Logger();

isset($_REQUEST['logData']) && ($_REQUEST['logData'] != 0) ?
    $logFiltro->setData($_REQUEST['logData']) 
        : $logFiltro->setData(null);

isset($_REQUEST['logGrupo']) && ($_REQUEST['logGrupo'] != 0) ?
    $logFiltro->setIdGrupo($_REQUEST['logGrupo']) 
        : $logFiltro->setIdGrupo(null);

isset($_REQUEST['logAcao']) && ($_REQUEST['logAcao'] != 0) ?
    $logFiltro->setIdAcao($_REQUEST['logAcao']) 
        : $logFiltro->setIdAcao(null);

isset($_REQUEST['logUsuario']) && ($_REQUEST['logUsuario'] != 0) ?
    $logFiltro->setIdUsuario($_REQUEST['logUsuario']) 
        : $logFiltro->setIdUsuario(null);


isset($_REQUEST['logData1']) && ($_REQUEST['logData1'] != 0) ?
    $logFiltro->setDataStart($_REQUEST['logData1']) 
        : $logFiltro->setDataStart(null);

isset($_REQUEST['logData2']) && ($_REQUEST['logData2'] != 0) ?
    $logFiltro->setDataEnd($_REQUEST['logData2']) 
        : $logFiltro->setDataEnd(null);




$arrLogs = $logC->getLogsPaginados($primeiro, $numPorPagina, $logFiltro, 1, 'down', false);
//$util->mostraObjeto($arrLogs);

$totalLogs = $logC->getTotalLogs($logFiltro);
//echo $totalLogs;
//die('x');

$totalPaginas = ceil($totalLogs / $numPorPagina); // ceil arredonda p/ maior , exemplo 1.65 sao 2 paginas


$anterior = $pagina - 1;
$proximo = $pagina + 1;

//trava palhaçadas , tipo colocar um nº maior do que o total de paginas
if ($pagina > $totalPaginas) {
//    header("Location:" . $basePage . $totalPaginas);
    $pagina = 1;
    echo 'Sem ocorrencias com essa pesquisa:';
    $util->mostraObjetoUser($logFiltro);

//    $util->mostraObjetoUser($_GET);
}
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
<th>id</th>
<th>Grupo</th>
<th>Data</th>
<th>Usuário</th>
<th>Ação</th>
<th>+info</th>
<th>ações</th>
</tr>
</thead>
    
<tbody id="tbArquivos">
    <?
    if ($totalLogs > 0) {
        for ($i = 0; $i < count($arrLogs); $i++) {
//                                $arquivo = clone($arrLogs[$i]);
            if ($arrLogs[$i] instanceof Logger) {
//                $filename = $arrLogs[$i]->getNome();
                $idLog = $arrLogs[$i]->getId();
                ?>
                <tr <?
            if ($i % 2 == 0) {
                echo "class=\"alt\"";
            }
                ?>>
                    <td  style="font-size: 100%;" id="indice"><?
            echo ($i + 1 + ($numPorPagina * $pagina) - $numPorPagina);

                ?></td>
                    <td><input type="checkbox" name="logs[]" id="log" value="<? echo $idLog; ?>"></td>
                    <td><?  echo $arrLogs[$i]->getId();    ?></td>
                    <td><?  echo $arrLogs[$i]->getGrupoNome();    ?></td>
                    <td><? echo $arrLogs[$i]->getData();        ?></td>
                    <td><? echo $arrLogs[$i]->getUsuarioNome(); ?></td>
                    <td><? echo $arrLogs[$i]->getAcaoNome(); ?></td>
                    <td><a href="#" title="<? echo $arrLogs[$i]->getObjectStored(); ?>">#</a></td>
                    <td class="actions">
                        <?

                        $nivelArquivos = $_SESSION['usuario']['nivel'];
                        $testPemissao=($nivelArquivos > 1 || $_SESSION['usuario']['id_grupo'] == 2)?true:false;
                        if ($testPemissao) {//habilita grupo 2 também
                            ?>
                            <a href="#" id="linkRemoveForm" onclick="jQuery.fn.removeLog(<? echo $idLog . "," . $idLog ; ?>);">
                                <img src="<? echo BASE_IMAGES; ?>b_drop.png" alt="Excluir" title="Excluir Log" width="16" height="16" border="0" />
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
                <? if ($testPemissao) { ?>
                    <button id="removerSelecionados" class="botaoMenor" type="button" style="alignment-baseline: middle;width: 200px;padding: 0px 0px 0px 0px;">
                        <img src="<? echo BASE_IMAGES; ?>b_drop.png" alt="Excluir Selecionados" title="Excluir Logs Selecionados" width="16" height="16" border="0" />
                        Remover Selecionados</button>
                    <input type="hidden" name="log[exclusao]" value="true">
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
            if($('#log:checked').size() == 0){
                alert('Selecione algum log para excluir');
            }else {
                var valores = "";
                $('#log:checked').each(function(){
                    valores+=$(this).val()+' , ';
                })
                
                if (confirm('Deseja excluir os logs :\n' + valores + '?')){
                    $('#formFiles').submit();
                }
            }})
        

    })
</script>
