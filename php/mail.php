<?php
// Importa PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Cargar el autoload de Composer
require '../vendor/autoload.php'; // Ajusta la ruta según la ubicación de `vendor`

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario y sanitizarlos
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Crear una instancia de PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Cambia esto al servidor SMTP de tu proveedor
        $mail->SMTPAuth = true;
        $mail->Username = 'eternalprometheus21@gmail.com'; // Tu dirección de correo
        $mail->Password = 'K*Uwfj@5'; // Contraseña del correo o contraseña de aplicación
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587; // Puerto SMTP

        // Configuración del correo
        $mail->setFrom($email, $name); // Remitente
        $mail->addAddress('ofrancohead@gmail.com'); // Destinatario

        // Asunto y cuerpo del mensaje
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = "<h3>Mensaje de: $name</h3><p>Email: $email</p><p>Mensaje: $message</p>";
        $mail->AltBody = "Mensaje de: $name\nEmail: $email\nMensaje: $message";

        // Enviar el correo
        if ($mail->send()) {
            echo "Mensaje enviado con éxito.";
        } else {
            echo "Error al enviar el mensaje.";
        }
    } catch (Exception $e) {
        echo "Error al enviar el mensaje. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>