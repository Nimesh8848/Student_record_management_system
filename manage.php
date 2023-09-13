<?php
session_start();
include("navbar.php");
include 'connect.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!---js----->
  
    

    <title></title>
    
  </head>
  <body style="background:#4070f4;">
  
  <button type="button" class="btn btn-light my-5 btn-lg" style="margin-left:10%;"  > <a href="addstudent.php" class="text-dark" style="text-decoration:none;">Add</a></button>
  <h3 style="text-align:center;align-items:center;color:white;">Student list</h3>
  <table class="table table-success table-striped" >
  <thead>
  <tr >
      <th>Id</th>
      <th>Rollno</th>
      <th>Name</th>
      <th>Guardian Name</th>
      <th>Gender</th>
      <th>Birth</th>
      <th>Number</th>
      <th>Faculty</th>
      <th>Assignment</th>
      <th>Attendance</th>
      <th>Email</th>
      <th>Remarks</th>
      <th>SEE Certificate</th>
      <th>+2 Certificate</th>

      <th>Action</th>
    </tr>
  </thead>
  <tbody>
  <?php
    // $sql = "Select * from `students`";
    $sql = "SELECT * FROM `students` JOIN `faculty` ON `students`.`faculty`=`faculty`.`facultyid`";
    $result = mysqli_query($con,$sql);
    if($result){
      while($row = mysqli_fetch_assoc($result))
      {
        $id=$row['id'];
        $rollno=$row['rollno'];
        $name=$row['name'];
        $gname=$row['gname'];
        $gender=$row['gender'];
        $birth=$row['birth'];
        $number=$row['number'];
        $faculty=$row['fname'];
        $assignment=$row['assignment'];
        $attendance=$row['attendance'];
        $email=$row['email'];
      
        $remark=$row['remark'];
        $pdf1=$row['pdf1'];
        $pdf=$row['pdf'];
        echo '<tr>
      
        <th scope="row">' .$id.'</th>
        <td>' .$rollno.'</td>
        <td>' .$name.'</td>
        <td>' .$gname.'</td>
        <td>' .$gender.'</td>
        <td>' .$birth.'</td>
        <td>' .$number.'</td>
        <td>' .$faculty.'</td>
        <td>' .$assignment.'</td>
        <td>' .$attendance.'</td>
        <td>' .$email.'</td>
        
        <td>' .$remark.'</td>
        <td><a href="/SMS/admin/uploads/'.$pdf1.'" target="_blank">'.$pdf1.'</a></td>
        <td><a href="/SMS/admin/uploads/'.$pdf.'" target="_blank">'.$pdf.'</a></td>

         <td> 
         <button type="button" class="btn btn-primary btn-large" style="font-size:10px;"   > <a href="update.php?updateid='.$id.'" class="text-light" style="text-decoration:none;">Update</a></button>
         <button type="button" class="btn btn-danger btn-large" style="font-size:10px;" onclick=" return myDelete()" > <a href=" delete.php?deleteid='.$id.'"  class="text-light" style="text-decoration:none; onclick="return confirm("delete this record?");" >Delete</a></button>
         
        
         
         </td>  
         </tr>';
      }
    }
    
    ?>
  </tbody>
  </tbody>
</table>
<script>

function myDelete() {
  confirm("Do You want to delete it?");
}
</script>

</body>
</html>