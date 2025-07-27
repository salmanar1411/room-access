<?php
    include "connect.php";

    session_start();

    $_SESSION['alert'];

    if (isset($_POST['action'])){
        
        $uid = $_POST['nomor_kartu'];
        $nama = $_POST['nama'];
        $jabatan = $_POST['jabatan'];

        if ($_POST['action'] == 'add'){

            $query = "INSERT INTO user VALUES(null, '$uid','$nama','$jabatan')";
            $sql = mysqli_query($conn, $query);

            if ($sql){
                $_SESSION['alert'] = "added";
                header("Location: index.php");
                exit;
            }
        }
        
        else if ($_POST['action'] == 'save'){

            $id = $_POST['id'];

            $query = "UPDATE user SET uid = '$uid', nama_pengguna = '$nama', jabatan = '$jabatan'  WHERE id = $id";
            $sql = mysqli_query($conn, $query);
            
            if ($sql){
                $_SESSION['alert'] = "edit";
                header("Location: index.php");
                exit;
            }
        }
    }

    if (isset($_GET['delete'])){
        $id = $_GET['delete'];

        $query = "DELETE FROM user WHERE id = $id";
        $sql = mysqli_query($conn, $query);

        if ($sql){
            $_SESSION['alert'] = "removed";
            header("Location: index.php");  
            exit;   
        }
    }
?>