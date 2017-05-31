<?php 
ini_set('display_errors','Off');
require_once "model/TotalVoiceApiModel.php";

$api = new TotalVoiceApi();
$api->setToken("f1acf1095d5d2af0f7068c0798539a74");
$api->setRequestApi("chamada/relatorio?data_inicio=03%2F05%2F2017&data_fim=05%2F05%2F2017");
$api->setMethod("GET");
$api->setHost("api.totalvoice.com.br");
$retorno = $api->sendRequestApi();
echo print_r($retorno);

?>