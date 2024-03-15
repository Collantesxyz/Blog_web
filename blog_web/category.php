<?php

   include 'components/connect.php';

   session_start();

   if(isset($_SESSION['user_id'])){
      $user_id = $_SESSION['user_id'];
   }else{
      $user_id = '';
   };

   if (isset($_GET['category'])) {
      $category = $_GET['category'];
   }else{
      $category = '';
   }
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
            <section class="posts-container">
               <h1 class="heading">post categories</h1>
               <div class="box-container">
                  <?php 
                     $select_posts = $conn->prepare("SELECT * FROM `posts` WHERE category = ? AND status = ?");
                     $select_posts->execute([$category, 'active']);
                     if ($select_posts->rowCount() > 0) {
                        while($fetch_posts = $select_posts->fetch(PDO::FETCH_ASSOC)){
                           $post_id = $fetch_posts['id'];

                           $count_post_comments = $conn->prepare("SELECT * FROM `comments` WHERE post_id = ?");
                           $count_post_comments->execute([$post_id]);
                           $total_post_comments = $count_post_comments->rowCount();

                           $count_post_likes = $conn->prepare("SELECT * FROM `likes` WHERE post_id = ?");
                           $count_post_likes->execute([$post_id]);
                           $total_post_likes = $count_post_likes->rowCount();

                           $confirm_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ? AND post_id = ?");
                           $confirm_likes->execute([$user_id, $post_id]);
                        
                  ?>
                  <form action="" method="post" class="box">
                     <input type="hidden" name="post_id" value="<?= $post_id; ?>">
                     <input type="hidden" name="admin_id" value="<?= $fetch_posts['admin_id']; ?>">
                     <div class="icons">
                        <a href="view_posts?post_id=<?= $post_id ?>"><i class="bx bxs-chat"></i><sup><?=$total_post_comments ?></sup></a>
                        <button type="submit" name="like_post"><i class="bx bxs-heart" style="<?php if($confirm_likes->rowCount() > 0){echo 'color: red;';} ?>"></i><sup><?= $total_post_likes; ?></sup></button>
                     </div>
                     <?php 
                        if ($fetch_posts['image'] != '') {
                     ?>
                     <img src="uploaded_img/<?= $fetch_posts['image']; ?>" class="post-image">
                     <?php } ?>
                     <div class="post-title">
                           <div class="title"><?= $fetch_posts['title']; ?></div>
                           <div class="post-admin">
                              <div><i class='bx bxs-user'></i><a href="author_post?authors=<?= $fetch_posts['name'] ?>"><?= $fetch_posts['name']; ?></a><span><?= $fetch_posts['date']; ?></span></div>
                           </div>
                        </div>
                        <div class="read">
                           <a href="view_posts.php?post_id=<?= $post_id; ?>">read more</a>
                           <a href="category.php?category=<?= $fetch_posts['category']; ?>" class="post-cat"><i class='bx bxs-purchase-tag-alt' ></i><span><?= $fetch_posts['category']; ?></span></a>
                        </div>
                     
                  </form>
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