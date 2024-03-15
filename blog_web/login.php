<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   
   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
   $select_user->execute([$email, $pass]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if ($select_user->rowCount() > 0) {
      $_SESSION['user_id'] = $row['id'];
      header('location:home.php');
   }else{
      $message[] = 'incorrect password or username';
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
                  <h3>login now</h3>
               
                  <label>your email <sup>*</sup></label><br>
                  <input type="email" name="email" required placeholder="enter your email" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">

                  <label>your password <sup>*</sup></label><br>
                  <input type="password" name="pass" required placeholder="enter your password" class="box" maxlength="50" oninput="this.value = this.value.replace(/\s/g, '')">

                  
                  <input type="submit" value="login now" name="submit" class="btn">
                  <p>do not have an account? <a href="register.php">register now</a></p>
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