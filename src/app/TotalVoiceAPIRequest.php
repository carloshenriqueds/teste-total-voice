<?php 
require_once ""
$totalvoice = new TotalVoiceAPIRequest();
echo print_r($totalvoice->getRelatorioDeChamadas());
class TotalVoiceAPIRequest{
	
	public function getRelatorioDeChamadas(){
		$host = "api.totalvoice.com.br";
		$resultado = null;
		$fp = fsockopen($host, 80, $errno, $errstr, 30);
		$out = $this->buildRequest($host);
		fwrite($fp, $out);
		while (!feof($fp)) {
			$resultado .= fgets($fp, 128);;
		}
		fclose($fp);
		$responseSplit = explode ( "\r\n\r\n", $resultado, 2 );
		return $responseSplit[1];
	}
	
	
	private function buildRequest($host) {
	 	$requestAPI = "chamada/relatorio?data_inicio=03%2F05%2F2017&data_fim=05%2F05%2F2017 HTTP/1.0\r\n";
	 	$accessToken = "f1acf1095d5d2af0f7068c0798539a74";
		$out = "GET /{$requestAPI}";
		$out .= "Access-Token: {$accessToken}\r\n";
		$out .= "Host: {$host}\r\n";
		$out .= "Connection: Close\r\n\r\n";
		return $out;
	}

}
?>