<?php
session_start();

function login($username, $password) {
    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = ""; 
    $dbname = "hw1";
    
    // Crea una connessione al database
    $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname) or die(mysqli_error($conn));
    // Verifica se la connessione è avvenuta con successo
    
    // Esegue una query per verificare le credenziali
    $query = "SELECT * FROM users WHERE username = '".$username."'";
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
        
    if (mysqli_num_rows($res) > 0) {
        $entry = mysqli_fetch_assoc($res);

        // Verifica la password fornita con quella salvata nel database
        if (password_verify($password, $entry['password'])) {

            // Imposta una sessione dell'utente
            $_SESSION["_agora_username"] = $entry['username'];
            $_SESSION["_agora_user_id"] = $entry['id'];
            mysqli_free_result($res);
            mysqli_close($conn);
            header("Location: profile.php");
            exit;
        } else {
            // Password non corretta
            mysqli_free_result($res);
            mysqli_close($conn);
            return "Password errata.";
        }
    } else {
        // Utente non trovato nel database
        mysqli_free_result($res);
        mysqli_close($conn);
        return "Username non valido.";
    }
}

// Verifica se sono stati inviati dati tramite il form di login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    $error = login($username, $password);
}
?>

<html>
    <head>
        <link rel='stylesheet' href='login.css'>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Accedi - Popcorn</title>
    </head>
    <body>
        <div id="logo">
            Popcorn
        </div>
        <main class="login">
            <section class="main">
                <h5>Accedi</h5>
                <?php
                // Verifica la presenza di errori
                if (isset($error) && !empty($error)) {
                    echo "<p class='error'>$error</p>";
                }
                ?>
                <form name='login' method='post'>
                    <!-- Seleziona il valore di ogni campo sulla base dei valori inviati al server tramite POST -->
                    <div class="username">
                        <label for='username'>Username</label>
                        <input type='text' name='username' <?php if(isset($_POST["username"])){echo "value='".$_POST["username"]."'";} ?>>
                    </div>
                    <div class="password">
                        <label for='password'>Password</label>
                        <input type='password' name='password' <?php if(isset($_POST["password"])){echo "value='".$_POST["password"]."'";} ?>>
                    </div>
                    <div class="submit-container">
                        <div class="login-btn">
                            <input type='submit' value="ACCEDI">
                        </div>
                    </div>
                </form>
                <div class="signup"><h4>Non hai un account?</h4></div>
                <div class="signup-btn-container"><a class="signup-btn" href="signup.php">ISCRIVITI</a></div>
            </section>
        </main>
    </body>
</html>
