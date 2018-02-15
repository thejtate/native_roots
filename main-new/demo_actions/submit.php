<?php
global $config;

$config = array(
  'email' => 'jtate@funneldesigngroup.com',//separate multiple by comma
  'is_smtp' => TRUE,
);

submit_process();

function submit_process() {
  global $config;

  $params = array(
    'first_name' => isset($_POST['first_name']) ? (string) $_POST['first_name'] : '',
    'last_name' => isset($_POST['last_name']) ? (string) $_POST['last_name'] : '',
    'email' => isset($_POST['email']) ? (string) $_POST['email'] : '',
    'type' => isset($_POST['type']) ? (string) $_POST['type'] : '',
  );

  $result = send_mail($config['email'], 'News subscribe submission', mail_body($params));

  $output = array(
    'result' => $result,
    'message' => $result ? 'Thank you for your submission.' : 'Error on sending email.',
  );

  echo json_encode($output);
}

function send_mail($email, $subject, $body) {
  global $config;

  require_once 'PHPMailer/PHPMailerAutoload.php';

  $mail = new PHPMailer;


  if($config['is_smtp']) {
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'funnelstage.mail@gmail.com';                 // SMTP username
    $mail->Password = 'pass4funnel';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;
  }

  $mail->setFrom('no-reply@nativeroots.funnelstagingtoo.com', 'NativeRoots');

  foreach (explode(',', $config['email']) as $mail_address) {
    $mail->addAddress(trim($mail_address));
  }


  $mail->Subject = $subject;
  $mail->Body    = $body;

  return $mail->send();
}

function mail_body($params) {
  $output = '';
  $output .= "News subscriber \n\n";
  $output .= "First name: " . check_plain($params['first_name']) .  " \n";
  $output .= "Last name: " . check_plain($params['last_name']) .  " \n";
  $output .= "Email: " . check_plain($params['email']) .  " \n";
  $output .= !empty($params['type']) ? "Type: " . check_plain($params['type']) .  " \n" : '';
  return $output;
}

function check_plain($text) {
  return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}