<?php
  include('../inc/connexion.php');
  include('../inc/function.php');
  session_start();
  $donnes = selectalldepartements($bdd);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/CSS/style.css">
    <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

<body style="background: linear-gradient(120deg, #f8fafc 0%, #e0e7ef 100%); min-height: 100vh;">
<script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <div class="container py-5">
      <nav class="navbar navbar-expand-lg navbar-light bg-white shadow rounded mb-4">
        <div class="container-fluid">
          <a class="navbar-brand fs-2 fw-bold text-primary" href="#">TENJYXHARENA</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active fw-semibold" aria-current="page" href="modal.php?page=accueil">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link fw-semibold" href="modal.php?page=details">Details</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <header class="text-end mb-4">
        <button class="btn btn-outline-primary shadow-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
          <span class="fs-5">🔍 SEARCH</span>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasRightLabel">Search</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <div class="row justify-content-center">
              <div class="col-12 col-md-10 col-lg-8">
                <div class="card shadow border-0 rounded-4 p-4">
                  <form action="traitement_recherche.php" method="get">
                    <input type="hidden" name="numero" value="1">
                    <h5 class="mb-3 text-primary">Deoartment</h5>
                    <select name="department" id="department" class="form-select form-select-lg mb-3 rounded-3" aria-label=".form-select-lg example">
                      <option value="">None</option>
                      <?php while ($data = mysqli_fetch_assoc($donnes)) {?>
                        <option value="<?php echo $data['dept_no']?>"><?php echo $data['dept_name']?></option>
                      <?php }?>
                    </select>
                    <h5 class="mb-3 text-primary">Name Of Employees</h5>
                    <input type="text" name="Employees_name" class="form-control form-control-lg mb-3 rounded-3" placeholder="Nom ou prénom">
                    <div class="row g-3 mb-3">
                      <div class="col-md-6">
                        <label class="form-label">Age min</label>
                        <input type="number" name="age_min" class="form-control rounded-3" min="0" placeholder="Min">
                      </div>
                      <div class="col-md-6">
                        <label class="form-label">Age max</label>
                        <input type="number" name="age_max" class="form-control rounded-3" min="0" placeholder="Max">
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 rounded-3 shadow">Rechercher</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </header>
      <?php 
        $page = $_GET['page'];
        include($page.".php");      
      ?>
    </div>
</body>
</html>