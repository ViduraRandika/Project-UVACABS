

<?php
	$u = "home";
    $index = "index.php";
    $booking = "user/booking.php";
    $contactus = "user/contactus.php";
    $user_profile = "user/profile.php";
    $login = "user/login.php";
	$signup = "user/signup.php";
	$logo = "img/logo.png";
?>

	<?php include('php/register.php') ?>

	
	<?php 
	//permissions
	if(isset($_SESSION['user'])){
	if($_SESSION['user']['user_type'] == "admin"){
			header('location: admin/index.php');
	}
	if($_SESSION['user']['user_type'] == "cashier"){
		header('location: cashier/index.php');
	}
	if($_SESSION['user']['user_type'] == "driver"){
		header('location: driver/index.php');
	}
}
?>
	<?php include('php/rememberme.php')?>
	<!DOCTYPE html>
	<html lang="zxx" class="no-js">

	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="shortcut icon" href="img/fav.png">

		<meta charset="UTF-8">
		<title>Uva Cabs</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
		

		<link rel="stylesheet" href="css/animate.min.css">
		<link rel="stylesheet" href="css/main1.css">
		<link rel="stylesheet" href="css/main.css">

	</head>

	<body>

		<?php
		// if(isset($_SESSION['feedback_success'])){
		// 	echo $_SESSION['feedback_success'];
		// 	unset ($_SESSION['feedback_success']);
		// }?>
		<?php 
		if(isset($_SESSION['bookingUnsuccess'])){ ?>
			<script>
				window.alert("Something went wrong, booking not success")
			</script>
		<?php
		unset($_SESSION['bookingUnsuccess']);
		}
		?>
		<!-- start banner Area -->
		
		<section class="banner-area relative" id="home">
			
			<div class="overlay overlay-bg"></div>
			<div class="container">
				<div class="row fullscreen d-flex align-items-center ">
					<div class="banner-content col-lg-6 ">
						<h6 class="text-white ">Need a ride? just a Click</h6><br><br>

						<a href="user/booking.php" class="primary-btn btn-right text-uppercase">Make Your Booking Now</a>
					</div>
				</div>
			</div>
		</section>
		<!-- Navigation bar start -->

		<?php include('common/navigation.php'); ?>

		<!-- Navigation bar end -->
		<section class="home-about-area section-gap">
			
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-6 about-left">
						<img class="img-fluid" src="img/about-img.jpg" alt="">
					</div>
					<div class="col-lg-6 about-right">
						<h1>Our commitment to safety</h1>
						<h4>We are here to listen from you deliver exellence</h4>
						<p>We want you to move freely, make the most of your time, and be connected to the people and places that matter most to you. That’s why we are committed to safety, from the creation of new standards to the development of technology with the aim of reducing incidents.


						</p>
						<a class="text-uppercase primary-btn" href="#">Get Details</a>
					</div>
				</div>
			</div>
		</section>


		<!-- Start services Area -->
		<section class="services-area pb-120">
			<div class="container">
				<div class="row section-title">
					<h1>Uva Cabs</h1>
					<p>Who are in extremely love with eco friendly system.</p>
				</div>
				<div class="row">
					<div class="col-lg-3 single-service">

						<h4><a href="#">
								<h4>CAR</h4>
							</a>
							<p>
								Rs 30.00 Per Mi
							</p>
						</h4>
					</div>
					<div class="col-lg-3 single-service">

						<h4><a href="#">
								<h4>VAN (Non AC)</h4>
							</a>
							<p>
								Rs 50.00 Per Mi
							</p>
						</h4>
					</div>
					<div class="col-lg-3 single-service">

						<h4><a href="#">
								<h4>VAN (AC)</h4>
							</a>
							<p>
								Rs 80.00 Per Mi
							</p>
						</h4>
					</div>
				</div>
			</div>
			</div>
		</section>
		<!-- End services Area -->

		<!-- Start image-gallery Area -->
		<section class="services-area pb-120 section-gap">
			<div class="container">
				<div class="row section-title">
					<h1>Our Photo Gallery</h1>

				</div>



				<div class="gallery cf">

					<div>
						<img class="img-responsive" src="img/g1.jpg" />
					</div>
					<div>
						<img class="img-responsive" src="img/g2.jpg" />
					</div>
					<div>
						<img class="img-responsive" src="img/g3.jpg" />
					</div>
					<div>
						<img class="img-responsive" src="img/g4.jpg" />
					</div>
					<div>
						<img class="img-responsive" src="img/g5.jpg" />
					</div>

				</div>

				<br />
			</div>
			</div>
			</div>

			</div>
		</section>
		<!-- End image-gallery Area -->



		<!-- start footer Area -->
		<?php include('footer.php'); ?>
		<?php
		if (isset($_SESSION['bookingSuccess'])) {
			echo '<script>alert("Booking Success. Please Cheack your email.");</script>';
			unset($_SESSION['bookingSuccess']);
		}
		if (isset($_SESSION['bookingUnsuccess'])) {
			echo '<script>alert("Unforunately Booking Unsuccess. There is a problem with your payment method. Please check the details and try again");</script>';
			unset($_SESSION['bookingUnsuccess']);
		}
		
		
		?>

		<!-- End footer Area -->
		
		<script src="js/jquery-2.2.4.min.js"></script>

		<script src="js/bootstrap.min.js"></script>


		<script src="js/main.js"></script>
	</body>

	</html>