<?php
$title = 'Join eBook Apps';
$htmlClass = 'h-100';
$bodyClass = 'h-100 d-flex align-items-center py-2';
include 'partials/header.php';
?>
<div class="form-sign w-100 m-auto p-4 text-center">
  <form action="index.php?action=signup" method="POST" autocomplete="off">
    <a href="index.php?action=home">
      <img src="assets/img/icon-ebook.png" alt="Icon eBook">
    </a>
    <h1 class="my-3 fs-3">Create an account</h1>
    <?php if (isset($result['error'])): ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= $result['message'] ?>
        <button class="btn-close" data-bs-dismiss="alert" type="button" aria-label="Close"></button>
      </div>
    <?php endif; ?>
    <div class="form-floating mb-2">
      <input class="form-control" id="username" name="username" type="text" placeholder="Username" maxlength="20" onkeyup="validateSignUp()" autofocus required>
      <label for="username">Username</label>
      <div class="invalid-feedback text-start">
        Please choose a username.
      </div>
    </div>
    <div class="form-floating mb-2">
      <input class="form-control" id="password" name="password" type="password" placeholder="Password" onkeyup="validateSignUp()" required>
      <label for="password">Password</label>
      <div class="invalid-feedback text-start">
        Password must be at least 8 characters long
      </div>
    </div>
    <div class="form-floating mb-2">
      <input class="form-control" id="confirmPassword" name="confirmPassword" type="password" placeholder="Confirm Password" onkeyup="validateSignUp()" required>
      <label for="confirmPassword">Confirm Password</label>
      <div class="invalid-feedback text-start">
        Password didn't match
      </div>
    </div>
    <div class="form-check my-3 d-flex justify-content-center">
      <input class="form-check-input me-2" id="show" name="show" type="checkbox" onclick="showPassword()">
      <label class="form-check-label" for="show">Show Password</label>
    </div>
    <button class="w-100 btn btn-lg btn-warning" name="signup" type="submit">Sign up</button>
    <div class="my-3">
      Already have an account?
      <a class="link-danger text-decoration-none fw-bold" href="index.php?action=login">Sign in</a>
    </div>
    <div class="mt-5 text-muted">
      &copy; <?= date('Y') ?> Created by
      <a class="link-warning text-decoration-none fw-bold" href="https://github.com/madfauzy" target="_blank" rel="noopener noreferrer">
        <i class="bi bi-balloon-heart-fill text-warning"></i> Ahmad Fauzy
      </a>
    </div>
  </form>
</div>

<?php
$footerScripts = '';
if (isset($result['success'])) {
  $footerScripts = <<<SCRIPT
  <script>
    let timerInterval;
    Swal.fire({
      title: 'Success!',
      html: 'You Will Be Redirected!',
      icon: 'success',
      allowOutsideClick: false,
      timer: 2000,
      timerProgressBar: true,
      didOpen: () => {
        Swal.showLoading();
      },
      willClose: () => {
        clearInterval(timerInterval);
      },
    }).then((result) => {
      if (result.dismiss === Swal.DismissReason.timer) {
        window.location.href = 'index.php?action=login';
      }
    });
  </script>
SCRIPT;
}
include 'partials/footer.php';
echo $footerScripts;
?>