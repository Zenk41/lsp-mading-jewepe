<section id="home">
 <?php if (isset($_GET['error'])): ?>
 <p class="alert alert-danger" role="alert"><?= htmlspecialchars($_GET['error']) ?></p>
 <?php endif; ?>

 <?php if (isset($_GET['success'])): ?>
 <p class="alert alert-success" role="alert"><?= htmlspecialchars($_GET['success']) ?></p>
 <?php endif; ?>

 <div class="container-fluid">
  <div class="jumbotron jumbotron-fluid text-center" style="background-color: #8ACDEA;">
   <div class="container">
    <img src=".../public/images/mading-jewepe-logo.png" width="450" class="d-inline-block align-top" alt="">
    <h1 class="display-5 text-center" style="color: white; font-weight: bold;">Mading JeWePe</h1>
    <p class="lead text-center" style="color: white;">Selamat datang di website Mading JeWePe</p>
   </div>
  </div>
  <h2 style="margin-left: 3rem; margin-top: 1rem;">Empat Artikel Baru</h2>
  <?php if (empty($artikel)): ?>
  <p class="text-center">Artikel kosong</p>
  <?php else: ?>
  <div class="row justify-content-around m-2">
   <?php
      $counter = 0;
      foreach ($artikel as $data) {
       if ($counter >= 4) {
        break;
       }
       $id = $data['ID_artikel'];
       $image = $data['gambar'];
       $title = $data['judul'];
       $url = BASE_URL . "/artikel/{$id}";
       ?>
   <div class="col-md-3">
    <div class="card" style="width: 100%;">
     <img class="card-img-top" src="<?php echo BASE_URL . ltrim(($data['gambar']), '.'); ?>" alt="">
     <div class="card-body">
      <h5 class="card-title"><?= $title ?></h5>
      <a href="<?php echo $url ?>" class="btn btn-primary">Detail</a>
     </div>
    </div>
   </div>
   <?php
       $counter++;
      }
      ?>
  </div>
  <?php endif; ?>
 </div>
</section>