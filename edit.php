<?php
    // Menghubungkan ke database crudbasic
    $db = mysqli_connect("localhost", "root", "", "crudbasic");
    // Error handling jika gagal/berhasil menghubungkan ke database
    if(!$db){
        die("Error in db" . mysqli_error($db));
    } else {
        // Mengambil nilai id dengan menggunakan method GET
        $id = $_GET['id'];
        // Mengambil data dari tabel user dengan menggunakan user id tertentu 
        $qry = "SELECT * FROM user WHERE user_id = $id";
        $run = $db->query($qry);
        // Mengecek jumlah baris yang berhasil diambil apakah lebih dari 0
        if($run-> num_rows > 0) {
            // Melakukan perulangan variabel row yang berisi array assosiatif
            while($row = $run->fetch_assoc()){
                $username = $row['user_name'];
                $useremail = $row['user_email'];
                $useraddress = $row['user_address'];
            }
        }
    }
?>

<!-- Menampilkan form edit menggunakan HTML -->
<!DOCTYPE html>
<html>
    <head>
        <title>PHP Crud</title>
    </head>
    <body>
        <!-- Pada bagian input masing-masing diberikan nilai yang didapatkan pada proses sebelumnya -->
        <form action="" method="post">
            <label>Name</label>
            <input type="text" name="name" value="<?php echo $username?>">
            <br><br>
            <label>Email</label>
            <input type="email" name="email" value="<?php echo $useremail?>">
            <br><br>
            <label>Address</label>
            <input type="text" name="address" value="<?php echo $useraddress?>">
            <br><br>
            <input type="submit" name="update" value="Update">
        </form>
</html>

<?php 
    // Melakukan proses update data user ke dalam database
    if(isset($_POST['update'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $address = $_POST['address'];

        $qry = "UPDATE user SET user_name='$name', user_email='$email', user_address='$address' WHERE user_id=$id";
        // Error handling jika query yg digunakan berhasil/gagal untuk melakukan proses update data
        if(mysqli_query($db,$qry)) {
            // redirect method untuk beralih ke halaman user.php
            header('location: user.php');
        }else {
            echo mysqli_error($db);
        }
    }
?>