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
require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/Utils.class.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/lib/block.php');
$util = new Utils();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=<? echo CHARSET; ?>" />
        <title><? echo TITULO; ?></title>
        <link href="<? echo BASE_STYLES; ?>/custom.css.php" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="/favicon.ico" />
        <? include($_SERVER['DOCUMENT_ROOT'] . '/pages/javascript.php'); ?>
    </head>
    <body class="fundoPages">
        <header>
            <div id="header">
                <nav>
                    <div id="logos">
                        <a href="<? echo URL_SITE; ?>"><img src="<? echo BASE_IMAGES . LOGOTIPO_CLIENTE; ?>" alt="" /></a>
                        <a href="<? echo URL_SITE; ?>"><img src="<? echo BASE_IMAGES . LOGOTIPO; ?>" alt="" /></a>

                        <?
//                        if (substr($_SERVER['HTTP_HOST'], -2) == "br") {
//                            $link = "http://delageuploads.portari.com.br";
//                        } else {
//                            $link = "http://delageuploads.portari.intra";
//                            //echo $_SERVER['HTTP_HOST'];
//                        }
//                         $_GET['section']=='' ? echo null : echo null;
                        $mark = " id=\"ativo\" ";
//                        if ($_GET['section']==''){echo $mark;}
                        ?>
                    </div>
                    <center>
                        <div id="navBar" style="display: inline;">
                            <ul>
                                <? if (isset($_SESSION['usuario']['tmpLink']) && ($_SESSION['usuario']['tmpLink'] != null)) { ?>
                                    <div id="divMensagens" style="display: none" class="msg">
                                        Houveram tentativas de resetar sua senha.
                                        <a href="#" id="verLog" title="...">+informações</a> 
                                        <div id="logTentativas" style="display: none;top:50px;left: 20px;right: 20px;bottom: 10px; width: auto;height: auto;overflow: auto" class="painel">
                                            <a href="#" id="fechaPainel">Fechar</a>
                                        </div>
                                        <br />     
                                        Clique <a href="#" id="cleanMsg">aqui</a> p/ limpar essa mensagem.    
                                    </div>
                                    <li><a href="#" id="linkMessages"><img border="0" title="Mensagens pra você" width="24" height="24" src="<? echo BASE_IMAGES; ?>messages.png"></img></a>
                                        <div id="formHidden" style="display: none">
                                            <form id="formRemoveMsg" method="post" action="/app/controller/PostController.php ">
                                                <input type="hidden" name="usuario[removeMsg]" value="true" />
                                                <input type="hidden" name="usuario[section]" value="<? echo  $_GET['section'] ;?>" />
                                                <input type="hidden" name="usuario[action]" value="<? echo  $_GET['action']; ?>" />

                                            </form>
                                        </div>
                                    <? } ?>
                                    <li><a href="#" id="linkDetalhesUsuario">Meu Perfil</a></li>
                                    <? if ($_SESSION['usuario']['nivel'] == 2) { ?>
                                        <li <?
                                    if ($_GET['section'] == 'admin') {
                                        echo $mark;
                                    }
                                        ?>>
                                            <a href="<? echo $_SESSION['usuario']['view'] . "?section=admin&action=index"; ?>">Admin </a>
                                        </li>
                                        <li<?
                                        if ($_GET['section'] == 'grupos') {
                                            echo $mark;
                                        }
                                        ?>>
                                            <a href="<? echo $_SESSION['usuario']['view'] . "?section=grupos&action=index"; ?>">Grupos </a>
                                        </li>
                                        <li<?
                                        if ($_GET['section'] == 'usuarios') {
                                            echo $mark;
                                        }
                                        ?>>
                                            <a href="<? echo $_SESSION['usuario']['view'] . "?section=usuarios&action=index"; ?>">Usu&aacute;rios </a>
                                        </li>
                                        <li<?
                                        if ($_GET['section'] == 'monitoracao') {
                                            echo $mark;
                                        }
                                        ?>>
                                            <a href="<? echo $_SESSION['usuario']['view'] . "?section=monitoracao&action=index"; ?>">Monitora&ccedil;&atilde;o </a>
                                        </li>
                                    <? } ?>


                                    <li<?
                                    if ($_GET['section'] == 'uploads') {
                                        echo $mark;
                                    }
                                    ?>>
                                        <a href="<? echo $_SESSION['usuario']['view'] . "?section=uploads&action=upload"; ?>">Uploads</a>
                                    </li>
                                    <li<?
                                        if ($_GET['section'] == 'arquivos') {
                                            echo $mark;
                                        }
                                    ?>>
                                        <a href="<? echo $_SESSION['usuario']['view'] . "?section=arquivos&action=index"; ?>">Arquivos</a>
                                    </li>



                                    <li><a href="/app/controller/LoginController.php?action=logout">Sair</a></li>
                            </ul>
                        </div>
                    </center>     
                    <div id="divDetalhesUsuario" style="display: none">
                        <?
                        try {
                            $u = new Usuario();
                            $u->setId($_SESSION['usuario']['id']);
                            $u->setLogin($_SESSION['usuario']['login']);
                            $u->setGrupo($_SESSION['usuario']['grupo']);
                            $u->setNivel($_SESSION['usuario']['nivel_nome']);
                            $u->setView($_SESSION['usuario']['view']);

                            $util->mostraObjetoUser($u);
                        } catch (Exception $err) {
                            echo $err->getMessage();
                        }
                        ?>
                    </div>

                </nav>
            </div>
        </header>
        <script language="javascript">
            $(document).ready(function(){
                $('a#linkDetalhesUsuario').toggle(
                function (){
                    $('div#divDetalhesUsuario').slideDown();    
                },
                function (){
                    $('div#divDetalhesUsuario').slideUp();    
                })
                $('a#linkMessages').toggle(
                function (){
                    $('div#divMensagens').slideDown();    
                },
                function (){
                    $('div#divMensagens').slideUp();    
                })
                
                $('a#verLog').toggle(
                function (){
                    $('div#logTentativas').slideDown(); 
                    $('div#logTentativas').load('/app/ajax/logResetPass.php'); 
                    
                },
                function (){
                    $('div#logTentativas').slideUp();    
                })
                $('a#fechaPainel').click(function(){
                    $('div#logTentativas').empty();
                    $('div#logTentativas').slideUp();
                })
                $('a#cleanMsg').click(function(){
                    
                    $('#formRemoveMsg').submit();
                    
                })
            });
        </script>