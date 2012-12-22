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
class ResetPass{
    
}
?>

<script language="javascript">
            $(document).ready(function(){

                $('#resetaSenha').click(function(){
                    
                                var loginF=$('#loginForget').val();
                                var captcha=$('#captchaDados').val();
                                var aprovado=true;
                                var msg='preencha os campos:\n';
                                if (loginF==''){
                                    aprovado=false;
                                    msg+='-Login\n';
                                }
                                if (captcha==''){
                                    aprovado=false;
                                    msg+='-Captcha\n';
                                }
                    
                                if (aprovado){
                                    var dataString='data[Usuario][captcha]='+$('#captchaDados').val()
                                        + '&data[Usuario][login]='+ $('#loginForget').val();
                                    $.post('/app/ajax/recuperacaoSenha.php',dataString,
                                    function (data){
                                        $('div#divResult').slideDown();
                                        $('div#divResult').html(data);
                     
                                    }
                                );
                                }else {
                                    $('div#divResult').slideDown();
                                    $('div#divResult').html(msg); 
//                                    window.location.href=window.location.href;
                                }
                               

                   
                            });
            })

</script>
<form id="form2" class="datagrid">
    <table width="400">
        <thead>
            <tr>
                <th colspan="2">
                    Reset de Senha
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th width="50%"> Informe o login:</th>
                <td width="50%">
                    <input name="data[Usuario][loginForget]" type="text" id="loginForget" style="width:90px;background-color: #fcefa1;border: solid 1px #4a3803;"  value="<? if (isset($_SESSION['tryLogin'])){echo $_SESSION['tryLogin'];}; ?>" />
                </td>
            </tr>
            <tr>
                <th> e preencha de acordo com as letras pretas:<img id="captchaImg" src="/lib/captcha.php?l=150&amp;a=50&amp;tf=20&amp;ql=5" alt="Captcha" /></th>
                <td>
                    <input name="data[Usuario][captcha]" type="text" id="captchaDados" style="width:40px;background-color: #fcefa1;border: solid 1px #4a3803;"   />
                </td>
            </tr>

        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" style="text-align: center">
                    <button type="button" name="resetaSenha" id="resetaSenha" class="botaoMenor">Resetar minha Senha</button>
                </td>
            </tr>
        </tfoot>
    </table>


</form>