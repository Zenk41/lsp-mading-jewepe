<?php

namespace app\controllers;

use app\models\Users;
use app\models\Session;

define('HOME', 'http://localhost/lsp-mading-jewepe2');
class AuthController
{

 public static function errorValidatation(array $results, array $currentValues, string $route): void
 {
  foreach ($results as $result => $value) {
   if ($value != "success") {
    $error[$result] = $value;
   }
  }
  if (!isset($error) || $error === null) {
   if ($route === 'login') {
    self::userLogin($currentValues);
   }
  } else {
   if ($route === 'login') {
    array_pop($currentValues);
    $view = './app/views/main/session/Login.php';
    include_once './app/views/main/layout/Layout.php';
   }
  }
 }
 public static function getCurrentValues(string $username = null, string $email = null, string $password = null, string $role = null): array
 {
  $currentValues['username'] = $username;
  $currentValues['email'] = $email;

  $currentValues['password'] = $password;

  $currentValues['role'] = $role;
  return $currentValues;
 }

 public static function loginValidate(): void
 {
  if (
   isset($_POST['username']) && !empty($_POST['username']) &&
   isset($_POST['password']) && !empty($_POST['password'])
  ) {
   $user = Users::findByUsername($_POST['username']);
   if ($user) {
    $results['username'] = 'success';

    if ($_POST['password'] == $user['password']) {

    } else {
     $results['password'] = 'Wrong password.';
    }
   } else {
    $results['username'] = 'No user found with this username.';
   }
  } else {
   $results['username'] = 'Username field is required';
   $results['password'] = 'Password field is required';
  }
  $currentValues = self::getCurrentValues($_POST['username'], null, $_POST['password']);
  self::errorValidatation($results, $currentValues, 'login');
 }

 public static function userLogin($currentValues): void
 {
  $user = Users::findByUsername($currentValues['username']);

  Session::setSession($currentValues['username'], $user['ID_user']);

  $dir = dirname($_SERVER['REQUEST_URI']);

  if (!Session::isAdmin($_SESSION['user_id'])) {
   header('Location: ' . HOME . '/');
  } else
   header('Location: ' . HOME . '/dashboard');

   
  echo '<script>alert("Login successful!");</script>';
  exit();
 }

 public static function logout(): void
 {
  Session::closeSession();
  $dir = dirname($_SERVER['REQUEST_URI']);

  header('Location: ' . HOME . '/login');
  exit();
 }
}