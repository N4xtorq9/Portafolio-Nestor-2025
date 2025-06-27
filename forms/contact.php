<?php
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars(trim($_POST["name"] ?? ""));
    $email = htmlspecialchars(trim($_POST["email"] ?? ""));
    $subject = htmlspecialchars(trim($_POST["subject"] ?? ""));
    $message = htmlspecialchars(trim($_POST["message"] ?? ""));

    if (!$name || !$email || !$subject || !$message) {
        echo json_encode(["status" => "error", "message" => "Todos los campos son obligatorios."]);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["status" => "error", "message" => "Correo electrónico no válido."]);
        exit;
    }

    $to = "n4xtor@gmail.com";  // Cambia a tu correo
    $email_subject = "Nuevo mensaje: $subject";
    $email_body = "Nombre: $name\nEmail: $email\nAsunto: $subject\nMensaje:\n$message";
    $headers = "From: no-reply@tudominio.com\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    if (mail($to, $email_subject, $email_body, $headers)) {
        echo json_encode(["status" => "success", "message" => "Mensaje enviado con éxito."]);
    } else {
        echo json_encode(["status" => "error", "message" => "No se pudo enviar el mensaje."]);
    }
} else {
    http_response_code(405);
    echo json_encode(["status" => "error", "message" => "Método no permitido."]);
}
?>
