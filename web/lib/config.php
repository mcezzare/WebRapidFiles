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
setlocale(LC_ALL, 'pt_BR'); // 
$base = $_SERVER['HTTP_HOST'];

//empresa customizavel
define('TITULO', 'WEB Rapid Files');
define('FOOTER', 'WEB Rapid Files ®- Todos os direitos reservados. Proibida a publica&ccedil;&atilde;o ou impress&atilde;o.');

define('LOGOTIPO', 'logoEmpresa.png');
define('BACKGROUND', 'desktop-dist.png');
define('SITE_EMAIL_SENDER', "webrapidfiles@" . $base);



//site config don't touch
define('CHARSET', 'UTF-8');
define('REPOSITORIO', (string) ($_SERVER["DOCUMENT_ROOT"] . '/files/'));
define('BASE_IMAGES', '/html/images/');
define('BASE_SCRIPTS', '/html/js/');
define('BASE_STYLES', '/html/css/');
define('URL_SITE', 'http://' . $base);
define('WEBAPP_VERSION', 1.1);



//cliente customizavel
define('NOME_CLIENTE', 'Cliente');
define('LOGOTIPO_CLIENTE', 'logoCliente.png');

// database properties configure de acordo com o novo banco a ser criado 
define('DB_HOST', 'localhost');
define('DB_USER', 'rapidfiles');
define('DB_PASS', 'rapidfiles');
define('DB_NAME', 'myuploads');


// para o setup customizavel
define('CONFIG_ADMIN_LOGIN', 'admin');
define('CONFIG_ADMIN_PASS', 'admin');

//altere p/ true p/ liberar o sistema após a configuração
define('APP_READY', true);

//define('APP_READY', true);




class Config {

    private $lcAll;
    private $titulo;
    private $charset;
    private $logotipo;
    private $nomeCliente;
    private $logotipoCliente;
    private $dbHost;
    private $dbUser;
    private $dbPass;
    private $dbName;
    private $repositorio;
    private $baseImages;
    private $baseScripts;
    private $baseStyles;
    private $urlSite;
    private $webAppVersion;
    //setup
    private $configAdminLogin;
    private $configAdminSenha;
    private $appReady;
    private $footer;

    public function __construct() {
        $this->lcAll = LC_ALL;
        $this->titulo = TITULO;
        $this->charset = CHARSET;
        $this->logotipo = LOGOTIPO;
        $this->nomeCliente = NOME_CLIENTE;
        $this->logotipoCliente = LOGOTIPO_CLIENTE;
        $this->dbHost = DB_HOST;
        $this->dbUser = DB_USER;
        $this->dbPass = DB_PASS;
        $this->dbName = DB_NAME;
        $this->repositorio = REPOSITORIO;
        $this->baseImages = BASE_IMAGES;
        $this->baseScripts = BASE_SCRIPTS;
        $this->baseStyles = BASE_STYLES;
        $this->urlSite = URL_SITE;
        $this->webAppVersion = WEBAPP_VERSION;
        $this->configAdminLogin = CONFIG_ADMIN_LOGIN;
        $this->configAdminSenha = CONFIG_ADMIN_PASS;
        $this->appReady = APP_READY;
        $this->footer = FOOTER;
    }

    public function getLcAll() {
        return $this->lcAll;
    }

    public function setLcAll($lcAll) {
        $this->lcAll = $lcAll;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getCharset() {
        return $this->charset;
    }

    public function setCharset($charset) {
        $this->charset = $charset;
    }

    public function getLogotipo() {
        return $this->logotipo;
    }

    public function setLogotipo($logotipo) {
        $this->logotipo = $logotipo;
    }

    public function getNomeCliente() {
        return $this->nomeCliente;
    }

    public function setNomeCliente($nomeCliente) {
        $this->nomeCliente = $nomeCliente;
    }

    public function getLogotipoCliente() {
        return $this->logotipoCliente;
    }

    public function setLogotipoCliente($logotipoCliente) {
        $this->logotipoCliente = $logotipoCliente;
    }

    public function getDbHost() {
        return $this->dbHost;
    }

    public function setDbHost($dbHost) {
        $this->dbHost = $dbHost;
    }

    public function getDbUser() {
        return $this->dbUser;
    }

    public function setDbUser($dbUser) {
        $this->dbUser = $dbUser;
    }

    public function getDbPass() {
        return $this->dbPass;
    }

    public function setDbPass($dbPass) {
        $this->dbPass = $dbPass;
    }

    public function getDbName() {
        return $this->dbName;
    }

    public function setDbName($dbName) {
        $this->dbName = $dbName;
    }

    public function getRepositorio() {
        return $this->repositorio;
    }

    public function setRepositorio($repositorio) {
        $this->repositorio = $repositorio;
    }

    public function getBaseImages() {
        return $this->baseImages;
    }

    public function setBaseImages($baseImages) {
        $this->baseImages = $baseImages;
    }

    public function getBaseScripts() {
        return $this->baseScripts;
    }

    public function setBaseScripts($baseScripts) {
        $this->baseScripts = $baseScripts;
    }

    public function getBaseStyles() {
        return $this->baseStyles;
    }

    public function setBaseStyles($baseStyles) {
        $this->baseStyles = $baseStyles;
    }

    public function getUrlSite() {
        return $this->urlSite;
    }

    public function setUrlSite($urlSite) {
        $this->urlSite = $urlSite;
    }

    public function getWebAppVersion() {
        return $this->webAppVersion;
    }

    public function setWebAppVersion($webAppVersion) {
        $this->webAppVersion = $webAppVersion;
    }

    public function getConfigAdminLogin() {
        return $this->configAdminLogin;
    }

    public function setConfigAdminLogin($configAdminLogin) {
        $this->configAdminLogin = $configAdminLogin;
    }

    public function getConfigAdminSenha() {
        return $this->configAdminSenha;
    }

    public function setConfigAdminSenha($configAdminSenha) {
        $this->configAdminSenha = $configAdminSenha;
    }

    public function getAppReady() {
        return $this->appReady;
    }

    public function setAppReady($appReady) {
        $this->appReady = $appReady;
    }

    public function getFooter() {
        return $this->footer;
    }

    public function setFooter($footer) {
        $this->footer = $footer;
    }

}

$config = new Config();
?>