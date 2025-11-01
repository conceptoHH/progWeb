<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// --- Validación del folio ---
if (isset($_POST['validacion'])) {
    $folioIngresado = $_POST['validacion'];

    if ($folioIngresado == $_SESSION['folio']) {
        // Recuperar datos de la sesión
        $correo = $_SESSION['email'];
        $nombre = $_SESSION['nombre'];
        $curso = $_SESSION['curso'];
        $folio = $_SESSION['folio'];
        
        // Conexión a la base de datos
        $host = 'localhost';
        $user = 'phpmyadmin';
        $password = 'Admin1234';
        $database = 'CURSOWEB';
        
        $mysqli = new mysqli($host, $user, $password, $database);
        
        if ($mysqli->connect_error) {
            die("Error de conexión: " . $mysqli->connect_error);
        }
        
        // Insertar datos
        $stmt = $mysqli->prepare("INSERT INTO Usuario (nombre, email, curso, folio) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $nombre, $correo, $curso, $folio);
        
        if ($stmt->execute()) {
            // Obtener todos los usuarios registrados
            $result = $mysqli->query("SELECT * FROM Usuario ORDER BY id_usuario ASC");
            
            if ($result->num_rows > 0) {
                echo "<h1>¡Validación exitosa!</h1>";
                echo "<h3>Usuarios registrados:</h3>";
                echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
                echo "<tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Curso</th>
                        <th>Folio</th>
                      </tr>";
                
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>".htmlspecialchars($row['id_usuario'])."</td>
                            <td>".htmlspecialchars($row['nombre'])."</td>
                            <td>".htmlspecialchars($row['email'])."</td>
                            <td>".htmlspecialchars($row['curso'])."</td>
                            <td>".htmlspecialchars($row['folio'])."</td>
                          </tr>";
                }
                
                echo "</table>";
            } else {
                echo "<p>No hay usuarios registrados aún</p>";
            }
        } else {
            echo "Error al registrar: " . $stmt->error;
        }
        
        $stmt->close();
        $mysqli->close();
        exit();
    } else {
        echo "<h1>Código incorrecto</h1>";
        // Mostrar nuevamente el formulario de validación
        echo '<form method="post">
                <input type="number" name="validacion" placeholder="Ingresa el código" required>
                <button type="submit">Validar</button>
              </form>';
        exit();
    }
}

// --- Proceso de envío de correo ---
if (isset($_GET['email']) && isset($_GET['nombre']) && isset($_GET['curso'])) {
    $correo = $_GET['email'];
    $nombre = $_GET['nombre'];
    $curso = $_GET['curso'];

    // Validación básica de datos
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        die("Correo electrónico inválido");
    }

    // Generar folio y guardar en sesión
    $folio = mt_rand(100000, 999999);
    $_SESSION['folio'] = $folio;
    $_SESSION['email'] = $correo;
    $_SESSION['nombre'] = $nombre;
    $_SESSION['curso'] = $curso;

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
} else {
    // Mostrar formulario inicial si no hay datos
    echo '<h2>Formulario de Registro</h2>
          <form method="get">
            <input type="text" name="nombre" placeholder="Nombre" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="text" name="curso" placeholder="Curso" required><br>
            <button type="submit">Enviar</button>
          </form>';
}
