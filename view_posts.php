<?php 
	include 'components/connect.php';

	session_start();

	if (isset($_SESSION['user_id'])) {
		$user_id = $_SESSION['user_id'];
	}else{
		$user_id = '';
	}
	$get_id = $_GET['post_id'];
	include 'components/like_post.php';

	//add comment to database
	if (isset($_POST['add_comment'])) {
		$admin_id = $_POST['admin_id'];
		$admin_id = filter_var($admin_id, FILTER_SANITIZE_STRING);
		$user_name = $_POST['user_name'];
		$user_name = filter_var($user_name, FILTER_SANITIZE_STRING);
		$comment = $_POST['comment'];
		$comment = filter_var($comment, FILTER_SANITIZE_STRING);

		$varify_comment = $conn->prepare("SELECT * FROM `comments` WHERE post_id = ? AND admin_id = ? AND user_id = ? AND user_name = ? AND comment = ?");
	   $varify_comment->execute([$get_id, $admin_id, $user_id, $user_name, $comment]);

		if ($varify_comment->rowCount() > 0) {
			$message[] = 'comment already exists';
		}else{
			$insert_comment = $conn->prepare("INSERT INTO `comments`(post_id, admin_id,user_id,user_name,comment) VALUES(?,?,?,?,?)");
			$insert_comment->execute([$get_id, $admin_id, $user_id, $user_name, $comment]);
			$message[] = 'comment inserted successfully';
			
		}

	}
	//edit comment
	if (isset($_POST['edit_comment'])) {
		$edit_comment_id = $_POST['edit_comment_id'];
		$edit_comment_id = filter_var($edit_comment_id, FILTER_SANITIZE_STRING);
		$comment_edit_box = $_POST['comment_edit_box'];
		$comment_edit_box = filter_var($comment_edit_box, FILTER_SANITIZE_STRING);

		$verify_comment = $conn->prepare("SELECT * FROM `comments` WHERE comment = ? AND id = ?");
		$verify_comment->execute([$comment_edit_box, $edit_comment_id]);

		if($verify_comment->rowCount() > 0){
			$message[] = 'comment already added';
		}else{
			$update_comment = $conn->prepare("UPDATE `comments` SET comment= ? WHERE id = ?");
			$update_comment->execute([$comment_edit_box, $edit_comment_id]);
			$message[] = 'your comment updated successfully';
		}
	}
	//delete comment

	if (isset($_POST['delete_comment'])) {
		$delete_comment_id = $_POST['comment_id'];
		$delete_comment_id = filter_var($delete_comment_id, FILTER_SANITIZE_STRING);
		$delete_comment = $conn->prepare("DELETE FROM `comments` WHERE id=?");
		$delete_comment->execute([$delete_comment_id]);
		$message[] = 'comment delete successfully';
	}

?>
<style type="text/css">
	<?php 
		include 'user_style.css';
	?>
</style>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- font awesome cdn link  -->
   	<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
	<title>blog - Home page</title>
</head>
<body>
	<?php include 'components/user_header.php'; ?>
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
					<!------edit comment section----------->
					<?php 
						if (isset($_POST['open_edit_box'])) {
							$comment_id = $_POST['comment_id'];
							$comment_id = filter_var($comment_id, FILTER_SANITIZE_STRING);
						
					?>
					<section class="comment-edit-form">
						<p>edit your comment</p>
						<?php 
							$select_edit_comment = $conn->prepare("SELECT * FROM `comments` WHERE id=?");
							$select_edit_comment->execute([$comment_id]);
							$fetch_edit_comment = $select_edit_comment->fetch(PDO::FETCH_ASSOC);
						?>
						<form action="" method="post">
							<input type="hidden" name="edit_comment_id" value="<?= $comment_id; ?>">
							<textarea name="comment_edit_box" maxlength="1000" class="comment-box" cols="30" rows="10" placeholder="write your comment" required><?= $fetch_edit_comment['comment']; ?></textarea>
							<div class="form-btn">
								<button type="submit" class="btn" name="edit_comment">edit comment</button>
								<div class="option-btn" onclick="window.location.href = 'view_posts.php?post_id=<?=$get_id; ?>'">cancel edit</div>
							</div>
						</form>
					</section>
					<?php } ?>
					<!------view post start----------->
					<div class="posts-container">
						<h1 class="heading">Post más recientes</h1>
						<div class="box-container">
							<?php 
								$select_posts = $conn->prepare("SELECT * FROM `posts` WHERE status = ? AND id=?");
								$select_posts->execute(['active', $get_id]);
								if($select_posts->rowCount() > 0){
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
								<div class="post-title">
									<div class="title"><?= $fetch_posts['title']; ?></div>
									<div class="post-admin">
										<div><i class='bx bxs-user'></i><a href="author_post?authors=<?= $fetch_posts['name'] ?>"><?= $fetch_posts['name']; ?></a><span><?= $fetch_posts['date']; ?></span></div>
									</div>
								</div>
								
								<?php 
									if ($fetch_posts['image'] != '') {
								?>
								<img src="uploaded_img/<?= $fetch_posts['image']; ?>" class="post-image">
								<?php } ?>
								<div class="post-content">
									<div class="icon">
										<div><i class='bx bxs-user'></i><a href="author_post?authors=<?= $fetch_posts['name'] ?>"><?= $fetch_posts['name']; ?></a></div>
										<div><i class="bx bx-chat"></i><span style="color:#000;"><?= $total_post_comments ?>comments</span></div>
										<button type="submit" name="like_post"><i class='bx bxs-heart' style="<?php if($confirm_likes->rowCount() > 0){echo 'color: red;';} ?>"></i><span><?= $total_post_likes; ?> likes</span></button>
									</div>
									<p><?= $fetch_posts['content']; ?></p>
								</div>
								
							</form>
							<?php
									}
								}else{
									echo '<p class= "empty">no posts added yet!</p>';
								}
							 ?>
						</div>
					</div>
					<!------post container end----------->
					<!------comment section start----------->
					<section class="comment-container">
						<p class="comment-title">add comment</p>
						<?php 
							if ($user_id != '' ) {
								$select_admin_id = $conn->prepare("SELECT * FROM `posts` WHERE id = ?");
								$select_admin_id->execute([$get_id]);
								$fetch_admin_id = $select_admin_id->fetch(PDO::FETCH_ASSOC);

						?>
						<form method="post" class="add-comment">
							<input type="hidden" name="admin_id" value="<?= $fetch_admin_id['admin_id']; ?>">
							<input type="hidden" name="user_name" value="<?= $fetch_profile['name'] ?>">
							<p class="user"><img src="uploaded_img/<?= $fetch_profile['profile'] ?>" class="image"><a href="update.php"><?= $fetch_profile['name'] ?></a></p>
							<textarea name="comment" maxlength="1000" class="comment-box" cols="30" rows="10" placeholder="write your comment" required></textarea>
							<input type="submit" name="add_comment" class="btn">
						</form>
						<?php }else{ ?>
							<div class="add-comment">
								<p>please login first or edit your comment</p>
								<a href="login.php" class="option-btn">login now</a>
							</div>
						<?php }?>
						<p class="comment-title">post comments</p>
						<div class="user-comments-container">
							<?php 
								$select_comments = $conn->prepare("SELECT * FROM `comments` WHERE post_id = ?");
								$select_comments->execute([$get_id]);
								if ($select_comments->rowCount() > 0) {
									while($fetch_comments = $select_comments->fetch(PDO::FETCH_ASSOC)){
										$select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
										$select_profile->execute([$fetch_comments['user_id']]);

										if ($select_profile->rowCount() > 0) {
											$fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC)
										
							?>
							<div class="show-comments" style="<?php if($fetch_comments['user_id'] == $user_id){echo 'order: -1;';} ?>">
								<div class="comment-detail">
									<img src="uploaded_img/<?= $fetch_profile['profile']; ?>" class="img">
									<div class="comment-user">
										<span><?= $fetch_comments['user_name']; ?></span>
										<div class="date"><?= $fetch_comments['date']; ?></div>
										<div class="comment-box">
											<?= $fetch_comments['comment']; ?>
										</div>
										<?php 
											if ($fetch_comments['user_id'] == $user_id) {
												
										?>
										<form action="" method="post">
											<input type="hidden" name="comment_id" value="<?= $fetch_comments['id']; ?>">
											<button type="submit" class="option-btn" name="open_edit_box">Editar comentario</button>
											<button type="submit" class="option-btn" name="delete_comment" style="background-color: crimson;">delete comment</button>
										</form>
										<?php } ?>
									</div>
								</div>
							</div>
							<?php 
										}
									}
								}
							?>
						</div>
					</section>
					<!------comment section end----------->
				</div>
				<?php include 'components/footer.php'; ?>
			</div>
			
			<!------right section----------->
			<div class="right-section">
				<div class="overlay"></div>
				<div class="detail">
					<div class="right-cube"></div>
				</div>
			</div>
			<!------right section----------->
		</div>
	</div>
	<script type="text/javascript" src="script.js"></script>
</body>
</html>