<?php 
	$service_url = 'http://workflow.msm.gov.ar/AV/api/av/EstadoReclamoPorNumeroDocumento?numeroDocumento='.$_POST['numeroDocumento'];

	$curl = curl_init($service_url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

	$curl_response = curl_exec($curl);

	if ($curl_response === false) {
		$info = curl_getinfo($curl);
		curl_close($curl);
		return $info;
	}

	curl_close($curl);
	$reclamo = json_decode($curl_response);

	if (isset($reclamo->response->status) and $reclamo->response->status == 'ERROR') {
		return 'error 2';
	}	

  	echo json_encode($reclamo);
?>