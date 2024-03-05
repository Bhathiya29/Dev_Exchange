<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Pixl - Login Here </title>
</head>
<body>
<section class="vh-100">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6 text-black">
        <div class="px-5 ms-xl-4">
          <i class="fas fa-crow fa-2x me-3 pt-5 mt-xl-4" style="color: #709085;"></i>
          <span class="h1 fw-bold mb-0">Logo</span>
        </div>

        <div class="d-flex align-items-center justify-content-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">
          <form action="<?php echo base_url('login/submit'); ?>" method="post" style="width: 23rem; margin-top: 70px;">
            <h3 class="fw-normal mb-3 pb-3 text-center" style="letter-spacing: 1px; margin-bottom: 5px;">Log in</h3>

            <div class="mb-4">
                <label for="username" class="form-label">Username :</label>
              <input type="email" class="form-control form-control-lg" id="username" name="username" placeholder="Username" required>
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">Password :</label>
              <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Password" required>
            </div>

            <div class="pt-1 mb-4">
              <button btn btn-info btn-lg btn-block" type="submit" value="Login">Login</button>
            </div>

            <p class="small mb-5 pb-lg-2"><a class="text-muted" href="#!">Forgot password?</a></p>
            <p>Don't have an account? <a href="#!" class="link-info">Register here</a></p>
          </form>
        </div>
      </div>

      <div class="col-sm-6 px-0 d-none d-sm-block bg-image-vertical">
        <img src="<?php echo base_url('application/assets/images/login-img.jpg'); ?>"alt="login page">
      </div>

    </div>
  </div>
</section>

</body>
</html>