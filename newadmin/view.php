<!DOCTYPE html>
<html>
<head>
	<title>Canteen Management system</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js">
    $(document).ready(function() {
    $('select').material_select();
  });
  </script>
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('.input-field input[type="search"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("searchtest.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".input-field").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});
</script>
	<style>
		.highlight{
			width:75%;
			height:55%;
			position: absolute;
			top:30%;
			left:20%;
		}
		.logo{
			width:4.5%;
			height:4.5%;
		}
    .searchbox{
      width:30%;
      height:20%;
      left:20%;
      position: absolute;
    }
    #slabel
    {
      left:-5%;
      position: absolute;
    }

</style>
<script type="text/javascript">
	/*function myFunction()
	{
		 
		 var myVariable = <?php //echo(json_encode($demo)); ?>;
		 document.getElementById(myVariable).innerHTML = "Hello World";
		 console.log(myVariable);

	}*/
	function Deleteqry(id)
{ 
  if(confirm("Are you sure you want to delete this row?")==true)
           window.location="delete.php?del="+id;
    return false;
}
function Updateqry(id)
{ 
  /*if(confirm("Are you sure you want to Update this row?")==true)
           window.location="Update.php?update="+id;
    return false;*/
    window.location="Update.php?update="+id;
}
	
</script>
</head>
<body>
	<nav>
    <div class="nav-wrapper">
      <a href="#!" class="brand-logo center" style="text-decoration: none">Canteen Management System</a>
      <ul class="left hide-on-med-and-down">
        <li><a href="add.php" style="text-decoration:none; color:inherit;">Add Staff</a></li>
        <li class="active"><a href="view.php" style="text-decoration:none; color:inherit;">Manage Staff</a></li>
        <li><a href="view2.php" style="text-decoration:none; color:inherit;">Manage Users</a></li>
        <li><a href="adminpanel.php" style="text-decoration:none; color:inherit;">Home</a></li>
      </ul>
    </div>
  </nav>
  <div class="searchbox">
  <form action="search.php" method="POST">
        <div class="input-field">
          <input id="search" type="search" name="searchname" list="suggestions" required>
          <label class="label-icon" for="search" id="slabel"><i class="material-icons">search</i></label>
          <i class="material-icons">close</i>
          <div class="result"></div>
        </div>
      </form>
  </div>    
</body>
</html>
<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "canteen";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "SELECT * FROM staff_login";
if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
         echo "<table class='highlight'>";
        echo "<thead ";
            echo "<tr>";
                echo "<th>ID</th>";
                echo "<th >FIRST NAME</th>";
                
                echo "<th>LAST NAME</th>";
                echo "<th>EMAIL</th>";
                echo "<th>USER NAME</th>";
                echo "<th>UPDATE</th>";
                echo "<th>DELETE</th>";
            echo "</tr>";
        echo "<thead/>";    
        $count = 0;
        while($row = mysqli_fetch_array($result)){
        	
            echo "<tr>";
                echo "<td >" . $row['id'] . "</td>";
                $pid = $row['id'];
                $count = $count+1; 
                $demo = 'demo' . $count;                
                echo "<td id='$demo'>" . $row['firstname'] . "</td>";                
                echo "<td> " . $row['lastname'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                  echo "<td><a class='btn btn-floating btn-large cyan pulse' onclick='Updateqry($pid);'><i class='material-icons'>edit</i></a></td>";
                 echo "<td> <a href='#' onclick='Deleteqry($pid);'><i class='material-icons'>delete</i></a></td>";
            echo "</tr>";
         }
        echo "</table>";
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}
?>