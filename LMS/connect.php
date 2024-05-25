<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $senderName = $_POST["senderName"];
    $senderEmail = $_POST["senderEmail"];
    $message = $_POST["message"];

    // Validate form data
    if (empty($senderName) || empty($senderEmail) || empty($message)) {
        echo "All fields are required";
    } else {
        // Connect to your MySQL database using MySQLi (object-oriented style)
        $servername = "your_database_host";
        $username = "your_database_username";
        $password = "your_database_password";
        $dbname = "your_database_name";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and execute the SQL query with prepared statements
        $sql = "INSERT INTO messages (senderName, senderEmail, message) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Bind parameters and execute the statement
        $stmt->bind_param("sss", $senderName, $senderEmail, $message);

        if ($stmt->execute()) {
            echo "Message stored successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close the statement and the database connection
        $stmt->close();
        $conn->close();
    }
}
?>