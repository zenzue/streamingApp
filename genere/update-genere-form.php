<?php

	include_once '../config/dbconfig.php';

	$genere_id=isset($_GET['genere_id']) ? $_GET['genere_id'] : die('ERROR: Genere ID not found.');
	$query = "SELECT genere_id, genere, genere_image FROM genere WHERE genere_id = " .$genere_id;
	$stmt = $db_con->prepare($query);
	if ($stmt->execute()) {
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$genere_id = $row['genere_id'];
		$genere_name = $row['genere'];
        $genere_image = $row['genere_image'];
	} else {
		echo "Unable to read record.";
	}

?>

<form id="update-genere-form" method="POST" action="#">
    <div class="form-group">
        <label for="generename">Genere Name</label>
        <input type="text" class="form-control" id="genere_name" name="genere_name" value='<?php echo htmlspecialchars($genere_name, ENT_QUOTES); ?>' placeholder="Genere Name" required>
    </div>

    <div class="form-group">
        <label for="generephoto">Genere Photo</label>
    	<img src="<?php echo $genere_image;?>" style="width:70px;" />
        <input type="file" class="form-control" id="genere_image" name="genere_image">
    </div>
    <input type='hidden' id="genere_id" name='genere_id' value='<?php echo $genere_id ?>' />
    <button type="submit" class="btn btn-primary">Submit</button>
</form>