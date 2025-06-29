<?php
$title = 'List eBook - eBook Apps';
include 'partials/header.php';
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="index.php?action=home">
      <img class="me-1" src="assets/img/icon-ebook.png" alt="Icon eBook"> eBook Apps
    </a>
    <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav" type="button" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="index.php?action=home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="index.php?action=list" aria-current="page">List eBook</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?action=create">Add eBook</a>
        </li>
      </ul>
      <form class="d-flex" action="index.php" method="GET" autocomplete="off">
        <input type="hidden" name="action" value="search">
        <input class="form-control me-2 ms-lg-2" id="keyword" name="keyword" type="search" value="<?= isset($keyword) ? $keyword : '' ?>" placeholder="Search eBooks">
      </form>
      <?php if (isset($_SESSION['username'])): ?>
        <div class="dropdown d-none d-lg-block">
          <img class="btn dropdown-toggle p-0" data-bs-toggle="dropdown" src="assets/img/icon-user.png" alt="Icon User" aria-expanded="false">
          <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
            <li>
              <button class="dropdown-item user-select-none pe-auto" type="button">
                Signed in as <span class="fw-bold"><?= $_SESSION['username'] ?></span>
              </button>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item link-warning fw-semibold" href="index.php?action=logout">Logout</a>
            </li>
          </ul>
        </div>
        <div class="text-light my-3 user-select-none d-lg-none">
          Signed in as <span class="fw-bold"><?= $_SESSION['username'] ?></span>
        </div>
        <a class="btn btn-warning mb-2 fw-semibold d-lg-none" href="index.php?action=logout">Logout</a>
      <?php else: ?>
        <a class="btn btn-warning fw-semibold mt-3 mb-2 my-lg-0 mx-lg-2" href="index.php?action=login">Sign In</a>
      <?php endif; ?>
    </div>
  </div>
</nav>

<main class="container my-4" id="content">
  <h1 class="fs-3 <?= !isset($_SESSION['username']) || $_SESSION['role'] === 'member' ? 'mb-4' : '' ?>">Total eBooks: <?= $totalEbook ?></h1>
  <?php if ($totalEbook === 0): ?>
    <div class="not-found d-flex flex-column justify-content-center align-items-center">
      <i class="bi bi-search display-1"></i>
      <h2 class="my-4">Oops couldn't find any eBooks!</h2>
    </div>
  <?php else: ?>
    <div class="list-ebook">
      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-2 g-4">
        <?php foreach ($ebooks as $ebook): ?>
          <div class="col">
            <?php if (isset($_SESSION['username']) && $_SESSION['role'] === 'admin'): ?>
              <div class="text-end">
                <div class="btn-group" role="group" aria-label="Update and Delete">
                  <a class="btn btn-sm btn-outline-success" href="index.php?action=edit&id=<?= $ebook['id'] ?>">Update</a>
                  <a class="btn btn-sm btn-outline-danger" href="index.php?action=delete&id=<?= $ebook['id'] ?>" onclick="deleteEbook(event)">Delete</a>
                </div>
              </div>
            <?php endif; ?>
            <div class="card shadow-sm">
              <div class="row g-0">
                <div class="col-xl-4 text-center m-xl-auto">
                  <img class="rounded" src="assets/img/ebook/<?= $ebook['cover'] ?>" alt="Cover <?= $ebook['title'] ?>" width="185" height="260">
                </div>
                <div class="col-xl-8">
                  <div class="card-body">
                    <a class="card-title link-dark text-center text-decoration-none fs-5 fw-bold line-clamp" href="<?= $ebook['link'] ?>" target="_blank" rel="noopener noreferrer"><?= $ebook['title'] ?></a>
                  </div>
                  <ul class="list-group list-group-flush mx-2">
                    <li class="list-group-item">Author: <?= $ebook['author'] ?></li>
                    <li class="list-group-item">Category: <?= $ebook['category'] ?></li>
                    <li class="list-group-item">Type:
                      <?php if ($ebook['type'] === 'Free'): ?>
                        <span class="badge bg-success">Free</span>
                      <?php else: ?>
                        <span class="badge bg-danger">Paid</span>
                      <?php endif; ?>
                    </li>
                    <li class="list-group-item d-flex justify-content-end align-items-center rounded-bottom">
                      <?php if ($ebook['status'] === 'Verified'): ?>
                        <span class="status">
                          <i class="bi bi-patch-check-fill text-primary"></i> Verified
                        </span>
                      <?php else: ?>
                        <span class="status">
                          <i class="bi bi-patch-exclamation-fill text-danger"></i> Unverified
                        </span>
                      <?php endif; ?>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  <?php endif; ?>

  <?php if ($totalEbook > 0): ?>
    <nav class="my-4">
      <ul class="pagination justify-content-center">
        <li class="page-item <?= $activePage <= 1 ? 'disabled' : '' ?>">
          <a class="page-link" href="?action=<?= isset($keyword) ? 'search' : 'list' ?>&page=<?= $activePage - 1 ?><?= isset($keyword) ? '&keyword=' . $keyword : '' ?>">Previous</a>
        </li>
        <?php for ($page = 1; $page <= $totalPage; $page++): ?>
          <li class="page-item <?= $page == $activePage ? 'active' : '' ?>">
            <a class="page-link" href="?action=<?= isset($keyword) ? 'search' : 'list' ?>&page=<?= $page ?><?= isset($keyword) ? '&keyword=' . $keyword : '' ?>"><?= $page ?></a>
          </li>
        <?php endfor; ?>
        <li class="page-item <?= $activePage >= $totalPage ? 'disabled' : '' ?>">
          <a class="page-link" href="?action=<?= isset($keyword) ? 'search' : 'list' ?>&page=<?= $activePage + 1 ?><?= isset($keyword) ? '&keyword=' . $keyword : '' ?>">Next</a>
        </li>
      </ul>
    </nav>
  <?php endif; ?>
</main>

<footer class="bg-dark text-light px-0 py-4 p-sm-4"></footer>
<?php include 'partials/footer.php'; ?>