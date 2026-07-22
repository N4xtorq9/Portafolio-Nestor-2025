
<?php
// Configuración del correo
$to = "n4xtor@gmail.com";

// Validar que sea una solicitud POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo "Método no permitido";
    exit;
}

// Obtener y validar datos del formulario
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$subject = isset($_POST['subject']) ? trim($_POST['subject']) : '';
$message = isset($_POST['message']) ? trim($_POST['message']) : '';

// Validar que todos los campos estén completos
if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    http_response_code(400);
    echo "Error: Todos los campos son obligatorios.";
    exit;
}

// Validar formato de email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo "Error: El correo electrónico no es válido.";
    exit;
}

// Sanitizar datos para prevenir inyección
$name = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
$email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
$subject = htmlspecialchars($subject, ENT_QUOTES, 'UTF-8');
$message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

// Configurar headers del correo
$headers = "From: " . $name . " <" . $email . ">\r\n";
$headers .= "Reply-To: " . $email . "\r\n";
$headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Construir cuerpo del mensaje
$body = "=== NUEVO MENSAJE DE CONTACTO ===\n\n";
$body .= "Nombre: " . $name . "\n";
$body .= "Correo: " . $email . "\n";
$body .= "Asunto: " . $subject . "\n";
$body .= "Fecha: " . date('Y-m-d H:i:s') . "\n";
$body .= "\n--- MENSAJE ---\n";
$body .= $message . "\n";
$body .= "\n=== FIN DEL MENSAJE ===\n";

// Enviar correo
if (mail($to, "[Portafolio] " . $subject, $body, $headers)) {
    http_response_code(200);
    echo "OK";
} else {
    http_response_code(500);
    echo "Error al enviar el mensaje. Intenta más tarde.";
}
exit;
?>