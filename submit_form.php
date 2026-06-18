<?php
require 'vendor/autoload.php'; // Include the SendGrid library

//SendGrid API key
$sendgrid = new SendGrid('..');

// Retrieve form data
$title = $_POST['title'];
$name = $_POST['name'];
$age = $_POST['age'];
$gender = $_POST['Gender'];
$number = $_POST['number'];
$email = $_POST['mail'];
$country = $_POST['country'];
$city = $_POST['city'];
$address = $_POST['address'];
$role = $_POST['role'];
$previous_experience = $_POST['previous_experience'];
$motivation = $_POST['motivation'];
$cover_letter = $_POST['cover_letter'];

// File upload handling
$cv = $_FILES['cv'];
$cv_name = $cv['name'];
$cv_tmp_name = $cv['tmp_name'];

// Prepare email content
$email_content = "
    Title: $title
    Full Name: $name
    Date of Birth: $age
    Gender: $gender
    Mobile Number: $number
    Email: $email
    Country: $country
    City: $city
    Address: $address
    Desired Role: $role
    Previous Experience: $previous_experience
    Motivation: $motivation
    Cover Letter: $cover_letter
";

// Prepare the email message
$email = new SendGrid\Mail\Mail();
$email->setFrom("...", "Your Name");
$email->setSubject("New Form Submission");
$email->addTo("...", "Recipient Name");
$email->addContent("text/plain", $email_content);

// Attach the CV file
$file_encoded = base64_encode(file_get_contents($cv_tmp_name));
$email->addAttachment(
    $file_encoded,
    "application/pdf", 
    $cv_name,
    "attachment"
);

// Send the email
try {
    $response = $sendgrid->send($email);
    if ($response->statusCode() == 202) {
        echo '<script>alert("Form submitted successfully!");</script>';
        echo '<script>document.getElementById("form3").reset();</script>'; // Clear the form fields
    } else {
        echo '<script>alert("Failed to submit form. Please try again later.");</script>';
    }
} catch (Exception $e) {
    echo '<script>alert("An error occurred: ' . $e->getMessage() . '");</script>';
}
?>
