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
			<h1 class="heading">admins account</h1>
			<div class="box-container">
				<div class="box">
					<p style="font-size: 2rem; text-transform: capitalize; margin-bottom:2rem;">register new admin</p>
					<a href="admin_register.php" style="margin-bottom: .5rem;" class="btn">register</a>
				</div>
				<?php 
					$select_account = $conn->prepare("SELECT * FROM `admin`");
					$select_account->execute();
					if ($select_account->rowCount() > 0) {
						while($fetch_accounts = $select_account->fetch(PDO::FETCH_ASSOC)){
							$count_admin_posts = $conn->prepare("SELECT * FROM `posts` WHERE admin_id = ?");
							$count_admin_posts->execute([$fetch_accounts['id']]);
							$total_admin_posts = $count_admin_posts->rowCount();
						
				?>
				<div class="box" style="order: <?php if($fetch_accounts['id'] == $admin_id){echo "-1";} ?>;">
					<img src="../uploaded_img/<?= $fetch_accounts['profile']; ?>" width="100">
					<p>admin id : <span><?= $fetch_accounts['id']; ?></span></p>
					<p>user name : <span><?= $fetch_accounts['name']; ?></span></p>
					<p>total posts : <span><?= $total_admin_posts; ?></span></p>
					<div class="flex-btn">
						<?php if($fetch_accounts['id'] == $admin_id){ ?>
							<a href="update_profile.php" class="option-btn" style="margin-bottom:.5rem;">update</a>
							<form action="" method="post">
								<input type="hidden" name="post_id" value="<?= $fetch_accounts['id']; ?>" on>
								<button type="submit" name="delete" onclick="return confirm('delete the account?')" class="btn" style="margin-bottom:.5rem;">delete</button>
							</form>
						<?php } ?>
					</div>
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