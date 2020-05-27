<html>
<body>
<?php 
session_start();
include('connection.php');
if(isset($_SESSION['dept'])){
		$query="SELECT * FROM course where department_id = '".$_SESSION['dept']."'";
$res=mysqli_query($conn,$query);}
		else {
	echo "Choose your department first";
		}
		?>
		 
	 <table border='1'>
        <tr>
<th>Course Name</th>
<th>Instructor Name</th>
</tr>
<?php
		while($row = $res->fetch_assoc()):?>
			<tr> <td> <?php echo $row['course_name'] ; ?></td>
			 <td> <?php echo $row['instructor_name'] ; ?></td>
			
		

	<?php endwhile; ?>
 </table>
</body> 
  
</html>

<html>
<!--</table>
</td>
</tr>
</table>-->
<br/>
<a href="departments.php"> Departments Page</a><br>
<a href="logout.php"> Logout </a>
</body>
</html>
   
?>