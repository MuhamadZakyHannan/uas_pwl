<?php
$title = 'Sign in to eBook Apps';
$htmlClass = 'h-100';
$bodyClass = 'h-100 d-flex align-items-center py-2';
include 'partials/header.php';
?>
<div class="form-sign w-100 m-auto p-4 text-center">
  <form action="index.php?action=login" method="POST" autocomplete="off">
    <a href="index.php?action=home">
      <img src="assets/img/icon-ebook.png" alt="Icon eBook">
    </a>
    <h1 class="my-3 fs-3">
      Sign in to <span>eBook Apps</span>
    </h1>
    <?php if (isset($error)): ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        Incorrect username or password!
        <button class="btn-close" data-bs-dismiss="alert" type="button" aria-label="Close"></button>
      </div>
    <?php endif; ?>
    <div class="form-floating mb-2">
      <input class="form-control" id="username" name="username" type="text" placeholder="Username" maxlength="20" autofocus required>
      <label for="username">Username</label>
    </div>
    <div class="form-floating mb-2">
      <input class="form-control" id="password" name="password" type="password" placeholder="Password" required>
      <label for="password">Password</label>
    </div>
    <div class="form-check my-3 d-flex justify-content-center">
      <input class="form-check-input me-2" id="remember" name="remember" type="checkbox">
      <label class="form-check-label" for="remember">Remember me</label>
    </div>
    <button class="w-100 btn btn-lg btn-warning" name="signin" type="submit">Sign in</button>
    <div class="my-3">
      Not a member yet?
      <a class="link-danger text-decoration-none fw-semibold" href="index.php?action=signup">Create an account</a>
    </div>
  </form>
</div>

<?php include 'partials/footer.php'; ?>