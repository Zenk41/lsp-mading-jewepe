<?php
namespace app\controllers;

use app\models\Artikel;
use app\models\Komentar;

define('HOME', 'http://localhost/lsp-mading-jewepe2');
class MainController
{
 public function index(): void
 {
  $artikel = Artikel::all();
  $view = './app/views/main/pages/Home.php';
  include_once './app/views/main/layout/Layout.php';
  exit;
 }

 public function loginForm(): void
 {
  $view = './app/views/main/session/Login.php';
  include_once './app/views/main/layout/Layout.php';
  exit;
 }

 public function artikelPage(): void
 {
  $artikel = Artikel::all();
  $view = './app/views/main/pages/Artikel.php';
  include_once './app/views/main/layout/Layout.php';
  exit;
 }

 public static function detailArtikel(string $artikelId): void
 {
  $artikel = Artikel::findByID($artikelId);
  if (isset($artikel)) {
   $komentar = Komentar::allByArtikelId($artikelId);
   $view = './app/views/main/pages/DetailArtikel.php';
   include_once './app/views/main/layout/Layout.php';
   exit;
  } else {
   echo "<script>alert('Article Not Found'); window.location.href='" . HOME . "';</script>";
   exit;
  }
 }

 public static function komentarValidate(string $artikelId): void
 {
  $results = array();

  if (
   isset($_POST['nama']) && !empty($_POST['nama']) &&
   isset($_POST['email']) && !empty($_POST['email']) &&
   isset($_POST['komentar']) && !empty($_POST['komentar'])
  ) {
   $data = array(
    'ID_artikel' => $artikelId,
    'name' => $_POST['nama'],
    'email' => $_POST['email'],
    'komentar' => $_POST['komentar'],
   );
   Komentar::addKomentar($data);
   $success = "komentar created successfully!";
   header('Location: ' . HOME . '/artikel' . '/' . $artikelId . '?success=' . urlencode($success));
   exit;
  } else {
   if (!isset($_POST['nama']) || empty($_POST['nama'])) {
    $results['nama'] = 'Nama field is required';
   }

   if (!isset($_POST['email']) || empty($_POST['email'])) {
    $results['email'] = 'Email field is required';
   }

   if (!isset($_POST['komentar']) || empty($_POST['komentar'])) {
    $results['komentar'] = 'Komentar field is required';
   }

   $error = http_build_query($results);

   header('Location: ' . HOME . '/artikel' . '/' . $artikelId . '?error=' . $error);
   exit;
  }
 }

}