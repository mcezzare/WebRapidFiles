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
error_reporting(E_ALL);
require_once($_SERVER['DOCUMENT_ROOT'] . "/lib/config.php");
if (!isset($config)) {
    $config = new Config();
}

require_once($_SERVER['DOCUMENT_ROOT'] . "/app/installer/check.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/lib/Utils.class.php");
$util = new Utils();
$root = $_POST['root'];
$rootPass = $_POST['root_pass'];
$loginUser=$_POST['db_user'];
$userPass=$_POST['db_pass'];
$dbNameCreate=$_POST['db_name'];
if ( isset($_POST['drop_all']) && ($_POST['drop_all']==1)){
    $dropALL=true;
}else {
    $dropALL=false;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=<? echo CHARSET; ?>" />
        <title><? echo TITULO; ?></title>
        <link href="<? echo BASE_STYLES; ?>custom.css.php" rel="stylesheet" type="text/css" />
        <link href="<? echo BASE_STYLES; ?>validation.css" rel="stylesheet" type="text/css" />
        <style type="text/css">
            body{
                font-size: 95%;
            }
        </style>
    </head>
    <body>
<fieldset id="flgeral">
      <legend class="tituloTab">
          <a href="#" id="linkGeral" class="tituloTab"><img src="<? echo BASE_IMAGES; ?>database_gear.png" ></img>Instalador do DB</a>
    </legend>
    <div id="divGeral">        
        
        
        
<?
$util->mostraObjeto($_POST);


$conRoot=mysql_connect(DB_HOST, $root, $rootPass);
//mysql_select_db(DB_NAME, $con);
echo 'conected as root...';
//part 1 - create db and user

$query0="drop database IF EXISTS $dbNameCreate";
$query0a="DROP USER '$loginUser'@'localhost'";
$query1="CREATE USER '$loginUser'@'localhost' IDENTIFIED BY '$userPass'";
$query2="GRANT USAGE ON * . * TO '$loginUser'@'localhost' IDENTIFIED BY '$userPass' 
    WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0 ";
$query3="CREATE DATABASE IF NOT EXISTS `$dbNameCreate` ";
$query4="GRANT ALL PRIVILEGES ON `$dbNameCreate` . * TO '$loginUser'@'localhost'    ";
$query5="RELOAD PRIVILEGES"; // not working



$queriesRoot=array($query1,$query2,$query3,$query4);
if ($dropALL){
   $queriesRoot=array($query0,$query0a,$query1,$query2,$query3,$query4);
}

for ($i=0;$i<count($queriesRoot);$i++){
    $sql = $queriesRoot[$i];
    $util->mostraSQL($sql);
    $rs= mysql_query($sql) or (print_r(mysql_error())) ;
    if($rs){
        echo 'SUCESS<br>';
    }
}
mysql_close($conRoot);
echo 'closing  root conection ...<br>';
echo 'conected as user...<br>';
$conUser=mysql_connect(DB_HOST, $loginUser, $userPass);
mysql_select_db(DB_NAME, $conUser);
//part 2 - create tables
$query6="CREATE  TABLE IF NOT EXISTS `".DB_NAME."`.`grupo_usuario` (
  `idgrupo_usuario` INT(11) NOT NULL AUTO_INCREMENT ,
  `grupo` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NULL DEFAULT NULL ,
  `descricao` VARCHAR(120) NULL ,
  PRIMARY KEY (`idgrupo_usuario`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
AUTO_INCREMENT = 4
COLLATE = utf8_bin";

$query7="CREATE  TABLE IF NOT EXISTS `".DB_NAME."`.`usuario` (
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
    REFERENCES `myuploads`.`grupo_usuario` (`idgrupo_usuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin";

$query8="CREATE  TABLE IF NOT EXISTS `".DB_NAME."`.`arquivos` (
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
    REFERENCES `myuploads`.`usuario` (`idusuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin";

$query9="CREATE  TABLE IF NOT EXISTS `".DB_NAME."`.`acao` (
  `idacao` INT NOT NULL AUTO_INCREMENT ,
  `acao` VARCHAR(45) NULL ,
  PRIMARY KEY (`idacao`) )
AUTO_INCREMENT = 11
ENGINE = InnoDB";

$query10="CREATE  TABLE IF NOT EXISTS `".DB_NAME."`.`site_log` (
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
    REFERENCES `myuploads`.`usuario` (`idusuario` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `acao_log`
    FOREIGN KEY (`idacao` )
    REFERENCES `myuploads`.`acao` (`idacao` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB";

$queriesUser=array($query6,$query7,$query8,$query9,$query10);
for ($i=0;$i<count($queriesUser);$i++){
    $sql = $queriesUser[$i];
    $util->mostraSQL($sql);
    $rs= mysql_query($sql) or (print_r(mysql_error())) ;
    if($rs){
        echo 'SUCESS<br>';
    }
}

echo 'carregando dados iniciais';
//part 3 - start data grupos, acoes, e usuario admin
$queryAcoes="
INSERT INTO `acao` (`idacao`,`acao`) VALUES (1,'upload');
INSERT INTO `acao` (`idacao`,`acao`) VALUES (2,'apaga arquivo');
INSERT INTO `acao` (`idacao`,`acao`) VALUES (3,'lista arquivos');
INSERT INTO `acao` (`idacao`,`acao`) VALUES (4,'atualiza usuário');
INSERT INTO `acao` (`idacao`,`acao`) VALUES (5,'cria usuário');
INSERT INTO `acao` (`idacao`,`acao`) VALUES (6,'remove usuário');
INSERT INTO `acao` (`idacao`,`acao`) VALUES (7,'login');
INSERT INTO `acao` (`idacao`,`acao`) VALUES (8,'logout');
INSERT INTO `acao` (`idacao`,`acao`) VALUES (9,'limpa logs');
INSERT INTO `acao` (`idacao`,`acao`) VALUES (10,'troca de senha')";

$queryGrupos="
INSERT INTO `grupo_usuario` (`idgrupo_usuario`,`grupo`,`descricao`) VALUES (1,'Cliente','Usuários Externos.Apenas fazem upload e listam arquivos');
INSERT INTO `grupo_usuario` (`idgrupo_usuario`,`grupo`,`descricao`) VALUES (2,'Empresa','Usuários Internos.Fazem upload e manipulam arquivos');
INSERT INTO `grupo_usuario` (`idgrupo_usuario`,`grupo`,`descricao`) VALUES (3,'Admin','Usuários Administradores.Upload, manipulam arquivos, usuários e grupos')";

$queryUsers="
INSERT INTO `usuario` 
(`idusuario`,`login`,`senha`,`email`,`lembrete`,`idgrupo_usuario`,`ativo`,`nivel`,`link_reset_senha`)
VALUES (1,'admin',md5('admin'),'EMAIL_ADMIN','',3,1,'Admin',NULL);

INSERT INTO `usuario` 
(`idusuario`,`login`,`senha`,`email`,`lembrete`,`idgrupo_usuario`,`ativo`,`nivel`,`link_reset_senha`)
VALUES (2,'empresa',md5('empresa'),'EMAIL_EMPRESA','',2,1,'Usuario',NULL); 

INSERT INTO `usuario` 
(`idusuario`,`login`,`senha`,`email`,`lembrete`,`idgrupo_usuario`,`ativo`,`nivel`,`link_reset_senha`)
VALUES (3,'cliente',md5('cliente'),'EMAIL_CLIENTE','',1,1,'Usuario',NULL) 
";

$queriesUserData=array($queryAcoes,$queryGrupos,$queryUsers);
for ($i = 0; $i < count($queriesUserData); $i++) {


    $sql = $queriesUserData[$i];
    $consultas = explode(';', $sql);
    for ($x = 0; $x < count($consultas); $x++) {
        $sqlDado = $consultas[$x];

        $util->mostraSQL($sqlDado);
        $rs = mysql_query(utf8_decode($sqlDado)) or (print_r(mysql_error()));
        if ($rs) {
            echo 'SUCESS<br>';
        }
    }
}

mysql_close($conUser);
echo 'closing  user conection ...<br>';
echo 'Fim<br>';
?>
A aplicação está pronta p/ ser testada.<br> 
<a href="/app/installer/index.php?step=4">Continue no  passo 4</a>
</div>
    </body>
</html>