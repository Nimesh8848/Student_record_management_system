<?php

session_start();
$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection,"srms");

if(isset($_GET['deleteid'])){
	$id = $_GET['deleteid'];

	$sql= "delete from `notice` where id=$id ";
    $result= mysqli_query($connection,$sql);
    if($result){
    	header('location:noticemanage.php');
        echo"<script type='text/javascript'>alert('student Deleted')</script>";
        }else{
    	die(mysqli_error($connection));
    }
}
?>