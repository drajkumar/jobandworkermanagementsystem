<?php
require_once '../core/init.php';
require_once '../functions/sanitize.php';
require_once '../vendor/autoload.php';

if(Input::exists()){
  if(Token::check(Input::get('token'))){
     $validate = new Validation();
     $validation =  $validate->check($_POST, array(
        'username'=>array(
           'required' =>true,
           'min'      => 2,
           'max'      => 20,
           'unique'   => 'admin_users' 
        	),
        'password'=>array(
          'required' => true,
          'min' => 6
        	)
    	));

     if($validation->passed()){
       $user = new Admin();
       $salt = Hash::salt(32);
        try {
          $user->create(array(
           'username' => Input::get('username'),
           'password' => Hash::make(Input::get('password'), $salt),
           'salt' => $salt
            ));

           Session::flash('register', 'You have been registered and can you login');
           Redirect::to('index.php');
        } catch (Exception $e) {
           die($e->getMessage());
        }
     }else{
        foreach($validation->errors() as $error){
          echo $error. '<br>';
        }
     }
  }
}


?>



<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Forms</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
	
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Register Admin</div>
				<div class="panel-body">
					<form role="form" action="" method="post">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Username" name="username" type="text" value="<?php echo escape(Input::get('username'));?>" autofocus="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" type="password" value="">
							</div>
					
								<label>
									<input type="hidden" name="token" value="<?php echo Token::generete(); ?>"/>
								</label>
				
							<input type="submit" class="btn btn-primary" value="Register_admin"/>
						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	
		

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script>
		!function ($) {
			$(document).on("click","ul.nav li.parent > a > span.icon", function(){		  
				$(this).find('em:first').toggleClass("glyphicon-minus");	  
			}); 
			$(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>	
</body>

</html>
