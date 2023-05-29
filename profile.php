<?php 
    require_once 'auth.php';
    if (!$userid = checkAuth()) {
        header("Location: login.php");
        exit;
    }
?>

<html>
    <?php 
        // Carico le informazioni dell'utente loggato per visualizzarle nella sidebar (mobile)
        $conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
        $userid = mysqli_real_escape_string($conn, $userid);
        $query = "SELECT * FROM users WHERE id = $userid";
        $res_1 = mysqli_query($conn, $query);
        $userinfo = mysqli_fetch_assoc($res_1);   
    ?>

    <head>
        <link rel='stylesheet' href='profile.css'>
        <script src='profile.js' defer></script>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">

        <title>Popcorn - <?php echo $userinfo['name']." ".$userinfo['surname'] ?></title>
    </head>

    <body>
    <div id="overlay">
    </div>
        <header>
            <nav>
                <div class="nav-container">
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
                </div>
                <div class="userInfo">
                    <div class="avatar" style="background-image: url(<?php echo $userinfo['propic'] == null ? "assets/default_avatar.png" : $userinfo['propic'] ?>)">
                    </div>
                    <h1><?php echo $userinfo['name']." ".$userinfo['surname'] ?></h1>
                </div>               
            </nav>
        </header>

       

    </body>
</html>

<?php mysqli_close($conn); ?>