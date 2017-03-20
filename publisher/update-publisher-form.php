<?php

	include_once '../config/dbconfig.php';

	$publisher_id=isset($_GET['pub_id']) ? $_GET['pub_id'] : die('ERROR: Publisher ID not found.');
	$query = "SELECT pub_id, pub_name,pub_prefix FROM publisher WHERE pub_id = " .$publisher_id;
	$stmt = $db_con->prepare($query);
	if ($stmt->execute()) {
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$publisher_id = $row['pub_id'];
		$publisher_name = $row['pub_name'];
		
	} else {
		echo "Unable to read record.";
	}

?>

<form id="update-publisher-form" method="POST" action="#">
    <div class="form-group">
        <label for="publishername">Publisher Name</label>
        <input type="text" class="form-control" id="publisher_name" name="publisher_name" value='<?php echo htmlspecialchars($publisher_name, ENT_QUOTES); ?>' placeholder="publisher Name" required>
    </div>

    
    <input type='hidden' id="publisher_id" name='publisher_id' value='<?php echo $publisher_id ?>' />
    <button type="submit" class="btn btn-primary">Submit</button>
</form>