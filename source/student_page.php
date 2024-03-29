<?php
require_once "connection.php";
?>
<?php
// Verificare dacă utilizatorul este autentificat și are o sesiune validă
session_start();

if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    // Utilizatorul nu este autentificat, redirecționare pagina de autentificare
    header("Location: index.php");
    exit();
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
        <?php
        if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {
            // Sesiunea este activă
            $user_type = $_SESSION['user_type'];
            $user_name = $_SESSION['user_name'];

            // Afișeazamesajul corespunzător în colțul din stânga sus
            //echo '<div class="user-message">';
            //echo 'Logat ca ' . $user_type . ': ' . $user_name;
            //echo '</div>';
            echo '<div class="user-message">
                        <button onclick="toggleMenu()">Logat ca ' . $user_type . ': ' . $user_name . '</button>
                        <div class="user-menu" id="user-menu">
                            <ul>
                                <li><a href="clasament.php">Clasament</a></li>
                                <li><a href="logout.php" onclick="event.preventDefault(); document.getElementById(\'logout-form\').submit();">Delogare</a>
                                </li>
                            </ul>
                        </div>
                    </div>';
        }
        ?>

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
                <nav>
                    <button id="backButton">Go back to categories</button>
                    <ul id="categoriesContainer">
                        <li>
                            <a href="#">
                                <img id="1" class="category-link" src="../resources/img/plane1.png" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img id="4" class="category-link" src="../resources/img/plane2.png" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img id="2" class="category-link" src="../resources/img/plane3.png" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img id="5" class="category-link" src="../resources/img/history.png" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img id="3" class="category-link" src="../resources/img/plane4.png" alt="">
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img id="6" class="category-link" src="../resources/img/geography.png" alt="">
                            </a>
                        </li>
                        <!--<li>
                            <a href="game.php">GAME PAGE TEST</a>
                        </li>-->
                    </ul>

                    <div id="gameslist-container" class="content-container"> </div>
                </nav>
                <div id="game-content"></div>
            </section>

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

    <form id="logout-form" action="logout.php" method="POST" style="display: none;">
        <!-- Este necesar un formular pentru a putea apela logout.php prin intermediul metodei POST -->
    </form>
    <script src="./script.js?v=<?php echo time(); ?>"></script>
    <script>
        function toggleMenu() {
            var menu = document.getElementById("user-menu");
            menu.classList.toggle("show");
        }
    </script>
</body>

</html>