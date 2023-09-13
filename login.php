<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<link rel="stylesheet" type="text/css" href="bootstrap-4.4.1/css/bootstrap.min.css">

  	<script type="text/javascript" src="bootstrap-4.4.1/js/juqery_latest.js"></script>
  	<script type="text/javascript" src="bootstrap-4.4.1/js/bootstrap.min.js"></script>
</head>
<style>

body {
  margin: 0;
  padding: 0;
  background: linear-gradient(120deg, #2980b9, #8e44ad);
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100vh;
}
h3{
	font-size: 50px;
  line-height: 1.2;
  color:white;
}
input{
	font-size: 18px;
  text-decoration: none;
  color: black;
  border: #fffffe 1px solid;
  padding: 10px 30px;
  border-radius: 10px;
  margin-top: 20px;
  grid-gap:20px;

}
input:hover{
	background: #ff37b2;
  transition: all 0.3s ease;
}


</style>
<body>
	<center><br><br>
	<h3>Student Record Management System</h3><br>
	<form action="" method="POST">
		<input type="submit" name="admin_login" value="Admin Login" required>
		<input type="submit" name="student_login" value="Student Login" required>
	</form>
	<?php
		if(isset($_POST['admin_login'])){
			header("Location: admin/admin_login.php");
		}
		if(isset($_POST['student_login'])){
			header("Location: student/student_login.php");
		}
	?>
	</center>
</body>
</html>