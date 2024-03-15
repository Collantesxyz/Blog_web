<?php 
	include '../components/connect.php';
	session_start();

	 $admin_id = $_SESSION['admin_id'];

	 if (!isset($admin_id)) {
	 	header('location: admin_login.php');
	 }

	if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['password']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpassword']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_img/'.$image;

   $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE name = ?");
   $select_admin->execute([$name]);
   
   if($select_admin->rowCount() > 0){
      $message[] = 'username already exists!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm passowrd not matched!';
      }else{
         $insert_admin = $conn->prepare("INSERT INTO `admin`(name, password,profile) VALUES(?,?,?)");
         $insert_admin->execute([$name, $cpass,$image]);
         move_uploaded_file($image_tmp_name, $image_folder);
         $message[] = 'new admin registered!';
      }
   }

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
	<title>Admin Login page</title>
</head>
<body style="padding-left: 0 !important;">
	<div class="main-container">
		<?php include '../components/admin_header.php'; ?>
		
		<section>
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
			<div class="form-container" id="admin_login">
				<form action="" method="post" enctype="multipart/form-data">
					<h3>register now</h3>
					<div class="input-field">
						<label>User name <sup>*</sup></label>
						<input type="text" name="name" maxlength="20" required placeholder="Enter your username" oninput="this.value.replace(/\s/g,'')">
					</div>
					<div class="input-field">
						<label>password <sup>*</sup></label>
						<input type="password" name="password" maxlength="20" required placeholder="Enter your password" oninput="this.value.replace(/\s/g,'')">
					</div>
					<div class="input-field">
						<label>confirm password <sup>*</sup></label>
						<input type="password" name="cpassword" maxlength="20" required placeholder="Enter your password" oninput="this.value.replace(/\s/g,'')">
					</div>
					<div class="input-field">
						<label>upload profile <sup>*</sup></label>
						<input type="file" name="image" accept="image/jpg, image/jpeg, image/png, image/webp">
					</div>
					<input type="submit" name="submit" value="register now" class="btn">
				</form>
			</div>
		</section>
	</div>
</body>
</html>