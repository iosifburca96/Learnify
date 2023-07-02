
<?php
require_once "connection.php";

?>
<?php
// Verificare dacă s-au trimis date de autentificare
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Preluare valori introduse în formular
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Realizarea interogarii către baza de date pentru a verifica autenticitatea utilizatorului
    $query = "SELECT * FROM utilizatori WHERE email = '$email' AND parola = '$password'";
    $result = mysqli_query($conn, $query);

    // Verificare dacă s-a găsit un rând rezultat
    if (mysqli_num_rows($result) == 1) {
        // Autentificarea a reușit
        // Creare sesiune pentru utilizator și redirecționare către pagina corespunzătoare
        session_start();
        $row = mysqli_fetch_assoc($result);
        $user_type = $row['tip_utilizator'];
        $user_name = $row['nume'];
        $user_id = $row['id_utilizator'];
        $_SESSION['email'] = $email;
        $_SESSION['user_type'] = $user_type;
        $_SESSION['user_name'] = $user_name;
        $_SESSION['utilizator_id'] = $user_id;

        if ($user_type == 'student') {
            header("Location: student_page.php");
            exit();
        } elseif ($user_type == 'profesor') {
            header("Location: teacher_page.php");
            exit();
        } elseif ($user_type == 'admin') {
            header("Location: admin_page.php");
            exit();
        }
    } else {
        // Autentificarea a eșuat
        // Afiseaza un mesaj de eroare sau redirectjionare catre o pagină de eroare
        echo "Autentificare eșuată. Verificați adresa de email și parola.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Platforma web de jocuri si teste educationale</title>
    <link rel="stylesheet" href="./style.css?v=<?php echo time(); ?>">
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
    
</head>

<body>
    <header>
        <div id="background-wrap">
            <div class="x1">
                <div class="cloud"></div>
            </div>

            <div class="x2">
                <div class="cloud"></div>
            </div>

            <div class="x3">
                <div class="cloud"></div>
            </div>

            <div class="x4">
                <div class="cloud"></div>
            </div>

            <div class="x5">
                <div class="cloud"></div>
            </div>

            <div class="x6">
                <div class="cloud"></div>
            </div>
        </div>
        <div class="logo-wrapper">
            <img class="dark" src="../resources/logos/3-dark.png" alt="">
            <img class="light" src="../resources/logos/3-light.png" alt="">
        </div>
        <div class="sun-wrapper">
            <div class="sun"></div>
        </div>
        <div class="moon">
            <div class="dark">
            </div>
            <div class="dark">
            </div>
            <div class="dark">
            </div>
            <div class="glow"></div>
        </div>
        <div class="switch">
            <img src="../resources/img/lamp-rope.png" alt="">
        </div>
    </header>

    <main>
        <div class="content">

            <h1>Welcome to Learnify - Play2Learn</h1>
            <section class="menu">

                <div class="login">
                    <h2>Create an Account</h2>
                    <form method="POST" action="register.php">
                        <div class="register-form">
                            <label for="name">Name:</label>
                            <input type="text" name="name" id="name" required>

                            <label for="email">Email:</label>
                            <input type="email" name="email" id="email" required>

                            <label for="password">Password:</label>
                            <input type="password" name="password" id="password" required>

                            <label for="user_type">User Type:</label>
                            <select name="user_type" id="user_type">
                                <option value="student">Student</option>
                                <option value="professor">Professor</option>
                            </select>
                        </div>
                        <input class="signin-btn" type="submit" value="Register">
                    </form>
                </div>
            </section>
            <?php
            // Verificați dacă formularul a fost trimis
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Preluați datele din formular
                $name = $_POST["name"];
                $email = $_POST["email"];
                $password = $_POST["password"];
                $user_type = $_POST["user_type"];

                // Verifica conexiunea la baza de date
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Verificați dacă adresa de email există deja în baza de date
                $query = "SELECT * FROM utilizatori WHERE email = '$email'";
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {
                    echo "Email already exists. Please choose a different email.";
                } else {
                    // Insereaza datele utilizatorului în tabelul "utilizatori"
                    $query = "INSERT INTO utilizatori (nume, email, parola, tip_utilizator) VALUES ('$name', '$email', '$password', '$user_type')";
                    if (mysqli_query($conn, $query)) {
                        echo "Registration successful. Please wait for admin approval";
                    } else {
                        echo "Error: " . mysqli_error($conn);
                    }
                }

                // Închide conexiunea la baza de date
                mysqli_close($conn);
            }
            ?>

        </div>

    </main>


    <footer>

        <div class="mountains">
            <div class='mountain-wrap foreground'>
                <div class='mountain'></div>
            </div>
            <div class='mountain-wrap background'>
                <div class='mountain'></div>
            </div>
        </div>

        <div class="hills">
            <div class="hill hill1"></div>
            <div class="hill hill2"></div>
            <div class="hill hill3"></div>
            <div class="hill hill4"></div>
            <div class="hill hill5"></div>
            <div class="hill hill6"></div>
        </div>

        <div class="ground">
            <div class="tree tree1">
                <img src="../resources/img/tree+grass.gif" alt="">
            </div>
            <div class="tree tree2">
                <img src="../resources/img/tree+grass.gif" alt="">
            </div>
            <div class="tree tree3">
                <img src="../resources/img/tree+grass.gif" alt="">
            </div>
            <div class="tree tree4">
                <img src="../resources/img/tree+grass.gif" alt="">
            </div>
            <div class="tree tree5">
                <img src="../resources/img/tree+grass.gif" alt="">
            </div>
            <div class="tree tree6">
                <img src="../resources/img/tree+grass.gif" alt="">
            </div>
            <div class="tree tree7">
                <img src="../resources/img/tree+grass.gif" alt="">
            </div>
            <div class="tree tree8">
                <img src="../resources/img/tree3.png" alt="">
            </div>
            <div class="castle">
                <img src="../resources/img/castle.png" alt="">
            </div>
            <div class="sakura">
                <img src="../resources/img/cherry-blossom-edited.png" alt="">
            </div>
            <div class="pond">
                <img src="../resources/img/pond.png" alt="">
            </div>
            <div class="kids-learning">
                <img src="../resources/img/kids-learning.png" alt="">
            </div>
            <div class="treehouse">
                <img src="../resources/img/treehouse.png" alt="">
            </div>
            <div class="birds">
                <img src="../resources/img/birds.png" alt="">
            </div>
            <div class="globe">
                <img src="../resources/img/globe-kid.png" alt="">
            </div>
            <div class="detective">
                <img src="../resources/img/detective.png" alt="">
            </div>
            <div class="kid-book">
                <img src="../resources/img/kid-book.png" alt="">
            </div>
        </div>
    </footer>


    <script src="./script.js?v=<?php echo time(); ?>"></script>
</body>

</html>