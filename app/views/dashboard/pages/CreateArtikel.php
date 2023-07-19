<section id="createartikel">
 <?php if (isset($_GET['error'])): ?>
 <p class="alert alert-danger text-center" role="alert">
  <i class="bi bi-exclamation-circle p-2"></i><?= htmlspecialchars($_GET['error']) ?>
 </p>
 <?php endif; ?>
 <?php if (isset($_GET['success'])): ?>
 <p class="alert alert-success text-center" role="alert">
  <i class="bi bi-check-circle p-2"></i><?= htmlspecialchars($_GET['success']) ?>
 </p>
 <?php endif; ?>
 <div class="container-fluid">
  <div class="row justify-content-center">
   <div class="col-6 bg-light"></div>
   <div class="container">
    <h1 class="my-5 text-center">Buat Artikel</h1>
    <form enctype="multipart/form-data" method="POST" action="<?php echo BASE_URL_D; ?>/artikel/create/validate"
     novalidate>
     <div class="row mb-3">
      <label class="col-2 col-form-label align-self-center">Judul</label>
      <div class="col-sm-10">
       <input class="form-control" type="text" name="judul" placeholder="Judul">
      </div>
     </div>
     <div class="row mb-3">
      <label class="col-2 col-form-label align-self-center">Konten</label>
      <div class="col-sm-10">
       <textarea class="form-control" name="konten" placeholder="Konten"></textarea>
      </div>
     </div>
     <div class="row mb-3">
      <label class="col-2 col-form-label align-self-center">Gambar</label>
      <div class="col-sm-10">
       <input class="form-control" type="file" name="gambar">
      </div>
     </div>
     <div class="row mb-3">
      <div class="col-2"></div>
      <div class="col-10">
       <input type="submit" class="col-5 btn btn-primary mr-5" name="submit" value="Simpan">
       <button type="button" class="col-5 btn btn-primary btn-light" onclick="window.history.back();">Batal</button>
      </div>
     </div>
    </form>
   </div>
  </div>
 </div>
</section>