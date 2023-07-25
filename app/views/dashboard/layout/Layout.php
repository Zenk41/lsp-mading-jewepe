<?php define('BASE_URL_D', 'http://localhost/lsp-mading-jewepe2/dashboard'); ?>
<?php define('BASE_URL', 'http://localhost/lsp-mading-jewepe2'); ?>
<!doctype html>
<html lang="en">

<head>
 <!-- Required meta tags -->
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

 <!-- Bootstrap CSS -->
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
  integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
 <title>Website Mading JeWePe</title>
</head>

<body>
 <header>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
   <a class="navbar-brand" href="#" style="font-weight:bold;color:#8ACDEA;">
    <img src="<?php echo BASE_URL . '/public/images/mading-jewepe-logo.png' ?>" width="30" height="30"
     class="d-inline-block align-top" alt="">
    Mading JeWePe
   </a>
   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
   </button>

   <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
    <ul class="navbar-nav">
     <li class="nav-item active">
      <a class="nav-link" href="<?php echo BASE_URL_D ?>">Home <span class="sr-only">(current)</span></a>
     </li>
     <li class="nav-item">
      <a class="nav-link" href="<?php echo BASE_URL_D . '/artikel'; ?>">Artikel</a>
     </li>
     <?php
     use app\models\Session;

     if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
       if (Session::isAdmin($_SESSION['user_id'])) {
         echo '<li class="nav-item"><a class="nav-link" href="' . BASE_URL_D . '/komentar">Komentar</a></li>';
         echo '<li class="nav-item"><a class="nav-link" href="' . BASE_URL_D . '/laporan">Laporan</a></li>';
         echo '<li class="nav-item"><a class="nav-link" href="' . BASE_URL_D . '/logout">Logout</a></li>';
       } else {
         echo '<li class="nav-item"><a class="nav-link" href="' . BASE_URL_D . '/logout">Logout</a></li>';
       }
     } else {
       echo '<li class="nav-item"><a class="nav-link" href="' . BASE_URL_D . '/login">Login</a></li>';
     }
     ?>

    </ul>
   </div>
  </nav>
 </header>

 <main>
  <div class="container">
   <?php include htmlspecialchars($view); ?>
  </div>
 </main>

 <!-- Footer -->
 <footer class="text-center text-white" style="background-color:#8ACDEA;">
  <!-- Grid container -->
  <div class="container p-4">
   <section class="mb-4">
    <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"></a>

    <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"></a>
    <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"></a>
 </footer>
 <!-- Optional JavaScript -->
 <!-- jQuery first, then Popper.js, then Bootstrap JS -->
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
  integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
  integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
  integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
  <script>
$(document).ready(function() {
  // Listen for the form's submit event
  $("#createartikel form").submit(function(event) {
    event.preventDefault(); // Prevent the default form submission

    // Get the status of the checkbox
    var isChecked = $("#myCheckbox").prop("checked");

    // Add the checkbox status to the form data
    var formData = new FormData(this);
    formData.append("isChecked", isChecked);

    // Send the form data (including the checkbox status) to PHP through AJAX
    $.ajax({
      url: "<?php echo BASE_URL_D; ?>/artikel/create/validate", // Replace with the PHP processing script URL
      method: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function(response) {
        // Handle the response from PHP if needed
        console.log(response);

        // Redirect to success or error page, depending on the response
        var successUrl = "<?php echo BASE_URL_D; ?>/success_page.php";
        var errorUrl = "<?php echo BASE_URL_D; ?>/error_page.php";

        if (response === "success") {
          window.location.href = successUrl;
        } else {
          window.location.href = errorUrl;
        }
      },
      error: function(xhr, status, error) {
        // Handle errors if any
        console.log("Error: " + error);
      }
    });
  });
});
</script>
</body>

</html>