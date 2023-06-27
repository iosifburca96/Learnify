<?php
require "connection.php";
// Retrieve the clicked button value
$clickedGameButton = $_GET['game-button'];
$clickedGameButton = intval($clickedGameButton);
echo "Clicked Game Button: " . $clickedGameButton;
// Define content based on the clicked button
$query = $conn->prepare("SELECT intrebare, raspuns1, raspuns2, raspuns3, raspuns4, raspuns_corect FROM interbari_raspunsuri WHERE test_id = ?");
$query->bind_param("i", $clickedGameButton);
$query->execute();
$result = $query->get_result();

while ($fetch = $result->fetch_assoc()) {
    ?>

    <p>
        <?php echo $fetch['intrebare'] ?>
    </p>
    <button>
		<?php echo $fetch['raspuns1'] ?>
	</button> <br>
	<button>
		<?php echo $fetch['raspuns2'] ?>
	</button> <br>
	<button>
		<?php echo $fetch['raspuns3'] ?>
	</button> <br>
	<button>
		<?php echo $fetch['raspuns4'] ?>
	</button> <br>
	<button>
		Urmatoarea intrebare
	</button>

    <?php
}
?>