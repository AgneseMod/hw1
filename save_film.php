<?php
require_once 'auth.php';

if (!$userid = checkAuth()) {
    exit;
}

savefilms();

function savefilms()
{
    global $dbconfig, $userid;
    $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
        
        $userid = mysqli_real_escape_string($conn, $userid);
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $anno = mysqli_real_escape_string($conn, $_POST['year']);
        $voto = mysqli_real_escape_string($conn, $_POST['imDbRating']);
        $img = mysqli_real_escape_string($conn, $_POST['image']);
        
        # Verifica se il film è già presente per l'utente
        $query = "SELECT * FROM film_salvati WHERE user_id = '$userid' AND film_id = '$id'";
        $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        
        if(mysqli_num_rows($res) > 0) {
            echo json_encode(array('ok' => true));
            exit;
        }

        # Inserimento dei dati del film nel database
        $insertQuery = "INSERT INTO film_salvati (user_id, film_id, titolo, anno, voto, img) 
            VALUES ('$userid', '$id', '$title', '$anno', '$voto', '$img')";

        $result = mysqli_query($conn, $insertQuery) or die(mysqli_error($conn));
        
        if ($result) {
            echo json_encode(array('ok' => true));
        } else {
            echo json_encode(array('ok' => false));
        }
    
        mysqli_close($conn);
   
}
?>
