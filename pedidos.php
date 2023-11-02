<?php
session_start();

// Inicializa la sesión si no está configurada
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}

// Agregar producto al carrito si se envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $producto = $_POST['producto'];
    $cantidad = (int)$_POST['cantidad'];

    if ($cantidad > 0) {
        $_SESSION['carrito'][] = array('producto' => $producto, 'cantidad' => $cantidad);
    }
}

// Procesar pedido y actualizar el historial
if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
    if (isset($_COOKIE['numero_pedidos'])) {
        $numero_pedidos = $_COOKIE['numero_pedidos'] + 1;
    } else {
        $numero_pedidos = 1;
    }
    $fecha_ultimo_pedido = date('Y-m-d H:i:s');
    setcookie('numero_pedidos', $numero_pedidos, time() + 3600, '/');
    setcookie('fecha_ultimo_pedido', $fecha_ultimo_pedido, time() + 3600, '/');
    // Borra la sesión del carrito
    $_SESSION['carrito'] = array();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos</title>
</head>

<body>
    <h1>Historial de Pedidos</h1>
    <ul>
        <?php
        if (!empty($_SESSION['carrito'])) {
            foreach ($_SESSION['carrito'] as $item) {
                echo "<li>{$item['producto']} - Cantidad: {$item['cantidad']}</li>";
            }
        } else {
            echo "<li>El carrito está vacío.</li>";
        }
        ?>
    </ul>
    <a href="inicio.php">Seguir comprando</a>
    <form action="pedidos.php" method="post">
        <input type="submit" value="Borrar historial">
    </form>
</body>

</html>