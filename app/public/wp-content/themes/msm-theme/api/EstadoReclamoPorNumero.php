<?php 

include_once('ApiWise.php');
$api = new ApiWise();
$token = $api->obtenerToken();

try {
	$curl = curl_init();

    $input = file_get_contents('php://input');
    $nroReclamo = json_decode($input, true);

    if (!isset($nroReclamo)) errorMsg('No se ingreso un número de reclamo');

    if ($nroReclamo === null) errorMsg('Error al enviar datos del formulario');

	curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://api.wcx.cloud/core/v1/cases?filtering=%5B%7B%22field%22%3A%22case.number%22%2C%22operator%22%3A%22EQUAL%22%2C%22value%22%3A%27'.$nroReclamo.'%27%7D%5D',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		CURLOPT_HTTPHEADER => array(
			'x-api-key: b1d75d26cd4149d5b9d76aacaae4e81a',
			'Content-Type: application/json',
			'Authorization: Bearer ' . $token
		),
	));


    $response = curl_exec($curl);

    if (curl_errno($curl)) return null;
    $responseData = json_decode($response, true);
    if (!isset($responseData['data']) || (isset($responseData['data']) && !$responseData['data'][0])) errorMsg('Error al obtener respuesta del reclamo');
    $caseId = $responseData['data'][0]['id'];

	curl_close($curl); # 529726
	$case = obtenerCasoById($caseId, $token, $curl);
	$res = json_encode($case, true);

    echo $res;

} catch (\Throwable $th) {
    errorMsg();
}
	
function obtenerCasoById($caseId, $token, $curl)
{
	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://api.wcx.cloud/core/v1/cases/'.$caseId.'?fields=id%2Cnumber%2Cstatus%2Ctype_id%2Csubject%2Ccreated_at%2Csolved_at%2Cclosed_at%2Clast_update',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		CURLOPT_HTTPHEADER => array(
			'x-api-key: b1d75d26cd4149d5b9d76aacaae4e81a',
			'Content-Type: application/json',
			'Authorization: Bearer ' . $token
		),
	));

    $response = curl_exec($curl);

    if (curl_errno($curl)) return null;
    $responseData = json_decode($response, true);

    return $responseData;
}

function errorMsg($message = 'Ocurrió un error'){
    echo json_encode([
        'data'      => null,
        'success'   => false,
        'message'   => $message
    ]);
    exit;
}