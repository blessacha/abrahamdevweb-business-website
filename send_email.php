<?php
require 'vendor/autoload.php';// Include the SendGrid library
// Prepare email content
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $emailAddress = isset($_POST['email']) ? $_POST['email'] : '';
    $Reason = isset($_POST['Reason']) ? $_POST['Reason'] : '';
    $comments = isset($_POST['comments']) ? $_POST['comments'] : '';

    $sendgrid = new \SendGrid('...'); // SendGrid API key
// Prepare the email message
    $email = new \SendGrid\Mail\Mail();
    $email->setFrom("...", "New Message");
    $email->setSubject("New Form Submission from $name");
    $email->addTo("...", "Client");
    $email->addContent("text/plain", "Title: $title\nName: $name\nPhone: $phone\nEmail: $emailAddress \Purpose of Contact: $Reason\nComments: $comments");
    $email->addContent("text/html", "<strong>Title:</strong> $title<br><strong>Name:</strong> $name<br><strong>Phone:</strong> $phone<br><strong>Email:</strong> $emailAddress<br><strong>Purpose of Contact:</strong> $Reason <br><strong>Comments:</strong> $comments");

    try {
        $response = $sendgrid->send($email);
        // Return a JSON response
        echo json_encode(['success' => true, 'message' => 'Thank you for contacting us. Your message has been successfully sent, and we will get back to you as soon as possible.']);
    } catch (Exception $e) {
        // Return a JSON response
        echo json_encode(['success' => false, 'message' => 'Unfortunately, there was an issue sending your message. Please try again later or use alternative contact methods.']);
    }
    exit; // Important to stop further script execution
}
?>,
