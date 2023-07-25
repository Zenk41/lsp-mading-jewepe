<section id="detailartikel">

 <?php if (isset($_GET['error'])): ?>
  <p class="alert alert-danger text-center" role="alert"><i
    class="bi bi-exclamation-circle p-2"></i><?= htmlspecialchars($_GET['error']) ?></p>
 <?php endif; ?>
 <?php if (isset($_GET['success'])): ?>
  <p class="alert alert-success text-center" role="alert"><i
    class="bi bi-check-circle p-2"></i><?= htmlspecialchars($_GET['success']) ?></p>
 <?php endif; ?>
 <div>
  <a href="javascript:history.back()" class="btn btn-primary">Back</a>
 </div>

 <div class="article-details">
  <div class="banner-image">
   <h2 class="article-title"><?php echo $artikel['judul']; ?></h2>
   <img src="<?php echo $artikel['gambar']; ?>" alt="Article Image">
  </div>
  <p class="article-content"><?php echo $artikel['konten']; ?></p>

  <h3>Komentar</h3>
  <div class="comments">
   <?php if (!empty($komentar)): ?>
    <?php foreach ($komentar as $data): ?>
     <div class="comment">
      <div class="comment-info">
       <h5><?php echo $data['name']; ?></h5>
       <p><?php echo $data['komentar']; ?></p>
       <span class="comment-date"><?php echo $data['tgl_komentar']; ?></span>
      </div>
     </div>
    <?php endforeach; ?>
   <?php else: ?>
    <p>tidak ada komentar</p>
   <?php endif; ?>
  </div>

  <h3>Beri Komentar</h3>
  <form method="POST"
   action="<?php echo BASE_URL . '/artikel/' . $artikel['ID_artikel'] . '/komentar/create/validate' ?>" novalidate>
   <div class="form-group">
    <label for="nama">Name</label>
    <input type="text" id="nama" name="nama" class="form-control" required>
   </div>
   <div class="form-group">
    <label for="email">Email</label>
    <input type="email" id="email" name="email" class="form-control" required>
   </div>
   <div class="form-group">
    <label for="komentar">Komentar</label>
    <textarea id="komentar" name="komentar" class="form-control" required></textarea>
   </div>
   <button type="submit" class="btn btn-primary">Submit Comment</button>
  </form>
 </div>
</section>

<style>
.banner-image {
 max-width: 100%;
 height: auto;
 text-align: center;
 margin-bottom: 20px;
}

.banner-image img {
 max-width: 100%;
 height: auto;
 max-height: 200px;
 display: inline-block;
 vertical-align: middle;
}
</style>