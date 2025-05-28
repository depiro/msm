<?php

class ApiWise 
{
	var $service_url ; 
	var $token;
	var $apiKey;

	function __construct()
	{
		$this->service_url = 'https://api.wcx.cloud/core/v1';
		// $this->token = $this->obtenerToken();
		// $this->apiKey = 'b1d75d26cd4149d5b9d76aacaae4e81a';
	}

	function obtenerToken() {	
		$curl = curl_init();
		try {
			curl_setopt_array($curl, array(
				CURLOPT_URL => 'https://api.wcx.cloud/core/v1/authenticate?user=svc_chat',
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'GET',
				CURLOPT_HTTPHEADER => array(
					'Content-Type: application/json',
					'x-api-key: b1d75d26cd4149d5b9d76aacaae4e81a'
				),
			));
		} catch (\Throwable $th) {
			echo 'Error al configurar CURL: ' . $th->getMessage();
			return null;
		}
	
		$response = curl_exec($curl);
		if (curl_errno($curl)) {
			echo 'Error en la solicitud CURL: ' . curl_error($curl);
			return null;
		}
		curl_close($curl);
	
		$decodedResponse = json_decode($response, true);
		if ($decodedResponse === null) {
			echo 'Error al decodificar la respuesta JSON: ' . $response;
			return null;
		}
	
		if (isset($decodedResponse['token'])) {
			return $decodedResponse['token'];
		} else {
			echo 'Token no encontrado en la respuesta: ' . $response;
			return null;
		}
	}
	

	function obtenerMotivos()
	{
		$curl = curl_init();
		$token = $this->obtenerToken();

		curl_setopt_array($curl, array(
		CURLOPT_URL => $this->service_url.'/cases/types?fields=id%2Cname%2Cparent_id',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json',
			'x-api-key: b1d75d26cd4149d5b9d76aacaae4e81a',
			'Authorization: Bearer '.$token
		),
		));

		$response = curl_exec($curl);

		curl_close($curl);
        $decodedResponse = json_decode($response, true);
        return $decodedResponse['data']; 
	}
}