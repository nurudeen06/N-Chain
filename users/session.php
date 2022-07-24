<?php 
session_start();

include '../config/db.php';
include '../config/config.php';
include '../config/functions.php';

	if (isset($_SESSION['username']) && isset($_SESSION['id'])) {
		$usern = $_SESSION['username'];
		$userId = $_SESSION['id'];
		$query = mysqli_query($link, "SELECT * FROM users WHERE username = '$usern' AND id = '$userId' ");
		if (mysqli_num_rows($query) > 0) {
			$data = mysqli_fetch_assoc($query);

			$id = $data['id'];
			$name = ucfirst($data['fullname']);
			$username = ucfirst($data['username']);
			$email = $data['email'];
			$password = $data['password'];
			$date_created = $data['date_created'];
			$phone = $data['phone'];
			$country = ucfirst($data['country']);
			$status = ucfirst($data['status']);
			$ref_bonus = ucfirst($data['ref_bonus']);


		}else{
			header("location: ../auth/login.php");
		}
	}else{
		header("location: ../auth/login.php");
	}

?>