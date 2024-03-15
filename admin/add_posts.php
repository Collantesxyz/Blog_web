<?php 
	 include '../components/connect.php';
	 session_start();

	 $admin_id = $_SESSION['admin_id'];

	 if (!isset($admin_id)) {
	 	header('location: admin_login.php');
	 }

	 if (isset($_POST['publish'])) {
	 	$name = $_POST['name'];
	   	$name = filter_var($name, FILTER_SANITIZE_STRING);

	   	$title = $_POST['title'];
	   	$title = filter_var($title, FILTER_SANITIZE_STRING);

	   	$content = $_POST['content'];
	   	$content = filter_var($content, FILTER_SANITIZE_STRING);

	   	$category = $_POST['category'];
	   	$category = filter_var($category, FILTER_SANITIZE_STRING);
	   	$status = 'active';

	   	$image = $_FILES['image']['name'];
	   	$image = filter_var($image, FILTER_SANITIZE_STRING);
	   	$image_size = $_FILES['image']['size'];
	   	$image_tmp_name = $_FILES['image']['tmp_name'];
	   	$image_folder = '../uploaded_img/'.$image;

	   	$select_image = $conn->prepare("SELECT * FROM `posts` WHERE image = ? AND admin_id = ?");
	   	$select_image->execute([$image, $admin_id]);

	   	if (isset($image)) {
	   		if ($select_image->rowCount() > 0) {
	   			$message[] = 'image name repeated!';
	   		}elseif($image_size > 2000000){
	   			$message[] = 'image size too large!';
	   		}else{
	   			move_uploaded_file($image_tmp_name, $image_folder);
	   		}
	   	}else{
	   		$image = '';
	   	}
	   	if ($select_image->rowCount() > 0 AND $image != '') {
	   		$message[] = 'please rename your image';
	   	}else{
	   		$insert_post = $conn->prepare("INSERT INTO `posts`(admin_id, name, title, content, category, image, status) VALUES (?,?,?,?,?,?,?)");
	   		$insert_post->execute([$admin_id, $name, $title, $content, $category, $image, $status]);
	   		$message[] = 'post publish';
	   	}
	 }

	 //post adding in draft
	 if (isset($_POST['draft'])) {
	 	$name = $_POST['name'];
	   	$name = filter_var($name, FILTER_SANITIZE_STRING);

	   	$title = $_POST['title'];
	   	$title = filter_var($title, FILTER_SANITIZE_STRING);

	   	$content = $_POST['content'];
	   	$content = filter_var($content, FILTER_SANITIZE_STRING);

	   	$category = $_POST['category'];
	   	$category = filter_var($category, FILTER_SANITIZE_STRING);
	   	$status = 'deactive';

	   	$image = $_FILES['image']['name'];
	   	$image = filter_var($image, FILTER_SANITIZE_STRING);
	   	$image_size = $_FILES['image']['size'];
	   	$image_tmp_name = $_FILES['image']['tmp_name'];
	   	$image_folder = '../uploaded_img/'.$image;

	   	$select_image = $conn->prepare("SELECT * FROM `posts` WHERE image = ? AND admin_id = ?");
	   	$select_image->execute([$image, $admin_id]);

	   	if (isset($image)) {
	   		if ($select_image->rowCount() > 0) {
	   			$message[] = 'image name repeated!';
	   		}elseif($image_size > 2000000){
	   			$message[] = 'image size too large!';
	   		}else{
	   			move_uploaded_file($image_tmp_name, $image_folder);
	   		}
	   	}else{
	   		$image = '';
	   	}
	   	if ($select_image->rowCount() > 0 AND $image != '') {
	   		$message[] = 'please rename your image';
	   	}else{
	   		$insert_post = $conn->prepare("INSERT INTO `posts`(admin_id, name, title, content, category, image, status) VALUES (?,?,?,?,?,?,?)");
	   		$insert_post->execute([$admin_id, $name, $title, $content, $category, $image, $status]);
	   		$message[] = 'post publish';
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
			
			<h1 class="heading">add post</h1>
			<div class="form-container">
				<form action="" method="post" enctype="multipart/form-data">
					<input type="hidden" name="name" value="<?= $fetch_profile['name']; ?>">
					<div class="input-field">
						<label>post title <sup>*</sup></label>
						<input type="text" name="title" maxlength="100" required placeholder="add post title">
					</div>
					<div class="input-field">
						<label>post content <sup>*</sup></label>
						<textarea name="content" required maxlength="10000" placeholder="write your content.."></textarea>
					</div>
					
					<div class="input-field">
						<label>post category <sup>*</sup></label>
						<select name="category" required>
							<option value="" selected disabled>---select category---</option>
							<option value="derechosHumanos">Derechos Humanos</option>
							<option value="educacionInclusiva">Educación inclusiva</option>
							<option value="empoderamientoEconomico">Empoderamiento económico</option>
							<option value="violenciaDeGenero">Violencia de género</option>
							<option value="representacionEnLosMediosDeComunicacion">Representación en los medios de comunicación</option>
							<option value="politicaYLiderazgo">Política y liderazgo</option>
							<option value="saludYBienestar">Salud y bienestar</option>
							<option value="identidadDeGenero">Identidad de género</option>
							<option value="Diversidad sexual">Diversidad sexual</option>
							<option value="conciliacionEntreVidaLaboralYFamiliar">Conciliación entre vida laboral y familiar</option>
							<option value="educacionYSensibilización">Educación y sensibilización</option>
							<option value="cat1">cat1</option>
							<option value="cat2">cat2</option>
							<option value="cat3">cat3</option>
							<option value="cat4">cat3</option>
							<option value="cat5">cat5</option>
							<option value="cat6">cat6</option>
							<option value="cat7">cat7</option>
							<option value="cat8">cat8</option>
							<option value="cat9">cat9</option>
							<option value="cat10">cat10</option>
						</select>
					</div>
					<div class="input-field">
						<label>post image <sup>*</sup></label>
						<input type="file" name="image" accept="image/jpg, image/jpeg, image/png, image/webp" required>
					</div>
					<div class="flex-btn">
						<input type="submit" name="publish" value="publish post" class="btn">
						<input type="submit" name="draft" value="save draft" class="option-btn">
					</div>
				</form>
			</div>
		</section>
	</div>
	
	<script type="text/javascript" src="script.js"></script>
</body>
</html>