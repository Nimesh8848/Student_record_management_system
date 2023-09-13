<?php
include("navbar.php");
include 'connect.php';

$conn = mysqli_connect('localhost','root','','srms');
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    

    <title></title>
    
  </head>
  <body style="background:#4070f4;">
  
 
  <h3 style="text-align:center;align-items:center;color:white;">Student list</h3>
  <table class="table table-success table-striped">
    
  <tr >
      <th>Id</th>
      <th>Rollno</th>
      <th>Name</th>
      <th>Gender</th>
      <th>Birth</th>
      <th>Number</th>
      <th>Faculty</th>
      <th>Email</th>
      <th>Remarks</th>
      <th>Action</th>
    </tr>

    <?php  
      if(isset($_GET['facultyid'])){
          $faculty = $_GET['facultyid'];
          $sql = "select * from students where faculty = '{$faculty}'";
      }else{
        $sql = "select * from students";}

        $run = mysqli_query($con,$sql);
        $count = mysqli_num_rows($run);
        if($count>0){
            while($row = mysqli_fetch_assoc($run)){

        ?>
<?php
        $id=$row['id'];
        $rollno=$row['rollno'];
        $name=$row['name'];
        $gender=$row['gender'];
        $birth=$row['birth'];
        $number=$row['number'];
        $faculty=$row['faculty'];
        $email=$row['email'];
      
       $remark=$row['remark'];
        echo '<tr>
      
        <th scope="row">' .$id.'</th>
        <td>' .$rollno.'</td>
        <td>' .$name.'</td>
        <td>' .$gender.'</td>
        <td>' .$birth.'</td>
        <td>' .$number.'</td>
        <td>' .$faculty.'</td>
        <td>' .$email.'</td>
        <td>' .$remark.'</td>

         <td> 
         <button type="button" class="btn btn-primary btn-large" style="font-size:10px;"  > <a href="update.php?updateid='.$id.'" class="text-light" style="text-decoration:none;">Update</a></button>
         <button type="button" class="btn btn-danger btn-large" style="font-size:10px;"  > <a href="delete.php?deleteid='.$id.'" class="text-light" style="text-decoration:none; onclick="return confirm("delete this record?");" >Delete</a></button>
        
         
         </td>  
         </tr>';
      }
    }

        
    
    
    ?>
  </tbody>
  </tbody>
</table>
</body>
</html>