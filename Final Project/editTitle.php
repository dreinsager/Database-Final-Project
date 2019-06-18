<!-- Doron Reinsager -->

<?php 
	require_once("main_function.php");
	new_header("Edit!", "Edit.php"); 
	$mysqli = db_connection();
	if (isset($_POST["submit"])) {
		$ID = $_GET["id"];
		// UPDATE query on $ID

		$query = "UPDATE Movies ";
		$query .= "SET Movie_Title = '".$_POST['Movie_Title']."'";
		$query .= " WHERE Movie_Title = '".$ID."'";
		

		
				
				

		//Output query results
		$result = $mysqli->query($query);

		//NOTE that we only check that $result was successful and DO NOT expect any rows to change
		if($result) {
			echo $_POST["Movie_Title"]." has been changed";
		}
		else {
			echo "Error! Could not change ".$_POST["Movie_Title"];
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
		$query .= "FROM Movies ";
		$query .= "WHERE Movie_Title = '".$ID."'";
	
	}	
	

			  
			  
		$result = $mysqli->query($query);

		//Process query
		if ($result && $result->num_rows > 0)  {
			$row = $result->fetch_assoc();
			echo "<div class='row'>";
			echo "<label for='left-label' class='left inline'>";

			echo "<h3>".$row["Movie_Title"]."</h3>";



			// Create form with inputs for each field in people table
			echo "<p><form action='editTitle.php?id={$ID}'method='post'>";

			
			//Create input tags for each field in the person's table
			echo "<p><input type='text' name='Director_FName' value='".$row['Movie_Title']."'/></p>";


			echo '<input type="submit" name="submit" class="button tiny round" value="Edit Movie Title" />';

			echo "</form>";
		
					
					
					
					
///////////////////////////////////////////////////////////////////////////////////////////


			echo "<br /><p>&laquo:<a href='index.php'>Back to Main Page</a>";
			echo "</label>";
			echo "</div>";

		}
		//Query failed to exit.
		else {
			$_SESSION["message"] = "Movie title could not be found!";
			header("Location: index.php");
			exit;
		}
	}
 
?>
<?php  new_footer("Doron Reinsager", $mysqli); ?>
