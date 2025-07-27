<?php 
    // Koneksi ke database
    $host = "192.168.189.78";
    $user = "mavis";
    $pw = "!23Mavis";
    // $db = "esp32";
    $db = "doorlock";

    $conn = mysqli_connect($host, $user, $pw, $db);

    // Periksa koneksi
    if (!$conn) {
        die(json_encode(["error" => "Connection failed: " . mysqli_connect_error()]));
    }

    // untuk mengecheck apakah kartu sudah terdaftar
    if (isset($_POST['uid'])){

        $uid = $_POST['uid'];

        $query = "SELECT * FROM user WHERE uid='$uid'";
        $sql = mysqli_query($conn, $query);

        $result = mysqli_fetch_assoc($sql);

        if ($result){
            header('Content-type: application/json');
            echo json_encode(["userStatus" => "true"]);
        } else {
            header('Content-type: application/json');
            echo json_encode(["userStatus" => "false"]);
        }

        exit();
    }

    // untuk mendata status kartu terdaftar saat masuk pada table access_log
    if (isset($_GET['tap']) && isset($_GET['uid'])){
        $tapStatus = $_GET['tap'];
        $uid = $_GET['uid'];

        if ($tapStatus == 'masuk'){
            $query1 = "SELECT * FROM user WHERE uid='$uid'";
            $sql1 = mysqli_query($conn, $query1);

            $result1 = mysqli_fetch_assoc($sql1);
            if ($result1){
                $nama = $result1['nama_pengguna'];
            }

            $query2 = "INSERT INTO access_log(uid, nama_pengguna, keterangan) VALUES('$uid', '$nama', '$tapStatus')";
            $sql2 = mysqli_query($conn, $query2);
        }
        else if ($tapStatus == 'keluar'){
            $query1 = "SELECT * FROM access_log WHERE uid='$uid' ORDER BY id DESC LIMIT 1";
            $sql1 = mysqli_query($conn, $query1);

            $result1 = mysqli_fetch_assoc($sql1);

            if ($result1 && $result1['keterangan'] == 'masuk'){
                $nama = $result1['nama_pengguna'];

                $query2 = "INSERT INTO access_log(uid, nama_pengguna, keterangan) VALUES('$uid', '$nama', '$tapStatus')";
                $sql2 = mysqli_query($conn, $query2);
                
                header('Content-type: application/json');
                echo json_encode(['status' => 'accepted']);
            }
            else {
                header('Content-type: application/json');
                echo json_encode(['status' => 'denied']);
            } 
        }
        exit();
    }
    // // Ambil data dari tabel 'num'
    // $query = "SELECT * FROM num"; // Sesuaikan query sesuai kebutuhan
    // $sql = mysqli_query($conn, $query);

    // if ($sql && mysqli_num_rows($sql) > 0) {
    //     $result = mysqli_fetch_assoc($sql);
    //     header('Content-Type: application/json'); // Pastikan format JSON
    //     echo json_encode($result); // Kirim data ke ESP32
    // } else {
    //     // Kirim respons jika data tidak ditemukan
    //     header('Content-Type: application/json');
    //     echo json_encode(["error" => "Data tidak ditemukan"]);
    // }

    // Tutup koneksi database
    mysqli_close($conn);
?>
