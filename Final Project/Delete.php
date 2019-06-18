<!-- Doron Reinsager -->
<?php require_once("session.php"); ?>

<?php 
	require_once("main_function.php");
	new_header("Welcome!", ""); 
	$mysqli = db_connection();
	if (($output = message()) !== null) {
		echo $output;
	}

  	if (isset($_GET["id"]) && $_GET["id"] !== "") {
		 $ID = $_GET["id"];
		 
		// Create a query to delete this id from persons

		$query = "DELETE FROM Actor WHERE Actor_ID = '".$ID."'";

		
				
		// Execute query
		$result = $mysqli->query($query); 
//////////////////////////////////////////////////////////////////////////////////////		
		if ($result && $mysqli->affected_rows === 1) {
			$_SESSION["message"] = "Person successfully deleted!";
			$output = message();
			echo $output;
			echo "<br /><br /><p>&laquo:<a href='index.php'>Back to Main Page</a>";

		}
		else {
		$_SESSION["message"] = "Person could not be deleted!";
		redirect_to("index.php");
		exit;
		}
	}
	else {
		$_SESSION["message"] = "Person could not be found!";
		redirect_to("index.php");
		exit;
	}

		
			
?>		
						
<?php  new_footer("Doron Reinsager", $mysqli); ?>