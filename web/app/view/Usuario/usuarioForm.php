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
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/model/Usuario.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/model/Grupo.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/controller/UsuarioController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/controller/GrupoController.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/FormUtils.php');

$userC = new UsuarioController();
$grupoC = new GrupoController();
//$usuario = new Usuario();
$usuario = $userC->getUsuarioPorId($_POST['usuario']['id']);
$FU = new FormUtils();
?>
<link href="/html/css/validation.css" rel="stylesheet" type="text/css" />

<a href="#" id="fechaPainel">Fechar</a><br> 
<a>ou aperte a tecla ESC do teclado</a><br>
<div id="space" style="height: 150px">
    
</div>
<fieldset id="usuarioContainer" style="vertical-align: middle;top: 150px;">
    <legend class="tituloTab">
        <a href="#" id="linkUsuarioPainel" class="tituloTab"><img src="<? echo BASE_IMAGES; ?>user_business.png" >Detalhes do Usuario</a>
    </legend>
    <div id="PainelUsuario" class="datagrid">
        <form class="formStyle3"  id="formUpdateUser"  method="post" action="/app/controller/PostController.php">


            <table>
                <thead>
                    <tr>
                        <th colspan="2">Editar Usuário</th>
                    </tr>    
                </thead>
                <tbody>
                    <tr>
                        <th width="25%">Id:</th><td width="75%"><? echo $usuario->getId(); ?>
                          <input type="hidden"  name="usuario[id]" value="<? echo $usuario->getId(); ?>">  
                          <input type="hidden"  name="usuario[update]" value="true">  
                        </td>
                    </tr>
                    <tr>
                        <th><label for="login">Login:</label></th><td><input type="text" id="login" class="required" minlength="5" name="usuario[login]" value="<? echo $usuario->getLogin(); ?>"></td>
                    </tr>
                    <tr>    
                        <th><label for="email">E-Mail</label></th><td><input type="text" id="email"  class="required email" name="usuario[email]" value="<? echo $usuario->getEmail(); ?>"></td>
                    </tr>
                    <tr>    
                        <th>Senha:</th><td><input type="password" id="senha" name="usuario[senha]" value="<? echo $usuario->getSenha(); ?>"><div id="dicaSenha" style="display:none;color: red;font-weight: bold;">Apenas preencha caso queira trocar a senha.</div></td>
                    </tr>
                    <tr>    
                        <th>Lembrete:</th><td><input type="password" id="lembrete" name="usuario[lembrete]" value="<? echo $usuario->getLembrete(); ?>"></td>
                    </tr>
                    <tr>
                        <th>Nível:</th><td><?
                        echo $usuario->getNivel()."&nbsp;";
                        $arrNiveis=array('Admin','Usuario');
                        $FU->buildSelect($arrNiveis, 'niveis', $usuario->getNivel(), 'usuario[nivel]');
                        
                        ?></td>
                    </tr>
                    <tr>
                        <th>Grupo:</th><td><?
                        echo $usuario->getGrupo()."&nbsp;";
                        $arrGrupos = $grupoC->getGrupos();
                        $FU->buildSelect($arrGrupos, 'grupos', $usuario->getIdGrupo(), 'usuario[id_grupo]');
                        ?></td>
                    </tr>
                    <tr>
                        <th>Ativo:</th><td><? 
                        echo $usuario->isAtivo()."&nbsp;"; 
                        $FU->buildcheckBox('usuario[ativo]',$usuario->isAtivo());
                        ?></td>
                    </tr>
                    <tr>
                        <th>Arquivos na lista:</th><td><? echo $usuario->getTotalArquivos(); ?></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2" style="text-align: center">
                            <button type="submit" class="botaoMenor">
                                <img src="<? echo BASE_IMAGES; ?>user_edit.png" >Salvar
                            </button></th>
                    </tr> 
                </tfoot>
            </table>
        </form>    

    </div>
    <? // print_r($usuario); ?>
</fieldset>


<script language="javascript">
    $(document).ready(function(){ 
        
        $('a#fechaPainel').click(function(){
            $('div#painelEdicao').empty();
            $('div#painelEdicao').slideUp();
        })
        
        $('#usuarioContainer').keyup(function(e) {
            //alert(e.keyCode);
            if(e.keyCode == 27) { // esc
                $('div#painelEdicao').empty();
                $('div#painelEdicao').slideUp();
            }
        })
        
             
        $('#senha').focus(
        function(){
            $('div#dicaSenha').slideDown();
        }  
    );
        
        $('#senha').blur(
        function(){
            $('div#dicaSenha').slideUp();
        }  
    );
        
        
        $('#formUpdateUser').validate();
        
        
        
        
    })
</script>        