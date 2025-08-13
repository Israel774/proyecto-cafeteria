<?php
header('Content-Type: application/json');

require_once '../../conexion/conexion.php';

$response = ['success' => false, 'message' => ''];
$conn = null;

// LECTURA DE DATOS DESDE EL FLUJO DE ENTRADA JSON
// Reemplaza esto:
// if (isset($_POST['codigobarra']) && !empty($_POST['codigobarra'])) {
//     $codigo_barras = $_POST['codigobarra'];
//
// Con esto:
$data = json_decode(file_get_contents('php://input'), true);

if ($data && isset($data['codigobarra']) && !empty($data['codigobarra'])) {
    $codigo_barras = $data['codigobarra'];

    try {
        $conn = conectar();

        $stmt = $conn->prepare("
            SELECT 
                u.nombre, 
                u.apellido, 
                u.nickname, 
                c.saldo,
                c.id_cliente 
            FROM 
                usuario u
            INNER JOIN 
                clientes c ON u.nickname = c.nickname
            WHERE 
                u.modificacion = ?
            LIMIT 1
        ");

        $stmt->bind_param("s", $codigo_barras);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $response['success'] = true;
            $response['nombre'] = $row['nombre'];
            $response['apellido'] = $row['apellido'];
            $response['nickname'] = $row['nickname'];
            $response['saldo'] = $row['saldo'];
            $response['id_cliente'] = $row['id_cliente'];
        } else {
            $response['message'] = 'Código de barras no encontrado o cliente no registrado.';
        }

        $stmt->close();

    } catch (Exception $e) {
        $response['message'] = 'Error al procesar la solicitud: ' . $e->getMessage();
    }
} else {
    $response['message'] = 'No se proporcionó un código de barras o el formato es incorrecto.';
}

if ($conn) {
    $conn->close();
}

echo json_encode($response);
exit();
?>