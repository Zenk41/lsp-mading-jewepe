<section id="komentar">
 <?php if (isset($_GET['error'])): ?>
  <p class="alert alert-danger" role="alert"><?= htmlspecialchars($_GET['error']) ?></p>
 <?php endif; ?>

 <?php if (isset($_GET['success'])): ?>
  <p class="alert alert-success" role="alert"><?= htmlspecialchars($_GET['success']) ?></p>
 <?php endif; ?>

 <div class="container-fluid">
  <div class="row justify-content-center">
   <div class="col-12">
    <h1 class="my-5 text-center">Komentar</h1>

    <form action="" method="GET" class="mb-3">
     <div class="input-group">
      <input type="text" class="form-control" name="q" placeholder="Search Komentar"
       value="<?php echo htmlspecialchars($searchQuery); ?>">
      <div class="input-group-append">
       <button class="btn btn-primary" type="submit">Search</button>
      </div>
     </div>
    </form>

    <table class="table">
     <thead>
      <tr>
       <th>ID Komentar</th>
       <th>ID Artikel</th>
       <th>name</th>
       <th>email</th>
       <th>komentar</th>
       <th>Aksi</th>
      </tr>
     </thead>
     <tbody>
      <?php
      if (!empty($filteredkomentar)) {
       foreach ($filteredkomentar as $data) {
        echo "<tr>";
        echo "<td>" . $data['ID_komentar'] . "</td>";
        echo "<td>" . $data['ID_artikel'] . "</td>";
        echo "<td>" . $data['name'] . "</td>";
        echo "<td>" . $data['email'] . "</td>";
        echo "<td>" . $data['komentar'] . "</td>";
        echo "<td>";
        echo "<a href='".DASHBOARD ."/komentar/delete?id=" . $data['ID_komentar'] . "' class='btn btn-danger btn-sm'>Delete</a>";
        echo "</td>";
        echo "<td>";
        echo "<a href='".DASHBOARD ."/komentar/hide?id=" . $data['ID_komentar'] . "' class='btn btn-danger btn-sm'>ON</a>";
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