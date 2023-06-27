<?php
session_start();

// Distrugerea sesiunii curente
session_destroy();

// Redirecționare către pagina de autentificare (index.php)
header("Location: index.php");
exit();
?>
