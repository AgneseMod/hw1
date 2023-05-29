
<?php 
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login.php");
        exit;
    }
?>

<html>
<head>
        <link rel='stylesheet' href='profile.css'>
        <script src='preferiti.js' defer></script>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">

        <title>Popcorn - <?php echo $userinfo['name']." ".$userinfo['surname'] ?></title>
    </head>

    <body>
    <div id="overlay">
    </div>
        <header>
        <nav>
        <div id="logo">
          Popcorn
        </div>
        <div id="links">
                        <a href='Hmw1.php'>HOME</a>
                        <a href='preferiti.php'>PREFERITI</a>
                        <a href='ricerca.php'>CERCA</a>
                        <a href='profile.php'>PROFILO</a>
                      
          <?php
            

            // Verifica se l'utente ha effettuato l'accesso
            if (isset($_SESSION['_agora_user_id'])) {
                // Utente loggato, mostra il pulsante di logout
                echo '<a href="logout.php">LOGOUT</a>';
            } else {
                // Utente non loggato, mostra il pulsante di login
                echo '<a href="login.php">LOGIN</a>';
            }
        ?>

        </div>
        <div id="menu">
          <div></div>
          <div></div>
          <div></div>
        </div>
      </nav>
        </header>
        <h1>Non sai cosa guardare stasera?</h1>
        <a class="subtitle">
                Controlla la tua lista e scegli cosa guardare!
        </a>
        
        <section class="container">        
            
            <div class="results" id ="film"> </div>
            <div class="results" id ="serie"> </div>
           
    </section>

    </body>
</html>

