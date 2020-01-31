<?php
session_start();

$GLOBALS['config'] = array(
 'mysql'=> array(
   'host'=> '127.0.0.1',
   'username'=>'root',
   'password'=>'',
   'db'  => 'worker'
 	),
 'remember'=> array(
     'cookie_name'=>'hash',
     'cookie_admin' => 'admin',
     'cookie_expiry'=>604800
 	),
 'session'=> array(
     'session_name'=>'user',
     'session_admin' => 'admin',
     'token_name' => 'token'
 	)
 );



?>