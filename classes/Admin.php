<?php
 class Admin{
 	private $_db,
 	        $_data,
 	        $_sessionName,
          $_cookieName,
 	        $_isAdminLoggedIn;

 	 public function  __construct($user = null){
      $this->_db = DB::getInstance();
      $this->_sessionName = Config::get('session/session_admin');

      if(!$user){
      	if(Session::exists($this->_sessionName)){
          $user = Session::get($this->_sessionName);

          if($this->find($user)){
            $this->_isAdminLoggedIn = true;
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

    if(!$this->_db->update('admin_user', $id, $fields)){
      throw new Exception("There was a problem updating...");
      
    }

   }

   public function update_all($table, $sid,  $fields = array()){
    if(!$this->_db->update($table, $sid, $fields)){
      throw new Exception("There was a problem updating...");
     }
   }

    public function update_allin($table, $column, $sid,  $fields = array()){
    if(!$this->_db->updateall($table, $column, $sid, $fields)){
      throw new Exception("There was a problem updating...");
     }
   }



 	 public function create($fields = array()){
       if(!$this->_db->insert('admin_user', $fields)){
          throw new Exception("There was a problem creating an account");
        
       }
 	 }

     public function createwithall($table, $fields = array()){
       if(!$this->_db->insert($table, $fields)){
        throw new Exception("There was a problem creating an catagori");
       }
   }

   public function whereAllin($table, $column, $value){
      $sql = "SELECT * FROM {$table} WHERE $column = '$value'";
      $data = $this->_db->getInfo($sql);
      return $data;
   }

 	 public function find($user = null){
       if($user){
         $field = (is_numeric($user)) ? 'id' : 'username';
         $data = $this->_db->get('admin_user', array($field, '=', $user));
          if($data->count()){
            $this->_data = $data->first();
            return true;
          }
       }
       return false;
 	 }

 	 public function login($username = null, $password = null){
      $user = $this->find($username);

      if(!$username && !$password && $this->exists()){
        Session::put($this->_sessionName, $this->data()->id);
      }else{

         if($user){
          if($this->data()->password === Hash::make($password, $this->data()->salt)){
            Session::put($this->_sessionName, $this->data()->id);
            return true;
          }
         }
     }
       return false;
 	 }

   public function selectAll($table){
      $sql = "SELECT * FROM {$table} ORDER BY id DESC";
      $data = $this->_db->getInfo($sql);
      return $data;
   }

   public function selectAllUid($table, $id){
      $sql = "SELECT * FROM {$table} ORDER BY $id DESC";
      $data = $this->_db->getInfo($sql);
      return $data;
   }

     public function remove($table, $column, $id){
     $this->_db->delete($table, array($column, '=', $id));
     return true;
   }

  public function removeall($table, $column, $id){
     $this->_db->delete($table, array($column, '=', $id));
     return true;
   }



 	 public function data(){
 	 	return $this->_data;
 	 }

   public function exists(){
    return (!empty($this->_data)) ? true : false;
   }

 	 public function logout(){
 	 	Session::delete($this->_sessionName);
 	 	session_destroy();
    Cookie::delete($this->_cookieName);
 	 }

 	 public function isAdminLoggedIn(){
 	 	return $this->_isAdminLoggedIn;
 	 }
 }



?>