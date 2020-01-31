<?php
require_once '../core/init.php';
require_once '../functions/sanitize.php';
require_once '../vendor/autoload.php';
$user = new Admin();
$user->logout();

Redirect::to('login.php');



?>