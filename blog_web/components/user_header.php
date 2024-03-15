<div class="head">
	<header>
		<div class="logo">
			<img src="image/logo.png">
		</div>
		<div class="logo1">
			<span>Equidad Creativa</span>
			<div class="bx bxs-user" id="user-btn"></div>
			<div class="bx bx-menu" id="menu-btn"></div>
		</div>
		<!------pofile detail start------->
		<div class="profile-detail">
			<?php 
				$select_profile = $conn->prepare("SELECT * FROM `users` WHERE id=?");
				$select_profile->execute([$user_id]);
				if ($select_profile->rowCount() > 0) {
					$fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
				
			?>
			<div class="profile">
				<img src="uploaded_img/<?= $fetch_profile['profile']; ?>" class="logo-image" width="100">
				<p><?= $fetch_profile['name']; ?></p>
			</div>
			<div class="flex-btn">
				<a href="update_profile.php" class="btn">update profile</a>
				<a href="components/user_logout.php" onclick="return confirm('logout from this website')" class="option-btn">logout</a>
			</div>
			<?php }else{ ?>
				<p class="name">please login or register first!</p>
				<div class="flex-btn">
					<a href="login.php" class="option-btn">login</a>
					<a href="register.php" class="option-btn">register</a>
				</div>
			<?php } ?>
		</div>
		<!------pofile detail end------->
		<!------sidebar start------->
		<div class="sidebar">
				<?php 
					$select_profile = $conn->prepare("SELECT * FROM `users` WHERE id=?");
					$select_profile->execute([$user_id]);
					if ($select_profile->rowCount() > 0) {
						$fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
					
				?>
				<div class="profile">
					<img src="uploaded_img/<?= $fetch_profile['profile']; ?>" class="logo-image" width="100">
					<p><?= $fetch_profile['name']; ?></p>
				</div>
				<?php }else{ ?>
					<div class="profile">
						<img src="image/user.jpg" class="logo-image">
						<h5>user</h5>
					</div>
				<?php } ?>
				<h5>menu</h5>
				<ul>
					<li><a href="home.php"><i class="bx bxs-home-smile"></i>home</a></li>
					<li><a href="posts.php"><i class="bx bxs-shopping-bags"></i>post</a></li>
					<li><a href="all_category.php"><i class='bx bx-food-menu' ></i>category</a></li>
					<li><a href="authors.php"><i class="bx bxs-user-detail"></i>authors</a></li>
					<li><a href="login.php"><i class="bx bxs-user-detail"></i>login</a></li>
					<li><a href="register.php"><i class="bx bxs-user-detail"></i>register</a></li>
					<li><a href="components/user_logout.php" onclick="return confirm('logout from this website')"><i class="bx bx-log-out"></i>logout</a></li>
				</ul>
				<h5>find us</h5>
				<div class="social-links">
					<i class="bx bxl-facebook"></i>
					<i class="bx bxl-instagram-alt"></i>
					<i class="bx bxl-linkedin"></i>
					<i class="bx bxl-twitter"></i>
					<i class="bx bxl-pinterest-alt"></i>
				</div>
			</div>
			<!------sidebar end------->
	</header>
	<div class="left-header">
		<div class="social-icons">
			<p>fb</p>
			<p>tw</p>
			<p>in</p>
			<p>yu</p>
			<p>be</p>
		</div>
		<div class="line"></div>
	</div>
</div>