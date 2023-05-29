<?php 
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login.php");
        exit;
    }
?>

<html>
    <head>
        <title>Popcorn</title>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="ricerca.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="ricerca.js" defer="true"></script>
    </head>
        
    <body> 
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
      <h1>Cerca il titolo di un film o una serie tv per saperne di più</h1>
        </header>
       
        <section id="search">
            <form autocomplete="off">
            <div class="search">
          <label for='search'>Cerca</label>
          <input type='text' name="search" class="searchBar">
          <input type="submit" value="Cerca">
        </div>
      </form>
      <article id="album-view">
			
		</article>
		<article id = "sinossi">
			<p id="plot"></p>
		</article>
		<article id="cast">
		</article>
		
		<article id="modale" class="hidden"> 
		</article>
      
        </section>
        <footer>
      <h1>Agnese Modica 1000026796</h1>
    </footer>
    </body>

</html>