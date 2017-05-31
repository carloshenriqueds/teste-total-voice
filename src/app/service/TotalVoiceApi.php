<?php

class TotalVoiceApi{
	private $fpSocket;
	private $token;
	private $method;
	private $requestApi;
	private $host;
	private $requestHttp;


	public function __construct($token=null, $method=null, $requestApi=null, $host=null) {
		$this->token = $token;
		$this->method = $method;
		$this->requestApi = $requestApi;
		$this->host = $host;
	}

	public function setToken($token){
		$this->token = $token;
	}

	public function setMethod($method){
		$this->method = $method;
	}
	
	public function setRequestApi($requestApi){
		$this->requestApi = $requestApi;
	}
	
	public function setHost($host){
		$this->host = $host;
	}

	public function setRequestHttp($requestHttp){
		$this->requestHttp = $requestHttp;
	}

	public function getToken(){
		return $this->token;
	}

	public function getMethod(){
		return $this->method;
	}

	public function getRequestApi(){
		return $this->requestApi;
	}

	public function getHost(){
		return $this->host;
	}

	/**
	 * * Função que cria conexão via socket.
	 * @access private
	 * @return void
	 * @throws Exception
	 */
	private function openSocket(){
		$this->fpSocket = fsockopen($this->host, 80, $errno, $errstr, 30);
		if(!$this->fpSocket){
			throw new Exception ("Erro ao abrir o socket.");
		}
	}
	
	/**
	 * * Função que fecha conexão via socket.
	 * @access private
	 * @return void
	 * @throws Exception
	 */
	private function closeSocket(){
		if(!$this->fpSocket){
			throw new Exception("Erro ao fechar o socket");
		}
		fclose($this->fpSocket);
	} 

	private function buildRequestApi(){
		$out = "$this->method /{$this->requestApi} HTTP/1.0\r\n";
		$out .= "Access-Token: {$this->token}\r\n";
		$out .= "Host: {$this->host}\r\n";
		$out .= "Connection: Close\r\n\r\n";
		$this->setRequestHttp($out);
	}

	/**
	 * * Função monta e envia o request de API
	 * @access public
	 * @return Array retorno da API
	 * @throws Exception
	 */
	public function sendRequestApi(){
		$resultado = array();
		try{
			$this->openSocket();
			$this->buildRequestApi();
			fwrite($this->fpSocket, $this->requestHttp);
			while (!feof($this->fpSocket)) {
				array_push($resultado, fgets($this->fpSocket, 128));
			}
			$this->closeSocket();
			return $resultado;
		}catch(Exception $e){
			echo print_r("Motivo erro: ".$e.getMessage());
		}
	}
}