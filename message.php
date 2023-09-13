<?php
include("navbar.php");

$conn = mysqli_connect('localhost','root','','srms') or die('connection failed');


session_start();




?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>dashboard</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
 :root{
   --main-color:#4834d4;
   --red:#e74c3c;
   --orange:#f39c12;
   --black:#34495e;
   --white:#fff;
   --light-bg:#f5f5f5;
   --light-color:#999;
   --border:.2rem solid var(--black);
   --box-shadow:0 .5rem 1rem rgba(0,0,0,.1);
} 
.messages .box-container{
   display: grid;
   grid-template-columns: repeat(auto-fit, 33rem);
   gap:1.5rem;
   justify-content: center;
   align-items: flex-start;
   margin-left:1rem;
   margin-right:1rem;
  

}
.title{
align-items:center;
text-align:center;
}
.messages .box-container .box{
   background-color: var(--white);
   border-radius: .5rem;
   box-shadow: var(--box-shadow);
   border:var(--border);
   padding:2rem;
   padding-top: 1rem;
}

.messages .box-container .box p{
   padding: .5rem 0;
   font-size: 1.8rem;
   color:var(--black);
}

.messages .box-container .box p span{
   color:var(--main-color);
}
</style>


</head>
<body>
   
<?php @include 'admin_header.php'; ?>

<section class="messages">

   <h1 class="title">Feedback</h1>

   <div class="box-container">

      <?php
       $select_message = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
       if(mysqli_num_rows($select_message) > 0){
          while($fetch_message = mysqli_fetch_assoc($select_message)){
      ?>
      <div class="box">
      <p>rollno : <span><?php echo $fetch_message['rollno']; ?></span> </p>
         <p>name : <span><?php echo $fetch_message['name']; ?></span> </p>
         <!--<p>number : <span><?php echo $fetch_message['number']; ?></span> </p>-->
         <p>email : <span><?php echo $fetch_message['email']; ?></span> </p>
         <p>message : <span><?php echo $fetch_message['message']; ?></span> </p>
         <a href="messagedelete.php?delete=<?php echo $fetch_message['id']; ?>" style="text-decoration :none;color:white;background:red;"  onclick="return confirm('delete this message?');" class="delete-btn">delete</a>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">you have no messages!</p>';
      }
      ?>
   </div>

</section>













<script src="js/admin_script.js"></script>

</body>
</html>