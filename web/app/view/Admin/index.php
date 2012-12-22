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

class IndexAdmin{
    
}

require_once ($_SERVER['DOCUMENT_ROOT'] . '/lib/block.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/lib/Utils.class.php');

require_once($_SERVER['DOCUMENT_ROOT'] . '/app/model/Arquivo.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/controller/ArquivoController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/model/Usuario.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/controller/UsuarioController.php');

$util = new Utils();
$arqC = new ArquivoController();
$userC = new UsuarioController();
//$grupoC = new ArquivoController();
//$arrArquivos = $grupoC->getArquivos();
$arquivo = new Arquivo();
$totalArquivos = $arqC->getTotalArquivos($arquivo);
$totalArquivosFS = count($arqC->getArquivosFs());
?>
<div id="container">

<script language="javascript">
    $(document).ready(function(){ 
        $('#btNULL').click(function(){
//            $('#tabela').load('/app/ajax/arquivosFs.php');
        });
        
//        $('#mostrarDiff').click(function(){
//            $('#tabela').load('/app/ajax/arquivosFs.php');
//        });
        
        $('a#linkAdmin').toggle(
        function (){
            $('div#divAdmin').slideDown();    
        },
        function (){
            $('div#divAdmin').slideUp();    
        })
        });
</script>
<fieldset id="flArquivo">
    <legend class="tituloTab">
        <a href="#" id="linkAdmin" class="tituloTab"><img src="<? echo BASE_IMAGES; ?>group.png" >Admin</a>
    </legend>
         
     <div align="center" id="carregandoArquivos" style="display:none;position: fixed ; width: 60%;" class="msg">
        <img src="<? echo BASE_IMAGES; ?>ajax-loader.gif">Aguarde.. atualizando grupos
    </div>
    
    <div id="divAdmin">
    
    
    
    
    <div>
        Olá, <? echo $_SESSION['usuario']['login'];?>
    </div>
        <fieldset class="borda" id="info">
        <legend>Usuários</legend>
        Total de Usuários : <? echo $userC->getTotalUsuarios() ;?><br>
        Total de Usuários Ativos : <? echo $userC->getTotalUsuariosAtivos() ;?>
        
    </fieldset>
    <div id="separator" style="padding: 2px 2px 2px 2px"></div>
    
    <fieldset class="borda" id="info">
        <legend>Arquivos</legend>
        Total de Arquivos no catálogo : <? echo $totalArquivos ;?><br>
        Total de Arquivos no repositório : <? echo $totalArquivosFS ;?><br>
        Total de Arquivos não catalogados : <? echo $totalArquivosFS - $totalArquivos;?>
        
    </fieldset>
    

    
 
    <button id="btNULL" style="display: none;" ></button>
    </div>
</fieldset>
<script lang="javascript">
    $(function () {
       
//        $('#btNULL').click();
       
    });
</script>
    
    
    
    
</div>
