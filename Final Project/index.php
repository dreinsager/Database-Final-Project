<?php 
	require_once("main_function.php");
	new_header("Welcome to Doron's Database"); 
	/////////////   CONNECT TO YOUR DATABASE    ////////////////////
	require_once('/home/dreinsager/DB.php');
	
	$mysqli = new mysqli(DBHOST, USERNAME, PASSWORD, DBNAME);
	
	if ($mysqli->connect_errno) {
		die("Could not connect to server!<br />");
	}
	else {
		echo "Successful Connection";
	}

	
	//****************  Add Query
	//  Query people to select PersonID, FirstName, and LastName, sorting in ascending order by LastName
	
	$query = "SELECT Movie_MPAARating, Movie_Title, Actor_ID, Actor_FName, Actor_LName, Director_ID, Director_FName, Director_LName, Actor.Actor_ID, Director.Director_ID ";
	$query .= "FROM Movies ";
	$query .= "RIGHT OUTER JOIN Actor ON Movies.Actor_Actor_ID = Actor.Actor_ID ";
	$query .= "LEFT OUTER JOIN Director ON Movies.Director_Director_ID = Director.Director_ID ";



	//  Execute query
				
	$result = $mysqli->query($query);
	

	if ($result && $result->num_rows > 0) {
		echo "<div class='row'>";
		echo "<center>";
		echo "<h2>The Stars</h2>";
		echo "<table>";
		echo "<tr><th>Actor/Actress</th><th>Director</th><th>Movie Title</th><th>MPAA Rating</th><th></th><th></th></tr>";

		while ($row = $result->fetch_assoc())  {
			echo "<tr>";
			//Output FirstName and LastName
			
		echo "<td style='text-align:center'>"." ".$row['Actor_FName']." ".$row['Actor_LName']."</td>";
		echo "<td style='text-align:center'>"." ".$row['Director_FName']." ".$row['Director_LName']."</td>";
		echo "<td style='text-align:center'>"." ".$row['Movie_Title']."</td>";
		echo "<td style='text-align:center'>"." ".$row['Movie_MPAARating']."</td>";


	




			//Create an Edit and Delete link
			//Edit should direct to editPeople.php, sending PersonID in URL
			//Delete should direct to deletePeople.php, sending PersonID in URL - include onclick to confirm delete

		echo "<td>&nbsp;<a href='Edit.php?id=".urlencode($row['Actor_ID'])."'>Edit Actor</a>&nbsp&nbsp</td>";
		echo "<td>&nbsp;<a href='Edit2.php?id=".urlencode($row['Director_ID'])."'>Edit Director</a>&nbsp&nbsp</td>";


		echo "<td>&nbsp;<a href='Delete.php?id=".urlencode($row['Actor_ID'])." ' onclick='return confirm(`Are you sure?`);'>Delete</a>&nbsp&nbsp</td>";
			
			echo "</tr>";
		}
		echo "</table>";
		echo "<br /><br /><a href='addActor.php'>Add an Actor</a>&nbsp;";


		echo "</center>";
		echo "</div>";
	}
/************       Uncomment Once Code Completed For This Section  ********************/
?>

<?php  new_footer("Doron Reinsager", $mysqli); ?>