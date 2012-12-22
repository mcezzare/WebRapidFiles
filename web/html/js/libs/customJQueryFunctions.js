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
jQuery.fn.testChar = function(letra){
    
//    var ilegalChars="/^[<>?`~+:;\"'=.,{}[]?§¶ªº????ø?¨¥?®´??åß?®?©???¬?ææ÷??µ???ç??]+()" ;
    var ilegalChars='[-@!#$%¨&*+_´`^~;:?áÁéÉíÍóÓúÚãÃçÇ|\?,./{}"<>()\'/ªº® ]' ;
//    for (i=0;i<=ilegalChars.length;i++){
//        if (ilegalChars[i]==letra){
//            return true;
//        }
//        
//    }
//    if(letra.match(['[-@!#$%¨&*+_´`^~;:?áÁéÉíÍóÓúÚãÃçÇ|\?,./{}"<>() ]'])) {
    if(letra.match([ilegalChars])) {
                return true;
    }
                else {return false;}
 
}
jQuery.fn.makeRandon = function(){
            var chars= "ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
//            var simbols= "0@1#2$3&4*5(6)7<8>9";
            var simbols= "@#$&*0123456789";
            var totalChars=chars.length;
            var totalSimbols=simbols.length;
            
            var s="";
            var pos="";
            for (var i=0;i<=12;i++){
                var randonChar = Math.floor((Math.random()*totalChars));
                var randonSimbol = Math.floor((Math.random()*totalSimbols));
//                s+= Chr(randon+i);
                
                if(i%2==0){
                    pos= chars.substring(randonChar,randonChar+1);
                    s+=pos;
                }else {
                    pos= simbols.substring(randonSimbol,randonSimbol+1);
                    s+=pos;
                }
                
            }
            if (s.length > 8) {
                s = s.substring(0,8);
            }
            return s;
        }

