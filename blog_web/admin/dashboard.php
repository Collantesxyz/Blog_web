<?php 
	 include '../components/connect.php';
	 session_start();

	 $admin_id = $_SESSION['admin_id'];

	 if (!isset($admin_id)) {
	 	header('location: admin_login.php');
	 }
?>
<style>
	<?php include 'admin_style.css'; ?>
</style>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- font awesome cdn link  -->
   	<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
	<title>admin dashboard</title>
</head>
<body>
	<div class="main-container">
		<?php include '../components/admin_header.php'; ?>
		<section class="dashboard">
			<h1 class="heading">dashboard</h1>
			<div class="box-container">
				<div class="box">
					<h3>welcome!</h3>
					<p><?=$fetch_profile['name']; ?></p>
					<a href="update_profile.php" class="btn">update profile</a>
				</div>
				<div class="box">
					<?php 
						$select_post = $conn->prepare("SELECT * FROM `posts` WHERE admin_id=?");
						$select_post->execute([$admin_id]);
						$number_of_posts = $select_post->rowCount();
					?>
					<h3><?= $number_of_posts; ?></h3>
					<p>post added</p>
					<a href="add_posts.php" class="btn">add new post</a>
				</div>
				<div class="box">
					<?php 
						$select_active_post = $conn->prepare("SELECT * FROM `posts` WHERE admin_id=? AND status = ?");
						$select_active_post->execute([$admin_id, 'active']);
						$number_of_active_post = $select_active_post->rowCount();
					?>
					<h3><?= $number_of_active_post; ?></h3>
					<p>active posts</p>
					<a href="view_posts.php" class="btn">see posts</a>
				</div>
				<div class="box">
					<?php 
						$select_deactive_post = $conn->prepare("SELECT * FROM `posts` WHERE admin_id=? AND status = ?");
						$select_deactive_post->execute([$admin_id, 'deactive']);
						$number_of_deactive_post = $select_active_post->rowCount();
					?>
					<h3><?= $number_of_deactive_post; ?></h3>
					<p>active posts</p>
					<a href="view_posts.php" class="btn">see posts</a>
				</div>
				<div class="box">
					<?php 
						$select_users = $conn->prepare("SELECT * FROM `users`");
						$select_users->execute();
						$number_of_users = $select_users->rowCount();
					?>
					<h3><?= $number_of_users; ?></h3>
					<p>users account</p>
					<a href="user_accounts.php" class="btn">see users</a>
				</div>
				<div class="box">
					<?php 
						$select_admins = $conn->prepare("SELECT * FROM `admin`");
						$select_admins->execute();
						$number_of_admins = $select_admins->rowCount();
					?>
					<h3><?= $number_of_admins; ?></h3>
					<p>admins account</p>
					<a href="users_accounts.php" class="btn">see admin</a>
				</div>
				<div class="box">
					<?php
			         $select_comments = $conn->prepare("SELECT * FROM `comments` WHERE admin_id = ?");
			         $select_comments->execute([$admin_id]);
			         $select_comments->execute();
			         $numbers_of_comments = $select_comments->rowCount();
			      ?>
			      <h3><?= $numbers_of_comments; ?></h3>
			      <p>comments added</p>
			      <a href="comments.php" class="btn">see comments</a>
				</div>
				<div class="box">
			      <?php
			         $select_likes = $conn->prepare("SELECT * FROM `likes` WHERE admin_id = ?");
			         $select_likes->execute([$admin_id]);
			         $select_likes->execute();
			         $numbers_of_likes = $select_likes->rowCount();
			      ?>
			      <h3><?= $numbers_of_likes; ?></h3>
			      <p>total likes</p>
			      <a href="view_posts.php" class="btn">see posts</a>
			   </div>
			</div>

		</section>
	</div>
	
	<script type="text/javascript" src="script.js"></script>
</body>
</html>