<?php
file_put_contents('test.txt', print_r($_POST, true));
require_once "connection.php";

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $student_id;

    $sql = "SELECT *
        FROM utilizatori
        INNER JOIN studenti ON utilizatori.id_utilizator = studenti.utilizator_id
        WHERE utilizatori.id_utilizator = '$user_id'";


    $result = mysqli_query($conn, $sql);

    // Verifică rezultatul interogării
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $student_id = $row['id_student'];
        }
    } 
    //
    $total_points = $_POST['total_points'];
    $test_count = $_POST['test_count'];

    // Actualizează tabela "studenti"
    $query = $conn->prepare("UPDATE studenti SET nr_teste_finalizate = nr_teste_finalizate + ? WHERE utilizator_id = ?");
    $query->bind_param("ss", $test_count, $user_id);
    $query->execute();

    $nrTeste;

    $sqlStudenti = "SELECT * FROM studenti";
    $res = mysqli_query($conn, $sqlStudenti);
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $nrTeste = $row['nr_teste_finalizate'];
        }
    } 

    // Actualizează tabela "clasament"
    $query = $conn->prepare("UPDATE clasament SET puncte_totale = puncte_totale + ? WHERE student_id = ?");
    $query->bind_param("ss", $total_points, $student_id);
    $query->execute();

    $query = $conn->prepare("UPDATE clasament SET medie = puncte_totale / ? WHERE student_id = ?");
    $query->bind_param("ss", $nrTeste, $student_id);
    $query->execute();


    echo "Rezultate actualizate cu succes!";
}
?>