<?php
    include 'connect.php';  

    session_start();

    $query = "SELECT * FROM user";
    $sql = mysqli_query($conn, $query);

    // $result = mysqli_fetch_assoc($sql);
    // var_dump($result);
    $num = 0;
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!--Bootstrap Framework-->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    
    <title>Database Doorlock</title>
    <style>
      .bg-dark h3 {
        background-color: #808080;
        border-radius: 5px;
        padding: 10px;
      }

      .bg-dark .user {
        background-color: #545252;
        border-radius: 5px;
        padding: 5px;
      }

      .bg-dark .visitor {
        padding: 5px;
      }
    </style>
</head>
<body>
    <!-- <nav class="navbar" style="background-color: #e3f2fd;"> -->
      <!-- NAVIGASI BAR -->
  <!-- <nav class="navbar bg-body-tertiary" data-bs-theme="dark">
    <div class="container-fluid d-flex justify-content-center">
      <a class="navbar-brand" href="index.php">
        <img src="/docs/5.3/assets/brand/bootstrap-logo.svg" alt="Logo" width="30" height="24" class="d-inline-block align-text-top"> -->
        <!-- CRUD DATABASE
      </a>
    </div>
  </nav> -->

  <div class="d-flex">
    <!-- Sidebar -->
    <nav class="bg-dark text-white p-3" style="width: 300px; height: 100vh;">
        <h3><center>ADMIN</center></h3>
        <ul class="nav flex-column">
            <li class="nav-item user">
                <a class="nav-link text-white" href="index.php">
                  <i class="fa fa-user" aria-hidden="true"></i>
                  Pengguna
                </a>
            </li>
            <li class="nav-item visitor">
                <a class="nav-link text-white" href="visitor.php">
                  <i class="fa fa-users" aria-hidden="true"></i>
                  Pengunjung
                </a>
            </li>
        </ul>
    </nav>


    <!-- NAVIGASI BAR -->
  
    <!-- HEAD DARI TABEL -->
    <div class="container">
      <h1 class="mt-4">Data Kartu Terdaftar</h1>

      <figure>
        <blockquote class="blockquote">
          <p>Berisi Daftar Pengguna Terdaftar.</p>
        </blockquote>
      </figure>

      <a href="control.php" type="button" class="btn btn-primary mb-3 mt-3">
        <i class="fa fa-plus-circle" aria-hidden="true"></i>
        Add Data
      </a>
      <!-- HEAD DARI TABEL -->

      <!-- ALERT -->
      <?php if (isset($_SESSION['alert'])): ?>

        <?php if ($_SESSION['alert'] == "added"):?>
          <div class="alert alert-success" role="alert">
            <i class="fa fa-check-circle" aria-hidden="true"></i>
            Data <strong>Berhasil Ditambahkan</strong>.
          </div>

        <?php elseif ($_SESSION['alert'] == "removed"):?>
          <div class="alert alert-danger" role="alert">
            <i class="fa fa-check-circle" aria-hidden="true"></i>
            Data <strong>Berhasil Dihapus</strong>.
          </div>
        
        <?php elseif ($_SESSION['alert'] == "edit"):?>
          <div class="alert alert-info" role="alert">
            <i class="fa fa-check-circle" aria-hidden="true"></i>
            Data <strong>Berhasil Diedit</strong>.
          </div>

        <?php 
          endif; 
          unset($_SESSION['alert']);
        ?>
      <?php endif; ?>
      <!-- ALERT -->

      <!-- TABEL DAFTAR PENGUNJUNG -->
      <div class="table-responsive">
        <table class="table align-middle table-bordered table-hover">
          <thead>
            <tr>
              <th><center>No.</center></th>
              <th>Nomor Kartu</th>
              <th>Nama</th>
              <th>Jabatan</th>
              <th>Action</th>
              </tr>
          </thead>
          <tbody>

            <!-- PENGAMBILAN DATA DARI MYSQL -->
            <?php
                while($result = mysqli_fetch_assoc($sql)){

            ?>
              <tr>
                <td><center>
                  <?php echo ++$num; ?>
                </center></td>
                <td>
                  <?php echo $result['uid']; ?>
                </td>
                <td>
                  <?php echo $result['nama_pengguna']; ?>
                </td>
                <td>
                  <?php echo $result['jabatan']; ?>
                </td>
                <td>
                  <a href="control.php?change=<?php echo $result['id']; ?>" type="button" class="btn btn-warning">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                  </a>
                  <a href="process.php?delete=<?php echo $result['id']; ?>" type="button" class="btn btn-danger" onClick="return confirm('Are you sure to delete the data???')">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                  </a>
                </td>
              </tr>
            <?php
                }
            ?>

          </tbody>
        </table>
      </div> 
    </div>
  </div>
</body>
</html>