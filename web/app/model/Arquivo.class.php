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
class Arquivo {

    private $idarquivos; //       int(11) PK
    private $nome; //             varchar(200)
    private $tipo; //             varchar(45)
    private $tamanho; //          int(11)
    private $idusuario; //        int(11)
    private $data; //             datetime
    private $ip; //               varchar(16)
    private $browser; //          varchar(255)
    //auxiliar
    private $usuarioNome;
    private $index;
    
    public function __construct() {
        
    }
    public function getIdarquivos() {
        return $this->idarquivos;
    }

    public function setIdarquivos($idarquivos) {
        $this->idarquivos = $idarquivos;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function getTamanho() {
        return $this->tamanho;
    }

    public function setTamanho($tamanho) {
        $this->tamanho = $tamanho;
    }

    public function getIdusuario() {
        return $this->idusuario;
    }

    public function setIdusuario($idusuario) {
        $this->idusuario = $idusuario;
    }

    public function getData() {
        return $this->data;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function getIp() {
        return $this->ip;
    }

    public function setIp($ip) {
        $this->ip = $ip;
    }

    public function getBrowser() {
        return $this->browser;
    }

    public function setBrowser($browser) {
        $this->browser = $browser;
    }

    public function getUsuarioNome() {
        return $this->usuarioNome;
    }

    public function setUsuarioNome($usuarioNome) {
        $this->usuarioNome = $usuarioNome;
    }

    public function getIndex() {
        return $this->index;
    }

    public function setIndex($index) {
        $this->index = $index;
    }

    public function getStatus() {
        
        $retorno="";
        $this->getIdarquivos()!=null?$retorno.="id: ".$this->getIdarquivos():null;
        $this->getData()!=null?$retorno.=" data: ".$this->getData():null;
        $this->getIdusuario()!=null?$retorno.=" idusuario: ".$this->getIdusuario():null;
        $this->getNome()!=null?$retorno.=" nomeArquivo: ".$this->getNome():null;
        $this->getTipo()!=null?$retorno.=" tipo: ".$this->getTipo():null;
        $this->getTamanho()!=null?$retorno.=" tamanho: ".$this->getTamanho():null;
    
        return $retorno;
    }

    
    public function __toString() {
        return $this->getStatus();
    }
    
    
//    public function __sleep() {
//        return $this->
//    }
    
//    public function getTotalArquivos() {
//        return $this->totalArquivos;
//    }
//
//    public function setTotalArquivos($totalArquivos) {
//        $this->totalArquivos = $totalArquivos;
//    }


}

?>
