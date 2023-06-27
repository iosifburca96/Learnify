<?php
require_once "connection.php";

// Verificare dacă utilizatorul este autentificat și are o sesiune validă
session_start();

if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    // Utilizatorul nu este autentificat, redirecționare către pagina de autentificare
    header("Location: index.php");
    exit();
}

if (isset($_POST['puncte_castigate'])) {
    $puncte_castigate = $_POST['puncte_castigate'];
    $user_email = $_SESSION['email'];

    // Actualizare tabela "clasament" pentru studentul logat
    $update_clasament = $conn->prepare("UPDATE clasament SET puncte_totale = puncte_totale + ?, medie = puncte_totale / nr_teste_finalizate WHERE email = ?");
    $update_clasament->bind_param("is", $puncte_castigate, $user_email);
    $update_clasament->execute();

    // Actualizare tabela "studenti" pentru numărul de teste finalizate
    $update_studenti = $conn->prepare("UPDATE studenti SET nr_teste_finalizate = nr_teste_finalizate + 1 WHERE email = ?");
    $update_studenti->bind_param("s", $user_email);
    $update_studenti->execute();

    // Încheie sesiunea utilizatorului și redirecționare 
    session_destroy();
    header("Location: confirmare.php");
    exit();
}
