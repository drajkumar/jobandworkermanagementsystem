<?php
require_once 'core/init.php';
require_once 'functions/sanitize.php';
require_once 'vendor/autoload.php';

$user = new User();

if(!$user->isLoggedIn()){
  Redirect::to('login.php');
}


?>



<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="keywords" content="">
		<meta name="decription" content="">
		<meta name="author" content="Asad Kabir">		
		<title>Welcome</title>
		<link rel="icon" href="img/fav.png" />		
		<link rel="stylesheet" href="assest/css/font-awesome.css" />
		<link rel="stylesheet" href="assest/css/bootstrap.css" />		
		<link rel="stylesheet" href="assest/css/style.css" />						
		<link rel="stylesheet" href="assest/css/responsive.css" />						
	</head>
	<body>
		<!--log-header part start-->		
		<div class="container">	
			<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
				<div class="row log-header-left al-head">
					<a href="#"><h2><span class="h-1">Website</span><span class="h-2">Title</span></h2></a>
					<h4>work & earn or offer a micro job</h4>
				</div>
			</div>				
		</div>	
		<!--log-header part end-->
		<!--nav-al part start-->		
		<div class="container">	
			<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
				<div class="row nav-al">
					<ul id="nav">
						<li><a href="index.php">Jobs</a></li>
						<li><a href="#">HG Jobs</a></li>
						<li><a href="finistask.php">Tasks I Finished</a></li>
						<li><a href="#">My Campaigns</a></li>
						<li><a href="#">Deposit</a></li>
						<li><a href="#">Withdraw</a></li>
						<li><a href="#">Account</a></li>
					</ul>
				</div>
			</div>				
		</div>	
		<!--nav-al part end-->
		<!--nav-al-bottom part start-->		
		<div class="container">	
			<div class="col-md-10 col-sm-10 col-md-offset-1 col-sm-offset-1">
				<div class="row">
					<div class="col-md-3 col-sm-5">
						<div class="nav-al-bottom-1 row">
							<p><strong><?php echo escape($user->data()->firstname) ?>&nbsp;<?php echo escape($user->data()->lastname) ?></strong><sup>bd</sup></p>
							<p><strong>$<?php echo escape($user->data()->balence) ?></strong> on account</p>
						</div>
					</div>
					<div class="col-md-4 col-sm-5">
						<div class="nav-al-bottom-2 row">
							<p>Member_168750 <sup>Username</sup> Change</p>
							<span><?php echo escape($user->data()->email) ?></span>
						</div>
					</div>
					<div class="col-md-5 col-sm-2">
						<div class="row nav-al-bottom-3">
							<a href="logout.php">Logout</a>
						</div>					
					</div>					
				</div>
			</div>				
		</div>	
		<!--nav-al-bottom part end-->
		<!--al-table part start-->		
		<div class="container">	


        
        
       
			<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
				<div class="row al-table">

					<div class="al-table-part">
						<table style="width:100%">
							  <tr class="table-head">
							    <th>Feed back</th>
							    <th>Job Name</th>
							    <th>Price</th>						   
							    <th>Done date</th>						    
							  </tr>

							  <?php
							   $user_id = escape($user->data()->user_id); 
                               $jobs = $user->whereAllin('done_jobs', 'user_id', $user_id);
                               foreach ($jobs as $key => $value):

                              
							  ?>

							  <tr>
							  <td>
							  <?php 
                                if($jobs[$key]['status'] == 1){
                                 echo '<img src="images/right.jpg" width=20 height=20>';
                                }elseif($jobs[$key]['status'] == 0){
                                 echo '<img src="images/cross.png" width=20 height=20>';
                                }

							  ?>


							  </td>
							    <td><?php echo $jobs[$key]['job_title'];?></td>
							    <td>$<?php echo $jobs[$key]['price'];?></td>						  
							    <td><?php echo $jobs[$key]['done_time'];?></td>				    
							  </tr>

                              <?php endforeach; ?>

						</table>
					</div>
				</div>
			</div>				
		</div>	
		<!--al-table part end-->
		<!--log-footer start-->		
		<div class="container">	
			<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
				<div class="row log-footer text-center">
					<p>&copy; 2009-2017 example.com, All Rights Reserved</p>
					<p>
						<a href="#">Terms of use</a>						
						<a href="#">Privacy Policy</a>
						<a href="#">FAQ</a>
						<a href="#">Contact Us</a>
					</p>					
				</div>
			</div>					
		</div>	
		<!--log-footer part end-->
			<div class="fixed-left-top">
			<!--=======AD Start=========-->

			<!--=======AD End=========-->
		</div>
		<div class="fixed-left-bottom">
			<!--=======AD Start=========-->

			<!--=======AD End=========-->
		</div>
		<div class="fixed-right-top">
			<!--=======AD Start=========-->

			<!--=======AD End=========-->
		</div>
		<div class="fixed-right-bottom">
			<!--=======AD Start=========-->

			<!--=======AD End=========-->
		</div>
				
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/scrolltotop.js"></script>		
		<script src="js/selectnav.js"></script>	
		<script>
			selectnav('nav');
		</script>	
	</body>
</html>