<?php
require_once 'auth.php';

if (!checkAuth()) {
    exit;
}

header('Content-Type: application/json');

// Chiamata alla funzione per cercare i film
$response = searchMovie();

// Restituisci la risposta come JSON
echo json_encode($response);

function searchMovie() {
    $url = 'https://imdb-api.com/en/API/Top250Movies/k_cw0ya8dw';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response); // Decodifica la risposta JSON in un oggetto PHP

    return $data;
}

?>
