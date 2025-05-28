<?php 

/**
* 
*/
class ReclamosRestApiPHP 
{
	var $service_url ; 
	function __construct($type)
	{
		$this->service_url = 'http://workflow.msm.gov.ar/AV/api/av/';
	}

	function imprimirOpcionesMotivos(){
		$service_url = $this->service_url.'motivos';
		$curl = curl_init($service_url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$curl_response = curl_exec($curl);
		if ($curl_response === false) {
		    $info = curl_getinfo($curl);
		    curl_close($curl);
		}
		curl_close($curl);
		$opciones = json_decode($curl_response);

		if (isset($decoded->response->status) and $decoded->response->status == 'ERROR') {
		}
		foreach ($opciones as $opcion)
			$this->imprimirOpcion($opcion->Id,$opcion->Descripcion);
	}

	function imprimirOpcion($value,$text){
		echo '<option value="'.$value.'">'.$text.'</option>';
	}

	function getCalles(){
		$service_url = $this->service_url.'calles';
		$curl = curl_init($service_url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$curl_response = curl_exec($curl);
		if ($curl_response === false) {
		    $info = curl_getinfo($curl);
		    curl_close($curl);
		}
		curl_close($curl);
		$opciones = json_decode($curl_response);
		if (isset($decoded->response->status) and $decoded->response->status == 'ERROR') {
		}	
		return $opciones;	
	}

	function getPrestadoras(){
		$service_url = $this->service_url.'PrestadoraServicios';
		$curl = curl_init($service_url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$curl_response = curl_exec($curl);
		if ($curl_response === false) {
		    $info = curl_getinfo($curl);
		    curl_close($curl);
		}
		curl_close($curl);
		$opciones = json_decode($curl_response);
		if (isset($decoded->response->status) and $decoded->response->status == 'ERROR') {
		}	
		return $opciones;	
	}

	function imprimirOpcionesCalle(){
		$opciones = $this->getCalles();
		foreach ($opciones as $opcion)
			$this->imprimirOpcion($opcion->Id,$opcion->Nombre);
	}
	function imprimirPrestadoras(){
		$opciones = $this->getPrestadoras();
		foreach ($opciones as $opcion)
			$this->imprimirOpcion($opcion->Id,$opcion->Descripcion);
	}

	function sendImages($images){
      /*  $images = json_decode($images);
        $images = $images->files;
		$service_url = $this->service_url.'files';
		$curl = curl_init($service_url);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST"); 
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		$data = array('name' => 'images', 'file' => $images[0] );
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                          
		    'Content-Type: image/jpeg')                                                                       
		);	
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		$curl_response = curl_exec($curl);
		if ($curl_response === false) {
		    $info = curl_getinfo($curl);
		    curl_close($curl);
		}
		curl_close($curl);
		$respuesta = json_decode($curl_response);
		if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
		}
		return $respuesta;	*/
	}

	function sendImagesReclamo($file){
		$filename = $file['name'];
		$filedata = $file['tmp_name'];
		$filesize = $file['size'];
		if ($filedata != ''){

			$handle    = fopen("/var/www/site-msm/wp-content/themes/msanmiguel/images/reclamos/".$filename, "r");
			$data      = fread($handle, $filesize);
			$POST_DATA = array(
			'file' => '@' ."/var/www/site-msm/wp-content/themes/msanmiguel/images/reclamos/".$filename
			);

			$ch = curl_init($this->service_url.'files');
			// $options = array(
				curl_setopt($ch, CURLOPT_HEADER ,true);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST ,"POST");
				curl_setopt($ch, CURLOPT_POST ,true);
				curl_setopt($ch, CURLOPT_HTTPHEADER ,$header = array('Content-Type: multipart/form-data'));
				//curl_setopt($ch, CURLOPT_INFILESIZE ,$filesize);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER ,true);
				curl_setopt($ch, CURLOPT_POSTFIELDS ,$POST_DATA );
			// ); // cURL options
			//curl_setopt_array($ch, $options);
			$curl_response = curl_exec($ch);
			curl_close($ch);
		if ($curl_response === false) {
		    $info = curl_getinfo($ch);
		}

		return $filename;			
		}
	}
}
 ?>
