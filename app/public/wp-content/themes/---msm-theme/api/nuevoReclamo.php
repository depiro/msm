<?php
include_once('ApiWise.php');
$api = new ApiWise();
$token = $api->obtenerToken();

try {
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    if ($data === null) errorMsg('Error al enviar datos del formulario');
    if (!isset($data['IdMotivo'])) errorMsg('No se seleccionó un motivo');

    $idMotivo   = isset($data['IdMotivo']) ? $data['IdMotivo'] : 'No definido';
    $textMotivo = isset($data['TextMotivo']) ? $data['TextMotivo'] : 'No definido';
    $apellido   = isset($data['Apellido']) ? $data['Apellido'] : 'No definido';
    $nombre     = isset($data['Nombre']) ? $data['Nombre'] : 'No definido';
    $email      = isset($data['Email']) ? $data['Email'] : 'No definido';
    $telefono   = isset($data['TelefonoDeContacto']) ? $data['TelefonoDeContacto'] : 'No definido';
    // $tipoDocumento  = isset($data['TipoDocumento']) ? $data['TipoDocumento'] : 'No definido';
    // $documento      = isset($data['NumeroDocumento']) ? $data['NumeroDocumento'] : 'No definido';

    $curl = curl_init();
    $data = array(
        "group_id"          => 24717,
        "tags"              => [],
        "type_id"           => $idMotivo,
        "source_channel"    => "web",
        "subject"           => $textMotivo,
        "ticket_area"       => "RECLAMOS",
        "activities" => array(
            array(
                "type"      => "contact_message",
                "content"   => "Nuevo Reclamo",
                "contact_from" => array(
                    "email"         => $email,
                    "name"          => $nombre,
                    "phone"         => $telefono,
                    "personal_id"   => "666451"
                ),
                "attachments" => []
            )
        ),
        "custom_fields" => [
            // "tipoDocumento" => $tipoDocumento,
            // "documento"     => $documento,
        ]
    );

    $responseData = generarReclamo($data, $token, $curl);

    if (!isset($responseData['case_id'])) errorMsg('Error al obtener respuesta del reclamo');
    $caseId = $responseData['case_id'];

    curl_close($curl);
    $newCurl = curl_init();

    $res = obtenerNumeroReclamo($caseId, $token, $newCurl);

    if (isset($res['number'])) {
        $number = $res['number'];
        echo json_encode([
            'data'      => $number,
            'success'   => true,
            'message'   => 'Reclamo realizado con éxito'
        ]);
    }
    
    curl_close($newCurl);
    curl_close($curl);
} catch (\Throwable $th) {
    errorMsg($th);
}

function generarReclamo($data, $token, $curl)
{
    $jsonData = json_encode($data);

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.wcx.cloud/core/v1/cases',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $jsonData,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'x-api-key: b1d75d26cd4149d5b9d76aacaae4e81a',
            'Authorization: Bearer ' . $token
        ),
    ));

    $response = curl_exec($curl);

    if (curl_errno($curl)) return null;
    $responseData = json_decode($response, true);

    return $responseData;
}

function obtenerNumeroReclamo($caseId, $token , $newCurl)
{
    $url = 'https://api.wcx.cloud/core/v1/cases/' . $caseId . '?fields=id%2Cnumber';
    $header = [
        'x-api-key: b1d75d26cd4149d5b9d76aacaae4e81a',
        'Content-Type: application/json',
        'Authorization: Bearer ' . $token
    ];

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => $header,
    ));
    $response = curl_exec($curl);
    if (curl_errno($curl)) null;
    return json_decode($response, true);
}

function errorMsg($message = 'Ocurrió un error'){
    echo json_encode([
        'data'      => null,
        'success'   => false,
        'message'   => $message
    ]);
    exit;
}

// function setCurl(String $url , Array $header){
//     $curl = curl_init();
//     curl_setopt_array($curl, array(
//         CURLOPT_URL => $url,
//         CURLOPT_RETURNTRANSFER => true,
//         CURLOPT_ENCODING => '',
//         CURLOPT_MAXREDIRS => 10,
//         CURLOPT_TIMEOUT => 0,
//         CURLOPT_FOLLOWLOCATION => true,
//         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//         CURLOPT_CUSTOMREQUEST => 'GET',
//         CURLOPT_HTTPHEADER => $header,
//     ));
//     $response = curl_exec($curl);
//     if (curl_errno($curl)) null;
//     return json_decode($response, true);
// }