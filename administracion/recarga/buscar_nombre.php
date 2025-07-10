<?php
// buscar_nombre.php - Backend para buscar nombre, apellido y saldo por código de barras

// Asegúrate de que solo se procesen solicitudes POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Incluye el archivo de conexión a la base de datos.
    // ¡AJUSTA ESTA RUTA SEGÚN TU ESTRUCTURA DE CARPETAS!
    require_once '../../conexion/conexion.php'; // Ejemplo: si conexion.php está dos niveles arriba

    // Obtén el código de barras de la solicitud POST.
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);
    $codigobarra = $data['codigobarra'] ?? '';

    // Inicializa el array de respuesta con valores predeterminados
    $response = [
        'nombre'   => 'No encontrado',
        'apellido' => 'No encontrado',
        'saldo'    => 'No encontrado' // O un valor numérico como 0.00
    ];

    if (!empty($codigobarra)) {
        // Accede a la variable de conexión global si tu conexion.php la establece así
        global $conn; 

        if ($conn) {
            // Prepara la sentencia SQL con INNER JOIN para obtener nombre, apellido y saldo
            $sql = "SELECT usuario.nombre, usuario.apellido, clientes.saldo 
                    FROM usuario 
                    INNER JOIN clientes ON usuario.nickname = clientes.nickname 
                    WHERE usuario.codigobarra = ?";
            
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                // Vincula el parámetro del código de barras
                $stmt->bind_param("s", $codigobarra); // "s" indica tipo string

                // Ejecuta la sentencia
                $stmt->execute();

                // Obtiene el resultado
                $result = $stmt->get_result();

                // Verifica si se encontró una fila
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $response['nombre'] = $row['nombre'];
                    $response['apellido'] = $row['apellido'];
                    $response['saldo'] = $row['saldo'];
                }

                // Cierra la sentencia
                $stmt->close();
            } else {
                // Maneja el error de preparación
                $response['nombre'] = 'Error en la preparación de la consulta';
                $response['apellido'] = '';
                $response['saldo'] = '';
                // Puedes registrar el error para depuración: error_log("Failed to prepare statement: " . $conn->error);
            }
            // Cierra la conexión a la base de datos si tu conexion.php no lo maneja automáticamente
            // $conn->close(); // Descomenta si tu conexion.php no cierra la conexión
        } else {
            $response['nombre'] = 'Error de conexión a la base de datos';
            $response['apellido'] = '';
            $response['saldo'] = '';
            // Puedes registrar el error para depuración: error_log("Database connection failed.");
        }
    }

    // Establece el tipo de contenido a JSON
    header('Content-Type: application/json');
    // Permite solicitudes de origen cruzado (CORS) si tu frontend está en un dominio/puerto diferente
    header('Access-Control-Allow-Origin: *'); // Sé más específico en producción si es posible
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');

    // Devuelve la respuesta JSON
    echo json_encode($response);
} else {
    // Si no es una solicitud POST, devuelve un error
    header('HTTP/1.1 405 Method Not Allowed');
    header('Allow: POST');
    echo json_encode(['error' => 'Método no permitido']);
}
?>