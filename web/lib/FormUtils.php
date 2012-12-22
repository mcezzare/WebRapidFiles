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
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/model/Grupo.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/model/Logger.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/model/Usuario.class.php');

class FormUtils {

    public function __construct() {
        
    }

    public function buildSelect($arr, $type, $selected, $name,$idTag=null,$extra=null) {

//        $options = null;
//        $options =  "<option value=\"0\">...</option>";
        $options = "<option value=\"0\" selected=\"SELECTED\">...</option>\n";
        switch ($type) {
            case 'niveis':
                for ($i = 0; $i < count($arr); $i++) {
                    if ($arr[$i] == $selected) {
                        $options.= "<option value=\"$arr[$i]\" selected=\"SELECTED\">$arr[$i]</option>\n";
                    } else {
                        $options.= "<option value=\"$arr[$i]\">$arr[$i]</option>\n";
                    }
                }
                break;
            case 'arquivos':
                break;
            case 'grupos':
                $grupo = new Grupo();
                foreach ($arr as $grupo) {
                    if ($grupo->getId() == $selected) {
                        $options.= "<option value=\"" . $grupo->getId() . "\" selected=\"SELECTED\">" . $grupo->getNome() . "</option>\n";
                    } else {
                        $options.= "<option value=\"" . $grupo->getId() . "\">" . $grupo->getNome() . "</option>\n";
                    }
                }

                break;
            case 'logs':
                $log = new Logger();
                foreach ($arr as $log) {
                    if ($log->getData() == $selected) {
                        $options.= "<option value=\"" . $log->getData() . "\" selected=\"SELECTED\">" . $log->getData() . "</option>\n";
                    } else {
                        $options.= "<option value=\"" . $log->getData() . "\">" . $log->getData() . "</option>\n";
                    }
                }

                break;
            case 'users_logs':
                $user = new Logger();
                foreach ($arr as $user) {
                    if ($user->getIdUsuario() == $selected) {
                        $options.= "<option value=\"" . $user->getIdUsuario() . "\" selected=\"SELECTED\">" . $user->getUsuarioNome() . "</option>\n";
                    } else {
                        $options.= "<option value=\"" . $user->getIdUsuario() . "\">" . $user->getUsuarioNome() . "</option>\n";
                    }
                }
                break;
            case 'acoes_logs':
                $acao = new Logger();
                foreach ($arr as $acao) {
                    if ($acao->getIdAcao() == $selected) {
                        $options.= "<option value=\"" . $acao->getIdAcao() . "\" selected=\"SELECTED\">" . $acao->getAcaoNome() . "</option>\n";
                    } else {
                        $options.= "<option value=\"" . $acao->getIdAcao() . "\">" . $acao->getAcaoNome() . "</option>\n";
                    }
                }
                break;
            case 'grupos_logs':
                $grupo = new Logger();
                foreach ($arr as $grupo) {
                    if ($grupo->getIdGrupo() == $selected) {
                        $options.= "<option value=\"" . $grupo->getIdGrupo() . "\" selected=\"SELECTED\">" . $grupo->getGrupoNome() . "</option>\n";
                    } else {
                        $options.= "<option value=\"" . $grupo->getIdGrupo() . "\">" . $grupo->getGrupoNome() . "</option>\n";
                    }
                }
                break;
            default :
                break;
        }
        $extra==null?$extra:'';
        if ($idTag==null){
            $combo = "<select name=\"$name\" id=\"$name\" $extra>\n";
        }else {
            $combo = "<select name=\"$name\" id=\"$idTag\" $extra>\n";
        }
        
        $combo .= $options;
        $combo .= "</select>\n";
        echo $combo;
        return true;
    }

    public function buildcheckBox($name, $checked) {

        $marked = '';
        if ($checked == 1) {
            $marked.=" checked=\"checked\" ";
        }
        $field = "<input type=\"checkbox\" name=\"$name\" id=\"$name\" value=\"1\" $marked >\n";

        echo $field;
        return true;
    }

}

?>
