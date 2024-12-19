<?php

$host = "localhost";
$username = "root";
$password = "";
$dbname = "driving";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $age = htmlspecialchars($_POST['age']);
    $phone = htmlspecialchars($_POST['phone']);
    $gender = htmlspecialchars($_POST['gender']);
    $dob = htmlspecialchars($_POST['dob']);
    $address = htmlspecialchars($_POST['address']);
    $testdate = htmlspecialchars($_POST['testdate']);
    
    // Prepare the SQL statement with placeholder values
    $stmt = $conn->prepare("INSERT INTO users (name, email, age, phone, gender, dob, address, testdate) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    
    // Use 's' for string types and 'i' for integer types. If age is an integer, use 'i' for age, else use 's'
    $stmt->bind_param("ssssssss", $name, $email, $age, $phone, $gender, $dob, $address, $testdate);
    
    if ($stmt->execute()) {
        echo "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Form Submitted</title>
            <link rel='stylesheet' href='style.css'>
        </head>
        <body>
            <div class='form-container'>
                <h2>Submission Successful</h2>
                <p><strong>Name:</strong> $name</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Phone:</strong> $phone</p>
                <p><strong>Gender:</strong> $gender</p>
                <p><strong>Date of Birth:</strong> $dob</p>
                <p><strong>Address:</strong> $address</p>
            </div>
        </body>
        </html>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
