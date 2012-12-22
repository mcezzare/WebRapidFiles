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
//$grupoC = new GrupoController();
//$arrGrupos = $grupoC->getGrupos();
class IndexGrupos{
    
}

?>
<script language="javascript">
    $(document).ready(function(){ 
          $('#btNULL').click(function(){
            $('#tabela').load('/app/ajax/grupos.php');
        });
        $('a#linkGrupo').toggle(
        function (){
            $('div#divGrupos').slideDown();    
        },
        function (){
            $('div#divGrupos').slideUp();    
        })
        });
</script>
<fieldset id="flGrupo">
    <legend class="tituloTab">
        <a href="#" id="linkGrupo" class="tituloTab"><img src="<? echo BASE_IMAGES; ?>group.png" >Grupos</a>
    </legend>
    
     <div align="center" id="carregandoGrupos" style="display:none;position: fixed ; width: 60%;" class="msg">
        <img src="<? echo BASE_IMAGES; ?>ajax-loader.gif">Aguarde.. atualizando grupos
    </div> 
    <div id="divGrupos" style="visibility: visible">
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
    
</fieldset>
<script lang="javascript">
    $(function () {
        //        $('#paginaAtual').val(1);
        $('#btNULL').click();
        //    jquery.fn.atualizaTabela();
    });
</script>