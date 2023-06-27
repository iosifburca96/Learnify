<?php
require_once "connection.php";

// Verificare dacă utilizatorul este autentificat și are o sesiune validă
session_start();

if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    // Utilizatorul nu este autentificat, redirecționare către pagina de autentificare
    header("Location: index.php");
    exit();
}

if (isset($_GET['id'])) {
    $id_test = $_GET['id'];

    // Obține întrebările și răspunsurile corespunzătoare din baza de date
    $query = $conn->prepare("SELECT intrebare, raspuns1, raspuns2, raspuns3, raspuns4, raspuns_corect FROM intrebari_raspunsuri WHERE test_id = ?");
    $query->bind_param("s", $id_test);
    $query->execute();
    $result = $query->get_result();
    ?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Learnify</title>
        <link rel="stylesheet" href="./style.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css " />
        <meta http-equiv='cache-control' content='no-cache'>
        <meta http-equiv='expires' content='0'>
        <meta http-equiv='pragma' content='no-cache'>
    </head>

    <body>
        <header>
            <div class="logo-wrapper-s">
                <img class="dark" src="../resources/logos/3-dark.png" alt="">
                <img class="light" src="../resources/logos/3-light.png" alt="">
            </div>
            <?php
            if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {
                // Sesiunea este activă
                $user_type = $_SESSION['user_type'];
                $user_name = $_SESSION['user_name'];

                // Afișați mesajul corespunzător în colțul din stânga sus
                //echo '<div class="user-message">';
                //echo 'Logat ca ' . $user_type . ': ' . $user_name;
                //echo '</div>';
                echo '<div class="user-message">
                        <button onclick="toggleMenu()">Logat ca ' . $user_type . ': ' . $user_name . '</button>
                        <div class="user-menu" id="user-menu">
                            <ul>
                                <li><a href="student_page.php">Home</a></li>
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
                <section class="menu">

                    <div id="game-content">
                        <h2 id="question-number"></h2>
                        <h3 id="correct-answers"></h3>
                        <?php
                        $questionNumber = 0;
                        $totalQuestions = $result->num_rows; // Inițializare variabila $totalQuestions cu numărul total de întrebări
                    
                        while ($fetch = $result->fetch_assoc()) {
                            $questionNumber++;
                            ?>
                            <div class="question-container" id="question-<?php echo $questionNumber; ?>">
                                <p class="question">
                                    <?php echo $fetch['intrebare']; ?>
                                </p>
                                <?php
                                $correctAnswerIndex = 0;
                                for ($i = 1; $i <= 4; $i++) {
                                    $answerColumn = 'raspuns' . $i;
                                    if ($fetch['raspuns_corect'] == $fetch[$answerColumn]) {
                                        $correctAnswerIndex = $i;
                                        break;
                                    }
                                }
                                ?>
                                <button class="answer" <?php if ($correctAnswerIndex == 1)
                                    echo 'data-correct="true"'; ?>>
                                    <?php echo $fetch['raspuns1']; ?>
                                </button><br>
                                <button class="answer" <?php if ($correctAnswerIndex == 2)
                                    echo 'data-correct="true"'; ?>>
                                    <?php echo $fetch['raspuns2']; ?>
                                </button><br>
                                <button class="answer" <?php if ($correctAnswerIndex == 3)
                                    echo 'data-correct="true"'; ?>>
                                    <?php echo $fetch['raspuns3']; ?>
                                </button><br>
                                <button class="answer" <?php if ($correctAnswerIndex == 4)
                                    echo 'data-correct="true"'; ?>>
                                    <?php echo $fetch['raspuns4']; ?>
                                </button><br>
                            </div>



                            <?php
                        }

                        ?>
                        <button id="next-question" style="display: none;">Următoarea întrebare</button>
                    </div>
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

            var questionContainers = document.querySelectorAll(".question-container");
            var answerButtons = document.querySelectorAll(".answer");
            var nextQuestionButton = document.getElementById("next-question");
            var currentQuestion = 0;
            var correctAnswersCount = 0;

            // Calculeza numărul total de întrebări
            var totalQuestions = questionContainers.length;

            // Afișare numărul întrebării curente
            var questionNumberText = "Întrebarea " + (currentQuestion + 1) + " din " + totalQuestions;
            document.getElementById("question-number").textContent = questionNumberText;

            // Afișare prima întrebare
            showQuestion(currentQuestion);

            // Adăugare un eveniment de click la fiecare buton de răspuns
            for (var i = 0; i < answerButtons.length; i++) {
                answerButtons[i].addEventListener("click", function () {
                    // Verificare dacă răspunsul este corect și increment numărul de răspunsuri corecte
                    if (this.getAttribute("data-correct") === "true") {
                        correctAnswersCount++;
                    }

                    currentQuestion++;
                    if (currentQuestion < questionContainers.length) {
                        // Dacă mai există întrebări, afișeaza următoarea întrebare
                        showQuestion(currentQuestion);
                    } else {
                        // Dacă nu mai există întrebări, ascunde butonul și afișeaza un mesaj de finalizare
                        nextQuestionButton.style.display = "none";
                        document.getElementById("game-content").innerHTML += "<p>Testul s-a încheiat. Mulțumim!</p>";
                    }

                    // Actualizeaza textul numărului întrebării și numărului de răspunsuri corecte
                    questionNumberText = "Întrebarea " + (currentQuestion + 1) + " din " + totalQuestions;
                    document.getElementById("question-number").textContent = questionNumberText;

                    // Actualizeaza textul numărului de răspunsuri corecte
                    var correctAnswersText = correctAnswersCount + " răspunsuri corecte din " + totalQuestions;
                    document.getElementById("correct-answers").textContent = correctAnswersText;
                });
            }

            // Funcție pentru afișarea unei întrebări specifice
            function showQuestion(questionIndex) {
                // Ascunde toate întrebările
                for (var i = 0; i < questionContainers.length; i++) {
                    questionContainers[i].style.display = "none";
                }
                // Afișeaza întrebarea curentă
                questionContainers[questionIndex].style.display = "block";
                // Dacă nu este ultima întrebare, afișați butonul "Următoarea întrebare"
                if (questionIndex < questionContainers.length) {
                    nextQuestionButton.style.display = "block";
                } else {
                    nextQuestionButton.style.display = "none";
                }
            }

            function toggleMenu() {
            var menu = document.getElementById("user-menu");
            menu.classList.toggle("show");
        }
        </script>

    </body>

    </html>
    <?php
} else {
    echo "Id-ul testului nu a fost specificat.";
}
?>