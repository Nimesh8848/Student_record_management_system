<?php
session_start();

$host="localhost";
$user="root";
$password="";
$db="srms";

$data=mysqli_connect($host,$user,$password,$db);

if($data===false)
{
	die("connection error");
}


if($_SERVER["REQUEST_METHOD"]=="POST")
{
	$username=$_POST["username"];
	$password=md5($_POST["password"]);
    
	

	$sql="select * from admin where username='".$username."' AND password='".$password."' ";

	$result=mysqli_query($data,$sql);

	$row=mysqli_fetch_array($result);

	if($row["usertype"]=="user")
	{	
        $_SESSION["role"]= 'user';
		$_SESSION["username"]=$username;

		header("location: student/student_login.php");
	}

	elseif($row["usertype"]=="admin")
	{
		$_SESSION["role"]= 'admin';

		$_SESSION["username"]=$username;
		
		header("location: index.php");
	}

	else{
		header("Location: admin_login.php?error=Incorect User name or password");
		        exit();
			}
			
			


}



?>









<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
</head>
<body>


<center>

	
	
<form  name="myform" action="" method="post" onsubmit="return validateform()">
		<h2> <bold> Login</bold></h2>
		<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
		
	<input type="text" name="username" class="username" placeholder="Enter your email" auto-complete="off">

	
	<input type="password" name="password" class="password" placeholder="Enter your password" >
	
			<input type="submit" name="submit" value="Login" class="send-btn">
		</form>


	<br><br>

</center>

<script>
    function validateform(){
        var name= document.myform.username.value;
        var password= document.myform.password.value;
        if(name==null || name==""){
            alert("Name cant be blanked");
            return false;
    
        }else if(password.length<4){
            alert("password must be atleast 4  characters long");
            return false;
        }

    }
</script>


</body>
</html>


