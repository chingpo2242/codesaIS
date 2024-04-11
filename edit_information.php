<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "paclar";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['edit_information'])) {
    $id = $_POST['id'];

    
    $result = $conn->query("SELECT * FROM information WHERE id = $id");
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
       
      
        echo '<form method="post" action="update_information.php">';
        echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
        echo '<input type="text" name="fullname" value="' . $row['fullname'] . '"><br>';
        echo '<input type="text" name="age" value="' . $row['age'] . '"><br>';
        echo '<input type="text" name="address" value="' . $row['address'] . '"><br>';
        echo '<input type="text" name="contact" value="' . $row['contact'] . '"><br>';
        echo '<button type="submit" name="update_information">Update</button>';
        echo '</form>';
    } else {
        echo 'Information not found.';
    }
}

$conn->close();
?>
