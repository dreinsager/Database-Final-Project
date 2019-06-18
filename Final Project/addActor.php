<?php require_once("session.php"); ?>

<?php 
	require_once("main_function.php");
	new_header("Add an Actor!", ""); 
	$mysqli = db_connection();
	if (($output = message()) !== null) {
		echo $output;
	}

	echo "<h3>Add an Actor!</h3>";
	echo "<div class='row'>";
	echo "<label for='left-label' class='left inline'>";

	if (isset($_POST["submit"])) {
		if( (isset($_POST["Actor_FName"]) && $_POST["Actor_FName"] !== "") && (isset($_POST["Actor_LName"]) && $_POST["Actor_LName"] !== "") &&(isset($_POST["Actor_BDate"]) && $_POST["Actor_BDate"] !== "") ) {


//////////////////////////////////////////////////////////////////////////////////////////////////
			//STEP 2.
				//Create query to insert information that has been posted
		$query = "INSERT INTO Actor ";
		$query .= "(Actor_FName, Actor_LName, Actor_BDate) ";
		$query .= "VALUES (";
		$query .= "'".$_POST["Actor_FName"]."', ";
		$query .= "'".$_POST["Actor_LName"]."', ";
		$query .= "'".$_POST["Actor_BDate"]."'); ";

					
				// Execute query
		$result = $mysqli->query($query);


//////////////////////////////////////////////////////////////////////////////////////////////////


			if($result) {

			$_SESSION["message"] = $_POST["Actor_FName"]." ".$_POST["Actor_LName"]." has been added";
				header("Location: index.php");
				exit;

			}
			else {

			$_SESSION["message"] = "Error! Could not change ".$_POST["Actor_FName"]." ".$_POST["Actor_LName"];
			}
		}
		else {
			$_SESSION["message"] = "Unable to add person. Fill in all information!";
			header("Location: addActor.php");
			exit;
		}
	}
	else {
//////////////////////////////////////////////////////////////////////////////////////////////////
					// STEP 1.
					// Part a.  Create a form that will post to this page: addPeople.php
					//          Also include a submit button
					// Part b.  Include <input> tags for each of the attributes in person:
					//                  First Name, Last Name, Birthdate, Birth City, Birth State, Region

					
					
//////////////////////////////////////////////////////////////////////////////////////////////////
	echo '<form action="addActor.php" method="post">';
	echo '<p>First Name:<input type="text" name="Actor_FName">';
	echo '<p>Last Name:<input type="text" name="Actor_LName">';
	echo '<p>Birthdate (YYYY, MM, DD):<input type="text" name="Actor_BDate">';

	echo '<input type="submit" name="submit" class="button tiny round" value="Add Actor" />';
				
	}
		
	echo "</label>";
	echo "</div>";
	echo '</form>';
?>


<?php new_footer("Doron Reinsager", $mysqli); ?>