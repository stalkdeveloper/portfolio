<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $message = $_POST["message"];

        // Set up your email configuration
        $to = "your-email@example.com"; // Change this to your email address
        $subject = "New Contact Form Submission";
        $message_body = "Name: $name\nEmail: $email\nPhone: $phone\nMessage:\n$message";

        // Send the email
        $success = mail($to, $subject, $message_body);

        // Check if the email was sent successfully
        if ($success) {
            echo "Your message has been sent successfully!";
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    } else {
        // If the request method is not POST, redirect back to the contact page
        header("Location: contact.html");
    }
?>
