<?php   
require_once 'auth.php';

if (!checkAuth()) {
    exit;
}
?>

<html>

    <head>
        <title>Popcorn</title>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="intro.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="intro.js" defer="true"></script>
    </head>

    <body>
            <h1>Fai i primi passi per configurare il tuo profilo</h1>
            <a class="subtitle"> Seleziona dalla lista alcuni dei film che vorresti vedere </a>
        <section class="container">
        
            <div id="results">
                
            </div>
            <a id="saveButton">Continua</a>

        </section>

    </body>

</html>