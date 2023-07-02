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
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css " />
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
        }

        th {
            cursor: pointer;
        }
    </style>
    <script>
        function confirmApproval(userId) {
            var result = confirm("Sigur doriți să aprobați acest utilizator?");
            if (result) {
                // Redirect sau executați operația de aprobare
                window.location.href = "aprobare_utilizator.php?user_id=" + userId;
            }
        }

        function confirmDelete(userId) {
            var result = confirm("Sigur doriți să ștergeți acest utilizator?");
            if (result) {
                // Redirect sau executați operația de ștergere
                window.location.href = "sterge_utilizator.php?user_id=" + userId;
            }
        }
    </script>
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

                <h1>Gestiune Utilizatori</h1>

                <?php
                // Verificați dacă a fost efectuată o căutare
                $searchQuery = "";
                if (isset($_GET['search'])) {
                    $search = $_GET['search'];
                    $searchQuery = " WHERE nume LIKE '%$search%'"; // Înlocuiți "nume" cu coloana corectă din tabela "utilizatori"
                }

                // Obțineți utilizatorii din tabela "utilizatori"
                $query = "SELECT * FROM utilizatori" . $searchQuery;

                // Sortare coloane
                if (isset($_GET['sort'])) {
                    $sortColumn = $_GET['sort'];
                    $query .= " ORDER BY $sortColumn";
                }

                // Filtrare după tipul de utilizator
                if (isset($_GET['tip_utilizator'])) {
                    $tipUtilizator = $_GET['tip_utilizator'];
                    $query .= " WHERE tip_utilizator = '$tipUtilizator'";
                }

                // Filtrare după aprobare
                if (isset($_GET['aprobat'])) {
                    $aprobat = $_GET['aprobat'];
                    $query .= " WHERE aprobat = '$aprobat'";
                }

                $result = $conn->query($query);
                ?>

                <form method="GET">
                    <input type="text" name="search" placeholder="Caută utilizatori..."
                        value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                    <input type="submit" value="Caută">
                </form>

                <table>
                    <tr>
                        <th><a href="?sort=id">ID</a></th>
                        <th><a href="?sort=nume">Nume Utilizator</a></th>
                        <th><a href="?sort=tip_utilizator">Tip Utilizator</a></th>
                        <th><a href="?sort=aprobat">Aprobat</a></th>
                        <th>Acțiuni</th>
                    </tr>

                    <?php
                    // Afisarea utilizatorilor în tabel
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $userId = $row["id_utilizator"];
                            $numeUtilizator = $row["nume"];
                            $tipUtilizator = $row["tip_utilizator"];
                            $aprobat = $row["aprobat"] ? "true" : "false";

                            echo "<tr>";
                            echo "<td>$userId</td>";
                            echo "<td>$numeUtilizator</td>";
                            echo "<td>$tipUtilizator</td>";
                            echo "<td>$aprobat</td>";
                            echo "<td>";
                            if (!$row["aprobat"]) {
                                echo "<button onclick=\"confirmApproval($userId)\">Aprobare</button>";
                            }
                            echo "<button onclick=\"confirmDelete($userId)\">Ștergere</button>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Nu există utilizatori.</td></tr>";
                    }

                    // Închideți conexiunea la baza de date
                    $conn->close();
                    ?>
                </table>


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