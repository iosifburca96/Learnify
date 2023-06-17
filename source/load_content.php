<?php
require "connection.php";
// Retrieve the clicked button value
$clickedButton = $_GET['button'];

// Define content based on the clicked button
    $query = $conn->prepare("SELECT name FROM games WHERE category = ?");
    $query->bind_param("s", $clickedButton);
    $query->execute();
    $result = $query->get_result();
    
    while($fetch = $result->fetch_assoc()){
      ?>
      <p><?php echo $fetch['name']?></p>
      <?php
    }
?>