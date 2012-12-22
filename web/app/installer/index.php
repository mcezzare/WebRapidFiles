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
session_start();

if (!file_exists($_SERVER['DOCUMENT_ROOT'] . "/lib/config.php")) {
    die('Crie o arquivo /lib/config.php a partir do arquivo /lib/config-dist.php <br>
        e execute este instalador de novo. <br>
        Obrigado. <br>
');
}
require_once($_SERVER['DOCUMENT_ROOT'] . "/lib/config.php");
if (!isset($config)) {
    $config = new Config();
}

require_once($_SERVER['DOCUMENT_ROOT'] . "/app/installer/check.php");
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
        <? include($_SERVER['DOCUMENT_ROOT'] . '/pages/javascriptSyntaxHigh.php'); ?>

        <script language="javascript">
            $(document).ready(function(){ 
                $('#formRootDb').validate();
                $('a#linkAbout').toggle(
                function (){
                    $('#divAbout').slideDown();    
                },
                function (){
                    $('#divAbout').slideUp();    
                })
                $('a#linkNotas').toggle(
                function (){
                    $('#divNotas').slideDown();    
                },
                function (){
                    $('#divNotas').slideUp();    
                })
                $('a#linkShowSQLCREATE').toggle(
                function (){
                    $('#divSQLCreate').slideDown();    
                },
                function (){
                    $('#divSQLCreate').slideUp();    
                })
                
<? for ($x = 0; $x <= 5; $x++) { ?>
                            $('a#linkPasso<? echo $x; ?>').toggle(
                            function (){
                                $('#divPasso<? echo $x; ?>').slideDown();    
                            },
                            function (){
                                $('#divPasso<? echo $x; ?>').slideUp();    
                            })
<? } ?>
                
                
                
                
                
                      $('#rootTest').click(function(){
                          jQuery.fn.testRootPass();
                    
                      });
                      $('#rootPass').change(function(){
                          jQuery.fn.testRootPass();
                    
                      });
                      $('#rootPass').keypress(function(){
                          jQuery.fn.testRootPass();
                    
                      });
                
                      jQuery.fn.testRootPass = function(){
                          if ( $('#root').val()!='' && $('#rootPass').val() ){
                              var dataString='root='+$('#root').val()
                                  +'&root_pass='+ $('#rootPass').val();
                              $.post('/app/installer/dbTest.php',dataString,
                              function(data){
                                  $('#rootTestResults').empty();
                                  $('#rootTestResults').slideDown();
                                  $('#rootTestResults').html(data);
                                  if (data=='SUCESS'){
                                      $('#loginAprovado').val('sim');
                                  }else {
                                      $('#loginAprovado').val(null);
                                  }
                              }
                          );
                          }else {
                              $('#rootTestResults').empty();
                              $('#rootTestResults').slideDown();
                              $('#rootTestResults').html('Preencha os campos login e senha do root');
                              //                        $('#rootTestResults').fadeTo("slow", 1).animate({opacity: 1.0}, 1000).fadeTo("slow", 0);
                              //                        $('#rootTestResults').slideUp();

                          }
                      }
                
              

                
                  })
        </script>
        <style type="text/css">
            body{
                font-size: 80%;
            }
        </style>
    </head>
    <body>

        <fieldset class="borda">

            <legend class="tituloTab"> <a><img width="32" height="32" src="<? echo BASE_IMAGES; ?>ico_lock.png"></img>Instalador Rapid Files </a> </legend>
            Olá, bem vindo ao Rapid Files

            <fieldset id="fldWelcome" class="borda">
                <legend class="tituloTab"><img width="32" height="32" src="<? echo BASE_IMAGES; ?>information.png"></img>  <a href="#" id="linkAbout">Sobre</a> </legend>
                <div id="divAbout" style="display: none;">
                    <div id="divWelcome"> Versão <? echo WEBAPP_VERSION; ?><br />
                        As permissões do sistema se definem em 3 Grupos:
                        <ul>
                            <li><a>Cliente</a>:Usuários Externos.<span  id="detalhe">Apenas fazem upload e listam arquivos</span></li>
                            <li><a>Empresa</a>:Usuários Internos.<span  id="detalhe">Fazem upload e manipulam arquivos</span></li>
                            <li><a>Admins</a>:Usuários Administradores.<span  id="detalhe">Upload, manipulam arquivos, usuários e grupos</span></li>
                        </ul>
                        As ações são monitoradas e logadas. 
                    </div>
                    <fieldset id="fldHistorico" class="borda">
                        <legend class="tituloTab"> <a>Histórico</a> </legend>
                        <div id="divHistorico">
                            
                            Resumo: 
Imagine a situação. um cliente manda um email com 1 arquivo anexo de 2 MB p/ uma lista de pessoas da empresa(10 pessoas).<br />
sendo um arquivo em cada mailbox são 20MB.<br />

P/ editar esse arquivos os usuários tem q fazer o download do arquivo, alterar e enviar p/ o grupo novamente, mais 20MB n servidor.<br />
Alguns usuários tem mania de guardar tudo no email. <br />
Quantas versões desse arquivo teremos no servidor ?<br />
                            
                            
                            Constantemente tinha que aumentar o limite da caixa de correio dos usuários dos Servidores de Email que administro  por causa de grandes arquivos anexos e cópias em mensagens;<br />
                            Decidi criar esta ferramenta para
                            <ul>
                                <li><a>centralizar os arquivos</a><a href="#"></a> enviados em um repósitorio</li>
                                <li>manter um <a>catálogo</a> desses arquivos em um banco de dados</li>
                                <li>permitir facilidades como busca e controle dos arquivos</li>
                                <li>peritir ter <a>log</a> das operações do site</li>
                                <li>permitir a troca de arquivos entre 2 ou mais lados (Empresa e Cliente)</li>
                                <li>ensinar os usuários a <a>N&Atilde;O UTILIZAR O EMAIL</a> <i>(cc,bcc,forward,multiplos grupos com aliases etc..)</i> PARA ARQUIVOS <a>MAIORES QUE 1/2 MB</a></li>
                            </ul>
                            <a>Mario Cezzare Angelicola Chiodi mcezzare@gmail.com</a>
                        </div>
                    </fieldset>
                    <fieldset id="fldConfig" class="borda">
                        <legend class="tituloTab"> <a>Requisitos</a> </legend>
                        <div id="divRequisitos">
                            <p>Requisitos mínimos : </p>
                            <ul>
                                <li>PHP 5.3 ou superior (por que está usando OOP)</li>
                                <li>Mysql 5.0 ou superior (funções e joins)</li>
                                <li>Navegadores mais atuais de preferência</li>
                            </ul>
                            Desenvolvido inteiramente no:<img src="<? echo BASE_IMAGES; ?>installer/nb.png"></img>
                        </div>
                    </fieldset>

                </div>

            </fieldset>


            <div id="separator" style="height: 20px"></div>    

            <fieldset class="borda">

                <legend class="tituloTab"> <a href="#" id="linkNotas"><img width="32" height="32" src="<? echo BASE_IMAGES; ?>config.png"></img>Notas de instalação</a> </legend>
                <div id="divNotas" style="display: inline;">


                    <div id="separator" style="height: 20px"></div> 
                    <fieldset class="borda">
                        <legend class="tituloTab"><a href="#" id="linkPasso0"><img  src="<? echo BASE_IMAGES; ?>installer/bind.png" />passo 0- DNS</a></legend>
                        <div id="divPasso0" style="display: none;">
                            Adicione um host em sua rede ou domínio de nome rapidfiles, restarte o bind e veja se o nome está acessível. <br />
                            O meu domínio de desenvolvimento é lpanic.intra
                            <pre class="brush:bash">
surfer@lab:~$ su - 
root@lab:~# cd /etc/bind/master/
root@lab:/etc/bind/master# vi db.lpanic.intra 
root@lab:/etc/bind/master# cat db.lpanic.intra | grep rapidfiles
rapidfiles    IN  A   192.168.0.254
root@lab:/etc/bind/master# vi db.168.192.in-addr.arpa 
root@lab:/etc/bind/master# cat db.168.192.in-addr.arpa | grep rapidfiles
254.0   	PTR     rapidfiles.lpanic.intra.
root@lab:/etc/bind/master# /etc/init.d/bind9 restart
root@lab:/etc/bind/master# nslookup rapidfiles.lpanic.intra
Server:		127.0.0.1
Address:	127.0.0.1#53

Name:	rapidfiles.lpanic.intra
Address: 192.168.0.254
                            </pre> 





                        </div>
                    </fieldset>
                    <div id="separator" style="height: 20px"></div> 
                    <fieldset class="borda">

                        <legend class="tituloTab"><a href="#" id="linkPasso1"><img  src="<? echo BASE_IMAGES; ?>installer/apache.gif" />passo 1- Apache</a></legend>
                        <div id="divPasso1" style="display: none;">

                            1.1 Crie a pasta p/ o dominio no servidor
                            <pre class="brush:bash">
root@lab:/etc/bind/master# cd /var/sites/
root@lab:/etc/bind/master# mkdir rapidfiles.lpanic.intra
root@lab:chown -R surfer rapidfiles.lpanic.intra/

                            </pre> 

                            1.2 Adicione um host em seu  domínio de nome rapidfiles
                            <pre class="brush:bash">
root@lab:cd /etc/apache2/sites-available/
root@lab:vi rapidfiles.lpanic.intra
                            </pre> 
                            Arquivo rapidfiles.lpanic.intra                        
                            <pre class="brush:xml">
&lt;VirtualHost *:80&gt;
	ServerAdmin webmaster@localhost

	DocumentRoot /var/sites/rapidfiles.lpanic.intra/
    ServerName  rapidfiles.lpanic.intra
	&lt;Directory /&gt;
		Options FollowSymLinks
		AllowOverride All
	&lt;/Directory&gt;
	&lt;Directory /var/sites/rapidfiles.lpanic.intra/&gt;
		Options Indexes FollowSymLinks MultiViews
		AllowOverride All
		Order allow,deny
		allow from all
	&lt;/Directory&gt;

	ScriptAlias /cgi-bin/ /usr/lib/cgi-bin/
	&lt;Directory "/usr/lib/cgi-bin"&gt;
		AllowOverride None
		Options +ExecCGI -MultiViews +SymLinksIfOwnerMatch
		Order allow,deny
		Allow from all
	&lt;/Directory&gt;

	ErrorLog ${APACHE_LOG_DIR}/rapidfiles.lpanic.intra-error.log

	# Possible values include: debug, info, notice, warn, error, crit,
	# alert, emerg.
	LogLevel warn

	CustomLog ${APACHE_LOG_DIR}/rapidfiles.lpanic.intra-access.log combined

    Alias /doc/ "/usr/share/doc/"
    &lt;Directory "/usr/share/doc/"&gt;
        Options Indexes MultiViews FollowSymLinks
        AllowOverride None
        Order deny,allow
        Deny from all
        Allow from 127.0.0.0/255.0.0.0 ::1/128
    &lt;/Directory&gt;

&lt;/VirtualHost&gt;
                            </pre>
                            1.3 Habilite o domínio e restarte o apache:
                            <pre class="brush:bash">
root@lab:a2ensite rapidfiles.lpanic.intra
root@lab:/etc/init.d/apache2 reload
                            </pre> 





                        </div>
                    </fieldset>


                    <div id="separator" style="height: 20px"></div> 

                    <fieldset class="borda">
                        <legend class="tituloTab"><a href="#" id="linkPasso2"><img  src="<? echo BASE_IMAGES; ?>installer/php.gif" />passo 2- arquivos PHP</a></legend>
                        <div id="divPasso2" style="display: none;">
                            Certifique-se de configurar corretamente o arquivo /lib/config.php
                            definindo um usuario e senha p/ o Admin da instalação.
                            <pre class="brush:php">
&lt;?
// para o setup 
define('CONFIG_ADMIN_LOGIN', 'admin');
define('CONFIG_ADMIN_PASS', 'adminsenha');
?&gt;

                            </pre>
                        </div>
                    </fieldset>
                    <div id="separator" style="height: 20px"></div> 
                    <fieldset class="borda">
                        <legend class="tituloTab"><a href="#" id="linkPasso3"><img  src="<? echo BASE_IMAGES; ?>installer/mysql.png" />passo 3- banco MYSQL</a></legend>
                        <div id="divPasso3" style="display: none;">
                            <legend>Schema:</legend>
                            <img title="SCHEMA" src="<? echo BASE_IMAGES ?>docs/MyUploadsSchemaDb.png"></img>


                            <a>Alternativas:</a>
                            <div id="divpasso3.1" class="borda">
                                3.1 - Informe o login e senha do usuario root do mysql para o instalador criar o usuário e o banco
                                conforme a definições do arquivo config.php,exceto as credenciais do usuario ROOT
                                <div id="divFormRootDb" class="datagrid">
                                    <form action="/app/installer/dbInstall.php" method="POST" id="formRootDb" class="formStyle3">
                                        <table>
                                            <thead>
                                                <th colspan="2">Criar o usuário e o banco</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th style="width:20%">Login root Mysql</th>
                                                    <td><input type="text" name="root" id="root" class="required" /></td>
                                                </tr>
                                                <tr>
                                                    <th>Senha root Mysql </th>
                                                    <td><input type="password" name="root_pass" id="rootPass" class="required" /></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <button class="botaoMenor" type="button" name="rootTest" id="rootTest">Testar acesso do Root</button>
                                                        <div id="rootTestResults" style="display: none">

                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr title="Apenas leitura, configure o arquivo /lib/config.php">
                                                    <th>Servidor</th>
                                                    <td><input readonly="readonly"  type="text" name="db_host" id="dbHost" class="required" value="<? echo $config->getDbHost() ?>" /></td>
                                                </tr>

                                                <tr title="Apenas leitura, configure o arquivo /lib/config.php" >
                                                    <th>Nome do banco</th>
                                                    <td><input  readonly="readonly"  type="text" name="db_name" id="dbName" class="required" value="<? echo $config->getDbName() ?>" /></td>
                                                </tr>
                                                <tr title="Apenas leitura, configure o arquivo /lib/config.php">
                                                    <th>Nome do usuário</th>
                                                    <td><input  readonly="readonly"  type="text" name="db_user" id="dbUser" class="required" value="<? echo $config->getDbUser() ?>" /></td>
                                                </tr>

                                                <tr title="Apenas leitura, configure o arquivo /lib/config.php">
                                                    <th>Senha do usuário</th>
                                                    <td><input  readonly="readonly"  type="text" name="db_pass" id="dbPass" class="required" value="<? echo $config->getDbPass() ?>" /></td>
                                                </tr>
                                                <tr title="">
                                                    <th>Remover Usuário e Banco existente e Criar de novo </th>
                                                    <td><input  type="checkbox" name="drop_all" id="dbPass"  value="1" />se já teve problemas com a configuração e não tem dados no banco assinale essa opção</td>
                                                </tr>

                                            </tbody>
                                            <tfoot>

                                                <tr>
                                                    <td colspan="2">

                                                        <div id="divValidacoes">
                                                            <div style="display:inline-table;">
                                                                <label for="loginAprovado">#Login Root Aprovado</label>
                                                                <input type="text" id="loginAprovado" readonly="readonly" name="loginAprovado" value=""  class="required" minlength="3" size="3" />

                                                            </div>
                                                        </div>        
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td colspan="2"> <button class="botaoMenor">Criar</button></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </form>
                                </div>


                            </div>

                            <div id="separator" style="height: 20px"></div> 
                            <div id="divpassoSQL" class="borda">
                                3.2 - Acesse o servidor mysql como root  e rode o SQL  abaixo <a href="#" id="linkShowSQLCREATE">Mostrar SQL</a><br />
                                Caso vc queira executar essa opção, atenção com as variáveis definidas no arquivo config.php.
                                <div id="divSQLCreate" style="display: none;">
                             <pre class="brush:sql">
-- CRIA BANCO E USUARIO
drop database IF EXISTS <? echo DB_NAME ; ?>;
DROP USER '<? echo DB_USER ; ?>'@'localhost';
CREATE USER '<? echo DB_USER ; ?>'@'localhost' IDENTIFIED BY '<? echo DB_PASS ; ?>';
GRANT USAGE ON * . * TO '<? echo DB_USER ; ?>'@'localhost' IDENTIFIED BY '<? echo DB_PASS ; ?>' ;
    WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0 ;
CREATE DATABASE IF NOT EXISTS `<? echo DB_NAME ; ?>` ;
GRANT ALL PRIVILEGES ON `<? echo DB_NAME ; ?>` . * TO '<? echo DB_USER ; ?>'@'localhost'


--- cria as tabelas 
CREATE  TABLE IF NOT EXISTS `<? echo DB_NAME ; ?>`.`grupo_usuario` (
  `idgrupo_usuario` INT(11) NOT NULL AUTO_INCREMENT ,
  `grupo` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NULL DEFAULT NULL ,
  `descricao` VARCHAR(120) NULL ,
  PRIMARY KEY (`idgrupo_usuario`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
AUTO_INCREMENT = 4
COLLATE = utf8_bin

CREATE  TABLE IF NOT EXISTS `<? echo DB_NAME ; ?>`.`usuario` (
  `idusuario` INT(11) NOT NULL AUTO_INCREMENT ,
  `login` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NULL DEFAULT NULL ,
  `senha` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `email` VARCHAR(120) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NULL DEFAULT NULL ,
  `lembrete` VARCHAR(180) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NULL DEFAULT NULL ,
  `idgrupo_usuario` INT(11) NOT NULL ,
  `ativo` TINYINT(1) NOT NULL DEFAULT '1' ,
  `nivel` ENUM('Admin','Usuario') NULL DEFAULT 'Usuario' ,
  `link_reset_senha` MEDIUMTEXT  NULL DEFAULT NULL ,
  PRIMARY KEY (`idusuario`) ,
  UNIQUE INDEX `login_UNIQUE` (`login` ASC) ,
  INDEX `usuario_grupo_FK` (`idgrupo_usuario` ASC) ,
  CONSTRAINT `usuario_grupo_FK`
    FOREIGN KEY (`idgrupo_usuario` )
    REFERENCES `<? echo DB_NAME ; ?>`.`grupo_usuario` (`idgrupo_usuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin

CREATE  TABLE IF NOT EXISTS `<? echo DB_NAME ; ?>`.`arquivos` (
  `idarquivos` INT(11) NOT NULL AUTO_INCREMENT ,
  `nome` VARCHAR(200) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NULL DEFAULT NULL ,
  `tipo` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NULL DEFAULT NULL ,
  `tamanho` INT(11) NULL DEFAULT NULL ,
  `idusuario` INT(11) NULL DEFAULT NULL ,
  `data` DATETIME NULL DEFAULT NULL ,
  `ip` VARCHAR(16) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NULL DEFAULT NULL ,
  `browser` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NULL DEFAULT NULL ,
  PRIMARY KEY (`idarquivos`) ,
  INDEX `arquivo_usuarioFK` (`idusuario` ASC) ,
  CONSTRAINT `arquivo_usuarioFK`
    FOREIGN KEY (`idusuario` )
    REFERENCES `<? echo DB_NAME ; ?>`.`usuario` (`idusuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin

CREATE  TABLE IF NOT EXISTS `<? echo DB_NAME ; ?>`.`acao` (
  `idacao` INT NOT NULL AUTO_INCREMENT ,
  `acao` VARCHAR(45) NULL ,
  PRIMARY KEY (`idacao`) )
AUTO_INCREMENT = 11
ENGINE = InnoDB


CREATE  TABLE IF NOT EXISTS `<? echo DB_NAME ; ?>`.`site_log` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `idusuario` INT NOT NULL ,
  `idacao` INT NOT NULL ,
  `data_acao` DATETIME NOT NULL ,
  `objeto` MEDIUMTEXT  NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `usuario_log` (`idusuario` ASC) ,
  INDEX `acao_log` (`idacao` ASC) ,
  CONSTRAINT `usuario_log`
    FOREIGN KEY (`idusuario` )
    REFERENCES `<? echo DB_NAME ; ?>`.`usuario` (`idusuario` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `acao_log`
    FOREIGN KEY (`idacao` )
    REFERENCES `<? echo DB_NAME ; ?>`.`acao` (`idacao` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB


-- dados 
INSERT INTO `acao` (`idacao`,`acao`) VALUES (1,'upload');
INSERT INTO `acao` (`idacao`,`acao`) VALUES (2,'apaga arquivo');
INSERT INTO `acao` (`idacao`,`acao`) VALUES (3,'lista arquivos');
INSERT INTO `acao` (`idacao`,`acao`) VALUES (4,'atualiza usuário');
INSERT INTO `acao` (`idacao`,`acao`) VALUES (5,'cria usuário');
INSERT INTO `acao` (`idacao`,`acao`) VALUES (6,'remove usuário');
INSERT INTO `acao` (`idacao`,`acao`) VALUES (7,'login');
INSERT INTO `acao` (`idacao`,`acao`) VALUES (8,'logout');
INSERT INTO `acao` (`idacao`,`acao`) VALUES (9,'limpa logs');
INSERT INTO `acao` (`idacao`,`acao`) VALUES (10,'troca de senha')



INSERT INTO `grupo_usuario` (`idgrupo_usuario`,`grupo`,`descricao`) VALUES (1,'Cliente','Usuários Externos.Apenas fazem upload e listam arquivos');
INSERT INTO `grupo_usuario` (`idgrupo_usuario`,`grupo`,`descricao`) VALUES (2,'Empresa','Usuários Internos.Fazem upload e manipulam arquivos');
INSERT INTO `grupo_usuario` (`idgrupo_usuario`,`grupo`,`descricao`) VALUES (3,'Admin','Usuários Administradores.Upload, manipulam arquivos, usuários e grupos')";

INSERT INTO `usuario` 
(`idusuario`,`login`,`senha`,`email`,`lembrete`,`idgrupo_usuario`,`ativo`,`nivel`,`link_reset_senha`)
VALUES (1,'admin',md5('admin'),'EMAIL_ADMIN','',3,1,'Admin',NULL);

INSERT INTO `usuario` 
(`idusuario`,`login`,`senha`,`email`,`lembrete`,`idgrupo_usuario`,`ativo`,`nivel`,`link_reset_senha`)
VALUES (2,'empresa',md5('empresa'),'EMAIL_EMPRESA','',2,1,'Usuario',NULL); 

INSERT INTO `usuario` 
(`idusuario`,`login`,`senha`,`email`,`lembrete`,`idgrupo_usuario`,`ativo`,`nivel`,`link_reset_senha`)
VALUES (3,'cliente',md5('cliente'),'EMAIL_CLIENTE','',1,1,'Usuario',NULL) 
                            </pre> 
                            </div>
                            
                            </div>



                            Se não houve erros siga para o passo 4. 
                        </div>
                    </fieldset>

                    <div id="separator" style="height: 20px"></div> 
                    <fieldset class="borda">
                        <legend class="tituloTab"><a href="#" id="linkPasso4"><img  src="<? echo BASE_IMAGES; ?>installer/app_test.png" />passo 4- Teste a configuração</a></legend>
                        <div id="divPasso4" style="display: none;">

                            prossiga com os <a href="installer.php">testes de configuração</a><br/>

                            </pre>   
                        </div>
                    </fieldset>
                    <div id="separator" style="height: 20px"></div> 
                    <fieldset class="borda">
                        <legend class="tituloTab"><a href="#" id="linkPasso5"><img  src="<? echo BASE_IMAGES; ?>installer/app_go.png" />passo 5- Liberar APP</a></legend>
                        <div id="divPasso5" style="display: none;">
                            Após a configuração altere o valor da constante <b>APP_READY</b> para true para liberar o sistema e cadastrar os usuários.
                            <pre class="brush:php">
&lt;?
//altere p/ true p/ liberar o sistema após a configuração
define('APP_READY', false);
?&gt;

                            </pre>   
                        </div>
                    </fieldset>








                </div>
            </fieldset>
<!--
            <div id="separator" style="height: 20px"></div> 
            <fieldset class="borda">
                <legend class="tituloTab"><a>passo X- Liberar APP</a></legend>
                <div>
                    Após a configuração altere o valor 
                    <pre class="brush:php">
                    </pre>   
                </div>

                <div id="form" class="datagrid">
                    <form action="" method="">
                        <table>
                            <thead>
                                <th></th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </form>
                </div>
            </fieldset>
-->

    </body>
</html>


<?
/*
if (isset($_SESSION['config']['autenticado'])) { ?>

<? } else { ?>
<? } 
 * ?>
 */
?>        