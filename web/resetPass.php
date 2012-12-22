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
require_once($_SERVER['DOCUMENT_ROOT'] . "/lib/config.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/app/model/Usuario.class.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/app/controller/UsuarioController.php");

$userC = new UsuarioController();
if (isset($_GET['link']) && ($_GET['link'] != '')) {
    $link = $_GET['link'];
    $updatable = $userC->procuraLinkPass($link);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=<? echo CHARSET; ?>" />
        <title><? echo TITULO; ?> Troca de Senha</title>
        <link href="<? echo BASE_STYLES; ?>/custom.css" rel="stylesheet" type="text/css" />
        <link href="<? echo BASE_STYLES; ?>/validation.css" rel="stylesheet" type="text/css" />
        <script language="javascript" src="<? echo BASE_SCRIPTS; ?>libs/jquery/jquery-1.7.2.js"></script>
        <script language="javascript" src="<? echo BASE_SCRIPTS; ?>libs/jquery/jquery.validate.js"></script>
        <script language="javascript" src="<? echo BASE_SCRIPTS; ?>libs/customJQueryFunctions.js"></script>


        <script language="javascript">
            $(document).ready(function(){ 
                $('#form1').validate();
                
                
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
                
                
                jQuery.fn.testaConfirmacaoSenha= function(){
                    var senha=$('#senha').val();
                    var confSenha=$('#senha2').val();
                
                    if (senha!=confSenha){
                        $('#senha2Aprovado').val(null);
                        return false;
                    }else {
                        $('#senha2Aprovado').val('sim');
                        return true;
                    }
                  }
                
                $('#senha2').blur(function(){
                    jQuery.fn.testaConfirmacaoSenha();
                });
                
                $('#senha2').keypress(function(){
                    jQuery.fn.testaConfirmacaoSenha();
                });
                
            })
        </script>   

    </head>

    <body class="fundoPages">
        <div id="logos">
            <img src="<? echo BASE_IMAGES . LOGOTIPO_CLIENTE; ?>" alt="" />
            <img src="<? echo BASE_IMAGES . LOGOTIPO; ?>" alt="" width="153" height="103" />

            <?
//            if (substr($_SERVER['HTTP_HOST'], -2) == "br") {
//                $link = "http://delageuploads2.portari.com.br";
//            } else {
//                $link = "http://delageuploads2.portari.intra";
//                //echo $_SERVER['HTTP_HOST'];
//            }
//            
            ?>
        </div>

        <fieldset class="borda" style="padding:10px;padding-left:50px;padding-top:120px;position:relative;margin-left: 2em;">


            <legend class="tituloTab">
                <a><img src="<? echo BASE_IMAGES; ?>user_business.png"></img> Troca de senha</a>
            </legend>

            <?
            if (($updatable instanceof Usuario) && ($updatable->getId() != 0) && ($updatable->isAtivo())) {
                $_SESSION['idusuario'] = $updatable->getId();
                ?>
                <form class="formStyle3" method="post" action="/app/controller/resetPassController.php" id="form1" name="form1">
                    <table  border="1" align="center" cellpadding="2" cellspacing="2" class="borda" style="width: 95%">
                        <tr>
                            <td colspan="2" align="center">

                                <tr>
                                    <td align="right" ><label for="login">Login:</label></td>
                                    <td align="left"><? echo $updatable->getLogin(); ?></td>
                                </tr>
                                <tr>
                                    <td align="right"><label for="senha"  style="padding: 2px 2px 2px 2px;  ">Senha:</label>
                                        


                                    </td>
                                    <td>
                                        <input name="data[UsuarioRemember][senha]" type="password" class="required" minlength="4" id="senha" maxlength="15" />
                                        <div id="sugestaoSenha" class="sugestaoSenha"></div>
                                        <a href="#" id="linkSugestaoSenha" name="linkSugestaoSenha" style="color:red;font-size: 80%;">Sugestão de Senha</a> | <a href="#" id="esconde" style="color:red;font-size: 80%;" >esconder sugestão</a>

                                        <div id="dicaSenha" style="display:none;color: red;font-weight: bold;">A nota deve ser=10.<br>Utilize letras a-z A-Z,núm 0-9 e símbolos@$#&*)(!</div>
                                        <div style="display: inline-table ">
                                            
                                        </div>
                                        
                                        
                                        <div id="notaSenha" class="sugestaoSenha" style="display:inline-table;position: relative " >
                                            Nota:
                                        </div>
                                        <div id="percSenha" class="borda"  style="display:inline-table ;height: 5px;width: 100px;background-color: grey;padding: 2px 2px 2px 2px;" >

                                        </div>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right"><label for="senha2">Confirmação de Senha:</label></td>
                                    <td><input name="data[UsuarioRemember][senha2]" type="password" class="required" minlength="4" id="senha2" maxlength="15" /></td>
                                </tr>
                                <tr>
                                    <td align="right"><label for="lembrete">Lembrete de Senha:</label></td>
                                    <td><input name="data[UsuarioRemember][lembrete]" type="text" class="required" minlength="4" id="lembrete" maxlength="15" /></td>
                                </tr>
                            </td>

                            <tr>
                                <td colspan="2" align="center">
                                    <div id="divValidacoes" style="display: inline;color: red;clear: both">
                                        <div style="display:inline-table;">
                                            <label for="senhaAprovado">#Senha Aprovada</label>
                                            <input type="text" id="senhaAprovado" readonly="readonly" name="senhaAprovado" value=""  class="required" minlength="3" size="3">
                                        </div>   
                                        <div style="display:inline-table;">
                                            <label for="senha2Aprovado">#Confirmação de Senha</label>
                                            <input type="text" id="senha2Aprovado" readonly="readonly" name="senha2Aprovado" value=""  class="required" minlength="3" size="3">
                                        </div>   


                                    </div>


                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center">
                                    <button name="btEntrar" type="submit" class="botaoMenor">
                                        <img src="<? echo BASE_IMAGES; ?>user_edit.png" width="18" height="18" alt="" /> Atualizar
                                    </button> 
                                    <input name="data[UsuarioRemember][update]" type="hidden" value="true" />

                                </td>
                            </tr>
                    </table>


                    <div id="erro" style="display: none;color: red;"></div>

                    <p>&nbsp;</p>
                    <br />


                </form>
            <? } else { ?>
            Esse link já expirou.<br>
                Contate o Administrador ou utilize a tela de login neste <a href="/index.php?err=4">Link</a>
            <? } ?>
            <center>
                <div id="divResult" style="display: none;color: red;"></div>            
            </center>
        </fieldset>
    </body>
</html>