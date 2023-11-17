<?php 
// Create the Transport
$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 587, 'tls')
  ->setUsername('irnovi@horestco.com')
  ->setPassword('wahid@satu@siji')
  ;

// Create the Mailer using your created Transport
$mailer = Swift_Mailer::newInstance($transport);

// Create a message
$message = Swift_Message::newInstance('Wonderful Subject')
  ->setFrom(array('irnovi@horestco.com' => 'John Doe'))
  ->setTo(array('irnovi@horestco.com' => 'Husain'))
  ->setBody(file_get_contents(dirname(__FILE__).'/contents.php'), 'text/html')
  ;

// Send the message
$result = $mailer->send($message);

vd($result);