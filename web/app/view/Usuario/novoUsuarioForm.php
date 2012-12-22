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
//$usuario = $userC->getUsuarioPorId($_POST['usuario']['id']);
$FU = new FormUtils();
?>
<link href="/html/css/validation.css" rel="stylesheet" type="text/css" />

<a href="#" id="fechaPainelNovo">Fechar</a><br> 
<a>ou aperte a tecla ESC do teclado</a><br>
<div id="space" style="height: 150px">

</div>
<fieldset id="usuarioContainer" style="vertical-align: middle;top: 150px;">
    <legend class="tituloTab">
        <a href="#" id="linkUsuarioPainel" class="tituloTab"><img src="<? echo BASE_IMAGES; ?>user_business.png" >Detalhes do Usuario</a>
    </legend>
    <div id="PainelUsuario" class="datagrid">
        <form class="formStyle3" id="formNovoUser" method="post" action="/app/controller/PostController.php">


            <table>
                <thead>
                    <tr>
                        <th colspan="2">Novo Usuário</th>
                    </tr>    
                </thead>
                <tbody>

                    <tr>
                        <th width="25%"><label for="login">Login:</label></th>
                        <td><input type="text" id="login" class="required" minlength="5" name="usuario[login]">
                            <div id="dicaLogin" style="display:none;color: red;font-weight: bold;"></div>
                        </td>
                    </tr>
                    <tr>    
                        <th><label for="email">E-Mail</label></th><td><input type="text" id="email"  class="required email" name="usuario[email]">
                            <div id="dicaEmail" style="display:none;color: red;font-weight: bold;"></div>
                        </td>
                    </tr>
                    <tr>    
                        <th>
                            <label for="senha">Senha:</label>
                <div>
                    <div id="notaSenha" class="sugestaoSenha" style="display:inline-table " >
                        Nota:
                    </div>
                    <div id="percSenha" class="borda"  style="display:inline-table ;height: 5px;width: 100px;background-color: grey;padding: 2px 2px 2px 2px;" >

                    </div>
                </div>

                </th>
                <td>
                    <a href="#" id="linkSugestaoSenha" name="linkSugestaoSenha" style="color:red;font-size: 80%;">Sugestão de Senha</a> | <a href="#" id="esconde" style="color:red;font-size: 80%;" >esconder sugestão</a>
                    <input type="password" class="required" minlength="5" id="senha" name="usuario[senha]" value="">

                    <div id="dicaSenha" style="display:none;color: red;font-weight: bold;">A nota deve ser=10.<br>Utilize letras a-z A-Z,núm 0-9 e símbolos@$#&*)(!</div>
                    <div style="display: inline-table ">
                        <div id="sugestaoSenha" class="sugestaoSenha"></div>
                    </div>
                </td>
                </tr>
                <tr>    
                    <th>Lembrete:</th><td><input type="password" id="lembrete" name="usuario[lembrete]" value=""></td>
                </tr>
                <tr>
                    <th>Nível:</th><td><?
$arrNiveis = array('Admin', 'Usuario');
$FU->buildSelect($arrNiveis, 'niveis', 'Usuario', 'usuario[nivel]');
?></td>
                </tr>
                <tr>
                    <th><label for="grupo">Grupo:</label></th><td><?
                        $arrGrupos = $grupoC->getGrupos();
                        $FU->buildSelect($arrGrupos, 'grupos', null, 'usuario[id_grupo]', 'grupo', 'class="required"');
?></td>
                </tr>
                <tr>
                    <th>Ativo:</th><td><?
                        $FU->buildcheckBox('usuario[ativo]', null);
?></td>
                </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2">
                <div id="divValidacoes">
                    <div style="display:inline-table;">
                        <label for="loginAprovado">#Login Aprovado</label>
                        <input type="text" id="loginAprovado" readonly="readonly" name="loginAprovado" value=""  class="required" minlength="3" size="3">

                    </div>

                    <div style="display:inline-table;">
                        <label for="emailAprovado">#Email Aprovado</label>
                        <input type="text" id="emailAprovado" readonly="readonly" name="emailAprovado" value=""  class="required" minlength="3" size="3">


                    </div>     

                    <div style="display:inline-table;">
                        <label for="grupoAprovado">#Grupo Aprovado</label>
                        <input type="text" id="grupoAprovado" readonly="readonly" name="grupoAprovado" value=""  class="required" minlength="3" size="3">


                    </div>     
                    <div style="display:inline-table;">
                        <label for="senhaAprovado">#Senha Aprovada</label>
                        <input type="text" id="senhaAprovado" readonly="readonly" name="senhaAprovado" value=""  class="required" minlength="3" size="3">


                    </div>     
                </div>    

                </tr> 
                <tr>
                    <th colspan="2" style="text-align: center">
                        <input type="hidden"  name="usuario[novo]" value="true"> 
                        <button type="submit" class="botaoMenor">Salvar</button></th>
                </tr> 
                </tfoot>
            </table>
        </form>    

    </div>
    <? // print_r($usuario);  ?>
</fieldset>


<script language="javascript">
    $(document).ready(function(){ 
        
  
        
        $('a#fechaPainelNovo').click(function(){
            $('div#painelNovoUsuario').empty();
            $('div#painelNovoUsuario').slideUp();
        })
        
        $('#usuarioContainer').keyup(function(e) {
            //alert(e.keyCode);
            if(e.keyCode == 27) { // esc
                $('div#painelNovoUsuario').empty();
                $('div#painelNovoUsuario').slideUp();
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
        ///check email
        $('#email').focus(
        function(){
            
            if ($('#email').val().length>3){
                jQuery.fn.verificaEmailExistente();
            }
        
        }  
    );
        
        $('#email').blur(
        function(){
            //            $('div#dicaEmail').slideUp();
            jQuery.fn.verificaEmailExistente();
        }  
    );
            
        jQuery.fn.verificaEmailExistente = function(){
            var dataString = 'email='+$('#email').val();
            $.post('/app/ajax/verificaExistente.php',
            dataString,function(data){
                $('div#dicaEmail').slideDown();
                $('div#dicaEmail').html(data);
                //               $('#emailAprovado').val();
            
                if (data==''){
                
                    $('div#dicaEmail').slideUp();
                    if ($('#email').val().length>5){
                        $('#emailAprovado').val('sim');
                    }
                }
                else {
                    //                   $('#emailAprovado').val('nao');
                    $('#emailAprovado').val(null);
                }
            }
        )
        
        
        }    
        //end email check
        //
        ///check login
        $('#login').focus(
        function(){
            
            if ($('#login').val().length>3){
                jQuery.fn.verificaLoginExistente();
            }
        
        }  
    );
        
        $('#login').blur(
        function(){
            jQuery.fn.verificaLoginExistente();
        }  
    );
            
        jQuery.fn.verificaLoginExistente = function(){
            var dataString = 'login='+$('#login').val();
            $.post('/app/ajax/verificaExistente.php',
            dataString,function(data){
                $('div#dicaLogin').slideDown();
                $('div#dicaLogin').html(data);
                //               $('#emailAprovado').val();
            
                if (data==''){
                
                    $('div#dicaLogin').slideUp();
                    
                    if ($('#login').val().length>=5){
                        $('#loginAprovado').val('sim');
                    }
                    
                }
                else {
                    
                    $('#loginAprovado').val(null);
                }
                
            }
        )
        
        
        }    
        //end email check
       
        //valida o grupo
        $('#grupo').change(function(){
            //        alert(this.val());
        
        });
        
        $('#grupo').blur(function(){
            //        alert(this.val());
            if($('#grupo').val()==0){
                $('#grupoAprovado').val(null);
                return false;
                
            }else {
                $('#grupoAprovado').val('sim');
                return true;
            }
        
        });

        $('#formNovoUser').validate();
        
        //luxo
        $('a#linkSugestaoSenha').click(
        function (){
            var novaSenha = jQuery.fn.makeRandon();
            $('div#sugestaoSenha').html(novaSenha);    
            $('div#sugestaoSenha').slideDown();    
        })
        $('a#esconde').click(
        function (){
            $('div#sugestaoSenha').slideUp();    
        })
        
        //valida a nota 1-10 da senha
        //             $('div#notaSenha').slideDown();
        //             var nota = jQuery.fn.testaSenhaDecente($('#senha').val());
        //             $('div#notaSenha').html('Nota:'+nota);         
        $('#senha').focus(function(){
            $('div#percSenha').slideDown();
            
        });
        $('#senha').change(function(){
//            $('div#percSenha').empty();
            var nota =  jQuery.fn.testaSenhaDecente($('#senha').val());
            
            $('div#notaSenha').html('Nota:'+nota);
            jQuery.fn.atualizaStatus(nota);
           
        });
        $('#senha').keypress(function(){
            var nota =  jQuery.fn.testaSenhaDecente($('#senha').val());
//            $('div#percSenha').empty();
            $('div#notaSenha').html('Nota:'+nota);
            jQuery.fn.atualizaStatus(nota);
        });
        $('#senha').blur(function(){
            var nota =  jQuery.fn.testaSenhaDecente($('#senha').val());
            $('div#notaSenha').html('Nota:'+nota);
            jQuery.fn.atualizaStatus(nota);
            //            $('div#percSenha').html("<table width='"+(nota*10)+"' bgcolor='green' border='1'><tr><td>"+nota +"%</td></tr></table>");
        });
        
        jQuery.fn.atualizaStatus= function(nota){
           $('div#percSenha').empty();

            var porcentagem = nota*10;
            var resto = porcentagem-nota;
            $('div#percSenha').html("<table width='100' bgcolor='#FFC' border='1'><tr><td><legend>"+nota+"%</legend><hr size='4' color='green' width="+porcentagem+"></td></tr></table>");

            
        }
        jQuery.fn.testaSenhaDecente= function(senha){
            //        jQuery.fn.testaSenhaDecente= function(){
            $('div#notaSenha').slideDown(); 
            var nota=0;
     
            if (senha.length==0){
                return 0;
            }

            var pattLetraMin= /[a-z]/g;
            var pattLetraMai= /[A-Z]/g;
            var pattNum= /[0-9]/g;
            var pattSim= /[!@#\$%\^&*()]/g;

            pattLetraMin.test(senha)?nota=nota+1:null;
            pattLetraMai.test(senha)?nota=nota+2:null;
            pattNum.test(senha)?nota=nota+3:null;
            pattSim.test(senha)?nota=nota+4:null;
            
            if (nota==10){
                $('#senhaAprovado').val('sim');
            }else {
                $('#senhaAprovado').val(null);
            }
            
            return nota; 
            //            $('div#percSenha').html("<table width='100' bgcolor='green' border='1'><tr><td width='"+porcentagem +"%'>"+nota +"%</td><td bgcolor=white width='"+resto +"%'>&nbsp;</td></tr></table>");
          
            
            
        }
        
    
    })
</script>        