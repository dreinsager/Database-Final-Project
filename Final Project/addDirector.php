<?php require_once("session.php"); ?>

<?php 
	require_once("main_function.php");
	new_header("Add a Director!", ""); 
	$mysqli = db_connection();
	if (($output = message()) !== null) {
		echo $output;
	}

	echo "<h3>Add a Director!</h3>";
	echo "<div class='row'>";
	echo "<label for='left-label' class='left inline'>";

	if (isset($_POST["submit"])) {
		if( (isset($_POST["Director_FName"]) && $_POST["Director_FName"] !== "") && (isset($_POST["Director_LName"]) && $_POST["Director_LName"] !== "") &&(isset($_POST["Director_BDate"]) && $_POST["Director_BDate"] !== "") ) {


//////////////////////////////////////////////////////////////////////////////////////////////////
			//STEP 2.
				//Create query to insert information that has been posted
		$query1 = "INSERT INTO Director ";
		$query1 .= "(Director_FName, Director_LName, Director_BDate) ";
		$query1 .= "VALUES (";
		$query1 .= "'".$_POST["Director_FName"]."', ";
		$query1 .= "'".$_POST["Director_LName"]."', ";
		$query1 .= "'".$_POST["Director_BDate"]."'); ";

					
				// Execute query
		$result1 = $mysqli->query($query1);


//////////////////////////////////////////////////////////////////////////////////////////////////


			if($result1) {

			$_SESSION["message"] = $_POST["Director_FName"]." ".$_POST["Director_LName"]." has been added";
				header("Location: index.php");
				exit;

			}
			else {

			$_SESSION["message"] = "Error! Could not change ".$_POST["Director_FName"]." ".$_POST["Director_LName"];
			}
		}
		else {
			$_SESSION["message"] = "Unable to add person. Fill in all information!";
			header("Location: addDirector.php");
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
	echo '<form action="addDirector.php" method="post">';
	echo '<p>First Name:<input type="text" name="Director_FName">';
	echo '<p>Last Name:<input type="text" name="Director_LName">';
	echo '<p>Birthdate (YYYY, MM, DD):<input type="text" name="Director_BDate">';

	echo '<input type="submit" name="submit" class="button tiny round" value="Add Director" />';
				
	}
		
	echo "</label>";
	echo "</div>";
	echo '</form>';
?>


<?php new_footer("Doron Reinsager", $mysqli); ?>