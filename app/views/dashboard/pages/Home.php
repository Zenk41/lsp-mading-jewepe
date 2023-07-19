<secion id="dashboard">
<?php if (isset($_GET['error'])): ?>
  <p class="alert alert-danger" role="alert"><?= htmlspecialchars($_GET['error']) ?></p>
 <?php endif; ?>

 <?php if (isset($_GET['success'])): ?>
  <p class="alert alert-success" role="alert"><?= htmlspecialchars($_GET['success']) ?></p>
 <?php endif; ?>

 <div class="jumbotron jumbotron-fluid text-center">
  <div class="container">
   <h1 class="display-4"> halo selamat datang. <?= $_SESSION['username'] ?> di menu Admin</h1>
  </div>
 </div>
 </section>