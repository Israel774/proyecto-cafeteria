<?php
session_start();
header('Content-Type: application/json');

require_once '../../conexion/conexion.php'; 

$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    echo json_encode(['success' => false, 'message' => 'No se recibieron datos.']);
    exit;
}

$conn = conectar();

if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Error de conexión a la base de datos.']);
    exit;
}

try {
    // Iniciar una transacción
    $conn->begin_transaction();

    // Variables de los datos recibidos
    $id_cliente = $data['id_cliente'];
    $totalCompra = $data['total_compra'];
    $carrito = $data['carrito'];
    $fecha_completa = date('Y-m-d H:i:s');
    $fecha_creacion = date('Y-m-d');
    $hora_creacion = date('H:i:s');
    $createBy = $_SESSION['id_usuario'] ?? 1;

    // 1. Obtener el saldo del cliente y el estado del usuario
    $sqlDatos = "SELECT c.saldo, u.estado 
                 FROM clientes c
                 JOIN usuario u ON c.nickname = u.nickname
                 WHERE c.id_cliente = ?";
    $stmtDatos = $conn->prepare($sqlDatos);
    $stmtDatos->bind_param("i", $id_cliente);
    $stmtDatos->execute();
    $resultDatos = $stmtDatos->get_result();
    $datos = $resultDatos->fetch_assoc();
    $stmtDatos->close();

    // Verificar si el cliente existe, está activo y tiene saldo suficiente
    if (!$datos) {
        $conn->rollback();
        echo json_encode(['success' => false, 'message' => 'El cliente no existe o no tiene un usuario asociado.']);
        exit;
    }
    
    if ($datos['estado'] != 'Activo') {
        $conn->rollback();
        echo json_encode(['success' => false, 'message' => 'El usuario no está activo y no puede realizar compras.']);
        exit;
    }

    if ($datos['saldo'] < $totalCompra) {
        $conn->rollback();
        echo json_encode(['success' => false, 'message' => 'Saldo insuficiente para realizar la compra.']);
        exit;
    }

    // 2. Insertar en la tabla de ventas
    $sqlVenta = "INSERT INTO ventas (id_cliente, total_pagado, create_at, createby) VALUES (?, ?, ?, ?)";
    $stmtVenta = $conn->prepare($sqlVenta);
    $stmtVenta->bind_param("idsi", $id_cliente, $totalCompra, $fecha_completa, $createBy);
    $stmtVenta->execute();
    $idVenta = $conn->insert_id;
    $stmtVenta->close();

    // 3. Insertar en la tabla de detalle de ventas y actualizar el stock
    $sqlDetalle = "INSERT INTO detalle_ventas (id_venta, id_producto, cantidad, precio_unitario, subtotal, create_time, create_date) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmtDetalle = $conn->prepare($sqlDetalle);

    $sqlStock = "UPDATE productos SET stock = stock - ? WHERE id_productos = ?";
    $stmtStock = $conn->prepare($sqlStock);

    foreach ($carrito as $producto) {
        $idProducto = $producto['id'];
        $cantidad = $producto['cantidad'];
        $precioUnitario = $producto['precio'];
        $subtotal = $cantidad * $precioUnitario;

        $stmtDetalle->bind_param("iiiddss", $idVenta, $idProducto, $cantidad, $precioUnitario, $subtotal, $hora_creacion, $fecha_creacion);
        $stmtDetalle->execute();
        
        $stmtStock->bind_param("ii", $cantidad, $idProducto);
        $stmtStock->execute();
    }

    $stmtDetalle->close();
    $stmtStock->close();

    // 4. Actualizar el saldo del cliente
    $sqlSaldo = "UPDATE clientes SET saldo = saldo - ? WHERE id_cliente = ?";
    $stmtSaldo = $conn->prepare($sqlSaldo);
    $stmtSaldo->bind_param("di", $totalCompra, $id_cliente);
    $stmtSaldo->execute();
    $stmtSaldo->close();

    // Obtener los datos del cliente para el recibo (opcional, si no se tienen ya)
    $sqlCliente = "SELECT nombre, apellido FROM clientes WHERE id_cliente = ?";
    $stmtCliente = $conn->prepare($sqlCliente);
    $stmtCliente->bind_param("i", $id_cliente);
    $stmtCliente->execute();
    $resultCliente = $stmtCliente->get_result();
    $clienteRecibo = $resultCliente->fetch_assoc();
    $stmtCliente->close();

    // Confirmar la transacción
    $conn->commit();

    // Devolver una respuesta JSON con los datos del recibo
    $recibo = [
        'cliente' => ['nombre' => $clienteRecibo['nombre'], 'apellido' => $clienteRecibo['apellido']],
        'productos' => array_map(function($p) {
            return [
                'nombre' => $p['nombre'],
                'cantidad' => $p['cantidad'],
                'subtotal' => $p['precio'] * $p['cantidad'],
            ];
        }, $carrito),
        'total' => $totalCompra,
    ];

    echo json_encode(['success' => true, 'message' => 'Compra registrada.', 'recibo' => $recibo]);

} catch (Exception $e) {
    // Si algo falla, revertir la transacción
    $conn->rollback();
    echo json_encode(['success' => false, 'message' => 'Error al procesar la compra: ' . $e->getMessage()]);
}

$conn->close();
?>