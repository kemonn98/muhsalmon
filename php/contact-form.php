<?php
// Allow cross-origin requests from any domain
header("Access-Control-Allow-Origin: *");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['name-2'];
    $email = $_POST['Email'];

    // Collect the selected services into an array based on "for" attributes
    $selectedServices = [];
    $serviceLabels = [
        'Visual-Identity' => 'Visual Identity',
        'Web-App-Design' => 'Web & App Design',
        'Graphic-Design' => 'Graphic Design',
        'Illustration' => 'Illustration',
        'Motion-Interaction' => 'Motion & Interaction',
        'Icon-Design' => 'Icon Design',
        'Web-Development' => 'Web Development',
        'Other' => 'Other'
    ];

    foreach ($serviceLabels as $label => $serviceName) {
        if (isset($_POST[$label])) {
            $selectedServices[] = $serviceName;
        }
    }

    // Convert the array of selected services into a comma-separated string
    $services = implode(", ", $selectedServices);

    $timeline = $_POST['Timeline'];
    $projectDetails = $_POST['Project-Details'];
    $budget = $_POST['Budget'];

    // Define the recipient email address (your email address)
    $to = "muhsalmon98@gmail.com";
    $from = "admin@muhsalmon.com";

    // Define the subject of the email
    $subject = "Form Submission from $name";

    // Construct the email message with proper line breaks
    $message = "Name: $name\n";
    $message .= "Email: $email\n\n";
    $message .= "Services: $services\n";
    $message .= "Timeline: $timeline\n";
    $message .= "Project Details: $projectDetails\n";
    $message .= "Budget: $budget\n";
 
    // Send the email
    $headers = "From: $from \r\n";
    if (mail($to, $subject, $message, $headers)) {
        echo "Form submitted successfully! The results have been sent to your email.";
    } else {
        echo "Form submission error: Email could not be sent.";
    }
} else {
    // If the form was not submitted via POST, return an error message
    echo "Form submission error: Method not allowed.";
}
?>