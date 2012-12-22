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

class Logger {

    private $id;
    private $idUsuario;
    private $idGrupo;
    private $data; //automatico
    private $idAcao; //automatico
    private $objectStored; //automatico
    
    
    //auxiliar reports
    private $usuarioNome;
    private $acaoNome;
    private $numRow;
    private $grupoNome;
    
    //auxiliar filters to filter sql queries 
    private $dataStart; 
    private $dataEnd; 
    
    
    public function __construct() {
        $this->id=0;
    }
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getIdUsuario() {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    public function getIdGrupo() {
        return $this->idGrupo;
    }

    public function setIdGrupo($idGrupo) {
        $this->idGrupo = $idGrupo;
    }

    public function getData() {
        return $this->data;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function getIdAcao() {
        return $this->idAcao;
    }

    public function setIdAcao($idAcao) {
        $this->idAcao = $idAcao;
    }

    public function getObjectStored() {
        return $this->objectStored;
    }

    public function setObjectStored($objectStored) {
        $this->objectStored = $objectStored;
    }

    public function getUsuarioNome() {
        return $this->usuarioNome;
    }

    public function setUsuarioNome($usuarioNome) {
        $this->usuarioNome = $usuarioNome;
    }

    public function getAcaoNome() {
        return $this->acaoNome;
    }

    public function setAcaoNome($acaoNome) {
        $this->acaoNome = $acaoNome;
    }

    public function getNumRow() {
        return $this->numRow;
    }

    public function setNumRow($numRow) {
        $this->numRow = $numRow;
    }
    public function getGrupoNome() {
        return $this->grupoNome;
    }

    public function setGrupoNome($grupoNome) {
        $this->grupoNome = $grupoNome;
    }
    public function getDataStart() {
        return $this->dataStart;
    }

    public function setDataStart($dataStart) {
        $this->dataStart = $dataStart;
    }

    public function getDataEnd() {
        return $this->dataEnd;
    }

    public function setDataEnd($dataEnd) {
        $this->dataEnd = $dataEnd;
    }



}
?>