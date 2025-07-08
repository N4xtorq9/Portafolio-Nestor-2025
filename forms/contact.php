<?php
<?php
// Cambia esto por tu correo
$to = "n4xtor@gmail.com";

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$subject = $_POST['subject'] ?? '';
$message = $_POST['message'] ?? '';

$headers = "From: $name <$email>\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

$body = "Nombre: $name\n";
$body .= "Correo: $email\n";
$body .= "Asunto: $subject\n";
$body .= "Mensaje:\n$message\n";

if (mail($to, $subject, $body, $headers)) {
  echo "OK";
} else {
  http_response_code(500);
  echo "Error al enviar el mensaje. Intenta más tarde.";
}
?>