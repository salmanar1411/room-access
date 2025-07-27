<?php
  include "connect.php";

  $uid = '';
  $nama = '';
  $jabatan = '';

  if (isset($_GET['change'] )){

    $id = $_GET['change'];

    $query = "SELECT * FROM user WHERE id=$id";
    $sql = mysqli_query($conn, $query);

    $result = mysqli_fetch_assoc($sql);

    $uid = $result['uid'];
    $nama = $result['nama_pengguna'];
    $jabatan = $result['jabatan'];
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!--Bootstrap Framework-->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script>

    <!--awesome font-->
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    
    <title>Database Doorlock</title>
</head>
<body>
      <!-- NAVIGASI BAR -->
      <nav class="navbar bg-body-tertiary" data-bs-theme="dark">
        <div class="container-fluid d-flex justify-content-center">
          <a class="navbar-brand" href="index.php">
            <!-- <img src="/docs/5.3/assets/brand/bootstrap-logo.svg" alt="Logo" width="30" height="24" class="d-inline-block align-text-top"> -->
            CRUD DATABASE
          </a>
        </div>
      </nav>
      <!-- NAVIGASI BAR -->

    <div class="container mt-4">
        <form method="POST" action="process.php">

          <input type="hidden" name="id" value="<?php echo $id ?>">

          <!-- INPUTAN UNTUK NOMOR KARTU -->
          <div class="mb-3 row">
            <label for="nomorkartu" class="col-sm-2 col-form-label">Nomor Kartu</label>
            <div class="col-sm-10">
              <input type="text" name="nomor_kartu" class="form-control" id="nomorkartu" placeholder="ex: 12345678" value="<?php echo $uid ?>">
            </div>
          </div>
          <!-- INPUTAN UNTUK NOMOR KARTU -->
      
          <!-- INPUTAN UNTUK NAMA PENGGUNA -->
          <div class="mb-3 row">
            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
              <input type="text" name="nama" class="form-control" id="nama" placeholder="ex: Mulyadi" value="<?php echo $nama ?>">
            </div>
          </div>
          <!-- INPUTAN UNTUK NAMA PENGGUNA -->

          <!-- INPUTAN UNTUK JABATAN PENGGUNA -->
          <div class="mb-3 row">
            <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
            <div class="col-sm-10">
              <select id="jabatan" name="jabatan" class="form-select">
                <option value="" <?php echo ($jabatan ==  "") ? "selected" : ""; ?>>Pilih Jabatan Anda</option>
                <option value="Dosen" <?php echo ($jabatan ==  "Dosen") ? "selected" : ""; ?>>Dosen</option>
                <option value="Staff" <?php echo ($jabatan ==  "Staff") ? "selected" : ""; ?>>Staff</option>
                <option value="Mahasiswa/i" <?php echo ($jabatan ==  "Mahasiswa/i") ? "selected" : ""; ?>>Mahasiswa/i</option>
              </select>
            </div>
          </div>
          <!-- INPUTAN UNTUK JABATAN PENGGUNA -->
          
          <!-- KONTROL BUTTON APAKAH ADD ATAU SAVE DATA -->
          <div class="mb-3 row">
              <div class="col">
                  <?php
                      if(isset($_GET['change'])){ 
                  ?>

                      <button id="submitBtn" type="submit" name="action" value="save" class="btn btn-primary">
                          <i class="fa fa-floppy-o" aria-hidden="true"></i>
                          Save Changes
                      </button>
                  
                  <?php
                      } else {
                  ?>
                      <button id="submitBtn" type="submit" name="action" value="add" class="btn btn-primary">
                          <i class="fa fa-floppy-o" aria-hidden="true"></i>
                          Add Data
                      </button>
                  
                  <?php
                      }
                  ?>

                  <a href="index.php" type="button" class="btn btn-danger">
                      <i class="fa fa-step-backward" aria-hidden="true"></i>
                      Cancel
                  </a>
              </div>
          </div>
          <!-- KONTROL BUTTON APAKAH ADD ATAU SAVE DATA -->

        </form>
    </div>

    <script> 
      const jabatanElement = document.getElementById('jabatan');
      const buttonElement = document.getElementById('submitBtn');

      function checkOption() {
        (jabatanElement.value === '') ? buttonElement.disabled = true : buttonElement.disabled = false;
      }

      checkOption();

      jabatanElement.addEventListener('change', checkOption);

    </script>
</body>
</html>