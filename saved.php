<?php
require_once 'auth.php';

if (!$userid = checkAuth()) {
    exit;
}

fetchSavedFilms();

function fetchSavedFilms()
{
    global $dbconfig, $userid;
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);

    // Query per selezionare i film salvati per l'utente
    $queryfilm = "SELECT * FROM film_salvati WHERE user_id = '$userid'";
    $resultfilm = mysqli_query($conn, $queryfilm) or die(mysqli_error($conn));

    $films = array();
    while ($row = mysqli_fetch_assoc($resultfilm)) {
        $films[] = $row;
    }

    // Query per selezionare le serie TV salvate per l'utente
    $queryserie = "SELECT * FROM serie_tv_selezionate WHERE user_id = '$userid'";
    $resultserie = mysqli_query($conn, $queryserie) or die(mysqli_error($conn));

    $series = array();
    while ($row = mysqli_fetch_assoc($resultserie)) {
        $series[] = $row;
    }

    mysqli_close($conn);

    // Combina i risultati dei film e delle serie TV in un'unica struttura dati
    $data = array(
        'films' => $films,
        'series' => $series
    );

    echo json_encode($data);
}
?>
