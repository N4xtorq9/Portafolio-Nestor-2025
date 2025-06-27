<?php
// Verifica que la solicitud sea de tipo POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Recupera y sanitiza los datos del formulario
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Valida campos básicos
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo json_encode([
            "status" => "error",
            "message" => "Por favor, completa todos los campos."
        ]);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode([
            "status" => "error",
            "message" => "El correo proporcionado no es válido."
        ]);
        exit;
    }

    // Configura el correo
    $to = "n4xtor@gmail.com"; // Cambia a tu correo real
    $email_subject = "Nuevo mensaje de contacto: $subject";
    $email_body = "Has recibido un nuevo mensaje de contacto.\n\n" .
                  "Nombre: $name\n" .
                  "Correo: $email\n" .
                  "Asunto: $subject\n" .
                  "Mensaje:\n$message\n";

    // Cabeceras
    $headers = "From: n4xtor@gmail.com\r\n"; // Cambia tudominio.com por el tuyo
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Envía el correo
    if (mail($to, $email_subject, $email_body, $headers)) {
        echo json_encode([
            "status" => "success",
            "message" => "Tu mensaje fue enviado con éxito. ¡Gracias!"
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Hubo un problema al enviar el mensaje. Inténtalo de nuevo."
        ]);
    }

} else {
    // Método no permitido
    http_response_code(405);
    echo json_encode([
        "status" => "error",
        "message" => "Método no permitido."
    ]);
}
?>