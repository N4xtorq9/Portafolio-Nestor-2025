<?php
  /**
  * Requires the "PHP Email Form" library
  * The "PHP Email Form" library is available only in the pro version of the template
  * The library should be uploaded to: vendor/php-email-form/php-email-form.php
  * For more info and help: https://bootstrapmade.com/php-email-form/
  */

  // Replace contact@example.com with your real receiving email address
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Aquí puedes procesar los datos, como enviar un correo electrónico
    $to = "n4xtor@gmail.com";
    $subject = "Nuevo mensaje de contacto";
    $body = "Nombre: $name\nEmail: $email\nMensaje: $message";
    mail($to, $subject, $body);

    echo "Mensaje enviado con éxito.";
} else {
    http_response_code(405);
    echo "Método no permitido.";
}
?>
