<?php
	session_start();

	require_once '../config/dbconfig.php';
	$response = array();
	if(isset($_POST['btn-login']))
	{
		$user_email = trim($_POST['username']);
		$user_password = $_POST['password'];
		$password = md5($user_password);
		
		try
		{	
		
			$stmt = $db_con->prepare("SELECT * FROM users WHERE user_email=:user_email");
			$stmt->execute(array(":user_email"=>$user_email));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$count = $stmt->rowCount();
			
			if($row['user_password']==$password){	

				$_SESSION['user_session'] = $row['user_id'];
				$response['status']='ok'; 
				header('Content-Type: application/json');
				echo json_encode($response);
			}
			
			else{
				
				$response['status']='failed';
                header('Content-Type: application/json');
                echo json_encode($response); // wrong details 
			}
				
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}

?>