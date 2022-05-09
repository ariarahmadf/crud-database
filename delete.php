<?php
    // Menghubungkan ke database crudbasic
    $db = mysqli_connect("localhost", "root", "", "crudbasic");
    // Error handling jika gagal menghubungkan ke database
    if(!$db) {
        die('Error in db' . mysqli_error($db));
    }
    // Mengambil nilai id dengan menggunakan method GET
    $id = $_GET['id'];

    $qry = "DELETE FROM user WHERE user_id = $id";
    // Error handling jika query yg digunakan berhasil/gagal untuk melakukan proses update data
    if(mysqli_query($db, $qry)){
        // redirect method untuk beralih ke halaman user.php
        header('location: user.php');
    } else {
        echo mysqli_error($db);
    }
?>