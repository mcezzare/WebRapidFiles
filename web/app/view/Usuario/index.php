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
class IndexUsuarios{
    
}
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/model/Grupo.class.php');

$userC = new UsuarioController();

$arrUsuarios = $userC->getUsuariosGrupo();
$arrGrupos = array();
$util = new Utils();
?>

<fieldset id="flUsuario">
    <legend class="tituloTab">
        <a href="#" id="linkUsuario" class="tituloTab"><img src="<? echo BASE_IMAGES; ?>user_business.png" >Usuarios</a>
    </legend>

    <div id="novo">
        <form>
            <button class="botaoMenor" type="button" id="btNovoUser" onclick="jQuery.fn.novoUsuario();">
                <img src="<? echo BASE_IMAGES; ?>user_add.png">   Adicionar Usuário
            </button>
        </form>
    </div>



    <div id="painelEdicao" class="painel" style="display: none">
        <a href="#" id="fechaPainel">Fechar</a>

    </div> 
    <div id="painelNovoUsuario" class="painel" style="display: none">
        <a href="#" id="fechaPainelNovo">Fechar</a>

    </div> 


    <div align="center" id="carregandoUsuarios" style="display:none;position: fixed ; width: 60%;" class="msg">
        <img src="<? echo BASE_IMAGES; ?>ajax-loader.gif">Aguarde.. atualizando usuários
    </div> 
    <div id="divUsuarios" style="visibility: visible">

        <?
        $grupoLast = null;
//        $usuario = new Usuario(); // only to nB see the object

        foreach ($arrUsuarios as $usuario) {
            $grupoTmp = $usuario->getGrupo();
            $grupoTmpId = $usuario->getIdGrupo();
            $grupoObj = new Grupo();
            $grupoObj->setId($grupoTmpId);
            $grupoObj->setNome($grupoTmp);

            if ($grupoTmp != $grupoLast) {
//               array_push($arrGrupos, $grupoTmp);
                array_push($arrGrupos, $grupoObj);
                ?> 
                <fieldset id="flGrupo<? echo $grupoTmpId; ?>">
                    <legend class="tituloMenor"><a href="#" id="linkGrupo<? echo $grupoTmpId; ?>"><img src="<? echo BASE_IMAGES; ?>group.png" >Grupo:<? echo $usuario->getGrupo(); ?></a></legend>
                    <div class="datagrid" id="divGrupo<? echo $grupoTmpId; ?>">
                        <form id="formGrupo<? echo $grupoTmpId; ?>" method="POST" action="/app/controller/PostController.php">
                            <table id="tabela">
                                <thead>
                                    <tr>
                                        <th width="5%" id="indice">#</th>
                                        <th width="10%">Id</th>
                                        <th width="25%">Login</th>
                                        <th width="35%">Email</th>
                                        <th width="5%">Ativo</th>
                                        <th width="10%">Nivel</th>
                                        <th width="20%">Arquivos Enviados</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?
                                    $i = 0;
                                    foreach ($arrUsuarios as $usuariogrupo) {
                                        if ($grupoTmp == $usuariogrupo->getGrupo()) {
                                            ?>
                                            <tr <?
                            if ($i % 2 == 0) {
                                echo "class=\"alt\"";
                            }
                                            ?>>
                                                <td id="indice"><? echo $i + 1 ?></td>
                                                <td><a href="#" onclick="jQuery.fn.editUsuario(<? echo $usuariogrupo->getId(); ?>)" id="linkUser<? echo $usuariogrupo->getId(); ?>"><? echo $usuariogrupo->getId(); ?></a></td>
                                                <td><? echo $usuariogrupo->getLogin(); ?></td>
                                                <td><? echo $usuariogrupo->getEmail(); ?></td>
                                                <td><? echo $usuariogrupo->isAtivo(); ?></td>
                                                <td><? echo $usuariogrupo->getNivel(); ?></td>
                                                <td><?
                                echo $usuariogrupo->getTotalArquivos();

                                if ($usuariogrupo->getTotalArquivos() == 0) {
                                                ?>
                                                        <button class="botaoMenor" type="button" id="btRemoveUser" onclick="jQuery.fn.removeUsuario(<? echo $usuariogrupo->getId(); ?>,'<? echo $usuariogrupo->getLogin(); ?>');">
                                                            <img src="<? echo BASE_IMAGES; ?>user_delete.png">
                                                        </button>
                                                    <? } ?>
                                                </td>

                                            </tr>
                                            <?
                                        }
                                        $i++;
                                    }
                                    ?> 
                                </tbody>

                            </table>

                        </form> 
                    </div>
                </fieldset>
                <?
            }
            $grupoLast = $usuario->getGrupo();
        }
        ?>
    </div>
    <button id="btNULL" style="display: none;" ></button>
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

<script language="javascript">
    $(document).ready(function(){ 
        $('#btNULL').click(function(){
            //            $('#tabela').load('/app/ajax/grupos.php');
        });
        $('a#fechaPainel').click(function(){
            $('div#painelEdicao').empty();
            $('div#painelEdicao').slideUp();
        })
        $('a#fechaPainelNovo').click(function(){
            $('div#painelNovoUsuario').empty();
            $('div#painelNovoUsuario').slideUp();
        })
        
        $('a#linkUsuario').toggle(
        function (){
            $('div#divUsuarios').slideDown();    
        },
        function (){
            $('div#divUsuarios').slideUp();    
        })
        
        $('div#divUsuarios').keyup(function(e) {
            //alert(e.keyCode);
            if(e.keyCode == 27) { // esc
                $('div#painelEdicao').empty();
                $('div#painelEdicao').slideUp();
            }
        })
	
	
        //		alert('Enter key was pressed.');
        //        event.preventDefault();
        
<?
//        for ($i=0;$i<count($arrGrupos);$i++)
foreach ($arrGrupos as $grupo) {
    $grupoId = $grupo->getId();
    ?>
                $('a#linkGrupo<? echo $grupoId; ?>').toggle(
                function (){
                    $('div#divGrupo<? echo $grupoId; ?>').slideDown();    
                },
                function (){
                    $('div#divGrupo<? echo $grupoId; ?>').slideUp();    
                })
                    
<? } ?> 


        jQuery.fn.editUsuario = function(idUsuario){
            $('div#painelEdicao').slideDown(0.5, function(){
                //            return true;
                //        $('div#painelEdicao').load('/app/view/Usuario/usuarioForm.php?id='+idUsuario);
                var dataString='usuario[id]='+idUsuario;
                $.post('/app/view/Usuario/usuarioForm.php',dataString,
                function (data){
                    $('div#painelEdicao').html(data); 
                }
            )
        
            })
        }
        jQuery.fn.novoUsuario = function(){
            $('div#painelNovoUsuario').slideDown(0.5, function(){
                //            return true;
                $('div#painelNovoUsuario').load('/app/view/Usuario/novoUsuarioForm.php');
                //se quiser postar em vez de get
                //    var dataString='usuario[id]='+idUsuario;
                //        $.post('/app/view/Usuario/usuarioForm.php',dataString,
                //        function (data){
                //            $('div#painelEdicao').html(data); 
                //        }
                //        )
        
            })
        }
    
        jQuery.fn.removeUsuario = function(idUsuario,nomeUsuario){
            //        alert(idUsuario);
            if (confirm('Deseja remover o usuário: '+ nomeUsuario + '?\n Os logs desse usuário também serão removidos.' )){
                //        alert('removendo');
                var dataString='usuario[remove]=true&usuario[id]='+idUsuario;
                $.post('/app/controller/PostController.php',dataString,
                function (data){
                    //only for debug
//                    $('#resultado').slideDown();
//                    $('#resultado').html(data);
                }
            )
                window.location.href=window.location.href;
    
            }else {
                //        alert('cancelando');
            }
    
    
        }

    
    });
</script>