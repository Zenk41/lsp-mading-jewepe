<section id="artikel">
 <?php if (isset($_GET['error'])): ?>
  <p class="alert alert-danger" role="alert"><?= htmlspecialchars($_GET['error']) ?></p>
 <?php endif; ?>

 <?php if (isset($_GET['success'])): ?>
  <p class="alert alert-success" role="alert"><?= htmlspecialchars($_GET['success']) ?></p>
 <?php endif; ?>

 <div class="container-fluid">
  <div class="row justify-content-center">
   <div class="col-12">
    <h1 class="my-5 text-center">Artikel</h1>

    <div class="text-left mb-3">
     <a href="<?php echo BASE_URL_D . '/artikel/create'; ?>" class="btn btn-primary">Buat Artikel baru</a>
    </div>

    <form action="" method="GET" class="mb-3">
     <div class="input-group">
      <input type="text" class="form-control" name="q" placeholder="Search articles"
       value="<?php echo htmlspecialchars($searchQuery); ?>">
      <div class="input-group-append">
       <button class="btn btn-primary" type="submit">Search</button>
      </div>
     </div>
    </form>

    <table class="table">
     <thead>
      <tr>
       <th>ID Artikel</th>
       <th>Gambar</th>
       <th>Judul</th>
       <th>Konten</th>
       <th>Aksi</th>
      </tr>
     </thead>
     <tbody>
      <?php
      if (!empty($filteredartikel)) {
       foreach ($filteredartikel as $data) {
        echo "<tr>";
        echo "<td>" . $data['ID_artikel'] . "</td>";
        echo "<td><img src='" . $data['gambar'] . "' alt='Gambar' width='100'></td>";
        echo "<td>" . $data['judul'] . "</td>";
        echo "<td>" . $data['konten'] . "</td>";
        echo "<td>";
        // echo "<a href='detail_artikel.php?id=" . $data['ID_artikel'] . "' class='btn btn-primary btn-sm mr-2'>Detail</a>";
        echo "<a href='".DASHBOARD ."/artikel/delete?id=" . $data['ID_artikel'] . "' class='btn btn-danger btn-sm'>Delete</a>";
        echo "</td>";
        echo "</tr>";
       }
      } else {
       echo "<tr><td colspan='5'>No articles found</td></tr>";
      }
      ?>
     </tbody>
    </table>
   </div>
  </div>
 </div>
</section>