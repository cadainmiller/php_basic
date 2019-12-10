<?php
    //config.php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '');
   define('DB_DATABASE', 'linkupmingle');
   $link = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

   // Check connection
   if($link === false){
      die("ERROR: Could not connect. " . mysqli_connect_error());
   }
?>



<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

include('includes\accountinfo.php');

?>

<?php
//Adding Config
require_once "includes\config.php";

?>

<?php
    //Update To Sql Database 
    $status = "";
    if(isset($_POST['new']) && $_POST['new']==1)
    {
    $id=$_REQUEST['id'];
    $job_title =$_REQUEST['job_title'];
    $date_due =$_REQUEST['date_due'];

    $update="update job set job_title='".$job_title."', date_due='".$date_due."' WHERE job_id='".$id."'";
    mysqli_query($link, $update) or die(mysqli_error());
    
    //Update Message
    $status = "Job Updated Successfully. </br></br>
    <a href='my_jobs.php'>View My jobs</a>";
    echo '<p style="color:#FF0000;">'.$status.'</p>';

    }else { 

    }


     
?>

<!DOCTYPE html>
<html>
<head>
	<title>CRUD: CReate, Update, Delete PHP MySQL</title>
</head>
<body>
	<form method="post" action="server.php" >
		<div class="input-group">
			<label>Name</label>
			<input type="text" name="name" value="">
		</div>
		<div class="input-group">
			<label>Address</label>
			<input type="text" name="address" value="">
		</div>
		<div class="input-group">
			<button class="btn" type="submit" name="save" >Save</button>
		</div>
	</form>
</body>
</html>


<?php 

	// initialize variables
	$name = "";
	$address = "";
	$id = 0;
	$update = false;

	if (isset($_POST['save'])) {
		$name = $_POST['name'];
		$address = $_POST['address'];

		mysqli_query($db, "INSERT INTO info (name, address) VALUES ('$name', '$address')"); 
		$_SESSION['message'] = "Address saved"; 
		header('location: index.php');
	}

?>


<?php 
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM info WHERE id=$id");

		if (count($record) == 1 ) {
			$n = mysqli_fetch_array($record);
			$name = $n['name'];
			$address = $n['address'];
		}
    }
    
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $address = $_POST['address'];
    
        mysqli_query($db, "UPDATE info SET name='$name', address='$address' WHERE id=$id");
        $_SESSION['message'] = "Address updated!"; 
        header('location: index.php');
    }


    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        mysqli_query($db, "DELETE FROM info WHERE id=$id");
        $_SESSION['message'] = "Address deleted!"; 
        header('location: index.php');
    } 
?>









CREATE TABLE IF NOT EXISTS `new_record` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `trn_date` datetime NOT NULL,
 `name` varchar(50) NOT NULL,
 `age`int(11) NOT NULL,
 `submittedby` varchar(50) NOT NULL,
 PRIMARY KEY (`id`)
 );