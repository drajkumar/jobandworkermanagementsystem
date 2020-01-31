<?php
require_once '../core/init.php';
require_once '../functions/sanitize.php';
require_once '../vendor/autoload.php';

$user = new Admin();
if(!$user->isAdminLoggedIn()){
  Redirect::to('login.php');
}

$job_id = Input::get('post_id');
$user_id = Input::get('user_id');
$aprub = Input::get('aprub');
$price = Input::get('price');


 $user->update_allin('done_jobs', 'done_job_id', $job_id, array(
     'status' => $aprub
	));


$info = $user->whereAllin('user_account', 'user_id', $user_id);
$totale_balence = '';
foreach ($info as $key => $value) {
 $totale_balence = $info[$key]['balence'];
}

$addprice = $price + $totale_balence;
$subprice = $price - $totale_balence;

if($aprub == 1){
	 $user->update_allin('user_account', 'user_id', $user_id, array(
     'balence' => $addprice
	));
}elseif($aprub == 0){
	 $user->update_allin('user_account', 'user_id', $user_id, array(
     'balence' => $subprice
	));
}

Session::flash('done_job_update', 'done_jobs update');
Redirect::to('done_jobs.php');

?>