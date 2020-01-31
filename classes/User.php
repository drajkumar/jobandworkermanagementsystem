<?php
 class User{
 	private $_db,
 	        $_data,
 	        $_sessionName,
          $_cookieName,
 	        $_isLoggedIn;

 	 public function  __construct($user = null){
      $this->_db = DB::getInstance();
      $this->_sessionName = Config::get('session/session_name');
      $this->_cookieName = Config::get('remember/cookie_name');

      if(!$user){
      	if(Session::exists($this->_sessionName)){
          $user = Session::get($this->_sessionName);

          if($this->find($user)){
            $this->_isLoggedIn = true;
          }else{

          }
      	}
        
      }else{
      	$this->find($user);
      }
 	 }

   public function update($fields = array(), $id = null){

    if(!$id && $this->isLoggedIn()){
      $id = $this->data()->id;
    }

    if(!$this->_db->update('users', $id, $fields)){
      throw new Exception("There was a problem updating...");
      
    }

   }

 	 public function create($fields = array()){
       if(!$this->_db->insert('user_account', $fields)){
          throw new Exception("There was a problem creating an account");
          
       }
 	 }

    public function createAll($table, $fields = array()){
       if(!$this->_db->insert($table, $fields)){
          throw new Exception("There was a problem creating an account");
          
       }
   }

   public function selectAllUid($table, $id){
      $sql = "SELECT * FROM {$table} ORDER BY $id DESC";
      $data = $this->_db->getInfo($sql);
      return $data;
   }

   public function whereAllin($table, $column, $value){
      $sql = "SELECT * FROM {$table} WHERE $column = '$value'";
      $data = $this->_db->getInfo($sql);
      return $data;
   }

   public function jobDoneCount($id){
     $sql = "SELECT * FROM done_jobs WHERE job_id = $id";
      $data = $this->_db->countRows($sql);
      return $data;          
   }

 	 public function find($user = null){
       if($user){
         $field = (is_numeric($user)) ? 'user_id' : 'email';
         $data = $this->_db->get('user_account', array($field, '=', $user));
          if($data->count()){
            $this->_data = $data->first();
            return true;
          }
       }
       return false;
 	 }

 	 public function login($email = null, $password = null){
      $user = $this->find($email);

      if(!$email && !$password && $this->exists()){
        Session::put($this->_sessionName, $this->data()->id);
      }else{

         if($user){
          if($this->data()->password === Hash::make($password, $this->data()->salt)){
            Session::put($this->_sessionName, $this->data()->user_id);

            return true;
          }
         }
     }
       return false;
 	 }

 	 public function data(){
 	 	return $this->_data;
 	 }

   public function exists(){
    return (!empty($this->_data)) ? true : false;
   }

 	 public function logout(){
    $this->_db->delete('users_session', array('user_id', '=', $this->data()->id)); 
 	 	Session::delete($this->_sessionName);
 	 	session_destroy();
    Cookie::delete($this->_cookieName);
 	 }

 	 public function isLoggedIn(){
 	 	return $this->_isLoggedIn;
 	 }
 }



?>