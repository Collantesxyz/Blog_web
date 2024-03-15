<header>
	<div class="logo">
		<img src="#" width="50">
	</div>
	<div class="right">
		<a href="update_profile.php" class="btn">update profile</a>
		<div class="toggle btn"><i class='bx bx-menu' ></i></div>
	</div>
</header>
<div class="side-container">
	<div class="sidebar">
		<?php 
			$select_profile = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
			$select_profile->execute([$admin_id]);
			$fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
		?>
		<div class="profile">
			<img src="../uploaded_img/<?= $fetch_profile['profile']; ?>" class="logo-image" width="100">
			<p><?= $fetch_profile['name']; ?></p>
		</div>
		<h5>menu</h5>
		<div class="navbar">
			<ul>
				<li><a href="dashboard.php"><i class="bx bxs-home-smile"></i>dashboard</a></li>
				<li><a href="add_posts.php"><i class="bx bxs-shopping-bags"></i>add post</a></li>
				<li><a href="view_posts.php"><i class='bx bx-food-menu' ></i>view post</a></li>
				<li><a href="admin_account.php"><i class="bx bxs-user-detail"></i>accounts</a></li>
				<li><a href="../components/admin_logout.php" onclick="return confirm('logout from this website')"><i class="bx bx-log-out"></i>logout</a></li>
			</ul>
		</div>
	</div>
</div>