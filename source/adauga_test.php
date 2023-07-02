<?php
require_once "connection.php";
?>
<?php
// Verificare dacă utilizatorul este autentificat și are o sesiune validă
session_start();

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'profesor' || $_SESSION['user_type'] !== 'admin') {
    // Redirecționați utilizatorul către o altă pagină sau afișați un mesaj de eroare
    header('Location: index.php');
    exit();
}

// Obținerea opțiunilor pentru categorii din tabela "categorii_teste"
$categorii_query = "SELECT * FROM categorii_teste";
$categorii_result = $conn->query($categorii_query);

// Adăugarea testului în baza de date la submiterea formularului
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Preluarea datelor din formular
    $tip_test = $_POST["tip_test"];
    $nume_test = $_POST["nume_test"];
    $intrebari = $_POST["intrebari"];
    $raspunsuri_corecte = $_POST["raspunsuri_corecte"];

    // Adăugarea testului în tabela "teste"
    $adauga_test_query = "INSERT INTO teste (categorie_id, nume_test, nr_intrebari, puncte_totale)
                          VALUES ('$tip_test', '$nume_test', '10', '10')";
    $conn->query($adauga_test_query);

    // Obținerea id-ului testului adăugat
    $id_test = $conn->insert_id;

    // Obținerea ultimului ID din tabela "intrebari_raspunsuri"
    $ultimul_id_query = "SELECT MAX(id_intrebare) as last_id FROM intrebari_raspunsuri";
    $ultimul_id_result = $conn->query($ultimul_id_query);
    $row = $ultimul_id_result->fetch_assoc();
    $ultimul_id = $row['last_id'];

    // Parcurgerea întrebărilor și adăugarea lor în tabela "intrebari_raspunsuri"
    foreach ($intrebari as $nr_intrebare => $text_intrebare) {
        // Incrementarea ID-ului pentru a obține următorul ID disponibil
        $ultimul_id++;

        $raspuns1 = $_POST["raspuns1"][$nr_intrebare];
        $raspuns2 = $_POST["raspuns2"][$nr_intrebare];
        $raspuns3 = $_POST["raspuns3"][$nr_intrebare];
        $raspuns4 = $_POST["raspuns4"][$nr_intrebare];
        $raspuns_corect = $raspunsuri_corecte[$nr_intrebare];

        // Adăugarea întrebării în tabela "intrebari_raspunsuri" cu noul ID
        $adauga_intrebare_query = "INSERT INTO intrebari_raspunsuri (id_intrebare, test_id, intrebare, raspuns1, raspuns2, raspuns3, raspuns4, raspuns_corect)
                               VALUES ('$ultimul_id', '$id_test', '$text_intrebare', '$raspuns1', '$raspuns2', '$raspuns3', '$raspuns4', '$raspuns_corect')";
        $conn->query($adauga_intrebare_query);
    }


    // Redirecționare către o altă pagină după ce testul a fost adăugat
    header("Location: test_succes.php");
    exit();
}

// Închiderea conexiunii cu baza de date
$conn->close();
?>


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Platforma web de jocuri si teste educationale</title>
    <link rel="stylesheet" href="./style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css " />
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


            <section class="menu">
                <h1>Adaugă Test</h1>

                <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">

                    <label for="tip_test">Tipul Testului:</label>

                    <select id="tip_test" name="tip_test">
                        <?php while ($categorie = $categorii_result->fetch_assoc()) { ?>
                            <option value="<?php echo $categorie['id_categorii_teste']; ?>"><?php echo $categorie['nume_categorie']; ?></option>
                        <?php } ?>
                    </select>

                    <br><br>

                    <label for="nume_test">Numele Testului:</label>
                    <input type="text" id="nume_test" name="nume_test">
                    <br><br>

                    <h2>Întrebări:</h2>

                    <?php for ($i = 1; $i <= 10; $i++) { ?>
                        <label for="intrebare_<?php echo $i; ?>">Întrebarea <?php echo $i; ?>:</label>
                        <input type="text" id="intrebare_<?php echo $i; ?>" name="intrebari[<?php echo $i; ?>]">
                        <br>

                        <label for="raspuns1_<?php echo $i; ?>">Răspuns 1:</label>
                        <input type="text" id="raspuns1_<?php echo $i; ?>" name="raspuns1[<?php echo $i; ?>]">
                        <br>

                        <label for="raspuns2_<?php echo $i; ?>">Răspuns 2:</label>
                        <input type="text" id="raspuns2_<?php echo $i; ?>" name="raspuns2[<?php echo $i; ?>]">
                        <br>

                        <label for="raspuns3_<?php echo $i; ?>">Răspuns 3:</label>
                        <input type="text" id="raspuns3_<?php echo $i; ?>" name="raspuns3[<?php echo $i; ?>]">
                        <br>

                        <label for="raspuns4_<?php echo $i; ?>">Răspuns 4:</label>
                        <input type="text" id="raspuns4_<?php echo $i; ?>" name="raspuns4[<?php echo $i; ?>]">
                        <br>

                        <label for="raspuns_corect_<?php echo $i; ?>">Răspuns Corect:</label>
                        <input type="text" id="raspuns_corect_<?php echo $i; ?>"
                            name="raspunsuri_corecte[<?php echo $i; ?>]">
                        <br><br>
                    <?php } ?>
                    <input type="submit" value="Adaugă Test">
                </form>

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