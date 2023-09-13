<?php
include("navbar.php");
include("connect.php");

if(isset($_POST['Submit'])){
  $facultyid=$_POST['facultyid'];
  $fname=$_POST['fname'];
 

 $sql="insert into `faculty`( `facultyid`,`fname`) VALUES ('$facultyid' ,' $fname' )";
 $result=mysqli_query($con,$sql);
 if($result){
   header('location: Managefaculty.php');
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
    <h2>Add Faculty</h2>

    <form method="POST">
    
     
      
      <div class="input-box">
        <input type="text" placeholder="Enter faculty name"name="fname" required>
      </div>
      

      <div class="input-box button">
        <input type="Submit" name="Submit" value="Add" onClick="show_alert()">


      
    </form>
  </div>

  <h3 style="text-align:center;align-items:center;color:white;">Student list</h3>
  <table class="table table-success table-striped" >
  <thead>
  <tr >
      
      <th>Facultyname</th>
      <th>Action</th>
      
    </tr>
  </thead>
  <tbody>
  <?php
    $sql = "Select * from `faculty`";
    $result = mysqli_query($con,$sql);
    if($result){
      while($row = mysqli_fetch_assoc($result))
      {
        $facultyid=$row['facultyid'];
       
        $name=$row['fname'];
       
       
        echo '<tr>
      
      
        <td>' .$name.'</td>
        
       

         <td> 

         <button type="button" class="btn btn-danger btn-large" style="font-size:10px;"  retun onclick="myDelete()"  > <a href=" facultydelete.php?deleteid='.$facultyid.'"  class="text-light" style="text-decoration:none; onclick="return confirm("delete this record?");" >Delete</a></button>
        
         
         </td>  
         </tr>';
      }
    }
    
    ?>
  </tbody>
  </tbody>
</table>



  <script>
  function show_alert(){
    alert("Faculty Added Successfully");
  }


function myDelete() {
  confirm("Do You want to delete it?");
}


  </script>
    
  
</body>
</html