<?php
require_once 'core/init.php';
require_once 'functions/sanitize.php';
require_once 'vendor/autoload.php';

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
			<div class="col-md-5 col-md-offset-1 col-sm-5 col-sm-offset-1">
				<div class="row log-header-left">
					<a href="#"><h2><span class="h-1">TASK FOR</span><span class="h-2">COIN</span></h2></a>
					<h4>work & earn or offer a micro job</h4>
				</div>
			</div>
			<div class="col-md-5 col-sm-5">
				<div class="row log-header-right">
					<ul>
						<li><a href="#">Blog &nbsp;-</a></li>
						<li><a href="#">API &nbsp;-</a></li>
						<li><a href="#">Template</a></li>
					</ul>
				</div>					
			</div>			
		</div>	
		<!--log-header part end-->
		<!--log-nav part start-->		
		<div class="container">	
			<div class="col-md-3 col-md-offset-1 col-sm-3 col-sm-offset-1">
				<div class="row log-nav-left">
					<p>Existing user <a href="login.php"> Login</a></p>
				</div>
			</div>
			<div class="col-md-7 col-sm-7">
				<div class="row log-nav-right">
					<p>New user? <a href="register.php"> Register for free</a></p>
				</div>					
			</div>			
		</div>	
		<!--log-nav part end-->
		<!--log part start-->		
		<div class="container">	
			<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
				<div class="row log">
					<p>Login</p>
				</div>
			</div>					
		</div>	
		<!--log-nav part end-->
		<!--log-main part start-->		
		<div class="container">	
			<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
				<div class="row log-main">
					<div class="log-main-part">
						<p class="border-p">Login to your account</p><br/>
						<?php
                    if(Input::exists()){
					    if(Token::check(Input::get('token'))){
					    $validate = new Validation();
					    $validation = $validate->check($_POST, array(
					      'email'=> array('required' => true),
					      'password' => array('required' => true)
					    	));

					      if($validation->passed()){
					         $user = new User();
					 
					         $login = $user->login(Input::get('email'), Input::get('password'));
					         if($login){
					           Redirect::to('index.php');
					         }else{
					           echo '<h5 style="color:#FF4040; margin-left:40px;">Invalid Username and Password </h5>';
					         }
					      }else{
					      	 foreach($validation->errors() as $error){
					           echo $error . '<br>';
					      	 }
					      }
					  }
					  
					}

				  ?>
						<form action="" method="post">									
						<table>
							<tr>
								<td>Email:</td>
								<td class="td-padding">
									<input type="email" name="email" />
								</td>
							</tr>
							<tr>
								<td>Password:</td>
								<td class="td-padding">
									<input type="password" name="password" />
								</td>
							</tr>
							
							<tr>
								<td></td>
								<td class="td-padding">
									<p>By Login to your account you agree to our <a href="#">Terms & Conditions</a></p>
								</td>
							</tr>							
							<tr>
								<td></td>
								<td class="td-padding">
								<input type="hidden" name="token" value="<?php echo Token::generete(); ?>"/>
								<input type="submit" value="Login"/>
								</td>
							</tr>
							<tr>
								<td></td>
								<td class="td-padding">
									<a href="#">Forgot password?</a>
								</td>
							</tr>
						</table>
						</form>									
					 </div>					
				</div>
			</div>					
		</div>	
		<!--log-main part end-->
		<!--log-footer start-->		
		<div class="container">	
			<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
				<div class="row log-footer text-center">
					<p>&copy; 2009-2017 taskforcoin.com, All Rights Reserved</p>
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
	</body>
</html>