<?php
include("navbar.php");
include("connect.php");
$conn = mysqli_connect('localhost','root','','srms');

if(isset($_POST['Submit'])){
  $rollno=$_POST['rollno'];
  $name=$_POST['name'];
  $gname=$_POST['gname'];
  $gender=$_POST['gender'];
  $birth=$_POST['birth'];
  $number=$_POST['number'];
  $faculty=$_POST['faculty'];
  $assignment=$_POST['assignment'];
  $attendance=$_POST['attendance'];
  $email=$_POST['email'];
  $password=$_POST['password'];
  $remark=$_POST['remark'];
 
  $pdf1=$_FILES['pdf1']['name'];
  $pdf1_type=$_FILES['pdf1']['type'];
  $pdf1_size=$_FILES['pdf1']['size'];
  $pdf1_tem_loc=$_FILES['pdf1']['tmp1_name'];
  $pdf1_store="uploads/".$pdf1;

  move_uploaded_file($pdf1_tem_loc,$pdf1_store);

  if (move_uploaded_file($pdf1_tem_loc,$pdf1_store)) {
    echo "The file ". htmlspecialchars( basename( $pdf1)). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }



  $pdf=$_FILES['pdf']['name'];
          $pdf_type=$_FILES['pdf']['type'];
          $pdf_size=$_FILES['pdf']['size'];
          $pdf_tem_loc=$_FILES['pdf']['tmp_name'];
          $pdf_store="uploads/".$pdf;

          move_uploaded_file($pdf_tem_loc,$pdf_store);

          if (move_uploaded_file($pdf_tem_loc,$pdf_store)) {
            echo "The file ". htmlspecialchars( basename( $pdf)). " has been uploaded.";
          } else {
            echo "Sorry, there was an error uploading your file.";
          }



  $sql="insert into `students`( `rollno`,`name`,`gname`,  `gender`, `birth`, `number`, `faculty`,`assignment`,`attendance`,`email`, `password`,`remark`,`pdf1`,`pdf`) VALUES ('$rollno','$name','$gname','$gender','$birth','$number','$faculty','$assignment','$attendance','$email','$password','$remark','$pdf1','$pdf')";
 $result=mysqli_query($con,$sql);
 if($result){
   header('location:manage.php');
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
    <h2>Add student</h2>

    <form method="POST" enctype="multipart/form-data">
    <div class="input-box">
    
       <input type="text" placeholder="Enter  roll no" name="rollno" >
       
      </div>
       
      <div class="input-box">
      <input type="text" placeholder="Enter  name" name="name" >
       
      </div>
      <div class="input-box">
      <input type="text" placeholder="Enter   Guardian name" name="gname" >
      </div>
      <div class="input-box">
      <select  type ="text" name="gender"  style="width:100%;height:50px;box-shadow: 0 5px 10px rgba(0,0,0,0.2); border: 1.5px solid #C7BEBE;border-radius:5px;color:#707070;">

        <option value="selected disabled">--Select gender--</option>
  <option value="Male">Male</option>
  <option value="Female">Female</option>

</select>
      </div>
    
      <div class="input-box">
        <input type="date" placeholder="Enter  DOB" name="birth" >
      </div>
      <div class="input-box">
        <input type="text" placeholder="Enter  phone no" name="number" >
      </div>
      <div class="input-box">
     
      <select  type ="text" name="faculty"  style="width:100%;height:50px;box-shadow: 0 5px 10px rgba(0,0,0,0.2); border: 1.5px solid #C7BEBE;border-radius:5px;color:#707070;">
          
        <option value="selected disabled">Select Faculty</option>
        <?php
       $select_faculty = mysqli_query($conn, "SELECT * FROM `faculty` ") or die('query failed');
       if(mysqli_num_rows($select_faculty) > 0){
       while($fetch_faculty = mysqli_fetch_assoc($select_faculty)){
         // Extracting data from a database 
      ?>
         <option value="<?php echo $fetch_faculty['facultyid']; ?>"><?php echo $fetch_faculty['fname']; ?></option>

         <?php
        }
        }else{
        echo '<p class="empty">no products added yet!</p>';
       }
      ?>

       
   
</optgroup>
</select>
      </div>
      <div class="input-box">
      <select  type ="text" name="assignment"  style="width:100%;height:50px;box-shadow: 0 5px 10px rgba(0,0,0,0.2); border: 1.5px solid #C7BEBE;border-radius:5px;color:#707070;">

      <option value="selected disabled">--Assignments--</option>
  <option value="Completed">Completed</option>
  <option value="Not Completed">Not completed</option>

</select>
      </div>

      <div class="input-box">
    
      <select  type ="text" name="attendance"  style="width:100%;height:50px;box-shadow: 0 5px 10px rgba(0,0,0,0.2); border: 1.5px solid #C7BEBE;border-radius:5px;color:#707070;">

      <option value="selected disabled">--Attendance--</option>    
  <option value="100%">100%</option>
  <option value="90%">90%</option>
  <option value="80%">80%</option>
  <option value="70%">70%</option>
  <option value="60%">60%</option>
  <option value="50%">50%</option>
  
   

</select>
      </div>

      <div class="input-box">
        <input type="email" placeholder="Create  email" name="email" >
      </div>
      <div class="input-box">
        <input type="password" placeholder="Create password"  name ="password">
        
      </div>
      <div class="input-box">
      <input type="text" placeholder="Remarks"  name ="remark"required>
      </div>
      <div class="input-box" style="margin-top:1.5rem;margin-bottom:3rem;">
      <label>SEE certificate</label>
      <input type="file" name="pdf1" accept="image/jpg, image/jpeg, image/png" class="box"  placeholder="SEE certificate"required>
      </div>
      <div class="input-box" style="margin-top:3rem;margin-bottom:3rem;">
        <label>+2 certificate</label>
      <input type="file" name="pdf" accept="image/jpg, image/jpeg, image/png" class="box"  required>
      </div>


      <div class="input-box button">
        <input type="Submit" name="Submit" value="Add" onClick="show_alert()">
      </div>

      
    </form>
  </div>
  <script>
  function show_alert(){
    alert("Student Added Successfully");
  }

  </script>
    
  
</body>
</html>
