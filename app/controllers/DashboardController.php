<?php
namespace app\controllers;

use app\models\Artikel;
use app\models\Komentar;
use app\models\User;
use app\models\Session;
use app\controllers\AuthController;

define('HOME', 'http://localhost/lsp-mading-jewepe2');
define('DASHBOARD', 'http://localhost/lsp-mading-jewepe2/dashboard');
class DashboardController
{
 public function index(): void
 {
  if (isset($_SESSION['user_id'])) {
   if (Session::isAdmin($_SESSION['user_id'])) {
    $view = './app/views/dashboard/pages/Home.php';
    include_once './app/views/dashboard/layout/Layout.php';
   } else {
    $error = "You are not allowed to go here ! You were redirect to the Home page";
    header('Location: ' . HOME . '/');
    echo $error;
   }
  } else {
   header("HTTP/1.0 404 Not Found");
  }
  exit;
 }

 public function artikel(): void
 {

  if (Session::isAdmin($_SESSION['user_id'])) {
   $artikel = Artikel::all();
   $searchQuery = isset($_GET['q']) ? $_GET['q'] : '';


   $filteredartikel = [];
   if (!empty($searchQuery)) {
    foreach ($artikel as $data) {
     if (strpos($data['judul'], $searchQuery) !== false || strpos($data['konten'], $searchQuery) !== false) {
      $filteredartikel[] = $data;
     }
    }
   } else {
    $filteredartikel = $artikel;
   }

   $view = './app/views/dashboard/pages/Artikel.php';
   include_once './app/views/dashboard/layout/Layout.php';
  } else {
   $error = "You are not allowed to go here ! You were redirect to the Home page";
   echo $error;
  }
  exit;
 }

 public function laporan(): void
 {

  if (Session::isAdmin($_SESSION['user_id'])) {
   $artikel = Artikel::all();
   $searchQuery = isset($_GET['q']) ? $_GET['q'] : '';


   $filteredartikel = [];
   if (!empty($searchQuery)) {
    foreach ($artikel as $data) {
     if (strpos($data['judul'], $searchQuery) !== false || strpos($data['konten'], $searchQuery) !== false) {
      $filteredartikel[] = $data;
     }
    }
   } else {
    $filteredartikel = $artikel;
   }

   $view = './app/views/dashboard/pages/Artikel.php';
   include_once './app/views/dashboard/layout/Layout.php';
  } else {
   $error = "You are not allowed to go here ! You were redirect to the Home page";
   echo $error;
  }
  exit;
 }

 public function editArtikel($artikelId): void
 {
  $artikel = Artikel::findByID($artikelId);
  if (isset($_SESSION['user_id'])) {
   if (Session::isAdmin($_SESSION['user_id'])) {
    $artikel = Artikel::findByID($artikelId);
    if (isset($artikel)) {
     $view = './app/views/dashboard/pages/EditArtikel.php';
     include_once './app/views/dashboard/layout/Layout.php';
    } else {
     echo "<script>alert('Article Not Found'); window.location.href='" . HOME . "';</script>";
     exit;
    }
   } else {
    $error = "You are not allowed to go here! You were redirected to the Home page";
    echo $error;
   }
  } else {
   header("HTTP/1.0 404 Not Found");
   exit;
  }
 }

 public function artikelEditValidate($artikelId): void
 {
  $results = array();
  $stat = "";
  if (
   isset($_POST['judul']) && !empty($_POST['judul']) &&
   isset($_POST['konten']) && !empty($_POST['konten'])
  ) {
   $data = array(
    'judul' => $_POST['judul'],
    'konten' => $_POST['konten'],
    'komentar' => true
   );

   if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
    $gambar = $_FILES['gambar'];
    $gambarName = $gambar['name'];
    $gambarTmp = $gambar['tmp_name'];

    $ext = pathinfo($gambarName, PATHINFO_EXTENSION);
    $newFileName = uniqid('img_', true) . '.' . $ext;
    $gambarPath = '../public/uploads/' . $newFileName;
    $movePath = 'public/uploads/' . $newFileName;

    // Move the uploaded file to the destination
    if (move_uploaded_file($gambarTmp, $movePath)) {
     // Get the old "gambar" path from the database
     $oldArtikel = Artikel::findByID($artikelId);
     $oldGambarPath = ltrim($oldArtikel['gambar'], '.');
     $stat = "Old Gambar Path: " . $oldGambarPath . "<br>";
     // Remove the old "gambar" from the server
     if (file_exists($oldGambarPath) && is_file($oldGambarPath)) {
      unlink($oldGambarPath);
     }

     // Update the article data with the new "gambar" path
     $data['gambar'] = $gambarPath;
    } else {
     $results['gambar'] = 'Failed to move the uploaded file to the destination.';
    }
   }

   Artikel::editArtikel($artikelId, $data);
   $success = "Artikel update successfully! " . $stat;
   echo '<script>alert("Login successful!");';
   header('Location: ' . DASHBOARD . '/artikel?success=' . urlencode($success));
   exit;
  } else {
   if (!isset($_POST['judul']) || empty($_POST['judul'])) {
    $results['judul'] = 'Judul field is required';
   }

   if (!isset($_POST['konten']) || empty($_POST['konten'])) {
    $results['konten'] = 'Konten field is required';
   }

   $error = http_build_query($results);

   header('Location: ' . DASHBOARD . '/artikel/' . $artikelId . '/edit?error=' . $error);
   exit;
  }
 }


 public function createArtikel(): void
 {
  if (isset($_SESSION['user_id'])) {
   if (Session::isAdmin($_SESSION['user_id'])) {
    $view = './app/views/dashboard/pages/CreateArtikel.php';
    include_once './app/views/dashboard/layout/Layout.php';
   } else {
    $error = "You are not allowed to go here! You were redirected to the Home page";
    echo $error;
   }
  } else {
   header("HTTP/1.0 404 Not Found");
  }
  exit;
 }


 public function artikelValidate(): void
 {
  $results = array();

  if (
   isset($_POST['judul']) && !empty($_POST['judul']) &&
   isset($_POST['konten']) && !empty($_POST['konten']) &&
   isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK
  ) {
   $gambar = $_FILES['gambar'];
   $gambarName = $gambar['name'];
   $gambarTmp = $gambar['tmp_name'];

   $ext = pathinfo($gambarName, PATHINFO_EXTENSION);
   $newFileName = uniqid('img_', true) . '.' . $ext;
   $gambarPath = '../public/uploads/' . $newFileName;
   $movePath = 'public/uploads/' . $newFileName;
   if (move_uploaded_file($gambarTmp, $movePath)) { // Corrected the move_uploaded_file() function
    $data = array(
     'ID_user' => $_SESSION['user_id'],
     'judul' => $_POST['judul'],
     'konten' => $_POST['konten'],
     'gambar' => $gambarPath,
     'komentar' => true
    );

    Artikel::addArtikel($data);
    $success = "Artikel created successfully!";
    echo '<script>alert("Login successful!");';
    header('Location: ' . DASHBOARD . '/artikel?success=' . urlencode($success));
    exit;
   } else {
    $results['gambar'] = 'Failed to move the uploaded file to the destination.';
   }
  } else {
   if (!isset($_POST['judul']) || empty($_POST['judul'])) {
    $results['judul'] = 'Judul field is required';
   }

   if (!isset($_POST['konten']) || empty($_POST['konten'])) {
    $results['konten'] = 'Konten field is required';
   }

   if (!isset($_FILES['gambar']) || $_FILES['gambar']['error'] !== UPLOAD_ERR_OK) {
    $results['gambar'] = 'Gambar field is required';
   }

   $error = http_build_query($results);

   header('Location: ' . DASHBOARD . '/artikel/create?error=' . $error);
   exit;
  }
 }


 public function komentar(): void
 {

  if (Session::isAdmin($_SESSION['user_id'])) {
   $komentar = Komentar::all();
   $searchQuery = isset($_GET['q']) ? $_GET['q'] : '';


   $filteredkomentar = [];
   if (!empty($searchQuery)) {
    foreach ($komentar as $data) {
     if (strpos($data['name'], $searchQuery) !== false || strpos($data['komentar'], $searchQuery) !== false) {
      $filteredkomentar[] = $data;
     }
    }
   } else {
    $filteredkomentar = $komentar;
   }

   $view = './app/views/dashboard/pages/Komentar.php';
   include_once './app/views/dashboard/layout/Layout.php';
  } else {
   $error = "You are not allowed to go here ! You were redirect to the Home page";
   echo $error;
  }
  exit;
 }

 public static function komentarDelete(): void
 {
  if (Session::isAdmin($_SESSION['user_id'])) {
   Komentar::deleteKomentar($_GET['id']);
   $success = "komentar deleted successfully !";
   header("Location: " . DASHBOARD . "/komentar?success=" . $success);
   exit();
  } else {
   $error = "You are not allowed to go here ! You were redirect to the Home page";
   header("Location: " . HOME . "/?error=" . $error);
   exit();
  }
 }

 public static function artikelDelete(): void
 {
  if (Session::isAdmin($_SESSION['user_id'])) {
   Artikel::deleteArtikel($_GET['id']);
   $success = "artikel deleted successfully !";
   header("Location: " . DASHBOARD . "/artikel?success=" . $success);
   exit();
  } else {
   $error = "You are not allowed to go here ! You were redirect to the Home page";
   header("Location: " . HOME . "/?error=" . $error);
   exit();
  }
 }

 public static function artikelKomentarHide(): void
 {
  if (Session::isAdmin($_SESSION['user_id'])) {
   $data = array(
    'komentar' => 1
   );
   Artikel::editArtikel($_GET['id'], $data);
   $success = "artikel komentar hide successfully !";
   header("Location: " . DASHBOARD . "/artikel?success=" . $success);
   exit();
  } else {
   $error = "You are not allowed to go here ! You were redirect to the Home page";
   header("Location: " . HOME . "/?error=" . $error);
   exit();
  }
 }

 public static function artikelKomentarUnHide(): void
 {
  if (Session::isAdmin($_SESSION['user_id'])) {
   $data = array(
    'komentar' => 0
   );
   Artikel::editArtikel($_GET['id'], $data);
   $success = "artikel komentar unhide successfully !";
   header("Location: " . DASHBOARD . "/artikel?success=" . $success);
   exit();
  } else {
   $error = "You are not allowed to go here ! You were redirect to the Home page";
   header("Location: " . HOME . "/?error=" . $error);
   exit();
  }
 }

}
?>