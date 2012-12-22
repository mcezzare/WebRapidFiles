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
class Usuario {

    private $id;
    private $login;
    private $senha;
    private $ativo;
    private $lembrete;
    private $email;
    //auxiliares
    private $idGrupo;
    private $grupo;
    private $nivel;
    private $totalArquivos;
    private $view;
    private $tmpLink;
    

    public function Usuario() {
        $this->id = 0;
        $this->ativo = 0;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getLogin() {
        return $this->login;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function setSenha($senha) {
        $this->senha = $senha;
    }

    public function isAtivo() {
        return $this->ativo;
    }

    public function setAtivo($ativo) {
        $this->ativo = $ativo;
    }

    ///
    public function getIdGrupo() {
        return $this->idGrupo;
    }

    public function setIdGrupo($idGrupo) {
        $this->idGrupo = $idGrupo;
    }

    public function getGrupo() {
        return $this->grupo;
    }

    public function setGrupo($grupo) {
        $this->grupo = $grupo;
    }

    public function getLembrete() {
        return $this->lembrete;
    }

    public function setLembrete($lembrete) {
        $this->lembrete = $lembrete;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }
    public function getNivel() {
        return $this->nivel;
    }

    public function setNivel($nivel) {
        $this->nivel = $nivel;
    }
    public function getTotalArquivos() {
        return $this->totalArquivos;
    }

    public function setTotalArquivos($totalArquivos) {
        $this->totalArquivos = $totalArquivos;
    }

    public function getStatus() {
        
        $retorno="";
        $this->getId()!=null?$retorno.="Id: ".$this->getId()."\n":null;
        $this->getLogin()!=null?$retorno.=" Login: ".$this->getLogin()."\n":null;
        
        $this->getEmail()!=null?$retorno.=" Email: ".$this->getEmail()."\n":null;
        $this->getNivel()!=null?$retorno.=" Nivel: ".$this->getNivel()."\n":null;
        $this->getIdGrupo()!=null?$retorno.=" Idgrupo: ".$this->getIdGrupo()."\n":null;
        $this->getGrupo()!=null?$retorno.=" Grupo: ".$this->getGrupo()."\n":null;
        $this->getView()!=null?$retorno.=" View: ".$this->getView()."\n":null;
//        $this->get()!=null?$retorno.=" : ".$this->get():null;
        return $retorno;
    }

    
    public function __toString() {
        return $this->getStatus();
    }
    public function getView() {
        return $this->view;
    }

    public function setView($view) {
        $this->view = $view;
    }

    public function getTmpLink() {
        return $this->tmpLink;
    }

    public function setTmpLink($tmpLink) {
        $this->tmpLink = $tmpLink;
    }


}

?>
