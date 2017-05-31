<?php
require_once "../app/service/TotalVoiceApi.php";
class TesteAPI extends PHPUnit_Framework_Testcase{

	public function testeToken(){
		$tv = new TotalVoiceApi("f1acf1095d5d2af0f7068c0798539a74");
		$this->assertEquals("f1acf1095d5d2af0f7068c0798539a74", $tv->getToken());
	}

	public function testeMethod(){
		$tv = new TotalVoiceApi(null, "GET");
		$this->assertEquals("GET", $tv->getMethod());
	}

	public function testeHost(){
		$tv = new TotalVoiceApi(null, null, null, "api.totalvoice.com.br");
		$this->assertEquals("api.totalvoice.com.br", $tv->getHost());
	}

	public function testeRequestApi(){
		$tv = new TotalVoiceApi(null, null, "chamada/relatorio?data_inicio=03%2F05%2F2017&data_fim=05%2F05%2F2017");
		$this->assertEquals("chamada/relatorio?data_inicio=03%2F05%2F2017&data_fim=05%2F05%2F2017", $tv->getRequestApi());
	}

	public function testeSendRequestApi(){
		$tv = new TotalVoiceApi("f1acf1095d5d2af0f7068c0798539a74", "GET", "chamada/relatorio?data_inicio=03%2F05%2F2017&data_fim=05%2F05%2F2017", "api.totalvoice.com.br");
		$result = $tv->sendRequestApi();
		$this->assertContains("OK", $result[0]);
		$this->assertNotEmpty($result[8]);
	}

}
?>