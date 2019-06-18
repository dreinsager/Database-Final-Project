<!-- Doron Reinsager -->

<?php 
	require_once("main_function.php");
	new_header("Edit!", "Edit.php"); 
	$mysqli = db_connection();
	if (isset($_POST["submit"])) {
		$ID = $_GET["id"];
		// UPDATE query on $ID

		$query = "UPDATE Actor ";
		$query .= "SET Actor_FName = '".$_POST['Actor_FName']."', Actor_LName = '".$_POST['Actor_LName']."', Actor_BDate = '".$_POST['Actor_BDate']."'";
		$query .= " WHERE Actor_ID = '".$ID."'";
		

		
				
				

		//Output query results
		$result = $mysqli->query($query);

		//NOTE that we only check that $result was successful and DO NOT expect any rows to change
		if($result) {
			echo $_POST["Actor_FName"]." ".$_POST["Actor_LName"]." has been changed";
		}
		else {
			echo "Error! Could not change ".$_POST["Actor_FName"]." ".$_POST["Actor_LName"];
		}
		
		//Once the Edit has been completed (CHANGE button clicked)
		//redirect to the webpage
		header("Location: index.php");
		exit;
	}
	else {
	  // GET id and create a query to SELECT * on the id

	if (isset($_GET["id"]) && $_GET["id"] !== "") {
		$ID = $_GET["id"];

		$query = "SELECT * ";
		$query .= "FROM Actor ";
		$query .= "WHERE Actor_ID = '".$ID."'";
	
	}	
	

			  
			  
		$result = $mysqli->query($query);

		//Process query
		if ($result && $result->num_rows > 0)  {
			$row = $result->fetch_assoc();
			echo "<div class='row'>";
			echo "<label for='left-label' class='left inline'>";

			echo "<h3>".$row["Actor_FName"]." ".$row["Actor_LName"]."'s Profile</h3>";



			// Create form with inputs for each field in people table
			echo "<p><form action='Edit.php?id={$ID}'method='post'>";

			
			//Create input tags for each field in the person's table
			echo "<p><input type='text' name='Actor_FName' value='".$row['Actor_FName']."'/></p>";
			echo "<p><input type='text' name='Actor_LName' value='".$row['Actor_LName']."'/></p>";
			echo "<p><input type='text' name='Actor_BDate' value='".$row['Actor_BDate']."'/></p>";


			echo '<input type="submit" name="submit" class="button tiny round" value="Edit Actor" />';

			echo "</form>";
		
					
					
					
					
///////////////////////////////////////////////////////////////////////////////////////////


			echo "<br /><p>&laquo:<a href='index.php'>Back to Main Page</a>";
			echo "</label>";
			echo "</div>";

		}
		//Query failed to exit.
		else {
			$_SESSION["message"] = "Person could not be found!";
			header("Location: index.php");
			exit;
		}
	}
 
?>
<?php  new_footer("Doron Reinsager", $mysqli); ?>
