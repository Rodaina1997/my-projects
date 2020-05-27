<?php
session_start();
include('connection.php');

if(isset($_POST['Submit1'])){
	
if(!empty($_POST['username']) && !empty($_POST['password'])){

	$username=$_POST['username'];
    $password=$_POST['password'];
	$query="SELECT * FROM user where username='$username' and password='$password'";
    $res=mysqli_query($conn,$query);
    $rows = mysqli_num_rows($res);
	
	$rowx = $res->fetch_assoc();
	$mydept = $rowx['department_id'];
	if($mydept != 0){
		$_SESSION['dept'] = $mydept;
		}
 if($rows==1){
 	header('location:departments.php');
 	$_SESSION['username']=$username;
 }
else{
	echo '<script type="text/javascript">'; 
	echo 'alert("INVALID USERNAME OR PASSWORD");'; 
	echo 'window.location.href = "registrationform.html";';
	echo '</script>';
}
}
else{
	echo '<script type="text/javascript">'; 
	echo 'alert("YOU MUST ENTER USERNAME AND PASSWORD");'; 
	echo 'window.location.href = "registrationform.html";';
	echo '</script>';
}

}

else if(isset($_POST['Submit2'])){
 $username = filter_input(INPUT_POST, 'username');
 $email = filter_input(INPUT_POST, 'email');
 $password = filter_input(INPUT_POST, 'password');
 if (!empty($username)){
if (!empty($password)){

 $sql_u = "SELECT * FROM user WHERE username='$username'";
 $res_u = mysqli_query($conn, $sql_u);

 if (mysqli_num_rows($res_u) > 0) {
	 echo '<script type="text/javascript">'; 
	 echo 'alert("Sorry... username is already taken");'; 
	 echo 'window.location.href = "registrationform.html";';
	 echo '</script>';	
  	}
else{
$sql = "INSERT INTO user (username,email, password)
values ('$username','$email','$password')";

if ($conn->query($sql)){
header('location:departments.php');
 	$_SESSION['username']=$username;
}
else echo $conn->error;
}
}
}
$conn->close();
}
?>