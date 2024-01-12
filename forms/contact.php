<?php
  /**
  * Requires the "PHP Email Form" library
  * The "PHP Email Form" library is available only in the pro version of the template
  * The library should be uploaded to: vendor/php-email-form/php-email-form.php
  * For more info and help: https://bootstrapmade.com/php-email-form/
  */

  // Replace contact@example.com with your real receiving email address
  // $receiving_email_address = 'shiferaw83@gmail.com';

  // if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
  //   include( $php_email_form );
  // } else {
  //   die( 'Unable to load the "PHP Email Form" Library!');
  // }

  // $contact = new PHP_Email_Form;
  // $contact->ajax = true;
  
  // $contact->to = $receiving_email_address;
  // $contact->from_name = $_POST['name'];
  // $contact->from_email = $_POST['email'];
  // $contact->subject = $_POST['subject'];

  // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
  /*
  $contact->smtp = array(
    'host' => 'example.com',
    'username' => 'example',
    'password' => 'pass',
    'port' => '587'
  );
  */

//   $contact->add_message( $_POST['name'], 'From');
//   $contact->add_message( $_POST['email'], 'Email');
//   $contact->add_message( $_POST['message'], 'Message', 10);

//   echo $contact->send();
// ?>
<?php
// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Get the form fields and remove whitespace
$name = strip_tags(trim($_POST["name"]));
$email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
$subject = strip_tags(trim($_POST["subject"]));
$message = trim($_POST["message"]);

// Check that data was sent to the mailer
if (empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
// Set a 400 (bad request) response code and exit
https_response_code(400);
echo "Please complete the form and try again.";
exit;
}

// Set the recipient email address
// You can change this to any email address you want
$recipient = "shiferaw83l@gmail.com.com";

// Build the email content
$email_content = "Name: $name\n";
$email_content .= "Email: $email\n\n";
$email_content .= "Subject: $subject\n\n";
$email_content .= "Message:\n$message\n";

// Build the email headers
$email_headers = "From: $name <$email>";

// Send the email
if (mail($recipient, $subject, $email_content, $email_headers)) {
// Set a 200 (okay) response code
https_response_code(200);
echo "Thank you for your message. It has been sent.";
} else {
// Set a 500 (internal server error) response code
https_response_code(500);
echo "Something went wrong and we couldn't send your message.";
}
} else {
// Not a POST request, set a 403 (forbidden) response code
https_response_code(403);
echo "There was a problem with your submission, please try again.";
}
?>
