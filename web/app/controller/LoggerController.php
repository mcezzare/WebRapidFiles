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
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/model/Logger.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/model/Usuario.class.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/dao/LoggerDAO.php');

class LoggerController {
    public function LoggerController() {
//        echo "entrei aqui";
    }
    public function loga(Logger $log) {
//        echo "entrei aqui";
        $loggerDAO = new LoggerDAO();
        $loggerDAO->registraLog($log);
    }
    
    
    
    
    public function getLogs(Logger $logFiltro=null){
        $loggerDAO = new LoggerDAO();
        $arrLog= $loggerDAO->getAllLogs($logFiltro);
        return $arrLog;
    }
    public function getTotalLogs(Logger $logFiltro=null){
        $loggerDAO = new LoggerDAO();
        $total= $loggerDAO->getTotalLogs($logFiltro);
        return $total;
    }

    public function getLogsPaginados($primeiro, $numPorPagina, Logger $logFiltro,$order, $orderMode,$debug) {
        $loggerDAO = new LoggerDAO();
        $arrLog= $loggerDAO->getLogsPaginadosDAO($primeiro, $numPorPagina, $logFiltro,$order, $orderMode,$debug);
        return $arrLog;
        
        
    }

    public function getUsuariosLogs($postUsuario=null) {
        $loggerDAO = new LoggerDAO();
        $arrUsers= $loggerDAO->getUsersLogs();
//        var_dump($arrUsers);
        $tmpUsuario = new Usuario();
        $totalUsers= count($arrUsers)-1;
        $options="";
        
        foreach ($arrUsers as $tmpUsuario) {
            
          if ($tmpUsuario->getId()==$postUsuario) {
            $options.= "<option selected=\"SELECTED\" value=\"".$tmpUsuario->getId()."\">".$tmpUsuario->getLogin()." </option>\n";
          }else {
              $options.= "<option value=\"".$tmpUsuario->getId()."\">".$tmpUsuario->getLogin()." </option>\n";
          }
        } 
//        for ($i=1;i<=$totalUsers;$i++){
//        $tmpUsuario = $arrUsers[$i];    
        

                
//                $options.= "<option value=\"".$arrUsers[$i]->getId()."\" selected=\"SELECTED\">".$arrUsers[$i]->getLogin()." </option>\n";
//            }else {
//                $options.= "<option value=\"".$tmpUsuario->getId()."\">".$tmpUsuario->getLogin()." </option>\n";
//                $options.= "<option value=\"".$i."\">".$i." </option>\n";
//            }
           
//        }
        
        echo  $options;
        
    }

    public function removeLogs($logs) {
        $loggerDAO = new LoggerDAO();
        $operacao= $loggerDAO->removerLogs($logs);
        return $operacao;
        
         
    }

    public function getUsuariosLogsExistentes() {
        $loggerDAO = new LoggerDAO();
        $arrLogs= $loggerDAO->getUsersLogs();  
        return $arrLogs;
        
    }
    public function getResetPassLogs(Usuario $usuario) {
        $loggerDAO = new LoggerDAO();
        $arrLogs= $loggerDAO->getResetPassLogs($usuario);
        return $arrLogs;
        
    }

    public function getDatasLogsExistentes() {
        $loggerDAO = new LoggerDAO();
        $arrLogs= $loggerDAO->getLogsExistentesDatas();  
        return $arrLogs;
        
    }
    public function getAcoesExistentes() {
        $loggerDAO = new LoggerDAO();
        $arrLogs= $loggerDAO->getAcoesLogadas();  
        return $arrLogs;
        
    }
    public function getGruposExistentes() {
        $loggerDAO = new LoggerDAO();
        $arrLogs= $loggerDAO->getGruposLogados();  
        return $arrLogs;
        
    }
}
?>
