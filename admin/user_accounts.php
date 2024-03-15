<?php 
	 include '../components/connect.php';
	 session_start();

	 $admin_id = $_SESSION['admin_id'];

	 if (!isset($admin_id)) {
	 	header('location: admin_login.php');
	 }
	 if (isset($_POST['delete'])) {
	 	$delete_image = $conn->prepare("SELECT * FROM `posts` WHERE admin_id = ?");
	 	$delete_image->execute([$admin_id]);
	 	while($fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC)){
	 		unlink('../update_image/'.$fetch_delete_image);
	 	}

	 	$delete_posts = $conn->prepare("DELETE FROM `posts` WHERE admin_id = ?");
	 	$delete_posts->execute([$admin_id]);
	 	$delete_likes = $conn->prepare("DELETE FROM `likes` WHERE admin_id = ?");
	 	$delete_likes->execute([$admin_id]);
	 	$delete_comment = $conn->prepare("DELETE FROM `comments` WHERE admin_id = ?");
	 	$delete_comment->execute([$admin_id]);

	 	$delete_admin = $conn->prepare("DELETE FROM `admin` WHERE id = ?");
	 	$delete_admin->execute([$admin_id]);

	 	header('location:../components/admin_logout.php');

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
		<section class="accounts">
			<h1 class="heading">users account</h1>
			<div class="box-container">
				<?php 
 					$select_users = $conn->prepare("SELECT * FROM `users`");
 					$select_users->execute();
 					if ($select_users->rowCount() > 0) {
 						while($fetch_accounts = $select_users->fetch(PDO::FETCH_ASSOC)){
 							$user_id = $fetch_accounts['id'];
 							$count_user_comments = $conn->prepare("SELECT * FROM `comments` WHERE user_id = ?");
 							$count_user_comments->execute([$user_id]);
 							$total_user_comments = $count_user_comments->rowCount();

 							$count_user_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ?");
 							$count_user_likes->execute([$user_id]);
 							$total_user_likes = $count_user_likes->rowCount();
 						
				?>
				<div class="box">
					<p>users id : <span><?= $user_id; ?></span></p>
					<p>user name : <span><?= $fetch_accounts['name']; ?></span></p>
					<p>total comments : <span><?= $total_user_comments ?></span></p>
					<p>total likes : <span><?= $total_user_likes ?></span></p>
				</div>
				<?php 
						}
 					}else{
 						echo '
							<div class="empty">
								<p>no post found!</p>
							</div>
						';
 					}
				?>
			</div>
		</section>
	</div>
	
	<script type="text/javascript" src="script.js"></script>
</body>
</html>