<?php
    // Menghubungkan ke database crudbasic
    $db = mysqli_connect("localhost", "root", "", "crudbasic");
?>

<!-- Menampilkan form insert new data user menggunakan HTML -->
<!DOCTYPE html>
<html>
    <head>
        <title>PHP Crud</title>
    </head>
    <body>
        <form action="" method="post">
            <label>Name</label>
            <input type="text" name="name" placeholder="Enter name">
            <br><br>
            <label>Email</label>
            <input type="email" name="email" placeholder="Enter email">
            <br><br>
            <label>Address</label>
            <input type="text" name="address">
            <br><br>
            <input type="submit" name="submit" value="Submit">
        </form>

        <hr>

<!-- Memanggil data user yang telah tersimpan di dalam database dan menampilkannya ke dalam bentuk tabel -->
        <h3>User List</h3>

        <table style="width:60%" border="1">
            <tr>
                <th>S#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Operations</th>
            </tr>
            <?php
                // Membuat variabel counter
                $i = 1; 
                // Mengambil seluruh data yang ada di dalam variabel user 
                $qry = "SELECT * FROM user";
                $run = $db->query($qry);
                // Mengecek jumlah baris yang berhasil diambil apakah lebih dari 0
                if($run-> num_rows > 0) {
                    // Melakukan perulangan variabel row yang berisi array assosiatif
                    while($row = $run-> fetch_assoc()) { 
                        $id = $row['user_id'];
            ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $row['user_name']; ?></td>
                        <td><?php echo $row['user_email']; ?></td>
                        <td><?php echo $row['user_address']; ?></td>
                        <td>
                            <!-- href xxx.php?id=$id digunakan untuk mengalihkan ke halaman x dengan id tertentu -->
                            <a href="edit.php?id=<?php echo $id ?>">Edit</a> | 
                            <a href="delete.php?id=<?php echo $id ?>" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php }
                } 
            ?>
        </table>
    </body>
</html>

<?php
    // Melakukan proses penginputan/insert data new user ke dalam database
    if(isset($_POST['submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $address = $_POST['address'];

        $qry = "INSERT INTO user VALUE (null, '$name', '$email', '$address')";
        // Erorr handling jika query yg digunakan berhasil/gagal untuk melakukan proses insert data
        if(mysqli_query($db, $qry)) {
            echo '<script>alert("User registered successfuly.");</script>';
            // redirect method untuk beralih ke halaman user.php
            header('location: user.php');
        } else {
            echo mysqli_error($db);
        }
    }

?>