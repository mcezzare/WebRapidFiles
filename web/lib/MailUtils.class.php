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
require_once($_SERVER['DOCUMENT_ROOT'] . '/lib/config.php');
mb_internal_encoding(CHARSET);

require_once($_SERVER['DOCUMENT_ROOT'] . '/app/model/Usuario.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/controller/UsuarioController.php');

class MailUtils {

    private $cartaSenha;
    private $headers;

    public function __construct() {
        $this->cartaSenha = "Sr %s;\n
Este email foi enviado a partir de uma solicitação em nosso Site originada do IP: %s \n
em %s. \n
Motivo : Esquecimento da senha.\n
Segue credenciais:\n
Login: %s \n
Lembrete de senha:%s .\n
Se foi você quem solicitou a alteração e o lembrete não ajudou a lembrar a senha, clique no link abaixo para criar uma nova senha :
%s

Se não foi você quem solicitou a alteração, favor desconsiderar a mensagem.
Porém, pode ter alguém tentando acessar sua conta.
\n
Atenciosamente\n
%s";
        $this->headers = 'From: ' . TITULO . '<' . SITE_EMAIL_SENDER . '> \r\n';
    }

    public function EnviaSenha(Usuario $usuario, $link = null) {
        $userC = new UsuarioController();
        $user = $userC->findLogin($usuario->getLogin(), true);


        if (($user instanceof Usuario) && ($user->getId() != 0) && ($user->isAtivo())) {
//         echo 'Enviando nova senha por e-mail...';

            $user = $userC->load($user);

            mail($user->getEmail(), "[" . TITULO . "] - Reenvio de Senha", sprintf(utf8_decode($this->cartaSenha), $user->getLogin(), $_SERVER['REMOTE_ADDR'], date('d/m/Y H:i:s'), $user->getLogin(), $user->getLembrete(), URL_SITE . 'resetPass.php?link=' . $link, TITULO
                    ), $this->headers
            );
            return true;
        } else {
            return false;
        }
    }

    public function getCartaSenha() {
        return $this->cartaSenha;
    }

    public function setCartaSenha($cartaSenha) {
        $this->cartaSenha = $cartaSenha;
    }

    public function getHeaders() {
        return $this->headers;
    }

    public function setHeaders($headers) {
        $this->headers = $headers;
    }


}

?>
