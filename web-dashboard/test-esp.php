<?php 
    $host = "192.168.100.13";
    $user = "mavis";
    $pw = "!23Mavis";
    $db = "esp32";

    $conn = mysqli_connect($host, $user, $pw, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_POST['num1']) && isset($_POST['num2'])){
        $num1 = $_POST['num1'];
        $num2 = $_POST['num2'];
        
        $query = "INSERT INTO num (num1, num2) VALUES ($num1, $num2)";
        $sql = mysqli_query($conn, $query);

        echo ($sql)? "Data berhasil disimpan" : "Data gagal disimpan";
    }

    mysqli_close();
?>