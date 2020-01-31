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
					<p>Register</p>
				</div>
			</div>					
		</div>	
		<!--log-nav part end-->
		<!--log-main part start-->		
		<div class="container">	
			<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
				<div class="row log-main">
				
					<div class="log-main-part">
					
						<p class="border-p">Register a new account</p><br/>

						<?php


							if(Input::exists()){
							  if(Token::check(Input::get('token'))){
							     $validate = new Validation();
							     $validation =  $validate->check($_POST, array(
							        'firstname' => array(
							           'required' =>true,
							           'max'      => 30 
							        	),
							        'lastname' => array(
							          'required' => true,
							          'max'      => 30 
							          
							        	),
							        'email' =>  array( 
                                     'required' =>true,
                                     'unique'   => 'user_account' 
							        	),
							        'password' => array( 
							            'required' => true,
                                        'min' => 6,
                                        'max' => 12
                                        ),
							        'password_again'=>array(
							          'required' => true,
							          'matches'  => 'password'
							        	),
							        'address' => array(
							          'required' => true
							        	),
							        'city' => array(
							          'required' => true
							        	),
							        'zipcode' => array(
                                      'required' => true
							        	),
							        'agree'=> array(
                                      'required' => true
							        	)
							    	));

							     if($validation->passed()){
							       $user = new User();
							       $salt = Hash::salt(32);
							        try {
							          $user->create(array(
							           'firstname' => Input::get('firstname'),
							           'lastname' => Input::get('lastname'),
							           'email' => Input::get('email'),
							           'email_code' => '',
							           'password' => Hash::make(Input::get('password'), $salt),
							           'salt' => $salt,
							           'balence' => 0.12,
							           'address' => Input::get('address'),
							           'city'   => Input::get('city'),
							           'zipcode' => Input::get('zipcode'),
							           'joined' => date('Y-m-d H:i:s'),
							           'status' => 1
							            ));

							           Session::flash('register', 'You have been registered and can you login');
							           
							        } catch (Exception $e) {
							           die($e->getMessage());
							        }
							     }else{
							        foreach($validation->errors() as $error){
							          echo $error;
							        }
							     }
							  }
							}


							?>	

							<?php	
                                     if(Session::exists('register')){
					            echo '<div class="alert alert-success alert-block">
					             <a class="close" data-dismiss="alert" href="#">×</a>
					             <h4 style="margin-left:60px" class="alert-heading">Success!</h4> '.
					             '<p style="font-size:15px; color:green; margin-left:60px">'.
					               Session::flash('register') .'</p>           
					              </div>';
             }
                          

							?>	

							<?php         



							?>		
						<form action="" method="post">	
									
						<table>
							<tr>
								<td>First name:</td>
								<td class="td-padding">
									<input type="text" name="firstname" value="<?php echo escape(Input::get('firstname'));?>" placeholder="Firstname"/>
								</td>
							</tr>

							<tr>
								<td>Last name:</td>
								<td class="td-padding">
									<input type="text" name="lastname" value="<?php echo escape(Input::get('lastname'));?>" placeholder="Lastname"/>
								</td>
							</tr>



						    <tr>
								<td>Email:</td>
								<td class="td-padding">
									<input type="email" name="email" value="<?php echo escape(Input::get('email'));?>" placeholder ="Email"/>
								</td>
							</tr>


							<tr>
								<td>Password:</td>
								<td class="td-padding">
									<input type="password" name="password"  placeholder ="Password"/>
								</td>
							</tr>


							<tr>
								<td>Password again:</td>
								<td class="td-padding">
									<input type="password" name="password_again" placeholder ="Password again"/>
								</td>
							</tr>



						    <tr>
								<td>Address:</td>
								<td class="td-padding">
									<input type="text" name="address" value="<?php echo escape(Input::get('address'));?>" placeholder ="Address"/>
								</td>
							</tr>


							<tr>
								<td>City :</td>
								<td class="td-padding">
									<input type="text" name="city" value="<?php echo escape(Input::get('city'));?>" placeholder ="City"/>
								</td>
							</tr>



							<tr>
								<td>Zip code:</td>
								<td class="td-padding">
									<input type="text" name="zipcode" value="<?php echo escape(Input::get('zipcode'));?>" placeholder ="Zip code"/>
								</td>
							</tr>
							
							<tr>
								<td></td>
								<td class="td-padding">
									<p><input type="checkbox" name="agree" />&nbsp;By register to your account you agree to our <a href="#">Terms & Conditions</a></p>
								</td>
							</tr>							
							<tr>
								<td></td>
								<td class="td-padding">
								<input type="hidden" name="token" value="<?php echo Token::generete(); ?>"/>
								<input type="submit"  value="Register"/>
								</td>
							</tr>
							<tr>
		
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