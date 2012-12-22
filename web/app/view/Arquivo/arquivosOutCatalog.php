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
       $('a#linkNaoCatalogados').toggle(
        function (){
            $('div#divArquivosNG').slideDown();    
        },
        function (){
            $('div#divArquivosNG').slideUp();    
        })    
        $('a#linkGeral').toggle(
        function (){
            $('div#divGeral').slideDown();    
        },
        function (){
            $('div#divGeral').slideUp();    
        }) 
          // so p/ iniciar         
        $('#btNULL').click(function(){
//            jQuery.fn.atualizaTabela(1,20);
            $('#tabelaNG').load('/app/ajax/arquivosFs.php');
        });
   });
       
</script>       
<fieldset id="flgeral">
      <legend class="tituloTab">
        <a href="#" id="linkGeral" class="tituloTab"><img src="<? echo BASE_IMAGES; ?>folder_page.png" >Arquivos</a>
    </legend>
    
    <div id="divGeral">
     <fieldset class="borda" id="info">
         Total de Arquivos no catálogo :<b><? echo $totalArquivos ;?></b> <div id="infoText">(Uploads registrados)</div>&nbsp;&nbsp;<a id="mostrarDiff" href="<? echo $_SESSION['usuario']['view']?>?section=arquivos&action=index">Mostrar Arquivos</a> <br>
         Total de Arquivos no repositório :<b> <? echo $totalArquivosFS ;?></b><div id="infoText">(lista total)</div><br>
         Total de Arquivos não catalogados :<b> <? echo $totalArquivosFS - $totalArquivos;?></b><div id="infoText">(Uploads não registrados)</div> 
         
        
    </fieldset>
    
<fieldset id="flNaoCatalogados">

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
    
    <button id="btNULL" style="display: none;" ></button>
    
</fieldset>  
        <script lang="javascript">
    $(function () {
        //        $('#paginaAtual').val(1);
        $('#btNULL').click();
        //    jquery.fn.atualizaTabela();
    });
</script>

