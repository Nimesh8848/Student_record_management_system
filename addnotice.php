<?php
include("navbar.php");
include("connect.php");
$conn = mysqli_connect('localhost','root','','srms');

if(isset($_POST['Submit'])){
  $noticedate=$_POST['noticedate'];
  $noticetitle=$_POST['noticetitle'];
  $notice_1 =$_POST['notice_1'];


//  $sql="insert into `notice`( `noticeno`,`notice_1`,`faculty`) VALUES(`$noticeno` , `$notice_1`,`$faculty` )";
 $sql="insert into notice(noticedate,noticetitle,notice_1) VALUES('$noticedate','$noticetitle', '$notice_1')";
 $result=mysqli_query($conn,$sql);
 if($result){
   header('location: noticemanage.php');
 }else{
  die(mysqli_error($con));
  }
}

?>
<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="add1.css">
    <!--<link rel="stylesheet" href="add.css">-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
   </head>
<body>

<div class="wrapper">
    <h2>Add notice</h2>

    <form method="POST">
    <div class="input-box">
        <input type="date" placeholder="Enter Notice date" name="noticedate" >
      </div>
    <div class="input-box">
        <input type="text" placeholder="Enter notice title" name=" noticetitle" required>
      </div>
       
      <div class="input-box">
        <textarea rows="2" cols="43" placeholder="Enter  Notice" name="notice_1" required></textarea>
      </div>
     
      

      <div class="input-box button">
        <input type="Submit" name="Submit" value="Add" onClick="show_alert()">


      
    </form>
  </div>
  <script>
  function show_alert(){
    alert("Notice Added Successfully");
  }

  </script>
    
  
</body>
</html>