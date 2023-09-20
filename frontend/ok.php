<?php
	include 'connect.php';
    session_start();

    var_dump($_SESSION);

    // echo '<pre>';
 	// session_destroy();

	if (isset($_GET['id']))
	{
		echo $id = $_GET['id'];
	}

	// if (isset($_POST['logout']))
	// {
	// 	header('location: login.php');
	// 	session_destroy();
	// 	var_dump($_SESSION);
	// }
?>