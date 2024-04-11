<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Information Form</title>
 
</head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "paclar";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function addInformation($conn, $fullname, $age, $address, $contact) {
   
    if(strlen($age) > 10) { // Adjust the maximum length as per your database schema
        echo "Error: Age is too long.";
        return;
    }
    
    $sql = "INSERT INTO information (fullname, age, address, contact) VALUES ('$fullname', '$age', '$address', '$contact')";
    if ($conn->query($sql) === TRUE) {
        echo "New information added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if(isset($_POST['add_information'])) {
    $fullname = $_POST["fullname"];
    $age = $_POST["age"];
    $address = $_POST["address"];
    $contact = $_POST["contact"];

    addInformation($conn, $fullname, $age, $address, $contact);
    // Redirect to the same page to avoid resubmission
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}
?>

<div class="containers">

    <div class="form-container form-animation">
        <form method="post" action="paclar.php">
            <input type="text" name="fullname" placeholder="FullName"><br>
            <input type="text" name="age" placeholder="Age"><br>
            <input type="text" name="address" placeholder="Address"><br>
            <input type="text" name="contact" placeholder="Contact"><br>
            <button type="submit" name="add
            <button type="submit" name="add_information">Add information</button>
        </form>
    </div>

    <?php
    echo '<div class="table-container table-animation">';
    echo '<table>';
    echo '<tr>';
    echo '<th>FullName</th>';
    echo '<th>Age</th>';
    echo '<th>Address</th>';
    echo '<th>Contact</th>';
    echo '<th>Actions</th>'; 
    echo '</tr>';

    $result = $conn->query("SELECT * FROM information");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['fullname'] . '</td>';
            echo '<td>' . $row['age'] . '</td>';
            echo '<td>' . $row['address'] . '</td>';
            echo '<td>' . $row['contact'] . '</td>';
    

            echo '<td>';
            echo '<form method="post" action="edit_information.php">';
            echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
            echo '<button type="submit" name="edit_information">Edit</button>';
            echo '</form>';
            echo '<form method="post" action="delete_information.php">';
            echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
            echo '<button type="submit" name="delete_information">Delete</button>';
            echo '</form>';
            echo '</td>';
            echo '</tr>';
        }
    }

    echo '</table>';
    echo '</div>';
    ?>
</div>


<?php $conn->close(); ?>
</body>
</html>
