<?php
$id = $_POST['ID'];
$studentName = $_POST['studentName'];
$dob = $_POST['dob'];
$gander = $_POST['gender'];
$grade = $_POST['grade'];
$contactNumber = $_POST['contactNumber'];
$email = $_POST['email'];
$comment = $_POST['comment'];

$connect = new mysqli('localhost', 'abdelrahman', '12345', 'tmatt');
if ($connect->connect_error) {
    die('Connection failed: ' . $connect->connect_error);
} else {
    $stmt = $connect->prepare("INSERT INTO idstudent(id,studentName:,Gender:,Date, Grade, Number,email,Comment) VALUES (, ?,?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssisss", $id,$studentName, $gander,$dob, $grade, $contactNumber, $email, $comment);

    if ($stmt->execute()) {
        echo "Data inserted successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $connect->close();
}
?>
