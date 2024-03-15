<?php

   include 'components/connect.php';

   session_start();

   if(isset($_SESSION['user_id'])){
      $user_id = $_SESSION['user_id'];
   }else{
      $user_id = '';
   };
   include 'components/like_post.php';


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
            <section class="authors">
               <h1 class="heading">authors</h1>
               <div class="box-container">
                  <?php 
                     $select_authors = $conn->prepare("SELECT * FROM `admin`");
                     $select_authors->execute();
                     if ($select_authors->rowCount()>0) {
                        while($fetch_authors = $select_authors->fetch(PDO::FETCH_ASSOC)){
                           $count_admin_posts = $conn->prepare("SELECT * FROM `posts` WHERE admin_id=? AND status =?");
                           $count_admin_posts->execute([$fetch_authors['id'], 'active']);
                           $total_admin_posts = $count_admin_posts->rowCount();

                           $count_admin_likes = $conn->prepare("SELECT * FROM `likes` WHERE admin_id=?");
                           $count_admin_likes->execute([$fetch_authors['id']]);
                           $total_admin_likes = $count_admin_likes->rowCount();

                           $count_admin_comments = $conn->prepare("SELECT * FROM `comments` WHERE admin_id=?");
                           $count_admin_comments->execute([$fetch_authors['id']]);
                           $total_admin_comments = $count_admin_comments->rowCount();
                  ?>
                  <div class="box">
                     <p>author : <span><?= $fetch_authors['name']; ?></span></p>
                     <p>total posts : <span><?= $total_admin_posts; ?></span></p>
                     <p>total likes: <span><?= $total_admin_likes ?></span></p>
                     <p>total comments: <span><?= $total_admin_comments; ?></span></p>
                     <a href="author_post.php?authors=<?= $fetch_authors['name']; ?>" class="btn">view posts</a>
                  </div>
                  <?php 
                        }
                     }else{
                        echo '<p class= "empty">no posts added yet!</p>';
                     }
                  ?>
               </div>

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