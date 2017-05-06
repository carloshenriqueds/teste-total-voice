<?php
require_once 'TotalVoiceAPIRequest.php';
class TesteAPI extends PHPUnit_Framework_Testcase{
	public function testeTotalVoiceRequest(){
		$totalvoice = new TotalVoiceAPIRequest();
		$return = '{"status":200,"sucesso":true,"motivo":0,"mensagem":"dados retornados com sucesso","dados":{"relatorio":[]}}';
		$this->assertEquals($return, $totalvoice->getRelatorioDeChamadas());
	}
}
?>