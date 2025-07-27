<?php
    include 'connect.php';  

    $query = "SELECT * FROM access_log";
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
        padding: 5px;
      }

      .bg-dark .visitor {
        background-color: #545252;
        border-radius: 5px;
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
      <h1 class="mt-4">Data Pengunjung</h1>

      <figure>
        <blockquote class="blockquote">
          <p>Berisi Daftar Pengunjung Ruangan Pribadi.</p>
        </blockquote>
      </figure>
      <!-- HEAD DARI TABEL -->

      <!-- TABEL DAFTAR PENGUNJUNG -->
      <div class="table-responsive">
        <table class="table align-middle table-bordered table-hover">
          <thead>
            <tr>
              <th><center>No.</center></th>
              <th>Nomor Kartu</th>
              <th>Nama</th>
              <th>Waktu</th>
              <th>Keterangan</th>
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
                  <?php echo $result['waktu']; ?>
                </td>
                <td>
                  <?php 
                    if ($result['keterangan'] == "masuk"){
                      echo "<span class='badge text-bg-primary' style='font-size: 15px'>" . $result['keterangan'] . "</span>";
                    } 

                    else if ($result['keterangan'] == "keluar"){
                      echo "<span class='badge text-bg-danger' style='font-size: 15px' >" . $result['keterangan'] . "</span>";
                    } 
                  ?>
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