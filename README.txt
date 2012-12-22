--------------------------------------------------------------------------------------------------------------------------
WEB RAPID FILES 
Versão:1.1
Author:Mario Cezzare Angelicola Chiodi
Contact:mcezzare@gmail.com
Licensa : GPL /docs/GPL-pt_BR.txt
---------------------------------------------------------------------------------------------------------------------------
Alterações da versão 1.0
- Tela de uploads que usava uma applet foi substituida por um formulario html que aceita "DRAG & DROP" de arquivos e faz upload múltiplo
Esse upload é feito 1 por vez com ajax, e não carrega os limites de conexão. o único limite é a configuração do servidor e do php
u@h:/etc/php5/apache2$ cat php.ini | grep max_file
upload_max_filesize = 2M
max_file_uploads = 20


---------------------------------------------------------------------------------------------------------------------------
Resumo: 
Imagine a situação. um cliente manda um email com 1 arquivo anexo de 2 MB p/ uma lista de pessoas da empresa(10 pessoas).
sendo um arquivo em cada mailbox são 20MB.

P/ editar esse arquivos os usuários tem q fazer o download do arquivo, alterar e enviar p/ o grupo novamente, mais 20MB n servidor.
Alguns usuários tem mania de guardar tudo no email. 
Quantas versões desse arquivo teremos no servidor ?


---------------------------------------------------------------------------------------------------------------------------
Histórico:
Constantemente tinha que aumentar o limite da caixa de correio dos usuários dos Servidores de Email que administro por causa
 de grandes arquivos anexos e cópias em mensagens;

Decidi criar esta ferramenta para
- centralizar os arquivos enviados em um repósitorio
- manter um catálogo desses arquivos em um banco de dados
- permitir facilidades como busca e controle dos arquivos
- peritir ter log das operações do site
- permitir a troca de arquivos entre 2 ou mais lados (Empresa e Cliente)
- ensinar os usuários a NÃO UTILIZAR O EMAIL (cc,bcc,forward,multiplos grupos com aliases etc..) PARA ARQUIVOS MAIORES QUE 1/2 MB
---------------------------------------------------------------------------------------------------------------------------

Instalação:


1- Na pasta docs tem um arquivo pdf INSTALL.pdf com a explicação dos passos a serem excitados
Se você pretende colocar isso em sua rede local, comece pelo passo 0

Se vc já possui um domínio e pretende instalar essa ferramenta coloque o conteúdo da pasta web na raiz do seu site (public_html) e inicie pelo passo2 
+------------------------------------------------------------------------------------------------------------------------------------------------------------
IMPORTANTE: a pasta /files precisa de permissão de escrita para o controle dos arquivos, pelo shell execute um chmod -R 777 nesta pasta e um chown -R www-data(usuário do apache)  ou se for provedor de hospedagem, utilize o Painel de Controle para tal.   
+------------------------------------------------------------------------------------------------------------------------------------------------------------
2- altere em /lib/config.php o valor das variáveis p/ inicializar o instalador:
define('CONFIG_ADMIN_LOGIN', 'admin');
define('CONFIG_ADMIN_PASS', 'admin');

3- e para a configuração e customização do site altere essas variáveis de acordo com as suas necessidades:
As imagens para logoEmpresa, logoCliente e desktop podem ser alterados

//empresa
define('TITULO', 'WEB Rapid Files');
define('FOOTER', 'WEB Rapid Files ®- Todos os direitos reservados. Proibida a publica&ccedil;&atilde;o ou impress&atilde;o.');
define('LOGOTIPO', 'logoEmpresa.png');
define('BACKGROUND', 'desktop-dist.png');// se quizer alterar a imagem de fundo
define('SITE_EMAIL_SENDER', "webrapidfiles@".$base);// se quiser alterar o email q o site usa p/ mandar os lembretes de senha

//cliente
define('NOME_CLIENTE', 'Cliente');
define('LOGOTIPO_CLIENTE', 'logoCliente.png');

4- A configuração do acesso ao banco de dados

// database properties configure de acordo com o novo banco a ser criado 
define('DB_HOST', 'localhost');
define('DB_USER', 'rapidfiles');
define('DB_PASS', 'rapidfiles');
define('DB_NAME', 'myuploads');

e acesse http://seu_dominio/ q redirecionará para http://seu_dominio/app/installer/

no passo 3 você pode optar por deixar o sistema criar o banco ou copiar os códigos SQL gerados de acordo com os dados no arquivo config.php (você pode alterar os nomes dos grupos, e dos usuários excepto o admin)

5 - Execute o teste de instalação
O resultado deve ser igual o do arquivo na pasta docs TEST_INSTALL.pdf 

6 -  Após a configuração altere o valor da constante APP_READY para true para liberar o sistema e cadastrar os usuários. 
define('APP_READY', true);

e acesse http://seu_dominio/  para ver a tela de Login. Logue como admin , e crie os usuários do sistema. teste os uploads.
---------------------------------------------------------------------------------------------------------------------------
Notas para Desenvolvedores:

Na pasta docs/AppDocs tem a documentação das classes utilizadas no sistema.

Se você pretende utilizar essa WebApp dentro de seu site, isso talvez  exija fazer algumas modificações no seu site, ou implementar ao mini framework utilizado neste sistema.



