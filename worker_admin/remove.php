<?php
require_once '../core/init.php';
require_once '../functions/sanitize.php';
require_once '../vendor/autoload.php';
$user = new Admin();
if(!$user->isAdminLoggedIn()){
  Redirect::to('login.php');
}


if(!empty($_REQUEST['adminuser'])){ 
       $adminuserid = $_REQUEST['adminuser'];
      $remove1 = $user->remove('admin_user', $adminuserid);
     if($remove1){
       echo "User Account Deleted Successfully ...";
    }

 }elseif(!empty($_REQUEST['jobcata'])){
      $jobcata = $_REQUEST['jobcata'];
      $remove2 = $user->remove('job_catagori', $jobcata);
      if($remove2){
       echo "Job Catagori Deleted Successfully ...";
      }
  }elseif(!empty($_REQUEST['jobid'])){
      $jobid = $_REQUEST['jobid'];
      $remove3 = $user->removeall('jobs', 'job_id', $jobid);
      if($remove3){
       echo "Job Deleted Successfully ...";
      }
  }elseif(!empty($_REQUEST['workerid'])){
      $user_id = $_REQUEST['workerid'];
      $remove4 = $user->removeall('user_account', 'user_id', $user_id);
      if($remove4){
       echo "worker Deleted Successfully ...";
      }
  }elseif(!empty($_REQUEST['doneid'])){
      $done_job_id = $_REQUEST['doneid'];
      $remove5 = $user->removeall('done_jobs', 'done_job_id', $done_job_id);
      if($remove5){
       echo "Done Job Deleted Successfully ...";
      }
  }

?>