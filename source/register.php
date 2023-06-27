<?php include 'connection.php'; ?>


<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h2>Create an Account</h2>
    <form method="POST" action="register.php">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>

        <label for="user_type">User Type:</label>
        <select name="user_type" id="user_type">
            <option value="student">Student</option>
            <option value="professor">Professor</option>
        </select><br><br>

        <input type="submit" value="Register">
    </form>
</body>
</html>

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

