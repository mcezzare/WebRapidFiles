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
require_once($_SERVER['DOCUMENT_ROOT'].'/lib/config.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/lib/Conexao.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/app/model/Usuario.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/app/dao/UsuarioDAO.php');

class UsuarioController {
    public function __construct() {
        
    }
    
    function autenticar($login,$senha){
        
        $usuarioDAO = new UsuarioDAO();
        $Usuario = $usuarioDAO->validar($login,$senha); 
        return $Usuario;
    }

    public function load(Usuario $user) {
        $usuarioDAO = new UsuarioDAO();
        $Usuario = $usuarioDAO->load($user); 
        
        return $Usuario;
    }

    public function getUsuariosGrupo() {
        $usuarioDAO = new UsuarioDAO();
        $arrUsuarios = $usuarioDAO->getUsuarios();
        
        return $arrUsuarios;
        
    }

    public function getTotalUsuarios() {
        $usuarioDAO = new UsuarioDAO();
        $total = $usuarioDAO->getTotalUsuarios();
        
        return $total;
        
    }
   
    public function atualizaDadosUsuario(Usuario $usuario) {
      
        $usuarioDAO = new UsuarioDAO();
        $operacao = $usuarioDAO->atualizaDados($usuario);
        return $operacao;
        
    }

   

    public function salvaNovoUsuario(Usuario $usuario) {
        
        $usuarioDAO = new UsuarioDAO();
        $operacao = $usuarioDAO->adicionaUsuario($usuario);
        return $operacao;
    }

    public function getUsuarioPorId($idUser) {
        $usuarioDAO = new UsuarioDAO();
        $usuario = $usuarioDAO->getUsuario($idUser);
        
        return $usuario;
    }

    public function removeUsuario(Usuario $usuario) {
        if ($usuario instanceof Usuario){
        $usuarioDAO = new UsuarioDAO();
        $operacao = $usuarioDAO->deleteUsuario($usuario);
        return $operacao;
        }else {
            die('..nt4y');
        }
            
    }
        
     public function findEmail($email) {
        $usuarioDAO = new UsuarioDAO();
        $operacao = $usuarioDAO->findByMail($email); 
        
        return $operacao;
    }

    public function findLogin($login,$returnUser=false) {
        $usuarioDAO = new UsuarioDAO();
        $operacao = $usuarioDAO->findByLogin($login,$returnUser); 
        return $operacao;
    }

    public function getTotalUsuariosAtivos() {
        $usuarioDAO = new UsuarioDAO();
        $total = $usuarioDAO->getTotalUsuariosAtivos();
        
        return $total;
    }

    public function armazenaLink(Usuario $usuario, $resetPassLink) {
        
        $usuarioDAO = new UsuarioDAO();
        $operacao = $usuarioDAO->armazenaLinkSenha($usuario,$resetPassLink); 
        return $operacao;
        
        
    }

    public function procuraLinkPass($link) {
        $usuarioDAO = new UsuarioDAO();
        $usuario = $usuarioDAO->procuraLinkSenha($link); 
        return $usuario;
    }

    public function trocaSenha(Usuario $usuario) {
        $usuarioDAO = new UsuarioDAO();
        $operacao = $usuarioDAO->trocaSenha($usuario);
        return $operacao;
        
    }

    public function cleanMsgs(Usuario $usuario) {
        $usuarioDAO = new UsuarioDAO();
        $operacao = $usuarioDAO->limpaLinkSenha($usuario); 
        return $operacao;
    }

   
    
}

?>
