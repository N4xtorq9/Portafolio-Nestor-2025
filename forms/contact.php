<?php
  /**
  * Requires the "PHP Email Form" library
  * The "PHP Email Form" library is available only in the pro version of the template
  * The library should be uploaded to: vendor/php-email-form/php-email-form.php
  * For more info and help: https://bootstrapmade.com/php-email-form/
  */

  // Replace contact@example.com with your real receiving email address

// Verifica que la solicitud sea de tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera los datos del formulario
    $name = htmlspecialchars($_POST['name']); // Sanitiza el nombre
    $email = htmlspecialchars($_POST['email']); // Sanitiza el correo
    $subject = htmlspecialchars($_POST['subject']); // Sanitiza el asunto
    $message = htmlspecialchars($_POST['message']); // Sanitiza el mensaje

    // Configura el correo electrónico
    $to = "n4xtor@gmail.com"; // Reemplaza con tu dirección de correo
    $email_subject = "Nuevo mensaje de contacto: $subject";
    $email_body = "Has recibido un nuevo mensaje de contacto.\n\n".
                  "Nombre: $name\n".
                  "Correo: $email\n".
                  "Asunto: $subject\n".
                  "Mensaje:\n$message";

    // Cabeceras del correo
    $headers = "From: $email\n";
    $headers .= "Reply-To: $email";

    // Intenta enviar el correo
    if (mail($to, $email_subject, $email_body, $headers)) {
        // Respuesta de éxito (para AJAX o redirección)
        echo json_encode(["status" => "success", "message" => "Tu mensaje fue enviado con éxito. Gracias!"]);
    } else {
        // Respuesta de error
        echo json_encode(["status" => "error", "message" => "Hubo un problema al enviar el mensaje. Inténtalo de nuevo."]);
    }
} else {
    // Si la solicitud no es POST, devuelve un error 405
    http_response_code(405);
    echo json_encode(["status" => "error", "message" => "Método no permitido."]);
}
?>
