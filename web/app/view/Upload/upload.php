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
class IndexUploads{
    
}
include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/block.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/config.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/pages/javascriptMooTools.php');

?>


<script language="javascript">
    $(document).ready(function(){ 
//        $('#FormData').validate()
        window.addEvent('domready', function(){
        
            //        if ($('#FormData').validate()==true){
            var upload = new Form.Upload('url', {
                //            onsubmit:function(){
                //              if ($('#FormData').validate()==true){
                //                  
                //              }
                //              else {
                //                  alert('none');
                //                  this.end();
                //              }
                //            },    
                onComplete: function(){
                
                    alert('Upload Complete');
                    window.location.href=window.location.href;
                }
                
            
            });

            if (!upload.isModern()){
                // Use something like
            }
            //        }
        
        });
    });

</script>


<fieldset id="flUploads">

    <legend class="tituloTab">
        <a href="#" id="linkArq" class="tituloTab"><img src="<? echo BASE_IMAGES; ?>upload_file.png" >Uploads</a>
    </legend>
    <div id="wrapper" class="datagrid" style="width: 80%">

        <form method="post" id="FormData" action="/app/view/Upload/files.php" enctype="multipart/form-data">
            <fieldset>
                <legend class="tituloTab">Upload de Arquivos</legend>

                <div class="formRow">
                    <label for="url" class="floated">Arquivo: </label>
                    <input  class=" botaoMenor required" type="file" size="70" id="url" name="url[]" multiple><br>
                </div>

                <div class="formRow">
                    <input type="submit" id="_submit" name="_submit" class="botaoMenor" value="Enviar">
                    <input type="reset" id="reset" name="reset" class="botaoMenor" value="Limpar">
                </div>

            </fieldset>


        </form>

    </div>

</fieldset>

