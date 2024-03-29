<?php 
	 include '../components/connect.php';
	 session_start();

	 $admin_id = $_SESSION['admin_id'];

	 if (!isset($admin_id)) {
	 	header('location: admin_login.php');
	 }
	 if (isset($_POST['delete_comment'])) {
	 	$comment_id = $_POST['comment_id'];
	 	$comment_id = filter_var($comment_id, FILTER_SANITIZE_STRING);
	 	$delete_comment = $conn->prepare("DELETE FROM `comments` WHERE id = ?");
	 	$delete_comment->execute([$comment_id]);
	 	$message[] = 'comment deleted';
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
		<section class="comments">
			<h1 class="heading">post comments</h1>
			<p class="comment-title">post comments</p>
			<div class="box-container">
				<?php 
					$select_comments = $conn->prepare("SELECT * FROM `comments` WHERE admin_id = ?");
					$select_comments->execute([$admin_id]);
					if($select_comments->rowCount() > 0){
						while($fetch_comments = $select_comments->fetch(PDO::FETCH_ASSOC)){


				?>
				
				<div class="box">
					<?php 
						$select_posts = $conn->prepare("SELECT * FROM `posts` WHERE id = ?");
						$select_posts->execute([$fetch_comments['post_id']]);
						while($fetch_posts = $select_posts->fetch(PDO::FETCH_ASSOC)){

					?>
					<div class="post-title">from : <span><?= $fetch_posts['title']; ?></span><a href="read_posts.php>post_id=<?= $fetch_posts['id']; ?>">view post</a></div>
					<?php } ?>
					<div class="user">
						<i class="bx bxs-user-detail"></i>
						<div class="user-info">
							<span><?= $fetch_comments['user_name']; ?></span>
							<div><?= $fetch_comments['date']; ?></div>
						</div>
					</div>
					<div class="title"><?= $fetch_comments['comment']; ?></div>
					<form action="" method="post">
						<input type="hidden" name="comment_id" value="<?= $fetch_comments['id']; ?>">
						<button type="submit" name="delete_comment" class="btn">delete comment</button>
					</form>
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