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
            <section class="categories">
               <h1 class="heading">post categories</h1>
               
               <div class="box-container">
                  <div class="box"><span>01</span><a href="category.php?category=nature" class="links">Categoria 1</a></div>
                  <div class="box"><span>02</span><a href="category.php?category=education" class="links">Categoria 2</a></div>
                  <div class="box"><span>03</span><a href="category.php?category=pets and animals" class="links">Categoria 3</a></div>
                  <div class="box"><span>04</span><a href="category.php?category=technology" class="links">Categoria 4</a></div>
                  <div class="box"><span>05</span><a href="category.php?category=fashion" class="links">Categoria 5</a></div>
                  <div class="box"><span>06</span><a href="category.php?category=entertainment" class="links">Categoria 6</a></div>
                  <div class="box"><span>07</span><a href="category.php?category=gamming" class="links">Categoria 7</a></div>
                  <div class="box"><span>08</span><a href="category.php?category=movies" class="links">Categoria 8</a></div>
                  <div class="box"><span>09</span><a href="category.php?category=sports" class="links">Categoria 9</a></div>
                  <div class="box"><span>10</span><a href="category.php?category=bussiness" class="links">Categoria 10</a></div>
                  <div class="box"><span>11</span><a href="category.php?category=personal" class="links">Categoria 11</a></div>
                  <div class="box"><span>12</span><a href="category.php?category=news" class="links">Categoria 12</a></div>
                  <div class="box"><span>13</span><a href="category.php?category=music" class="links">Categoria 13</a></div>
                  <div class="box"><span>14</span><a href="category.php?category=travel" class="links">Categoria 14</a></div>
                  <div class="box"><span>15</span><a href="category.php?category=comedy" class="links">Categoria 15</a></div>
                  <div class="box"><span>16</span><a href="category.php?category=design and development" class="links">Categoria 16</a></div>
                  <div class="box"><span>17</span><a href="category.php?category=food and drinks" class="links">Categoria 17</a></div>
                  <div class="box"><span>18</span><a href="category.php?category=health and fitness" class="links">Categoria 18</a></div>
                  <div class="box"><span>19</span><a href="category.php?category=shopping" class="links">Categoria 19</a></div>
                  <div class="box"><span>20</span><a href="category.php?category=animations" class="links">Categoria 20</a></div>
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