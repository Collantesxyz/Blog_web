<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select_user->execute([$email]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $message[] = 'email already exists!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         $insert_user = $conn->prepare("INSERT INTO `users`(name, email, password, profile) VALUES(?,?,?,?)");
         $insert_user->execute([$name, $email, $cpass, $image]);
         move_uploaded_file($image_tmp_name, $image_folder);
         $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
         $select_user->execute([$email, $pass]);
         $row = $select_user->fetch(PDO::FETCH_ASSOC);
         if($select_user->rowCount() > 0){
            $_SESSION['user_id'] = $row['id'];
            header('location:home.php');
         }
      }
   }

}

?>
<style type="text/css">
   <?php include 'user_style.css'; ?>
</style>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <!-- font awesome cdn link  -->
   <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->
<div class="container-fluid">
   <div class="blog">
      <div class="blog-container">
         <div class="blog-section">
         	<?php 
				if (isset($message)) {
					foreach ($message as $message) {
						echo '
								<div class="message">
									<span>'.$message.'</span>
									<i class="bx bx-x" onclick="this.parentElement.remove();"></i>
								</div>
							';
						}
					}
				?>
            <section class="form-container">

	            <form action="" method="post" enctype="multipart/form-data">
	               <h3>register now</h3>
	               <label>your name <sup>*</sup></label><br>
	               <input type="text" name="name" required placeholder="enter your name" class="box" maxlength="50">
	               <label>your email <sup>*</sup></label><br>
	               <input type="email" name="email" required placeholder="enter your email" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
	               <label>your password <sup>*</sup></label><br>
	               <input type="password" name="pass" required placeholder="enter your password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
	               <label>confirm your password <sup>*</sup></label><br>
	               <input type="password" name="cpass" required placeholder="confirm your password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">
	               <label>profile <sup>*</sup></label>
	               <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp">
	               <input type="submit" value="register now" name="submit" class="btn">
	               <p>already have an account? <a href="login.php">login now</a></p>
	            </form>

	         </section>
         </div>
         <?php include 'components/footer.php'; ?>
      </div>
      <!--right section ----->
      <div class="right-section">
         <div class="overlay"></div>
            <div class="detail">
               <div class="right-cube"></div>    
            </div>         
      </div>
      <!--right section ----->
   </div>
</div>
<script type="text/javascript" src="script.js"></script>
</body>
</html>