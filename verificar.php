<?php 
require_once "conexion/conexion.php"; // Aquí se incluye $conn

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nickname'], $_POST['pass'])) {
        $nickname = trim($_POST['nickname']);
        $contraseña = hash('sha512',$_POST['pass']);

        // Preparamos consulta segura con mysqli
        $sql = "SELECT * FROM usuario WHERE nickname = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("s", $nickname);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $user = $result->fetch_assoc();

                if (($contraseña = $user['contraseña'])) {
                    session_start();
                    $_SESSION['estado'] = $user['estado'];
                    $_SESSION['id_usuario'] = $user['id_usuario'];
                    $_SESSION['nickname'] = $user['nickname'];
                    $_SESSION['rol'] = $user['tipo']; // 'tipo' es el nombre real del campo en BD

                    if ($user['tipo'] == 'Administrador') {
                        header("Location: administracion/index.php");
                        exit;
                    } elseif ($user['tipo'] == 'Alumno') {
                        header("Location: pagina-cliente/historial.php");
                        exit;
                    } elseif ($user['tipo'] == 'Kiosko') {
                        header("Location: Diseño-pantalla-tactil/index.php");
                        exit;
                    }
                    else {
                        $error_message = "Rol de usuario no reconocido.";
                    }

                } else {
                    $error_message = "Usuario o contraseña incorrectos.";
                }

            } else {
                $error_message = "Usuario o contraseña incorrectos.";
            }

            $stmt->close();
        } else {
            $error_message = "Error en la preparación de la consulta.";
        }

        $conn->close();
    } else {
        $error_message = "Todos los campos son obligatorios.";
    }
}
?>
