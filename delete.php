<?php

session_start();
$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection,"srms");

if(isset($_GET['deleteid'])){
	$id = $_GET['deleteid'];

	$sql= "delete from `students` where id=$id ";
    $result= mysqli_query($connection,$sql);
    if($result){
    	header('location:manage.php');
        
        }else{
    	die(mysqli_error($connection));
    }
}
?>