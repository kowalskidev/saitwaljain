<?php

$errors = [];
$errorMessage = '';

if (!empty($_POST)) {
   $name = $_POST['name'];
   $email = $_POST['email'];
   $message = $_POST['message'];

   if (empty($name)) {
       $errors[] = 'Name is empty';
   }

   if (empty($email)) {
       $errors[] = 'Email is empty';
   } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $errors[] = 'Email is invalid';
   }

   if (empty($message)) {
       $errors[] = 'Message is empty';
   }

   if (empty($errors)) {
    $toEmail = 'contact@saitwaljain.com';
    $emailSubject = 'New message from your website visitor';
    $headers = ['From' => 'no-reply@saitwaljain.com', 'Reply-To' => $email, 'Content-type' => 'text/html; charset=utf-8'];
    $bodyParagraphs = ["Name: {$name}", "Email: {$email}", "Message:", $message];
    $body = join(PHP_EOL, $bodyParagraphs);

    if (mail($toEmail, $emailSubject, $body, $headers)) {
        $message = '<p> Thank you for contacting us! We will get back to you soon. </p>';
    } else {
        $message = '<p> Oops, something went wrong. Please try again later </p>';
    }

} else {

    $allErrors = join('<br/>', $errors);
    $message = "<p style='color: red;'>{$allErrors}</p>";
}

    }    
?>