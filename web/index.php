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
if (!$config->getAppReady()){
    header('Location: /app/installer/');
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=<? echo CHARSET; ?>" />
        <title><? echo TITULO; ?></title>
        <link href="<? echo BASE_STYLES; ?>custom.css.php" rel="stylesheet" type="text/css" />
        <link href="<? echo BASE_STYLES; ?>validation.css" rel="stylesheet" type="text/css" />
        <script language="javascript" src="<? echo BASE_SCRIPTS; ?>libs/jquery/jquery-1.7.2.js"></script>
        <script language="javascript" src="<? echo BASE_SCRIPTS; ?>libs/jquery/jquery.validate.js"></script>


        <script language="javascript">
            $(document).ready(function(){ 
                $('#form1').validate();
                
                
<? if (isset($_GET['err']) && ($_GET['err'] == 81)) { ?>
                            $('div#erro').slideDown();
                            $('div#erro').append('Login Desabilitado');
<? } else { ?>
    <? if (isset($_GET['err']) && ($_GET['err'] >= 2)) { ?>
                                $('div#erro').slideDown();
                                $('div#erro').append("<a href='#' id='remember'> Esqueci minha senha.</a>");
    <? }
} ?>
                
                            $('#remember').click(function(){
                                $('div#divRemember').empty();
                                $('div#divRemember').slideDown();
                                $('div#divRemember').load('/app/ajax/formResetPass.php');
                   
                            });

                
                        })
        </script>   

    </head>

    <body class="fundoPages">
        <div id="logos">
             <a href="<?echo URL_SITE;?>"><img src="<? echo BASE_IMAGES . LOGOTIPO_CLIENTE; ?>" alt="" /></a>
             <a href="<?echo URL_SITE;?>"><img src="<? echo BASE_IMAGES . LOGOTIPO; ?>" alt=""  /></a>

        </div>

        <fieldset class="borda" style="width:70%;padding:10px;padding-left:50px;padding-top:120px;position:relative;margin-left: 5em;">


            <legend class="tituloTab">
                <a> Entre com sua identifica&ccedil;&atilde;o</a>
            </legend>

            <form class="formStyle3" method="post" action="/app/controller/LoginController.php" id="form1" name="form1">
                <table style="width: auto;" border="0" align="center" cellpadding="2" cellspacing="2" class="borda">
                    <tr>
                        <td colspan="2" align="center">
                            <img src="<? echo BASE_IMAGES; ?>ico_lock.png"></img>
                            <tr>
                                <td align="right"><label for="login">Login:</label></td>
                                <td><input type="text" name="data[Usuario][login]" class="required" minlength="5" id="login" maxlength="15"  /></td>
                            </tr>
                            <tr>
                                <td align="right"><label for="senha">Senha:</label></td>
                                <td><input name="data[Usuario][senha]" type="password" class="required" minlength="4" id="senha" maxlength="15" /></td>
                            </tr>
                        </td>
                        <tr>
                            <td colspan="2" align="center">
                                <button name="btEntrar" type="submit" class="botaoMenor">
                                    <img src="<? echo BASE_IMAGES; ?>login.png" width="18" height="18" alt="" /> Entrar
                                </button> 
                            </td>
                        </tr>
                </table>
                <div id="erro" style="display: none;color: red;"></div>

                <p>&nbsp;</p>
                <br />


            </form>
            <center>
                <div id="divRemember" style="display: none;color: red;width: auto" class="borda">
                    


                </div>
                <div id="divResult" style="display: none;color: red;"></div>            
            </center>
        </fieldset>
    </body>
</html>