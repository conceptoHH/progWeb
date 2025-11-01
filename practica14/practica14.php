<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// --- Proceso de envío de correo ---
$correo = $_POST['email'];
$nombre = $_POST['nombre'];
$curso = $_POST['conferencia'];

// Validación básica de datos
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    die("Correo electrónico inválido");
}

// Generar folio y guardar en sesión
$folio = mt_rand(100000, 999999);
$_SESSION['folio'] = $folio;
$_SESSION['email'] = $correo;
$_SESSION['nombre'] = $nombre;
$_SESSION['conferencia'] = $curso;

// Configurar y enviar correo
$mail = new PHPMailer(true);

try {
    // Configuración del servidor SMTP
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'molinapasst@gmail.com';
    $mail->Password   = 'mmfx nxqk hgap qvna';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // Remitente y destinatario
    $mail->setFrom('molinapasst@gmail.com', 'Sistema de Registro');
    $mail->addAddress($correo, $nombre);

    // Contenido del correo
    $mail->isHTML(true);
    $mail->Subject = 'Tu codigo de verificacion';
    $mail->Body    = "Hola $nombre,<br><br>Tu codigo de verificacion es: <b>$folio</b>";

    $mail->send();
    echo 'Se ha enviado un código de verificación a tu correo.<br><br>';
    // Mostrar formulario de validación
    echo '<form method="post">
            <input type="number" name="validacion" placeholder="Ingresa el código" required>
            <button type="submit">Validar</button>
            </form>';
} catch (Exception $e) {
    echo "Error al enviar el correo: {$mail->ErrorInfo}";
}
