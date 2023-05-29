<html>
<head>
    <title>Popcorn</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="home.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="home.js" defer="true"></script>
  </head>
  
  <body>
    <div id="overlay" class="hidden">
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
            session_start();

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
      <h1>Tutto quello che vuoi sapere sulla settima arte</h1>
      <a class="subtitle">
       Esegui l'accesso per tenere traccia dei tuoi film e serie tv preferite
      </a>
    </header>
  
    <footer>
      <h1>Agnese Modica 1000026796</h1>
    </footer>
  </body>
  </html>
