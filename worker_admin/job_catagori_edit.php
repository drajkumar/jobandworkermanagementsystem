<?php
require_once '../core/init.php';
require_once '../functions/sanitize.php';
require_once '../vendor/autoload.php';

$user = new Admin();
if(!$user->isAdminLoggedIn()){
  Redirect::to('login.php');
}

$id = Input::get('post_id'); 


                      $errors = array();
						if(Input::exists()){
						  if(Token::check(Input::get('token'))){
						     $validate = new Validation();
						     $validation =  $validate->check($_POST, array(
						        'job_chatagori_name'=> array(
						           'required' =>true,
						           'min'      => 2,
						           'max'      => 20,
						           'unique'   => 'job_catagori'
						        	)

						    	));

						     if($validation->passed()){
						       $user = new Admin();

						        try {
						          $user->update_all('job_catagori', $id, array(
						           'job_chatagori_name' => Input::get('job_chatagori_name')

						            ));

						           Session::flash('job_catagori_update', 'You have been update job catagori');
						           Redirect::to('job_catagori_create.php');
						          

						        } catch (Exception $e) {
						           die($e->getMessage());
						        }
						     }else{
						       $errors[] = $validation->errors();
						        
						     }
						  }
						}


?>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Lumino - Dashboard</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">

<!--Icons-->
<script src="js/lumino.glyphs.js"></script>

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">

				<a class="navbar-brand" href="#"><span>Workkar</span>Admin</a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> User <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Profile</a></li>
							<li><a href="#"><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"></use></svg> Settings</a></li>
							<li><a href="#"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div>
		</form>
		<ul class="nav menu">
			<li class="active"><a href="index.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
			<li><a href="view_admin.php"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg> Admin User</a></li>
			<li><a href="charts.html"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg> Worker User</a></li>
			<li><a href="tables.html"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg> Jobs</a></li>
			<li><a href="forms.html"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg> Done Jobs</a></li>
			<li><a href="panels.html"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg> Widro Request</a></li>
			<li><a href="icons.html"><svg class="glyph stroked star"><use xlink:href="#stroked-star"></use></svg> Icons</a></li>
			<li class="parent ">
				<a href="#">
					<span data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> Dropdown 
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li>
						<a class="" href="#">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Sub Item 1
						</a>
					</li>
					<li>
						<a class="" href="#">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Sub Item 2
						</a>
					</li>
					<li>
						<a class="" href="#">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Sub Item 3
						</a>
					</li>
				</ul>
			</li>



			
		</ul>

	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Icons</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Job Catagori</h1>
			</div>
		</div><!--/.row-->
				
		

		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">Add Job Catagori</div>

                     <?php                     
                               
                        $admin = new Admin();
                             
                        $admin_users = $admin->whereAllin('job_catagori', 'id', $id);
                        foreach ($admin_users as $key => $value):
                        
                        ?>
					<form role="form" action="" method="post">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Job catagori" name="job_chatagori_name" type="text" value="<?php  echo $admin_users[$key]['job_chatagori_name'] ;?>" autofocus="">
							</div>
		

				            <input type="hidden" name="token" value="<?php echo Token::generete(); ?>"/>
							<input type="submit" class="btn btn-primary" value="Create"/>
						</fieldset>
					</form>

				<?php endforeach; ?>
				</div>
			</div>


	
			
		
	</div><!--/.main-->
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	

</body>

</html>
