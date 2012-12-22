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
require_once($_SERVER['DOCUMENT_ROOT'] . "/lib/config.php");
if (!isset($config)) {
    $config = new Config();
}
header('Content-type: text/css');
//header('Content-Disposition: attachment; filename="custom.css"');

?>
/* 
    Document   : custom
    Created on : Aug 29, 2012, 4:27:41 PM
    Author     : surfer
    Description:
        Purpose of the stylesheet follows.
*/
@charset "UTF-8";
body {
    /*	background: #ECE9D8;*/
    /*	color: #fff;*/
    font-family:Verdana, Geneva, sans-serif;
    font-size:90%;
    /*	margin: 0;*/
}
.fundoPages {
    background-color: #fff;
    margin-left: 0px;
    margin-top: 0px;
    margin-right: 0px;
    margin-bottom: 0px;
    background-image:url('<? echo BASE_IMAGES.BACKGROUND?>');
    text-align: center;
    background-attachment:fixed;
    background-position:center;
    background-repeat:no-repeat;
}
/* Paginas */
#divPage {
    display:block;
    -moz-border-radius: 1em 1em 1em 1em;
    border-radius: 1em 1em 1em 1em;
    padding:1px;
}

/* Estilo para os formularios */

.titulo {
    font-family: Verdana, Geneva, sans-serif;
    font-size: 12px;
    color: #006;
    font-weight:bold;
    text-align: center;
}
.tituloMenor {
    font-family: Verdana, Geneva, sans-serif;
    font-size: 10px;
    color: #006;
    font-weight:bold;
}

.linhasTabela {
    font-family: Verdana, Geneva, sans-serif;
    font-size: 10px;
    color: #333;
}
.borda{
    border:thin solid #003366;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius: 5px;
    -moz-background-clip: padding;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
}
.statusRegistros {
    font-family: Verdana, Geneva, sans-serif;
    font-size: 12px;
    font-weight: normal;
    text-align: center;
}
.tituloTab {
    font-family: Verdana, Geneva, sans-serif;
    font-size: 15px;
    color: #003;
    font-weight:bold;
    text-align:left;
}
.tituloTabela {
    font-family: Verdana, Geneva, sans-serif;
    font-size: 10px;
    color: #003;
    font-weight:bold;

}
.botao {
    font-family: Verdana, Geneva, sans-serif;
    font-size: 12px;
    background-color: #EDEDED;
    border: thin outset #003;
    font-weight: bold;
    color: #006;
    padding: 2.5px 8px;
    -webkit-border-radius: 9px;
    -moz-border-radius: 9px;
    border-radius: 9px;
    -webkit-box-shadow: rgba(0, 0, 0, 1) 0 1px 0;
    -moz-box-shadow: rgba(0, 0, 0, 1) 0 1px 0;
    box-shadow: rgba(0, 0, 0, 1) 0 1px 0;
}

/* criando de novo  para OS */
.formStyle3 fieldset {
    position:relative;
    border:solid 1px #003;
    padding:10px;
    margin:15px 0;
}
.formStyle3 tr {
    border-bottom:thin solid #003;
    font-family:Verdana, Geneva, sans-serif;font-size:10px;
}
.formStyle3 input[type="text"] {
    float:left;
    width:auto;
    height:auto;
    border:solid 1px #000;
    padding:5px;
    color:#003;
    background-color:#FFF;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius: 5px;
    -moz-background-clip: padding;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
}
.formStyle3 textarea {
    float:left;
    width:auto;
    height:auto;
    border:solid 1px #000;
    padding:5px;
    color:#003;
    background-color:#FFF;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius: 5px;
    -moz-background-clip: padding;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
}
.formStyle3 input[type="password"] {
    float:left;
    width:auto;
    height:auto;
    border:solid 1px #000;
    padding:5px;
    color:#003;
    background-color:#FFF;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius: 5px;
    -moz-background-clip: padding;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
}
.formStyle3 label {
    margin:0 5px 0 0;
    font-size:10px;
    font-weight:bold;
    font-family:Verdana, Geneva, sans-serif;
    color:#000;	
}

.formStyle3 table {
    bordercolor:"#000099";

}
.formStyle3 input[type="select"] {
    float:left;
    width:auto;
    height:auto;
    border:solid 1px #003366;
    padding:5px;
    color:#003366;
    margin: 2px 2px 2px 2px;
    background-color:#ccffff;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius: 5px;
    -moz-background-clip: padding;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
    background-color: #A9A9A9;
}

a{
    text-shadow: 2px 2px 2px #ffc042;
    filter: dropshadow(color=#ffc042, offx=2, offy=2);
}

/* a, a:visited {color:#dd311f;} */
a:hover {
    color:#4848FF;
    text-shadow: 2px 2px 2px #428eff;
    filter: dropshadow(color=#428eff, offx=2, offy=2);
}

header {font-family:Trebuchet MS;}
/*header li, footer li {float:left; list-style:none;}*/
/*header h1 { position:absolute; top:10px; left:20px; display:block; width:256px; height:115px; background:transparent url("../images/stwbrasil-logo.jpg") no-repeat 0 0;}
header h1 a { text-indent:-9999px; display:block; width:256px; height:115px;}
header .top-menu {
    	position:absolute; 
    top:5px;
    right:-12px;
    width:90%;
    height: 28px;
}
header .top-menu li {padding:2px 3px; font-size:13px; color:#006;  text-shadow: 1px 1px 1px #fabf99; line-height:20px;}
header .top-menu a {color:#003366;}

header #search {position:absolute; bottom:60px; right:20px;}
header #search input[type="text"] {float:left; width:170px; border:solid 1px #EA9C5C; padding:3px; color:#A9A9A9; background-color:#FFF;
                                   -moz-border-radius: 5px; 
                                   -webkit-border-radius: 5px; 
                                   border-radius: 5px; 
                                   -moz-background-clip: padding; -webkit-background-clip: padding-box; background-clip: padding-box;
}

header #search button {background:none; border:none; margin:0 0 0 5px; padding:0;}
*/


/** Tables **/
div #index table {
    /*	border-right:1 px;*/
    clear: both;
    color: #333;
    margin-bottom: 10px;
    width: 99%;
    font-size: 80%;
    alignment-adjust: central;
}
div #index th {
    border:0;
    border-bottom:2px solid #555;
    text-align: left;
    padding:4px;
    text-transform: uppercase;
}
div #index th a {
    /*	display: block;
            padding: 2px 4px;*/
    text-decoration: none;
}
div #index th a img {
    /*	display: block;
            padding: 2px 4px;*/
    border: 0px;
    width: 10px;
    height: 10px;
}
div #index th a img:hover {
    /*	display: block;
            padding: 2px 4px;*/
    border: 2px;
    width: 13px;
    height: 13px;
}
/*div #index th a.asc:after {
        content: ' ?';
}
div #index th a.desc:after {
        content: ' ?';
}*/
div #index table tr td {
    padding: 6px;
    text-align: left;
    vertical-align: top;
    border-bottom:1px solid #ddd;
}
div #index table tr:nth-child(even) {
    background: #f9f9f9;
}
div #index td.actions {
    text-align: center;
    white-space: nowrap;
}
div #index table td.actions a {
    margin: 0px 6px;
    padding:2px 5px;
}

tr:hover{
    color : #003366;
    /*    font-size: 13px;*/
    /*    font-weight:bold;*/
    background-color: #ccffff;
}

.msg{
    position: relative;
    text-align:center;
    font-family: Verdana, Geneva, sans-serif;
    font-size: 12px;
    background-color: #EDEDED;
    border: thin outset #003;
    font-weight: bold;
    color: #006;
    /*    padding: 2.5px 8px;*/
    -webkit-border-radius: 9px;
    -moz-border-radius: 9px;
    border-radius: 9px;
    -webkit-box-shadow: rgba(0, 0, 0, 1) 0 1px 0;
    -moz-box-shadow: rgba(0, 0, 0, 1) 0 1px 0;
    box-shadow: rgba(0, 0, 0, 1) 0 1px 0;
    alignment-baseline: central;
    alignment-adjust: central;
    /*    padding-left: 150px;*/

}


/*index links*/
div #paggingIndex{
    /*    padding: 2.5px 8px;*/
    position: relative;
    text-align:center;
    padding-top: 5px;
    padding-bottom: 5px;
    /*    border: inset 1px #003;*/
    border-bottom: inset 1px #003;
    border-bottom-left-radius: 1px;
    border-bottom-right-radius: 1px;
    alignment-baseline: central;
    alignment-adjust: central;
    width: 10%;
    overflow: auto;
    -webkit-border-radius: 6px;
    -moz-border-radius: 6px;
    border-radius: 6px;
    -webkit-box-shadow: rgba(0, 0, 0, 1) 0 1px 0;
    -moz-box-shadow: rgba(0, 0, 0, 1) 0 1px 0;
    box-shadow: rgba(0, 0, 0, 1) 0 1px 0;
    min-width: 30%;
    max-width: 100%;
}
div #paggingIndex a{
    color:blue;
}
div #paggingIndex a:hover{
    color:blue;
    font-size: 110%;
    font-weight: bold;
}

#footer{
    position: fixed;
    clear: both;
    padding: 2px 2px 2px 2px;
    text-align: center;
    font-size: 70%;
    color: #003366;
    text-shadow: rgba(166, 0, 0, 1) 0 1px 0;
    bottom: 0px;
     alignment-adjust: central;
     width: 97%;
}


#container *{
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius: 5px;
    -moz-background-clip: padding;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
    margin-top: 0;
    margin-right: auto;
    margin-bottom: 0;
    margin-left: auto;
    /*	min-height:80px;*/

}

#container #leftPanel {
    border: 1px solid #006;
    position: inherit;
    color:#006;
    text-align:left;
    position: relative;
    font-size: 12px;
    padding-left: 1px;
    max-height: 200px;
    overflow: scroll;
}

#container #rightPanel {
    border: 1px solid #006; 
    position: inherit;
    padding-right: 1px;
}

#container th{
    color:#006;
    text-align:left;
    position: relative;
    font-size: 10px;

}

#container td{
    color:#000;
    text-align:left;
    position: relative;
    font-size: 11px;

}

#container legend{
    color:#006;
    text-align:left;
    position: relative;
    /*    font-size: 90%;*/
    font-weight:bold;
    font-size: 12px;
    text-transform: uppercase;
    text-shadow: rgba(1, 0, 0, 1) 0 0px 0;

}

#container li{
    list-style-position: inside;
    margin-top: 1em;
    margin-bottom: 1em;
    padding:1px 1px;
    font-weight:bold;
    clear: both;
    text-align: left;
    padding-left: 1px;
    /*    line-height: 10px;*/
}
*  #indice{
    width: 20px;
    background-color:#A9A9A9;
    text-shadow: rgba(1, 0, 0, 1) 0 0px 0;    
    font-size: 9px;
    text-align: left;
}

div #navBar ul {
    /*    clear:both;*/
    /*    position:absolute;*/
    left:-6px;
    /*    bottom:-299px;*/
    width:90%;
    /*    height:auto;*/
    border-bottom:solid 1px #FFF;
    /*    top: 120;*/
    /*    overflow: auto;*/

}
div #navBar ul li {
    display: inline;
    padding:5px 2px 2px 5px; 
    font-size:15px; font-weight:bold; 
    color:#003366;
    /*text-shadow:0 0 3px #431D1C;*/
    /*    background:transparent url("../images/bg-menu-sep.png") no-repeat 100% 0;	*/
}

div #navBar ul li a {
    color:#006 ;
    text-decoration:none;
    text-shadow: 2px 2px 2px #fcb315;
    filter: dropshadow(color=#fcb315, offx=2, offy=2);
    /* color:#0033ff ;*/
    /*text-shadow: 1px 1px 2px #003366;*/
}
div #navBar ul li a:hover {
    color:#006;
    text-decoration:underline;
    text-shadow: 2px 2px 2px #90dcfc;
    filter: dropshadow(color=#90dcfc, offx=2, offy=2);
}

div #navBar #ativo {
    color:#006;
    text-decoration:underline;
    text-shadow: 2px 2px 2px #90dcfc;
    filter: dropshadow(color=#90dcfc, offx=2, offy=2);
    font-size: 110%;
    border: 1px solid #006;
     padding: 2px 10px;
     -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius: 5px;
    -moz-background-clip: padding;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
    margin-top: 0;
    margin-right: auto;
    margin-bottom: 0;
    margin-left: auto;
    background-color: #ccffff;
     
}



#footer {
    padding:5px 2px 2px 5px; 
    font-size:11px; font-weight:bold; 
    color:#006;
    text-shadow:0 0 3px #431D1C;
}
/*
#footer a:hover{
    padding:5px 2px 2px 5px; 
    font-size:11px; font-weight:bold; 
    color:#431D1C;
    text-shadow:0 0 3px #003366;
}*/

div #bottom{
    position:relative;
    bottom: -1px;
    clear: both;
    padding: 6px 10px;
    text-align: right;
    font-size: 80%;
    color: #003366;
    text-shadow: rgba(166, 0, 0, 1) 0 1px 0; 
    text-align: center
}

/* FIM VISAO GERAL DO ACESSO*/
/* FOTOS */
#divFotos {
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius: 5px;
    -moz-background-clip: padding;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
    margin-top: 0;
    margin-right: auto;
    margin-bottom: 0;
    margin-left: auto;
    font-size: 90%;
}


#divFotos th{
    color:#006;
    text-align:left;
    position: relative;
    font-size: 80%;
    font-size: 10px;
    border-bottom:thin solid #006;
}
#divFotos td{
    color:#000;
    text-align:left;
    position: relative;
    font-size: 80%;
    font-size: 11px;

}
#divFotos legend{
    color:#006;
    text-align:left;
    position: relative;
    font-size: 90%;
    font-weight:bold;
    font-size: 12px;

}

#divFotosPainel  *{
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius: 5px;
    -moz-background-clip: padding;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
    margin-top: 0;
    margin-right: auto;
    margin-bottom: 0;
    margin-left: auto;
    /*	min-height:80px;*/

}

#divFotosPainel #leftPanel {
    border: 1px solid #006;
    position: inherit;
    color:#006;
    /*    text-align:left;*/
    /*    position: relative;*/
    font-size: 10px;
    padding-left: 1px;
    max-height: 700px;
    overflow: scroll;
    min-height: 250px;
}

#divFotosPainel #rightPanel2 {
    border: 1px solid #006; 
    position: inherit;
    padding-right: 1px;
}

#divFotosPainel th{
    color:#006;
    text-align:left;
    position: relative;
    font-size: 10px;
    border-bottom:thin solid #006;

}

#divFotosPainel td{
    color:#000;
    text-align:left;
    position: relative;
    font-size: 11px;

}

#divFotosPainel legend{
    color:#006;
    text-align:left;
    position: relative;
    /*    font-size: 90%;*/
    font-weight:bold;
    font-size: 12px;
    text-transform: uppercase;
    text-shadow: rgba(1, 0, 0, 1) 0 0px 0;

}

.listaChaves{
    list-style-image: url("/images/bullet_key.png");
    text-combine-horizontal: all;
    /*    float: left;
        text-align:left;*/
}
.listaSimples{
    list-style-image: url("/images/bullet_blue.png");
    /*    float: left;
        text-align:left;*/
}
#divFotosPainel ul{
    list-style-image: url("/images/pic.png");
    float: left;
    text-align:left;
}
#divFotosPainel li{
    list-style-position: inside;
    margin-top: 1em;
    /*    margin-left: 1em;*/
    margin-bottom: 1em;
    padding:1px 1px;
    font-weight:bold;
    clear: both;
    text-align: left;
    padding-left: 0px;
    /*    line-height: 10px;*/
}

.imagemAtiva{
    background-color: aquamarine;
    font-size: 120%;
    color: red;
}

.imagemVista{
    background-color: #A9A9A9;
    font-size: 100%;
    color: blue;
    text-shadow: white 0 0px 0;

}

#divApreensao th{
    color:#006;
    text-align:left;
    position: relative;
    font-size: 10px;
    /*    border-bottom:thin solid #006;*/

}

#divApreensao td{
    color:#000;
    /*    text-align:left;*/
    position: relative;
    font-size: 11px;

}

#divApreensao legend{
    color:#006;
    text-align:left;
    position: relative;
    /*    font-size: 90%;*/
    font-weight:bold;
    font-size: 12px;
    text-transform: uppercase;
    text-shadow: rgba(1, 0, 0, 1) 0 0px 0;

}
#divApreensao table{
    border:thin solid #003366;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius: 5px;
    -moz-background-clip: padding;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
    alignment-adjust: central;

}
#container #leftPanelAP {
    border: 1px solid #006;
    position: inherit;
    color:#006;
    text-align:left;
    position: relative;
    font-size: 12px;
    padding-left: 1px;
    max-height: 200px;
    overflow: scroll;
}

#container #rightPanelAP {
    border: 1px solid #006; 
    position: inherit;
    padding-right: 1px;
}

#divUsuarios {


}
#divUsuarios indice {
    width: 20px;
    background-color:#A9A9A9;
    text-shadow: rgba(1, 0, 0, 1) 0 0px 0;    
    font-size: 9px;
    text-align: left;


}
#divUsuarios td{
    color:#000;
    text-align:left;
    position: relative;
    font-size: 11px;
    border: 0px;
    border-bottom:thin solid #000;
    -moz-border-radius: 0px;
    -webkit-border-radius: 0px;
}

#divUsuarios th{
    color:#006;
    text-align:left;
    position: relative;
    font-size: 11px;
    border: 0px;
    border-bottom:thin solid #006;

}
#divUsuarios tr:hover{
    color : #003366;
    /*    font-size: 13px;*/
    /*    font-weight:bold;*/
    background-color: #ccffff;
}

#divUsuarios #rightPanel {
    border: 1px solid #006; 
    position: inherit;
    padding-right: 1px;
}

#divUsuarios #leftPanel {
    border: 1px solid #006;
    position: inherit;
    color:#006;
    text-align:left;
    position: relative;
    font-size: 12px;
    padding-left: 1px;
    max-height: 800px;

    height: auto;
}

#divEmpresas ul{
    list-style-image: url("/images/ico_bank.png");
    /*    text-combine-horizontal: all;*/
    left:-6px;
    /*    bottom:-299px;*/
    width:90%;
    /*    height:auto;*/
    border-bottom:solid 1px #FFF;
    /*    top: 120;*/
}
#divEmpresas li{
    top :1px;
    bottom: 1px;
    border-bottom:solid 1px #FFF;
    padding-top: 1px;
    padding-bottom: 1px;
    height: 3px;


}
.fullscreen{
    float: top;
    clear: both;
    border: 1px solid #006;
    width: 100%;
    height:100%; 
    z-index: 9999;
    display:block;
    position: absolute;
    left: 0px;
    top: 0px;
    width:100%;
    height:100%;

}
#controleUsuario {
    position: absolute;
    left: 0px;
    top: 0px;
    width:100%;
    height:100%;
    text-align:center;
    z-index: 1000;
    background-color: #A9A9A9;

    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius: 5px;
    -moz-background-clip: padding;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;   
}
#controleUsuario div {
    width:500px;
    margin: 100px auto;
    background-color: #fff;
    border:1px solid #000;
    padding:15px;
    text-align:center;
}

.icon{
    padding: 0px 2px;
    text-shadow: rgba(1, 0, 0, 1) 0 0px 0;
    alignment-adjust: baseline;
    /* border: solid 1px #006;*/

    /*    -moz-border-radius: 5px;
        -webkit-border-radius: 5px;*/
}

/*DATA GRID*/
.datagrid table {
    border-collapse: collapse;
    text-align: left;
    width: 100%;
}
.datagrid {
    font: normal 12px/150% Arial, Helvetica, sans-serif;
    background: #fff;
    overflow: hidden;
    border: 1px solid #A65B1A;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
}
.datagrid table td, .datagrid table th {
    padding: 3px 10px;
}

.datagrid table thead th {
    background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #A65B1A), color-stop(1, #7F4614) );
    background:-moz-linear-gradient( center top, #A65B1A 5%, #7F4614 100% );
    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#A65B1A', endColorstr='#7F4614');
    background-color:#A65B1A;
    color:#FFFFFF;
    font-size: 15px;
    font-weight: bold;
    border-left: 1px solid #BF691E;
}
.datagrid table thead th:first-child {
    border: none;
}
.datagrid table tbody td {
    color: #7F4614;
    border-left: 1px solid #D9CFB8;
    font-size: 12px;
    font-weight: normal;
}

.datagrid table tbody .alt td {
    background: #F0E5CC;
    color: #000000;
}
.datagrid table tbody .alt td:hover {
    color : #00FFEE;
    background-color: #ccffff;
}
.datagrid table tbody td:first-child {
    border-left: none;
}
.datagrid table tbody tr:last-child td {
    border-bottom: none;
}
.datagrid table tfoot td div {
    border-top: 1px solid #A65B1A;
    background: #F0E5CC;
}
.datagrid table tfoot td {
    padding: 0;
    font-size: 12px
}
.datagrid table tfoot td div {
    padding: 2px;
}
.datagrid table tfoot td ul {
    margin: 0;
    padding:0;
    list-style: none;
    text-align: right;
}
.datagrid table tfoot li {
    display: inline;
}
.datagrid table tfoot li a {
    text-decoration: none;
    display: inline-block;
    padding: 2px 8px;
    margin: 1px;
    color: #FFFFFF;
    border: 1px solid #A65B1A;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #A65B1A), color-stop(1, #7F4614) );
    background:-moz-linear-gradient( center top, #A65B1A 5%, #7F4614 100% );
    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#A65B1A', endColorstr='#7F4614');
    background-color:#A65B1A;
}
.datagrid table tfoot li.active{
    display: inline-block;
    padding: 2px 8px;
    margin: 1px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    border: 1px solid #003366;
    background-color:#003366;
    background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #003366), color-stop(1, #00CCFF) );
    background:-moz-linear-gradient( center top, #0033CC 5%, #00FFEE 100% );
    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#0033CC', endColorstr='#003366');
}
.datagrid table tfoot ul.active, .datagrid table tfoot ul a:hover {
    text-decoration: none;
    border-color: #7F4614;
    color: #FFFFFF;
    background: none;
    background-color:#A65B1A;
}

.datagrid table tbody .alt tr:hover {
    color : #003366;
    background-color: #ccffff;
}
.datagrid table tbody tr:hover{
    color : #003366;
    /*    font-size: 13px;*/
    font-weight:bold;
    background-color: #ccffff;
}






/* form busca*/
.formBusca fieldset {
    position:relative;
    border:solid 1px #003;
    padding:10px;
    margin:15px 0;
}
.formBusca tr {
    border-bottom:thin solid #003;
    font-family:Verdana, Geneva, sans-serif;font-size:10px;
}
.formBusca input[type="text"] {
    float:left;
    width:auto;
    height:10px;
    border:solid 1px #000;
    padding:5px;
    color:#003;
    background-color:#FFF;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius: 5px;
    -moz-background-clip: padding;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
}
.formBusca textarea {
    float:left;
    width:auto;
    height:auto;
    border:solid 1px #000;
    padding:5px;
    color:#003;
    background-color:#FFF;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius: 5px;
    -moz-background-clip: padding;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
}
.formBusca input[type="password"] {
    float:left;
    width:auto;
    height:auto;
    border:solid 1px #000;
    padding:5px;
    color:#003;
    background-color:#FFF;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius: 5px;
    -moz-background-clip: padding;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
}
.formBusca label {
    margin:0 5px 0 0;
    font-size:10px;
    font-weight:bold;
    font-family:Verdana, Geneva, sans-serif;
    color:#000;	
}

.formBusca table {
    bordercolor:"#000099";

}
.formBusca input[type="select"] {
    float:left;
    width:auto;
    height:auto;
    border:solid 1px #000;
    padding:5px;
    color:#003;
    margin: 1px 1px 1px 1px;
    background-color:#FFF;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius: 5px;
    -moz-background-clip: padding;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
    background-color: #A9A9A9;
}


.formBusca div {
    font-family: Verdana, Geneva, sans-serif;
    font-size: 10px;
    font-style: normal;
    line-height: normal;
    font-variant: normal;
    color: #F00;
    background-color: #FFC;
    letter-spacing: normal;
    text-align: justify;
    white-space: pre;
    display: compact;
    margin: 1px;
    padding: 2px;
    clear: both;
    height: auto;
    width: auto;
    border: thin solid #F00;
    position: inline;
}
.painel{
    /*display:none;*/
    border:thin solid #003366;
    background-clip: padding-box;
    position: fixed ;
    left: auto;
    padding: 2px 2px 2px 2px;
    width: 98%;
    height: 98%;
    z-index: 99;
    display: block;
    top: 10px;
    bottom: 2px;
    background-color: graytext;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius: 5px;
    -moz-background-clip: padding;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
    background:-moz-linear-gradient( center top, #FFFFFF 5%, #CCCCFF 100% );
    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#FFFFFF', endColorstr='#7F4614');

}
.botaoMenor {
    text-decoration: underline;
    font-size: 12px;
    display: inline-block;
    border-top: 1px solid #4a3803;
    border-left: 1px solid #4a3803;
    background: #f2f1ea;
    background: -webkit-gradient(linear, left top, left bottom, from(#9c7f16), to(#f2f1ea));
    background: -webkit-linear-gradient(top, #9c7f16, #f2f1ea);
    background: -moz-linear-gradient(top, #9c7f16, #f2f1ea);
    background: -ms-linear-gradient(top, #9c7f16, #f2f1ea);
    background: -o-linear-gradient(top, #9c7f16, #f2f1ea);
    padding: 2.5px 7px;
    -webkit-border-radius: 7px;
    -moz-border-radius: 7px;
    border-radius: 7px;
    -webkit-box-shadow: rgba(0,0,0,1) 0 1px 0;
    -moz-box-shadow: rgba(0,0,0,1) 0 1px 0;
    box-shadow: rgba(0,0,0,1) 0 0.5px 0;
    /*text-shadow: 2px 2px 2px #ffc042;*/
    text-shadow: 2px 2px 2px #ffc042;
    filter: dropshadow(color=#ffc042, offx=2, offy=2);
    color: black;
    font-weight: bolder;
    font-family: Verdana, Geneva, sans-serif;
    text-decoration: none;
    vertical-align: middle;
}

.botaoMenor:hover {
    border-color: #b6baba;
    background: #b6baba;
    background-color: #EDEDED;
    color: #001340;
}

.botaoMenor:active {
    border-color: #3d2804;
    /*background: chocolate;*/
    background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #A65B1A), color-stop(1, #7F4614) );
    background:-moz-linear-gradient( center top, #A65B1A 5%, #7F4614 100% );
    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#A65B1A', endColorstr='#7F4614');
    background-color:#A65B1A;
    color:#ffffff;
}
.singleButon{

    text-decoration: none;
    display: inline-block;
    padding: 2px 8px;
    margin: 1px;
    color: #FFFFFF;
    border: 1px solid #A65B1A;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #A65B1A), color-stop(1, #7F4614) );
    background:-moz-linear-gradient( center top, #A65B1A 5%, #7F4614 100% );
    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#A65B1A', endColorstr='#7F4614');
    background-color:#A65B1A;
}
.singleButon:hover {
    font-weight: bold;
    border-color: #7F4614;
    color: #FFFFFF;
    background: none;
    background-color:#A65B1A;
}

#divValidacoes *{
    /*font-size: 90%;*/
    font-family:Trebuchet MS;
    background-color: #f9f9f9;
    text-decoration: underline;
}
#divValidacoes input[type="text"] {
    float:left;
    width:auto;
    height:10px;
    border:solid 1px #000;
    padding:5px;
    color:red;
    border-color: #F00;
    background-color: #EDEDED;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    -moz-background-clip: padding;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
}
    
.sugestaoSenha{
    /*font-size: 90%;*/
    color:black;
    border:solid 1px red;

    display: none;
    width: 110px;
    position:fixed;
    font-weight: bold;
    border-color: #F00;
    background-color: #EDEDED;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    -moz-background-clip: padding;
    -webkit-background-clip: padding-box;
    background-clip: padding-box;
}

#flgeral #infoText{
    color:#003366;
    font-size: 80%;
    display: inline-table;
    font-weight: bold;
	
}


#config  {
    font-size: 90%;
}
#config ul li #detalhe {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: bolder;
	color: #F00;
}
#config label {
    font-size: 90%;
    padding: 1px 1px 1px 1px; 
    display: inline-block;
}