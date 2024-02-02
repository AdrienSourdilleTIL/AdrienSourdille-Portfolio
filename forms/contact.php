<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Replace with your actual receiving email address
    $receiving_email_address = 'adrien.sourdille@theinformationlab.com';

    // Collect form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Validate data (you can add more validation if needed)
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        http_response_code(400);
        echo "Please fill in all the required fields.";
        exit();
    }

    // Create email content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Subject: $subject\n\n";
    $email_content .= "Message:\n$message";

    // Set email headers
    $headers = "From: $email\r\nReply-To: $email";

    // Send email
    if (mail($receiving_email_address, $subject, $email_content, $headers)) {
        http_response_code(200);
        echo "Your message has been sent. Thank you!";
    } else {
        http_response_code(500);
        echo "Oops! Something went wrong and we couldn't send your message.";
    }
} else {
    http_response_code(405);
    echo "Method Not Allowed";
}
?>

