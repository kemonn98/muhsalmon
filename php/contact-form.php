<?php
// Allow cross-origin requests from any domain
header("Access-Control-Allow-Origin: *");
header("Content-Type: text/plain");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data with proper validation
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $services = isset($_POST['services']) ? trim($_POST['services']) : '';
    $budget = isset($_POST['budget']) ? trim($_POST['budget']) : '';
    $timeline = isset($_POST['timeline']) ? trim($_POST['timeline']) : '';
    $message = isset($_POST['message']) ? trim($_POST['message']) : '';

    // Basic validation
    if (empty($name) || empty($email) || empty($message)) {
        echo "Please fill in all required fields.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Please enter a valid email address.";
        exit;
    }

    // Map service values to readable names
    $serviceLabels = [
        'visual-branding' => 'Visual Branding',
        'ui-ux' => 'UI/UX Design',
        'web-development' => 'Web Development',
        'graphic-design' => 'Graphic Design',
        'motion-graphics' => 'Motion Graphics',
        'other' => 'Other'
    ];

    $serviceName = isset($serviceLabels[$services]) ? $serviceLabels[$services] : $services;

    // Map budget values to readable names
    $budgetLabels = [
        'under-1k' => 'Under $1,000',
        '1k-5k' => '$1,000 - $5,000',
        '5k-10k' => '$5,000 - $10,000',
        '10k-25k' => '$10,000 - $25,000',
        'over-25k' => 'Over $25,000'
    ];

    $budgetName = isset($budgetLabels[$budget]) ? $budgetLabels[$budget] : $budget;

    // Map timeline values to readable names
    $timelineLabels = [
        'asap' => 'ASAP',
        '1-2-weeks' => '1-2 weeks',
        '1-month' => '1 month',
        '2-3-months' => '2-3 months',
        'flexible' => 'Flexible'
    ];

    $timelineName = isset($timelineLabels[$timeline]) ? $timelineLabels[$timeline] : $timeline;

    // Define the recipient email address
    $to = "muhsalmon98@gmail.com";
    $from = "noreply@muhsalmon.com";

    // Define the subject of the email
    $subject = "New Contact Form Submission from $name";

    // Construct the email message with proper formatting
    $emailMessage = "New contact form submission from your portfolio website:\n\n";
    $emailMessage .= "Name: $name\n";
    $emailMessage .= "Email: $email\n";
    $emailMessage .= "Services: " . ($serviceName ?: 'Not specified') . "\n";
    $emailMessage .= "Budget: " . ($budgetName ?: 'Not specified') . "\n";
    $emailMessage .= "Timeline: " . ($timelineName ?: 'Not specified') . "\n";
    $emailMessage .= "Message:\n$message\n\n";
    $emailMessage .= "---\n";
    $emailMessage .= "Sent from: " . $_SERVER['HTTP_HOST'] . "\n";
    $emailMessage .= "IP Address: " . $_SERVER['REMOTE_ADDR'] . "\n";
    $emailMessage .= "Date: " . date('Y-m-d H:i:s');

    // Set headers for the email
    $headers = "From: $from\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";

    // Send the email
    if (mail($to, $subject, $emailMessage, $headers)) {
        echo "Form submitted successfully! The results have been sent to your email.";
    } else {
        echo "Form submission error: Email could not be sent. Please try again or contact me directly at muhsalmon98@gmail.com";
    }
} else {
    // If the form was not submitted via POST, return an error message
    echo "Form submission error: Method not allowed.";
}
?>