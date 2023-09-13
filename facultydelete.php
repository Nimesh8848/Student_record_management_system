<?php
include 'connect.php';
if(isset($_GET['deleteid'])){
	$facultyid = $_GET['deleteid'];

	$sql= "delete from `faculty` where facultyid=$facultyid ";
    $result= mysqli_query($con,$sql);
    if($result){
    	header('location:Managefaculty.php');
        echo"<script type='text/javascript'>alert('Faculty Deleted')</script>";
        }else{
    	die(mysqli_error($con));
    }
}
?>