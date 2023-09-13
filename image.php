<?php
include 'admin_header.php'; 



if(isset($_POST['add_product'])){
//  sqloperator _ store function
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $details = mysqli_real_escape_string($conn, $_POST['details']);
   $details_1 = mysqli_real_escape_string($conn, $_POST['details_1']);
   $details_2 = mysqli_real_escape_string($conn, $_POST['details_2']);
   $details_3 = mysqli_real_escape_string($conn, $_POST['details_3']);
   $category = $_POST['category'];
   $price = $_POST['price'];
   $quantity = $_POST['quantity'];
  
   

   $image = $_FILES['image']['name'];

   $image_size = $_FILES['image']['size'];
   
   $image_tmp_name = $_FILES['image']['tmp_name'];

   $image_folder = '../uploaded_img/'.$image;


  

   $select_product_name = mysqli_query($conn, "SELECT name FROM products WHERE name = '$name'") or die('query failed');

   if(mysqli_num_rows($select_product_name) > 0){
      $message_1[] = 'product name already added';
   }else{
      $add_product_query = mysqli_query($conn, "INSERT INTO `students`(name,details,details_1,details_2,details_3, category, price, quantity,  image ) VALUES('$name', '$details',' $details_1', ' $details_2',' $details_3','$category','$price', '$quantity','$image')") or die('query failed');

      if($add_product_query){
         if($image_size > 2000000 OR $image1_size > 2000000){
            $message_1[] = 'image size is too large';
         }else{
            move_uploaded_file($image_tmp_name, $image_folder);
            move_uploaded_file($image1_tmp_name, $image1_folder);
            $message[] = 'product added successfully!';
         }
      }else{
         $message_1[] = 'product could not be added!';
      }
   }
   header('location:admin_products.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_image_query = mysqli_query($conn, "SELECT image FROM products WHERE id = '$delete_id'") or die('query failed');
   $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
   unlink('uploaded_img/'.$fetch_delete_image['image']);
   $message[] = 'deleted';
   mysqli_query($conn, "DELETE FROM products WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_show_products.php');
}

if(isset($_POST['update_product'])){

   $update_p_id = $_POST['update_p_id'];
   $update_name = $_POST['update_name'];
   $update_price = $_POST['update_price'];

   $update_details = $_POST['details'];
   $update_details_1 = $_POST['details_1'];
   $update_details_2 = $_POST['details_2'];
   $update_details_3 = $_POST['details_3'];
   $update_category = $_POST['category'];

   mysqli_query($conn, "UPDATE products SET name = '$update_name', price = '$update_price', details = '$update_details', details_1 = '$update_details_1' ,details_2 = '$update_details_2',details_3 = '$update_details_3',category = '$update_category' WHERE id = '$update_p_id'") or die('query failed');

   $update_image = $_FILES['update_image']['name'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_folder = '../uploaded_img/'.$update_image;
   $update_old_image = $_POST['update_old_image'];

   if(!empty($update_image)){
      if($update_image_size > 2000000){
         $message[] = 'image file size is too large';
      }else{
         mysqli_query($conn, "UPDATE students SET image = '$update_image' WHERE id = '$update_p_id'") or die('query failed');
         move_uploaded_file($update_image_tmp_name, $update_folder);
         unlink('../uploaded_img/'.$update_old_image);
      }
   }
   
   $update_image1 = $_FILES['update_image1']['name'];
   $update_image1_tmp_name = $_FILES['update_image1']['tmp_name'];
   $update_image1_size = $_FILES['update_image1']['size'];
   $update_folder = '../uploaded_img/'.$update_image1;
   $update_old_image1 = $_POST['update_old_image1'];

   if(!empty($update_image1)){
      if($update_image1_size > 2000000){
         $message[] = 'image file size is too large';
      }else{
         mysqli_query($conn, "UPDATE products SET image = '$update_image1' WHERE id = '$update_p_id'") or die('query failed');
         move_uploaded_file($update_image1_tmp_name, $update_folder);
         unlink('../uploaded_img/'.$update_old_image1);
      }
      header('location:admin_show_products.php');
   }

   // header('location:admin_show_products.php');

}



 ?>

<!-- product CRUD section starts  -->






   <!-- <h1 class="title">shop products</h1> -->
<section class="form-container">
   <form action="" method="post" enctype="multipart/form-data">
      <h3>add product</h3>
      
  
    <div class="flex">
    <div class="inputBox">     
      <input type="text" name="name" class="box" placeholder="enter product name" required>  </div>

    <div class="inputBox">     
    <input type="number" min="0" name="price" class="box" placeholder="enter product price" required>  </div>

    <div class="inputBox">     
    <input type="number" min="0" name="quantity" class="box" placeholder="enter product quantity" required>  </div>
  
    </div> 
    <div class="flex"> 
         <div class="inputBox">
         <select name="category" class="box" > 
            <option value="" selected disabled>select category</option>
            <?php
              $select_category = mysqli_query($conn, "SELECT * FROM category order by id desc") or die('query failed');
               if(mysqli_num_rows($select_category) > 0){
                while($fetch_category = mysqli_fetch_assoc($select_category)){
               // Extracting data from a database 
               ?>
                <option value="<?php echo $fetch_category['name']; ?>"><?php echo $fetch_category['name']; ?></option> 
              
                <?php
                  }
                }else{
                echo '<p class="empty">no product!</p>';
                       }
                ?>
         </select> 
         </div> 
      <div class="flex">
      <div class="inputBox">
     
            <textarea name="details" placeholder="enter product ram" class="box" ></textarea>
         </div>
         <div class="inputBox">
       
            <textarea name="details_1" placeholder="enter product storage " class="box" ></textarea>
         </div>
         <div class="inputBox">
           
            <textarea name="details_2" placeholder="enter product screen size" class="box" ></textarea>
         </div>
         <div class="inputBox">
        
            <textarea name="details_3" placeholder="enter product battery%" class="box" ></textarea>
         </div>
 
      </div>  
 
      <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
       
      
    <input type="submit" value="add product" name="add_product" class="btn" style="background-color: #6157d0;">
   </form>


</section>
<!-- product CRUD section ends -->
<!-- !-- show products  --> -->




</div>

<!-- ........................update             -->
</end>
<section class="form-container1">

   <?php
      if(isset($_GET['update'])){
         $update_id = $_GET['update'];
         $update_query = mysqli_query($conn, "SELECT * FROM products WHERE id = '$update_id'") or die('query failed');
         if(mysqli_num_rows($update_query) > 0){
            while($fetch_update = mysqli_fetch_assoc($update_query)){
   ?>
 <form action="" method="post" enctype="multipart/form-data">
   <h3>update product</h3>
 <img src="../uploaded_img/<?php echo $fetch_update['image']; ?>" height="100" alt="">
   <div class="flex">
      <div class="inputBox">
      <input type="text" name="update_name" value="<?php echo $fetch_update['name']; ?>" class="box" required placeholder="enter product name">
            
      </div>
      <div class="flex">
      <div class="inputBox">
      <input type="number" name="update_quantity" value="<?php echo $fetch_update['quantity']; ?>" min="0" class="box"required placeholder="enter product name">
            
      </div>
      <div class="inputBox">
      <input type="number" name="update_price" value="<?php echo $fetch_update['price']; ?>" class="box" required placeholder="enter product price">        
      </div>
  
      <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">
      <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?> " >
     
      <div class="flex"> 
         <div class="inputBox">
         <select name="category" class="box" > 
            <option value="" selected disabled>select category</option>
            <?php
              $select_category = mysqli_query($conn, "SELECT * FROM category order by id desc") or die('query failed');
               if(mysqli_num_rows($select_category) > 0){
                while($fetch_category = mysqli_fetch_assoc($select_category)){
               // Extracting data from a database 
               ?>
                <option value="<?php echo $fetch_category['name']; ?>"><?php echo $fetch_category['name']; ?></option> 
              
                <?php
                  }
                }else{
                echo '<p class="empty">no product!</p>';
                       }
                ?>
         </select> 
         </div> 
   
    <div class="flex">
      <div class="inputBox">
            <!-- <span>product details (required)</span> -->
            <textarea name="details" placeholder="enter product ram" class="box" ></textarea>
      </div>
         <div class="inputBox">
            <!-- <span>product details (required)</span> -->
            <textarea name="details_1" placeholder="enter product  storage  " class="box" ></textarea>
         </div>
         <div class="inputBox">
            <!-- <span>product details (required)</span> -->
            <textarea name="details_2" placeholder="enter product screen size" class="box" ></textarea>
         </div>
         <div class="inputBox">
            <!-- <span>product details (required)</span> -->
            <textarea name="details_3" placeholder="enter product battery%" class="box" ></textarea>
         </div>
   
    </div>  
 
  
      <input type="file" class="box" name="update_image1" accept="image/jpg, image/jpeg, image/png">
        <!-- <span>     </span>
      <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png"> -->
     
      <input type="submit" value="update" name="update_product" class="btn" style="background-color: #6157d0;">
      <!-- <input type="reset" value="cancel" id="close-update" class="option-btn"> -->
      <a href="admin_products.php" class="delete-btn" onclick="return confirm('cancel?');">cancel</a>

 </form>
   <?php
         }
      }
      }else{
         echo '<script>document.querySelector(".form-container1").style.display = "none";</script>';
      }
   ?>

</section>








<!-- custom admin js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>




$fileExt = explode('.', $fileName );
  $fileActualExt =strtolower(end($fileExt));
  $allowed =array('jpg', 'jpeg', 'png' ,'pdf');
  
  if(in_array($fileActualExt,$allowed)){
    if($fileError ===0){
      if($fileSize<1000000){
        $fileNameNew = uniqid('', true).".".$fileActualExt;
        $fileDestination = 'pdf/'.$fileNameNew;
        move_uploaded_file($fileTmpName,$fileDestination);
      
      }else{
        echo"your file is too big";
      }
      else{
      echo"There was an error uploading your file";
    }
    else{
      echo"you cannot upload file of this type";
    }
  }
  }