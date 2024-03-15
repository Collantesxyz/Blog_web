<?php 
	 include '../components/connect.php';
	 session_start();

	 $admin_id = $_SESSION['admin_id'];

	 if (!isset($admin_id)) {
	 	header('location: admin_login.php');
	 }

	 //delete post from database

	 if (isset($_POST['delete'])) {
	 	$p_id = $_POST['post_id'];
	 	$p_id = filter_var($p_id, FILTER_SANITIZE_STRING);
	 	$delete_image = $conn->prepare("SELECT * FROM `posts` WHERE id=?");
	 	$delete_image->execute([$p_id]);

	 	$fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC);
	 	if ($fetch_delete_image['image'] != '') {
	 		unlink('../update_image/'.$fetch_delete_image['image']);
	 	}

	 	$delete_post = $conn->prepare("DELETE FROM `posts` WHERE id = ?");
	 	$delete_post->execute([$p_id]);

	 	$delete_comments = $conn->prepare("DELETE FROM `comments` WHERE id = ?");
	 	$delete_comments->execute([$p_id]);

	 	$delete_likes = $conn->prepare("DELETE FROM `likes` WHERE id = ?");
	 	$delete_likes->execute([$p_id]);

	 	$message[] = 'post deleted successfully';
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
		<section class="post-editor">
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
			
			<h1 class="heading">your post</h1>
			<div class="show-post">
				<div class="box-container"> 
					<?php 
						$select_posts = $conn->prepare("SELECT * FROM `posts` WHERE admin_id = ?");
						$select_posts->execute([$admin_id]);
						if ($select_posts->rowCount() > 0) {
							while ($fetch_posts = $select_posts->fetch(PDO::FETCH_ASSOC)) {
								$post_id = $fetch_posts['id'];

								$count_post_comments = $conn->prepare("SELECT * FROM `comments` WHERE post_id = ?");
								$count_post_comments->execute([$post_id]);
								$total_post_comments = $count_post_comments->rowCount();

								$count_post_likes = $conn->prepare("SELECT * FROM `likes` WHERE post_id = ?");
								$count_post_likes->execute([$post_id]);
								$total_post_likes = $count_post_likes->rowCount();
							
					?>
					<form method="post" class="box">
						<input type="hidden" name="post_id" value="<?= $post_id; ?>">
						<?php if($fetch_posts['image'] != ''){ ?>
							<img src="../uploaded_img/<?= $fetch_posts['image'] ?>" class="image">
						<?php } ?>
						<div class="status" style="background-color: <?php if($fetch_posts['status'] == 'active'){echo 'limegreen'; }else{echo "coral";} ?>;"><?= $fetch_posts['status'] ?></div>

						<div class="title"><?= $fetch_posts['title'] ?></div>
						<div class="icons">
							<div class="likes"><i class="bx bx-heart"></i><sup><?= $total_post_likes ?></sup></div>
							<div class="comment"><i class="bx bx-chat"></i><sup><?= $total_post_comments ?></sup></div>
						</div>	
						<div class="flex-btn">
							<a href="edit_post.php?id=<?= $post_id ?>" class="btn">edit</a>
							<button type="submit" name="delete" class="btn" onclick="return confirm('delete this post?')">delete</button>
							<a href="read_posts.php?post_id=<?= $post_id ?>" class="btn">view post</a>
						</div>
					</form>
					<?php 
							}
						}else{

							echo '
								<div class="empty">
									<p>no post added yet! <br><a href="add_posts.php" class="btn" style="margin-top: 1.5rem;">add post</a></p>
								</div>
							';
						}
					?>
				</div>
				
			</div>
		</section>
	</div>
	
	<script type="text/javascript" src="script.js"></script>
</body>
</html>