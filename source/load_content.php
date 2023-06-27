<?php
require "connection.php";
// Retrieve the clicked button value
$clickedButton = $_GET['button'];

// Define content based on the clicked button
$query = $conn->prepare("SELECT nume_test, id_test FROM teste WHERE categorie_id = ?");
$query->bind_param("s", $clickedButton);
$query->execute();
$result = $query->get_result();

while($fetch = $result->fetch_assoc()){
  ?>
   <a href="game.php?id=<?php echo $fetch['id_test']; ?>"><?php echo $fetch['nume_test']; ?></a><br>
  <?php
}
?>