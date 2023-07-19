<?php namespace app\models;

use models\Database;

include_once "app/models/database.php";

class Session extends Database
{
 public static function setSession(String $username, Int $user_id)
 {
  session_start();
  $_SESSION['logged'] = true;
  $_SESSION['username'] = $username;
  $_SESSION['user_id'] = $user_id;
 }

 public static function closeSession()
 {
  session_start();
  session_destroy();
 }

 public static function isAdmin(String $user_id) :bool 
 {
  $user = Users::findByUserId($user_id);
  if($user['role'] === "admin")
  {
   return true;
  }
  else 
  {
   return false;
  }
 }
}

?>