<?php 
	$db_name = 'mysql:host=localhost;dbname=blog_db';
	$user_name = 'root';
	$user_password = '';

	$conn = new PDO($db_name, $user_name, $user_password);

	if (!$conn) {
		echo 'can not connected successfully';
	}
?>