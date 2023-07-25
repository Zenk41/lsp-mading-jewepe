<section id="loginForm">
 <?php if (isset($_GET['error'])): ?>
   <p class="alert alert-danger text-center" role="alert"><i
     class="bi bi-exclamation-circle p-2"></i><?= htmlspecialchars($_GET['error']) ?></p>
 <?php endif; ?>
 <?php if (isset($_GET['success'])): ?>
   <p class="alert alert-success text-center" role="alert"><i
     class="bi bi-check-circle p-2"></i><?= htmlspecialchars($_GET['success']) ?></p>
 <?php endif; ?>
 <div class="container-fluid">
  <div class="row">
   <div class="col-6 bg-light">
   </div>
   <div>
   </div>
   <div class="col-6" style="padding:260px 65px 260px">
    <div class="container">
     <h1 class="my-5 text-center"> Selamat Datang</h1>
     <p class="my-3">Silahkan masukan username dan password</p>
     <form class="row g-3" method="POST" action="<?php echo dirname($_SERVER['REQUEST_URI']); ?>/login/validate"
      novalidate>
      <div class="row mb-3">
       <label class="col-2 col-from-label align-self-center">Username</label>
       <div class="col-sm-10">
        <input type="text"
         class="form-control <?php if (isset($error['username'])): ?> border border-danger <?php endif; ?>"
         id="username" name="username" placeholder="Your username" aria-describedby="inputGroupPrepend"
         <?php if (isset($currentValues['username'])): ?> value="<?= htmlspecialchars($currentValues['username']) ?>"
         <?php endif; ?> required>
        <?php if (isset($error['username'])): ?>
          <p class="text-danger"><i class="bi bi-exclamation-circle p-1"></i><?= htmlspecialchars($error['username']) ?>
          </p>
        <?php endif; ?>
       </div>
      </div>
      <div class="row mb-3">
       <label class="col-2 col-from-label align-self-center">Password</label>
       <div class="col-sm-10">
        <input type="password"
         class="form-control <?php if (isset($error['password'])): ?> border border-danger <?php endif; ?>"
         id="password" name="password" placeholder="Your password" required>
        <?php if (isset($error['password'])): ?>
          <p class="text-danger"><i class="bi bi-exclamation-circle p-1"></i><?= htmlspecialchars($error['password']) ?>
          </p>
        <?php endif; ?>
       </div>
      </div>
      <div class="row mb-3">
       <div class="col-2"></div>
       <div class="col-10">
        <input type="submit" class="col-5 btn btn-primary mr-5" name="submit" value="login">
        <button type="button" class="col-5 btn btn-primary btn-light" onclick="window.history.back();">Batal</button>
       </div>
      </div>
     </form>
    </div>
   </div>
  </div>
  <div class="checkbox">
</div>
 </div>
</section>