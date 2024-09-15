<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data and sanitize
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars(trim($_POST["phone"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    $errors = [];

    // Validate data
    if (empty($name)) {
        $errors["name"] = ["Name is required."];
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = ["Invalid email address."];
    }
    if (empty($phone)) {
        $errors["phone"] = ["Phone number is required."];
    }
    if (empty($message)) {
        $errors["message"] = ["Message is required."];
    }

    if (!empty($errors)) {
        echo json_encode(["status" => "error", "errors" => $errors]);
        exit;
    }

    $to = "sunnyk.kongu@gmail.com";
    $subject = "New Contact Form Submission";
    $message_body = "Name: $name\nEmail: $email\nPhone: $phone\nMessage:\n$message";
    $headers = "From: $email\r\nReply-To: $email\r\n";

    // Send the email
    if (mail($to, $subject, $message_body, $headers)) {
        echo json_encode(["status" => "success", "message" => "Thank you for your message! I will get back to you soon."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Sorry, something went wrong. Please try again later."]);
    }
} else {
    header("Location: index.html");
}
?>
