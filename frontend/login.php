
<?php session_start();
var_dump($_FILES);
	include "connect.php";
	$err_name = '';
	$err_email = '';
	$err_password = '';
	$err_avatar = '';
	$msg= '';
	var_dump($_SESSION);
	if (isset($_POST['signup']))
	{
		// session_destroy();
		$flag = true;
		
		if(empty($_POST['name']))
		{
			$err_name = 'Vui long nhap email';
			$flag = false ;
		}

		if(empty($_POST['email']))
		{
			$err_email = 'Vui long nhap email';
			$flag = false;
		}

		if(empty($_POST['password']))
		{
			$err_password= 'Vui long nhap password';
			$flag = false;
		}

		

		if(isset($_FILES['avatar']))
		{
			if(empty($_FILES['avatar']))
			{
				$err_avatar = 'vui long chon anh';
				$flag = false;
			}

			// if( $_FILES['avatar']['error'] == 4)
			// {
			// 	$err_avatar = "Vui long chon anh";
			// 	$flag = false;
			// }
			// $err_avatar = 'Vui long chon avatar';
			// $flag = false;

			if($_FILES['avatar']['size'] > 1024*1024)
			{
				$err_avatar="</br> File Up da vuot qua 1 MB";
				$flag = false;
			}
			$mang = array('png', 'jpg', 'jpeg', 'PNG', 'JPG');
			$mangtam1 = explode(".", $_FILES['avatar']['name']);
			$mangtam2 = end($mangtam1);

			if(!in_array($mangtam2, $mang))
			{
				$err_avatar="</br> ko phai file anh";
				$flag = false ;
			}

			if ($_FILES['avatar']['size'] == 0)
			{
				$err_avatar = 'Vui long chon anh';
				$flag = false;
			}

			

			

			

			
		}

		if ($flag)
		{


			$sql = "INSERT INTO users (Name, Email, Pass, Avatar) 
                     VALUES ('".$_POST['name']."', '".$_POST['email']."', '".$_POST['password']."', '" .$_FILES['avatar']['name']."');";

			if ($result = $con-> query($sql))
			{
				echo "<h1> Thêm mới tài khoản thành công </h1>";
				$msg = "Dang ki thanh cong!!!";
		
			}
			else
			{
				echo "<h1>Có lỗi xảy ra </h1>";
			}
			
		}
	
	}


	$err_email1 = "";
	$err_pass1 = "";
	$flag1 = true;
	$msg1 = '';
	// echo $id = $_GET['id'];
	if (isset($_POST['login']))
	{
		// echo $id;
		if (empty($_POST['email1']))
		{
			$err_email1 = "vui long nhap ten";
			$flag1 = false;
		}

		if (empty($_POST['password1']))
		{
			$err_pass1 = 'vui long nhap pass';
			$flag1 = false;
		}

		if ($flag1)
		{
			// select * form user where e = e and p = p

			$sql = "select * from users where Email = '".$_POST['email1']."' and Pass = '".$_POST['password1']."' ";

			$result = $con->query($sql);


		
            if ($result->num_rows > 0) {
				// $id = $_GET['id'];
				// echo $id;
				$check = true;
				$_SESSION['check'] = $check;
                header('location: index.php');
				while ($row = $result-> fetch_assoc())
				{
					$data[] = $row;
					// echo $data['id'];
				}
            }

			
			else
			{
				echo "<h1>Có lỗi xảy ra </h1>";
			}
			
			
			// $html = '';
            foreach ($data as $value) {
                // $html .= '
                // <tr role="row">
                //     <td>'.$value['id'].'</td>
                //     <td>'.$value['Name'].'</td>
                //     <td>'.$value['Email'].'</td>
                //     <td>'.$value['Pass'].'</td>
                //     <td>'.$value['Avatar'].'</td>
                //     <td><a href="account.php?id='.$value['id'].'">Account</a></td>
                    
                // </tr>';
				$_SESSION['id'] = $value['id'];

            }
			// var_dump($data);
			// $_SESSION['id'] = $value['id'];
			// var_dump($_SESSION);

			// if ($result = $con-> query($sql))
			// {
			// 	$msg1 = "dang nhap thanh cong";

		
			// }
			// else
			// {
			// 	echo "<h1>Có lỗi xảy ra </h1>";
			// }


			//if (($_POST['email1']== $_SESSION['email']) && ($_POST['password1']== $_SESSION['password']))
			// {
			// 	$msg1 = 'dang nhap thanh cong';
			// 	header('location: index1.php');
			// }
			// else
			// {
			// 	$msg1 = "Dang nhap that bai";
			// }
		}
	}
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login | E-Shopper</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
	<style>
		p{
			background-color: red;
		}
	</style>
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href=""><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
								<li><a href=""><i class="fa fa-envelope"></i> info@domain.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href=""><i class="fa fa-facebook"></i></a></li>
								<li><a href=""><i class="fa fa-twitter"></i></a></li>
								<li><a href=""><i class="fa fa-linkedin"></i></a></li>
								<li><a href=""><i class="fa fa-dribbble"></i></a></li>
								<li><a href=""><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-md-4 clearfix">
						<div class="logo pull-left">
							<a href="index.html"><img src="images/home/logo.png" alt="" /></a>
						</div>
						<div class="btn-group pull-right clearfix">
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									USA
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="">Canada</a></li>
									<li><a href="">UK</a></li>
								</ul>
							</div>
							
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									DOLLAR
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="">Canadian Dollar</a></li>
									<li><a href="">Pound</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-8 clearfix">
						<div class="shop-menu clearfix pull-right">
							<ul class="nav navbar-nav">
								<!-- <li><a href="account.php"><i class="fa fa-user"></i> Account</a></li> -->
								<li><a href="account.php?id='.$value['id'].'">Account</a></li>
								<li><a href=""><i class="fa fa-star"></i> Wishlist</a></li>
								<li><a href="checkout.html"><i class="fa fa-crosshairs"></i> Checkout</a></li>
								<li><a href="cart.html"><i class="fa fa-shopping-cart"></i> Cart</a></li>
								<li><a href="login.php"><i class="fa fa-lock"></i> Login</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="index.html">Home</a></li>
								<li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="shop.html">Products</a></li>
										<li><a href="product-details.html">Product Details</a></li> 
										<li><a href="checkout.html">Checkout</a></li> 
										<li><a href="cart.html">Cart</a></li> 
										<li><a href="login.php" class="active">Login</a></li> 
                                    </ul>
                                </li> 
								<li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="blog.html">Blog List</a></li>
										<li><a href="blog-single.html">Blog Single</a></li>
                                    </ul>
                                </li> 
								<li><a href="404.html">404</a></li>
								<li><a href="contact-us.html">Contact</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
							<input type="text" placeholder="Search"/>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<form action="#" method='post' enctype="multipart/form-data">
							<input type="text" placeholder="Email" name="email1" />
							<p><?php echo $err_email1 ?></p>
							<input type="password" placeholder="Password" name='password1'/>
							<p><?php echo $err_pass1 ?></p>
							<span>
								<input type="checkbox" class="checkbox"> 
								Keep me signed in
							</span>
							<button type="submit" class="btn btn-default" name="login">Login</button>
							<!-- <a href="index1.php?id='." type="submit" class="btn btn-default" name="login">Login</button> -->
						</form>
						<p><?php echo $msg1 ?></p>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<form action="#" method='post' enctype="multipart/form-data">
							<input type="text" placeholder="Name" name="name"/>
							<p><?php echo $err_name ?></p>
							<input type="email" placeholder="Email Address" name="email"/>
							<p><?php echo $err_email ?></p>
							<input type="password" placeholder="Password" name="password"/>
							<p><?php echo $err_password ?></p>
							<input type="file" placeholder="Avatar" name="avatar"/>
							<p><?php echo $err_avatar ?></p>
							<button type="submit" class="btn btn-default" name='signup'>Signup</button>
						</form>
						<p><?php echo $msg ?></p>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	
	
	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span>e</span>-shopper</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe1.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe2.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe3.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe4.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="address">
							<img src="images/home/map.png" alt="" />
							<p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Service</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="">Online Help</a></li>
								<li><a href="">Contact Us</a></li>
								<li><a href="">Order Status</a></li>
								<li><a href="">Change Location</a></li>
								<li><a href="">FAQ’s</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Quock Shop</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="">T-Shirt</a></li>
								<li><a href="">Mens</a></li>
								<li><a href="">Womens</a></li>
								<li><a href="">Gift Cards</a></li>
								<li><a href="">Shoes</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Policies</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="">Terms of Use</a></li>
								<li><a href="">Privecy Policy</a></li>
								<li><a href="">Refund Policy</a></li>
								<li><a href="">Billing System</a></li>
								<li><a href="">Ticket System</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="">Company Information</a></li>
								<li><a href="">Careers</a></li>
								<li><a href="">Store Location</a></li>
								<li><a href="">Affillate Program</a></li>
								<li><a href="">Copyright</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<form action="#" class="searchform">
								<input type="text" placeholder="Your email address" />
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
								<p>Get the most recent updates from <br />our site and be updated your self...</p>
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
	

  
    <script src="js/jquery.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>