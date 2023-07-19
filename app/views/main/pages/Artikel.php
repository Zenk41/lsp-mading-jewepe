<section id="artikel">
 <div class="container">
  <div class="list-group">
   <?php foreach ($artikel as $data): ?>
   <div class="list-group-item">
    <div class="row">
     <div class="col-md-4">
      <img src="<?php echo BASE_URL . $data['gambar']; ?>" class="img-fluid">
     </div>
     <div class="col-md-8">
      <h5><?php echo $data['judul']; ?></h5>
      <p><?php echo $data['konten']; ?></p>
      <a href="/lsp-mading-jewepe2/artikel/<?php echo $data['ID_artikel']; ?>" class="btn btn-primary">Go to Detail</a>
     </div>
    </div>
   </div>
   <?php endforeach; ?>
  </div>
 </div>
</section>