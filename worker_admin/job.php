
<?php
require_once '../core/init.php';
require_once '../functions/sanitize.php';
require_once '../vendor/autoload.php';

$user = new Admin();
if(!$user->isAdminLoggedIn()){
  Redirect::to('login.php');
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
							<li><a href="logout.php"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
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
			<li><a href="worker.php"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg> Worker User</a></li>
			<li><a href="job.php"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg> Jobs</a></li>
			<li><a href="done_jobs.php"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg> Done Jobs</a></li>
			<li><a href="widro.php"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg> Withdraw Request</a></li>
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
			<ul class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active"><a href="job_catagori_create.php">Job Catagori</a></li>
				<li class="active"><a href="job_create.php">Job create</a></li>
				<li class="active"><a href="#">Icons</a></li>
				<li class="active"><a href="#">Icons</a></li>
				<li class="active"><a href="#">Icons</a></li>

			</ul>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Job Details</h1>
			</div>
		</div><!--/.row-->
		
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Job details</div>
					    <?php
					           if(Session::exists('job_update')){
					            echo '<div class="alert alert-success alert-block">
					             <a class="close" data-dismiss="alert" href="#">×</a>
					             <h4 style="margin-left:60px" class="alert-heading">Success!</h4> '.
					             '<p style="font-size:15px; color:green; margin-left:60px">'.
					               Session::flash('job_update') .'</p>           
					              </div>';
					             }
                           ?>
					<div class="panel-body">
						<table class="table table-striped">
						    <thead>
						    <tr>

						        <th data-field="id" data-sortable="true"> No</th>
						        <th data-field="name"  data-sortable="true">Job title</th>
						        <th data-field="name"  data-sortable="true">Job price</th>
						        <th data-field="name"  data-sortable="true">Job catagori</th>
						        <th data-field="name"  data-sortable="true">Date</th>
						        <th data-field="name"  data-sortable="true">View</th>
						        <th data-field="price" data-sortable="true">Edit</th>
                                <th data-field="action" data-sortable="true">Delete</th>
						    </tr>
						    </thead>
						    <tbody>
						    <tr>
                                <?php                     
                                
                                $admin = new Admin();
                                $x = 0;
                                  $admin_users = $admin->selectAllUid('jobs', 'job_id');
                                  foreach ($admin_users as $key => $value):
                               	$x++;  
                               	 ?>
						        <td><?php echo $x;  ?></td> 
						        <td><?php  echo $admin_users[$key]['job_title'] ;?></td>
						        <td><?php  echo $admin_users[$key]['job_price'] ;?></td>
						        <td><?php  echo $admin_users[$key]['job_catagori'] ;?></td>
						        <td><?php  echo $admin_users[$key]['date'] ;?></td>
						        <td class="center"><a data-dismiss="modal" class="btn btn-primary" href="job_singel_view.php?post_id=<?php echo $admin_users[$key]['job_id'] ;?>">View</a> </td>
						        <td class="center"><a data-dismiss="modal" class="btn btn-primary" href="job_edit.php?post_id=<?php echo $admin_users[$key]['job_id'] ;?>">Edit</a> </td>
						        <td ><a  job-id="<?php echo $admin_users[$key]['job_id'] ;?>" class="btn btn-danger delete_job" href="javascript:void(0)"><i class="glyphicon glyphicon-trash"></i>Delete</a>
						       
                
						    </tr>
                             <?php endforeach;?>

						    </tbody>
						</table>
					</div><!--/.row-->	
				</div>
			</div>
		</div><!--/.row-->
		

								
		
	</div>	<!--/.main-->
    <script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootbox.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script type="text/javascript">

 $(document).ready(function(){
    
    $('.delete_job').click(function(e){

      e.preventDefault();
      
      var pid = $(this).attr('job-id');
      var parent = $(this).parent("td").parent("tr");

      bootbox.dialog({
        message: "Are you sure you want to Delete ?",
        title: "<i class='glyphicon glyphicon-trash'></i> Delete !",
        buttons: {
        success: {
          label: "No",
          className: "btn-success",
          callback: function() {
           $('.bootbox').modal('hide');
          }
        },
        danger: {
          label: "Delete!",
          className: "btn-danger",
          callback: function() {
 
            
            
            $.post('remove.php', { 'jobid':pid })
            .done(function(response){
              bootbox.alert(response);
              parent.fadeOut('slow');
            })
            .fail(function(){
              bootbox.alert('Something Went Wrog ....');
            })
                        
          }
        }
        }
      });
      

    });
    
  });
</script>

</body>

</html>
