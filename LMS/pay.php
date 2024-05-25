<?php
// Replace with your database credentials
$servername = "localhost";
$username = "abdelrahman";
$password = "12345";
$dbname = "pay";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentName = $_POST['student-name'];
    $paymentType = $_POST['payment-type'];
    $amount = $_POST['amount'];
    $dueDate = $_POST['due-date'];
    $cardNumber = $_POST['card-number'];
    $expiryDate = $_POST['expiry-date'];
    $cvv = $_POST['cvv'];

    // Depending on the payment type, retrieve additional fields
    $additionalFields = '';
    if ($paymentType === 'scholarship') {
        $scholarshipType = $_POST['scholarship-type'];
        $scholarshipAmount = $_POST['scholarship-amount'];
        $additionalFields = ", scholarship_type='$scholarshipType', scholarship_amount='$scholarshipAmount'";
    } elseif ($paymentType === 'fees') {
        $feeType = $_POST['fee-type'];
        $feeAmount = $_POST['fee-amount'];
        $additionalFields = ", fee_type='$feeType', fee_amount='$feeAmount'";
    } elseif ($paymentType === 'special-cases') {
        $specialCasesReason = $_POST['special-cases-reason'];
        $additionalFields = ", special_cases_reason='$specialCasesReason'";
    }

    $sql = "INSERT INTO pay (student_name, payment_type, amount, due_date, card_number, expiry_date, cvv $additionalFields) VALUES ('$studentName', '$paymentType', '$amount', '$dueDate', '$cardNumber', '$expiryDate', '$cvv' $additionalFields)";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Data inserted successfully.</p>";
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }
}

// Close connection
$conn->close();
?>
