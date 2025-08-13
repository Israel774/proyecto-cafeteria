<?php 
require_once "conexion/conexion.php";
$conn = conectar();
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nickname'], $_POST['pass'])) {
        $nickname = trim($_POST['nickname']);
        $contraseña = hash('sha512', $_POST['pass']);

        $sql = "SELECT * FROM usuario WHERE nickname = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("s", $nickname);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $user = $result->fetch_assoc();

                // Verifica la contraseña correctamente
                if ($contraseña === $user['contraseña']) { 
                    $_SESSION['estado'] = $user['estado'];
                    $_SESSION['id_usuario'] = $user['id_usuario'];
                    $_SESSION['nickname'] = $user['nickname'];
                    $_SESSION['rol'] = $user['tipo'];

                    if ($user['tipo'] == 'Administrador') {
                        header("Location: pagina_administracion.php");
                        exit;
                    } elseif ($user['tipo'] == 'Alumno') {
                        header("Location: pagina-cliente/historial_compras.php");
                        exit;
                    } elseif ($user['tipo'] == 'Kiosko') {
                        header("Location: Diseño-pantalla-tactil/index.php");
                        exit;
                    } else {
                        // En caso de rol no reconocido
                        $_SESSION['error_message'] = "Rol de usuario no reconocido.";
                        header("Location: index.html"); // Redirige a la página de login
                        exit;
                    }
                } else {
                    // En caso de contraseña incorrecta
                    $_SESSION['error_message'] = "Usuario o contraseña incorrectos.";
                    header("Location: index.html"); // Redirige a la página de login
                    exit;
                }
            } else {
                // En caso de usuario no encontrado
                $_SESSION['error_message'] = "Usuario o contraseña incorrectos.";
                header("Location: login.html"); // Redirige a la página de login
                exit;
            }

            $stmt->close();
        } else {
            // En caso de error en la preparación de la consulta
            $_SESSION['error_message'] = "Error en la preparación de la consulta.";
            header("Location: index.html"); // Redirige a la página de login
            exit;
        }

        $conn->close();
    } else {
        // En caso de campos faltantes
        $_SESSION['error_message'] = "Todos los campos son obligatorios.";
        header("Location: index.html"); // Redirige a la página de login
        exit;
    }
} else {
    // Si la solicitud no es POST
    header("Location: index.html");
    exit;
}
?>