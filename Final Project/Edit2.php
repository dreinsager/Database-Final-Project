<!-- Doron Reinsager -->

<?php 
	require_once("main_function.php");
	new_header("Edit!", "Edit.php"); 
	$mysqli = db_connection();
	if (isset($_POST["submit"])) {
		$ID = $_GET["id"];
		// UPDATE query on $ID

		$query = "UPDATE Director ";
		$query .= "SET Director_FName = '".$_POST['Director_FName']."', Director_LName = '".$_POST['Director_LName']."', Director_BDate = '".$_POST['Director_BDate']."'";
		$query .= " WHERE Director_ID = '".$ID."'";
		

		
				
				

		//Output query results
		$result = $mysqli->query($query);

		//NOTE that we only check that $result was successful and DO NOT expect any rows to change
		if($result) {
			echo $_POST["Director_FName"]." ".$_POST["Director_LName"]." has been changed";
		}
		else {
			echo "Error! Could not change ".$_POST["Director_FName"]." ".$_POST["Director_LName"];
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
		$query .= "FROM Director ";
		$query .= "WHERE Director_ID = '".$ID."'";
	
	}	
	

			  
			  
		$result = $mysqli->query($query);

		//Process query
		if ($result && $result->num_rows > 0)  {
			$row = $result->fetch_assoc();
			echo "<div class='row'>";
			echo "<label for='left-label' class='left inline'>";

			echo "<h3>".$row["Director_FName"]." ".$row["Director_LName"]."'s Profile</h3>";



			// Create form with inputs for each field in people table
			echo "<p><form action='Edit2.php?id={$ID}'method='post'>";

			
			//Create input tags for each field in the person's table
			echo "<p><input type='text' name='Director_FName' value='".$row['Director_FName']."'/></p>";
			echo "<p><input type='text' name='Director_LName' value='".$row['Director_LName']."'/></p>";
			echo "<p><input type='text' name='Director_BDate' value='".$row['Director_BDate']."'/></p>";


			echo '<input type="submit" name="submit" class="button tiny round" value="Edit Director" />';

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
