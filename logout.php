<?php
    include 'dbconfig.php';

    // Distruggo la sessione esistente
    session_start();
    session_destroy();

    header('Location: Hmw1.php');
?>