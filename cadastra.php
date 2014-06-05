<?
/*Hotspot com cadastro e envio de senha via sms
V 1.0
Alvaro Alves - alvarolinkin@hotmail.com */

//solicita os arquivos para iniciar o API
	require('../routeros_api.class.php');
	$API = new routeros_api();
	$API->debug = true;

//dados do cliente
	$name=$_POST['nome']; 					 //puxa o nome do form de cadastro   */
	$cpf=$_POST['cpf'];   					 //puxa o cpf do form de cadastro
	$telefone=$_POST['ddd'].$_POST['fone'];  //puxa o ddd e o telefone do form de cadastro
	$senha= rand (1000, 9999);         //gera uma senha com 7 números aleatórios

//envio de sms
	//URL para onde vai ser enviado nosso POST
	$url =  "http://torpedus.com.br/sms/index.php?app=webservices&u=2337&p=osirnet2013&ta=pv&to=55".$telefone."&msg=ola+".$name."+seu+usuario+".$cpf."+sua+senha+".$senha;
	// Aqui inicio a função CURL
	$curl = curl_init();
	//aqu eu pego a URL para onde será enviado o POST
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_exec($curl);
	curl_close($curl);

//conecta ao API
//dados para conexão ao API
	$ip = '177.53.66.70';
	$usuario = 'server';
	$senharb = 's3051';

//salva usuário e senha na RB
if ($API->connect($ip, $usuario, $senharb)){
		$API->comm("/ip/hotspot/user/add", array(
         "name"     => $cpf,
         "password" => $senha,
         "server" => "hotspot1",
         "profile"  => "2mega",
		));
		$API->disconnect();
	}
	
?>
