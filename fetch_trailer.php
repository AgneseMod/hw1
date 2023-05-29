<?php
require_once 'auth.php';

if (!checkAuth()) {
    exit;
}

header('Content-Type: application/json');

// Chiamata alla funzione per cercare i film
$response = search();

// Restituisci la risposta come JSON
echo json_encode($response);

function search() {
    $query = urlencode($_GET["search"]);
    $url = 'https://www.googleapis.com/youtube/v3/search?part=snippet&q='.$query.'&type=video&videoEmbeddable=true&key=AIzaSyDm7-bZXIh7FUy4vRVnu1_vDTEck_Cwsa0';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response); // Decodifica la risposta JSON in un oggetto PHP

    return $data;
}


?>