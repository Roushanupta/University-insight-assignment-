<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(strip_tags($_POST["name"]));
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars(strip_tags($_POST["phone"]));
    $country = htmlspecialchars(strip_tags($_POST["country"]));

    if (empty($name) || empty($email) || empty($phone) || empty($country)) {
        echo json_encode(["status" => "error", "message" => "All fields are required."]);
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["status" => "error", "message" => "Invalid email format."]);
        exit();
    }

    if (!preg_match('/^\d{10}$/', $phone)) {
        echo json_encode(["status" => "error", "message" => "Enter a valid 10-digit phone number."]);
        exit();
    }

    // Store in database (optional) - Example using MySQL
    // $conn = new mysqli("localhost", "username", "password", "database");
    // $stmt = $conn->prepare("INSERT INTO applications (name, email, phone, country) VALUES (?, ?, ?, ?)");
    // $stmt->bind_param("ssss", $name, $email, $phone, $country);
    // $stmt->execute();
    // $stmt->close();
    // $conn->close();

    // Send an email (optional)
    $to = "your-email@example.com"; // Change this to your email
    $subject = "New MBBS Application";
    $message = "Name: $name\nEmail: $email\nPhone: $phone\nPreferred Country: $country";
    $headers = "From: noreply@example.com\r\nReply-To: $email";

    mail($to, $subject, $message, $headers);

    echo json_encode(["status" => "success", "message" => "Application submitted successfully!"]);
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request."]);
}
?>
